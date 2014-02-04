<?php


require_once(dirname(__FILE__) . '/fingerprint.php');
require_once(dirname(__FILE__) . '/lcs2.php');
require_once(dirname(__FILE__) . '/lib.php');
require_once(dirname(__FILE__) . '/reference.php');

//--------------------------------------------------------------------------------------------------
// Use content negotian and citeproc, may fail with some DOIs
// e.g. [14/12/2012 12:52] curl --proxy wwwcache.gla.ac.uk:8080 -D - -L -H   "Accept: application/citeproc+json;q=1.0" "http://dx.doi.org/10.1080/03946975.2000.10531130" 
function get_doi_metadata($doi)
{
	$reference = null;
	
	$url = 'http://data.crossref.org/' . $doi;
	$json = get($url, '', "application/citeproc+json;q=1.0");
	
	
	if ($json == '')
	{
		return $reference;
	}
	
	$citeproc = json_decode($json);

	if ($citeproc == null)
	{
		return $reference;
	}
		
	$reference = new stdclass;
	$reference->type = 'generic';
	
	$crossref = new stdclass;
	$crossref->time = date(DATE_ISO8601, time());
	$crossref->url = 'http://dx.doi.org/' . $doi;
	$reference->provenance['crossref'] = $crossref;
		
	$reference->title = $citeproc->title;
	if ($reference->title != '')
	{
		// clean
		$reference->title = strip_tags($reference->title);
		
		$reference->title = preg_replace('/\s\s+/u', ' ', $reference->title);
		$reference->title = preg_replace('/^\s+/u', '', $reference->title);
		$reference->title = preg_replace('/\s+$/u', '', $reference->title);
		
	}
	
	$reference->identifier = array();
	$identifier = new stdclass;
	$identifier->type = 'doi';
	$identifier->id = $citeproc->DOI;
	$reference->identifier[] = $identifier;
	
	if ($citeproc->type == 'article-journal')
	{
		$reference->type = 'article';
		$reference->journal = new stdclass;
		$reference->journal->name = $citeproc->{'container-title'};
		$reference->journal->volume = $citeproc->volume;
		if ($citeproc->issue)
		{
			$reference->journal->issue = $citeproc->issue;
		}
		$reference->journal->pages = $citeproc->page;
		
		if (preg_match('/--/', $reference->journal->pages))
		{
		}
		else
		{
			$reference->journal->pages = str_replace('-', '--', $reference->journal->pages);
		}
		
	}

	if ($citeproc->issued->{'date-parts'})
	{
		$reference->year = $citeproc->issued->{'date-parts'}[0][0];
	}
	else
	{
		if (isset($citeproc->issued->raw))
		{
			if (preg_match('/^[0-9]{4}$/', $citeproc->issued->raw))
			{
				$reference->year = $citeproc->issued->raw;
			}
		}
	}
	$reference->issued = $citeproc->issued;
	
	if (isset($citeproc->publisher))
	{
		$reference->publisher = $citeproc->publisher;
	}
	
	if (isset($citeproc->author))
	{
		$reference->author = array();
		foreach ($citeproc->author as $a)
		{
			// clean up name
			$author = new stdclass;
			
			if (isset($a->literal))
			{
				if (preg_match('/^(?<lastname>.*),\s+(?<firstname>.*)$/Uu', $a->literal, $m))
				{
					$author->firstname = $m['firstname'];
					$author->lastname = $m['lastname'];
					$author->name = $author->firstname . ' ' . $author->lastname;
				}
				else
				{
					$author->name = $a->literal;
				}
			}
			else
			{
				if (isset($a->given))
				{			
					$author->firstname = $a->given;
					
					// Initials without space (try and catch long names that are all capitals by ignoring names > 3 characters)
					if (preg_match('/^[A-Z]+$/', $a->given) && (strlen($a->given) < 3))
					{
						$initials = str_split($a->given);
						$author->firstname = join(' ', $initials);						
					}					
					
					$author->firstname = preg_replace('/\.([A-Z])/Uu', ' $1', $author->firstname);
					$author->firstname = preg_replace('/\./Uu', '', $author->firstname);
					$author->firstname = mb_convert_case($author->firstname, MB_CASE_TITLE, 'UTF-8');
					$author->lastname = mb_convert_case($a->family, MB_CASE_TITLE, 'UTF-8');
					$author->name = $author->firstname . ' ' . $author->lastname;
				}
			}
			$reference->author[] = $author;
		}
	}
	return $reference;
}


//--------------------------------------------------------------------------------------------------
// Use search API
function search_crossref(&$reference)
{
	global $config;
	
	$match = false;
	
	$citation = '(' . $reference->year . ') ' . $reference->title . '. ' . $reference->journal->name . ', ' . $reference->journal->volume . ': ' . str_replace('--', '-', $reference->journal->pages);
	
	// remove any existing DOI
	unset($reference->doi);
	
	$post_data = array();
	$post_data[] = $citation;
	
	$ch = curl_init(); 
	
	$url = 'http://search.labs.crossref.org/links';
	
	curl_setopt ($ch, CURLOPT_URL, $url); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 

	// Set HTTP headers
	$headers = array();
	$headers[] = 'Content-type: application/json'; // we are sending JSON
	
	// Override Expect: 100-continue header (may cause problems with HTTP proxies
	// http://the-stickman.com/web-development/php-and-curl-disabling-100-continue-header/
	$headers[] = 'Expect:'; 
	curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
	
	if ($config['proxy_name'] != '')
	{
		curl_setopt($ch, CURLOPT_PROXY, $config['proxy_name'] . ':' . $config['proxy_port']);
	}

	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
	
	$response = curl_exec($ch);
	
	//echo $response;
	
	$obj = json_decode($response);
	if (count($obj->results) == 1)
	{
		if ($obj->results[0]->match)
		{
			$match = false;
			
			$obj->results[0]->doi = str_replace('http://dx.doi.org/', '', $obj->results[0]->doi);
			
			$double_check = true;
			
			if ($double_check)
			{
				$threshold = 0.9;
				
				$actual_reference = get_doi_metadata($obj->results[0]->doi);
				if ($actual_reference)
				{
					$match = true;
					
					// criteria
					if (0)
					{
						echo '<pre>';
						print_r($actual_reference);
						echo '</pre>';
						echo '<pre>';
						print_r($reference);
						echo '</pre>';
					}
					
					$v1 = '';
					$v2  ='';
					
					if (isset($actual_reference->title) && isset($reference->title))
					{
					
						$v1 = finger_print($actual_reference->title);
						$v2 = finger_print($reference->title);
					}
					else
					{
						$v1 = reference_to_citation_string($actual_reference);
						$v2 = $reference->citation;
						
						$v1 = finger_print($v1);
						$v2 = finger_print($v2);					
					}
					
					if (($v1 != '') && ($v2 != ''))
					{
						//echo $v1 . '<br/>';
						//echo $v2 . '<br/>';
						
						$lcs = new LongestCommonSequence($v1, $v2);
						$d = $lcs->score();
						
						//echo $d;
						
						$score = min($d / strlen($v1), $d / strlen($v2));
						
						if ($score >= $threshold)
						{
							// ok
						}
						else
						{
							$match = false;
						}
					}
				}
			}			
		}
	}



	if ($match)
	{
		// check if we already have a DOI
		$have = false;
		foreach ($reference->identifier as $i)
		{
			if ($i->type == 'doi')
			{
				$have = true;
			}
		}
		if (!$have)
		{
			$identifier->type = 'doi';
			$identifier->id = $obj->results[0]->doi;
			$reference->identifier[] = $identifier;
		}
	}


	return $match;	
}


function main()
{
	$postdata = file_get_contents("php://input");
	
	if ($postdata != '')
	{
		$reference = json_decode($postdata);
		
		$identifiers = reference_identifiers($reference);
		$have_doi = isset($identifiers['doi']);
		
		if (!$have_doi)
		{
			search_crossref($reference);
			$have_doi = isset($identifiers['doi']);
		}
		
		if (1)
		{
			$openurl = reference_to_openurl($reference);
			
			$json = get('http://bionames.org/api/openurl?' . $openurl);
			$result = json_decode($json);
			
			//echo $result;
			
			if (count($result->results) != 0)
			{
				if ($result->results[0]->match)
				{
					// Add BioNames identifier to make this linkable
					$reference->_id = $result->results[0]->reference->_id;
					
					// Image if we have it
					if (isset($result->results[0]->reference->thumbnail))
					{
						$reference->thumbnail = $result->results[0]->reference->thumbnail;
					}
				
					// add other identifiers
					if (isset($result->results[0]->reference->identifier))
					{
						foreach ($result->results[0]->reference->identifier as $identifier)
						{
							switch ($identifier->type)
							{
								case 'doi':
									// check if we already have a DOI
									$have = false;
									foreach ($reference->identifier as $i)
									{
										if ($i->type == 'doi')
										{
											$have = true;
										}
									}
									if (!$have)
									{
										$reference->identifier[]  = $identifier;
									}
									break;
									
								default:
									$reference->identifier[]  = $identifier;
									break;
							}
						}
					}
					
				}
			}			
		}
		
		echo json_encode($reference);
		
	}
}


main();

?>