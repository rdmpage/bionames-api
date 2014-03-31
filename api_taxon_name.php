<?php

// Taxon name

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');

//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
function clusters_with_name($name, $callback = '')
{
	global $config;
	global $couch;
		
	$include_docs = true;
	
	$url = '_design/taxonName/_view/nameString?key=' . urlencode(json_encode($name));
	
	if ($include_docs)
	{
		$url .= '&include_docs=true';
	}
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	//echo $url;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->clusters = array();
			foreach ($response_obj->rows as $row)
			{
				if ($include_docs)
				{
					$obj->clusters[] = $row->doc;
				}
				else
				{
					$obj->clusters[] = $row->value;				
				}
			}
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Unsorted array of publications containing a name
// Question is how scalable this is if we return documents as well as ids?
function publications_with_name_simple($name, $fields=array('all'), $callback = '', $include_docs = false)
{
	global $config;
	global $couch;
	
	// Names listed as "tags" of articles
	
	$startkey = array($name);
	$endkey = array($name, new stdclass);
	$url = '_design/publication/_view/tags?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&reduce=false';
			
	
	/*
	if ($include_docs)
	{
		$url .= '&include_docs=true';
	}
	*/
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	//echo $url;
	
	//exit();
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->publications = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->publications[] = $row->value;				
			}
		}
	}
	
	// names published
	$url = '_design/publication/_view/names?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&reduce=false';
		
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	//echo $url;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	$response_obj = json_decode($resp);
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
		}
		else
		{	
			unset ($obj->error);
			$obj->status = 200;

			foreach ($response_obj->rows as $row)
			{
				$obj->publications[] = $row->value;				
			}
		}
	}
	
	$obj->publications = array_unique($obj->publications);
	
	// Fill out if wanted
	if ($include_docs)
	{
		$documents = array();
		foreach ($obj->publications as $id)
		{
			$documents[] = api_get_document_simplified($id, $fields);
		}
		$obj->publications = $documents;
	}
	
	//print_r($obj->publications);
	
	
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Question is how scalable this is if we return documents as well as ids?
function publications_with_name($name, $year = '', $fields=array('all'), $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;
	
	// Names listed as "tags" of articles
	
	if ($year == '')
	{
		$startkey = array($name);
		$endkey = array($name, new stdclass);
	}
	else
	{
		$startkey = array($name, $year);
		$endkey = array($name, $year);
	}
	
	$url = '_design/publication/_view/tags?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&reduce=false';
	
	$include_docs = true;
	$include_docs = false;
	
	//$url = '_design/publication/_view/tags?key=' . urlencode(json_encode($name));
	
	if ($include_docs)
	{
		$url .= '&include_docs=true';
	}
	
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	//echo $url;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->years = array();
			foreach ($response_obj->rows as $row)
			{
				if (!isset($obj->years[$row->key[1]]))
				{
					$obj->years[$row->key[1]] = array();
				}
				
			
				if ($include_docs)
				{
					$obj->years[$row->key[1]][$row->id] = $row->doc;
				}
				else
				{
					$obj->years[$row->key[1]][] = $row->value;				
				}
				
			}
		}
	}
	
	//print_r($obj);
	
	// Names published by a publication	
	if ($year == '')
	{
		$startkey = array($name);
		$endkey = array($name, new stdclass);
	}
	else
	{
		$startkey = array($name, $year);
		$endkey = array($name, $year);
	}
	
	
	$url = '_design/publication/_view/names?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&reduce=false';
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
		}
		else
		{	
			unset ($obj->error);
			$obj->status = 200;

			foreach ($response_obj->rows as $row)
			{
				if (!isset($obj->years[$row->key[1]]))
				{
					$obj->years[$row->key[1]] = array();
				}
				$obj->years[$row->key[1]][] = $row->value;				
			}
		}
	}
	
	if (isset($obj->years))
	{
		// remove duplicates
		$keys = array();
		$years = array();
		foreach ($obj->years as $k => $v)
		{
			$keys[] = $k;
			$years[$k] = array_unique($obj->years[$k]);
		}
		
		// sort by year
		sort($keys);
		$obj->years = array();
		foreach ($keys as $year)
		{
			if (1)
			{
				foreach ($years[$year] as $id)
				{
					$document = api_get_document_simplified($id, $fields);
					if ($document)
					{
						$obj->years[$year][$id] = $document;
					}			
				}
			}
			else
			{
				$obj->years[$year] = $years[$year];
			}
		}
	}
	
	/*
	// populate
	foreach ($keys as $year)
	{
		foreach ($obj->years[$year] as $k => $v)
		{
			$document = api_get_document($v);
			if ($document)
			{
				$obj->years[$year][$v] = $document;
				unset($obj->years[$year][$k]);
			}
		}
	}
	*/
	
	
	
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// may return less than limit as we filter duplicate names
function name_suggest($name, $limit = 5, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;
	
	$url = "/_design/taxonName/_view/nameString?startkey=" . urlencode('"' . $name . '"') . "&endkey=" . urlencode('"' . $name . '\u9999"') . "&limit=$limit";
		
	//echo $url;
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->suggestions = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->suggestions[] = $row->key;
			}
			
			$obj->suggestions = array_values(array_unique($obj->suggestions));
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Names that share same epithet and author (handy for searching for possible synonyms)
function name_same_epithet_author($epithet, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;
	
	$url = "/_design/taxonName/_view/epithet_author?key=" . urlencode('"' . $epithet . '"');
		
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->names = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->names[] = $row->value;
			}
			
			$obj->names = array_values(array_unique($obj->names));
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Names that are "related" e.g. possible synonyms
function name_related($name, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;
	
	// BHL page co-occurrence
	$url = "/_design/bhl/_view/epithet?key=" . urlencode(json_encode($name));
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->related = array();
			foreach ($response_obj->rows as $row)
			{
				//$obj->related[] = $row->value->name;
				$obj->related[] = $row->value[0];
			}
			
			$obj->related = array_values(array_unique($obj->related));
		}
	}
		
	// Names that one or more classifications say are synonyms
	$url = "/_design/classification/_view/synonyms?key=" . urlencode(json_encode($name));
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	/*$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;	
	$obj->related = array();*/
	
	$response_obj = json_decode($resp);
		
	if (isset($response_obj->error))
	{
		//$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
		}
		else
		{	
			$obj->status = 200;
			unset($obj->error);
			if (!isset($obj->related))
			{
				$obj->related = array();
			}
			foreach ($response_obj->rows as $row)
			{
				$obj->related[] = $row->value;
			}
		}
	}
	
	// Use search index to get other possible variants of a multinomial name
	
	if (preg_match('/\w+\s+\w+/', $name))
	{
		$to_do[] = $name;
			
		while (count($to_do) > 0)
		{	
			//echo "To do\n";
			//print_r($to_do);
			
			$string = array_pop($to_do);
			
			// parse
			$parts = explode(' ', $string);
			if (count($parts) == 3)
			{
				// First and last (e.g., ignore subgenus, promote subspecies)
				$query = $parts[0] . ' ' . $parts[2];
				if (!in_array($query, $to_do) && !in_array($query, $obj->related))
				{
					$to_do[] = $query;
				}
				
				// Promote subgenus species
				if (preg_match('/\w+ \(\w+\) \w+/', $string))
				{
					$query = $parts[1] . ' ' . $parts[2];
					$query = preg_replace('/\(/', '', $query);
					$query = preg_replace('/\)/', '', $query);
					if (!in_array($query, $to_do) && !in_array($query, $obj->related))
					{
						$to_do[] = $query;
					}
				}
				
			}
			
			$url = '_design/search/_view/short?key=' . urlencode(json_encode($string));
		
			$url .= '&stale=ok';
		
			$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
		
			$response_obj = json_decode($resp);
		
			//print_r($response_obj);
			
			foreach ($response_obj->rows as $row)
			{
				if ($row->value->type == 'nameCluster')
				{
					$obj->related[] = $row->value->term;
					if (!in_array($row->value->term, $to_do) && !in_array($row->value->term, $obj->related))
					{
						$to_do[] = $row->value->term;
					}
				}			
			}
		}
	}
	
	// Remove duplicates
	$obj->related = array_unique($obj->related);
	
	// Make sure this name isn't in list of "related" names
	if (isset($obj->related))
	{
		// http://stackoverflow.com/a/8135667/9684
		$key = array_search($name,$obj->related);
		if($key!==false){
    		unset($obj->related[$key]);
		}
	}
	
	// Ensure array is list of values without keys
	$obj->related = array_values($obj->related);
	
	if (count($obj->related) > 0)
	{
		$obj->status = 200;
	}
	
	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Return taxon concepts that include this name (by identifier)
function name_to_concept($id, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;
	
	$url = "/_design/classification/_view/name_to_concept?key=" . urlencode('"' . $id . '"');
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->concepts = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->concepts[] = $row->value;
			}
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Return taxon concepts that include this name (by name)
function namestring_to_concept($name, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;
	
	$url = "/_design/classification/_view/namestring_to_concept?key=" . urlencode(json_encode($name));
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	$include_docs = true;
	
	if ($include_docs)
	{
		$url .= '&include_docs=true';
	}
	
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			$obj->concepts = array();
			foreach ($response_obj->rows as $row)
			{
				if ($include_docs)
				{
					$obj->concepts[] = $row->doc;
				}
				else
				{
					$obj->concepts[] = $row->value;				
				}
			}
		}
	}
	
	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Return species names associated with this genus
function species_for_genus($name, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;
	
	$startkey = array($name);
	$endkey = array($name, new stdclass);
	$url = '_design/genus/_view/species_year?start_key=' . urlencode(json_encode($startkey)) . '&end_key=' . urlencode(json_encode($endkey));
		
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	$obj->url = $url;
	
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			$obj->error = 'Not found';
		}
		else
		{	
			$obj->status = 200;
			
			$obj->species = array();
			
			$years = array();
			foreach ($response_obj->rows as $row)
			{
				$years[] = $row->key[1];
				
				$species = new stdclass;
				$species->id = $row->id;
				$species->name = $row->value;
				$species->year = $row->key[1];
				
				$obj->species[] = $species;
			}
			
			
			// sort
			array_multisort($years, SORT_DESC, $obj->species);
			
		}
	}
	
	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Return names that resemble query string
function name_did_you_mean($name, $callback = '')
{
	global $config;
	
	$obj = new stdclass;
	$obj->status = 404;
	
	$cmd = $config['simstring'] . ' -d ' . $config['simstring_db'] . ' -t 0.75 cosine';
	
	$descriptorspec = array(
	   0 => array("pipe", "r"),
	   1 => array("pipe", "w")
	);
	
	$process = proc_open($cmd, $descriptorspec, $pipes);
	
	if (is_resource($process)) {
		fwrite($pipes[0], $name . "\n"); // NOTE: add \n to end of string!
		fclose($pipes[0]);
	
		$output = stream_get_contents($pipes[1]);
		fclose($pipes[1]);
	
		$return_value = proc_close($process);
		
		
		if ($return_value == 0)
		{
			$obj->status = 200;
			
			// clean
			$lines = explode("\n", $output);
			
			$hits = array();
			foreach ($lines as $line)
			{
				if (preg_match('/^\s+/', $line))
				{
					$hits[] = trim($line);
				}
			}
			$hits = array_unique($hits);
			
			//print_r($hits);
			//print_r(array($name));
			
			
			
			
			$candidates = array_values(array_diff($hits, array($name)));
			
			$distances = array();
			foreach ($candidates as $candidate)
			{
				$distances[$candidate] = levenshtein($name, $candidate);
			}			
			$scores = array_values($distances);

			array_multisort($distances, SORT_ASC, SORT_NUMERIC, $scores);

			$obj->names = array_keys($distances);
			
		}
	}
	api_output($obj, $callback);
}



//--------------------------------------------------------------------------------------------------
function main()
{
	$callback = '';
	$handled = false;
	
	// If no query parameters 
	if (count($_GET) == 0)
	{
		default_display();
		exit(0);
	}
	
	if (isset($_GET['callback']))
	{	
		$callback = $_GET['callback'];
	}
	
	$include_docs = false;
	if (isset($_GET['include_docs']))
	{	
		$include_docs = true;
	}
	
	
	// Optional fields to include
	$fields = array('all');
	if (isset($_GET['fields']))
	{	
		$field_string = $_GET['fields'];
		$fields = explode(",", $field_string);
	}
	
	
	if (!$handled)
	{
	
	
		// Queries based on identifier
		if (isset($_GET['id']))
		{	
			$id = $_GET['id'];

			if (!$handled)
			{
				if (isset($_GET['concepts']))
				{	
					name_to_concept($id, $callback);
					$handled = true;
				}
			}
		}
			

		// Queries based on name string	
		if (isset($_GET['name']))
		{	
			$name = $_GET['name'];
			
			if (!$handled)
			{
				if (isset($_GET['concepts']))
				{	
					namestring_to_concept($name, $callback);
					$handled = true;
				}
			}

			if (!$handled)
			{
				if (isset($_GET['species']))
				{	
					species_for_genus($name, $callback);
					$handled = true;
				}
			}
			
			
			if (!$handled)
			{
				if (isset($_GET['publications']))
				{	
					$year = '';
					if (isset($_GET['year']))
					{
						$year = $_GET['year'];
						publications_with_name($name, $year, $fields, $callback);
						$handled = true;
					}
					
					if (!$handled)
					{
						publications_with_name_simple($name, $fields, $callback, $include_docs);
						$handled = true;
					}
					
				}
			}
			
			if (!$handled)
			{
				if (isset($_GET['suggestions']))
				{	
					name_suggest($name, 5, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{
				if (isset($_GET['related']))
				{	
					name_related($name, $callback);
					$handled = true;
				}
			}

			if (!$handled)
			{
				if (isset($_GET['epithet']))
				{	
					name_same_epithet_author($name, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{
				if (isset($_GET['didyoumean']))
				{	
					name_did_you_mean($name, $callback);
					$handled = true;
				}
			}
			
			
			if (!$handled)
			{
				// show clusters for this name
				clusters_with_name($name, $callback);
				$handled = true;
			}
		}
	}

}



main();

?>
