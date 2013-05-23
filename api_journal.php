<?php

// journal

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');

//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
// One journal (ISSN)
function display_issn ($issn, $callback = '')
{
	global $config;
	global $couch;
	
	$couch_id = 'issn/' . $issn;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		$obj = json_decode($resp);
		$obj->status = 200;
	}

	api_output($obj, $callback);
}	

//--------------------------------------------------------------------------------------------------
// One journal (OCLC)
function display_oclc ($oclc, $callback = '')
{
	global $config;
	global $couch;
	
	
	$couch_id = 'oclc/' . $oclc;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		$obj = json_decode($resp);
		$obj->status = 200;
	}

	api_output($obj, $callback);
}	

/*
// Articles in a given year and volume in a journal
function display_issn_decade_volumes ($issn, $year, $volume, $callback = '')

	global $config;
	global $couch;
	
				$startkey = array($issn, (Integer)$decade, (Integer)$year, $volume->volume);
				$endkey = array($issn, (Integer)$decade, (Integer)$year, $volume->volume, new stdclass);


function display_articles
*/

//--------------------------------------------------------------------------------------------------
// Journal articles in a given volume
function display_articles_year_volume ($namespace, $value, $year, $volume, $callback = '')
{
	global $config;
	global $couch;
	
	
	$decade = floor($year/10) * 10;
	
	switch ($namespace)
	{
		case 'oclc':
			$startkey = array((Integer)$value, $decade, (Integer)$year, $volume);
			$endkey = array((Integer)$value, $decade, (Integer)$year, $volume, new stdclass);

			$url = '_design/oclc/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&reduce=false&include_docs=true';
			break;
			
		case 'issn':
		default:
			$startkey = array($value, $decade, (Integer)$year, $volume);
			$endkey = array($value, $decade, (Integer)$year, $volume, new stdclass);
			$url = '_design/issn/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&reduce=false&include_docs=true';
			break;			
	}
	
	
	/*
	$startkey = array($issn, $decade, (Integer)$year, $volume);
	$endkey = array($issn, $decade, (Integer)$year, $volume, new stdclass);
	$url = '_design/issn/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&reduce=false'; // &include_docs=true';
	*/
	//echo $url;
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	
	//print_r($response_obj);
	
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
			
			// group into decades	
			$obj->articles = array();
			foreach ($response_obj->rows as $row)
			{
				//$obj->articles[] = $row->doc;
				$obj->articles[] = $row->id;
			}	
						
			
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// All articles in a journal
function display_articles ($namespace, $value, $fields=array('all'), $callback = '')
{
	global $config;
	global $couch;
	
	
	switch ($namespace)
	{
		case 'oclc':
			$url = '_design/oclc/_view/articles?startkey=' . json_encode($value);
			break;
			
		case 'issn':
		default:
			$url = '_design/issn/_view/articles?startkey=' . json_encode($value);
			break;			
	}
	
	$include_docs = true;
	
	if ($include_docs)
	{
		$url .= '&include_docs=true';
	}
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	
	//print_r($response_obj);
	
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
			
			$obj->articles = array();
			foreach ($response_obj->rows as $row)
			{
				if ($include_docs)
				{
					$document = $row->doc;
					$year = null;
					if ($document->year)
					{
						$year = $document->year;
					}
					$document = api_get_document_simplified($row->id, $fields);
					if ($document)
					{
						$obj->years[$year][$row->id] = $document;
					}			
				
					$obj->articles[] = $document;
				}
				else
				{
					$obj->articles[] = $row->value;				
				}
			}	
						
			
		}
	}
	
	api_output($obj, $callback);
}



//--------------------------------------------------------------------------------------------------
// Journal volumes clustered by decade
function display_article_decade_volumes ($namespace, $value, $callback = '')
{
	global $config;
	global $couch;
	
	
	switch ($namespace)
	{
		case 'oclc':
			$startkey = array((Integer)$value);
			$endkey = array((Integer)$value, new stdclass);

			$url = '_design/oclc/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&group_level=4';
			break;
			
		case 'issn':
		default:
			$startkey = array($value);
			$endkey = array($value, new stdclass);
		
			$url = '_design/issn/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&group_level=4';
			break;			
	}
	
	/*
	$startkey = array($issn);
	$endkey = array($issn, new stdclass);
	
	$url = '_design/issn/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&group_level=4';
	*/
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	
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
			
			// group into decades	
			$obj->decades = array();
			foreach ($response_obj->rows as $row)
			{
				if (!isset($obj->decades[$row->key[1]]))
				{
					$obj->decades[$row->key[1]] = array();
				}
		
				if (!isset($obj->decades[$row->key[1]][$row->key[2]]))
				{
					$obj->decades[$row->key[1]][$row->key[2]] = array();
				}
				
				$volume = new stdclass;
				$volume->volume = $row->key[3];
				$volume->count = $row->value;
				$obj->decades[$row->key[1]][$row->key[2]][] = $volume;
			}	
			
			
			
			
			
		}
	}
	
	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Status of article identifiers for a journal
function display_article_identifiers ($namespace, $value, $callback = '')
{
	global $config;
	global $couch;
	
		
	$startkey = array($value);
	$endkey = array($value, new stdclass);
	
	switch ($namespace)
	{
		case 'oclc':
			$startkey = array((Integer)$value);
			$endkey = array((Integer)$value, new stdclass);

			$url = '_design/oclc/_view/identifier?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey);
			break;
			
		case 'issn':
		default:
			$startkey = array($value);
			$endkey = array($value, new stdclass);
		
			$url = '_design/issn/_view/identifier?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey);
			break;			
	}
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
			
	
	//echo $url;
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	
	//print_r($response_obj);
	
	
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
			
			// group into years	
			$obj->years = array();
			foreach ($response_obj->rows as $row)
			{
				if (!isset($obj->years[$row->key[1]]))
				{
					$obj->years[$row->key[1]] = array();
				}
				
				$identifiers = array();
				foreach ($row->value as $identifier)
				{
					$identifiers[] = $identifier;
				}
				$obj->years[$row->key[1]][$row->id] = $identifiers;
			}	
			
			
			
			
			
		}
	}
	
	api_output($obj, $callback);
	
}

//--------------------------------------------------------------------------------------------------
// Articles per journal
function display_article_count ($namespace, $callback = '')
{
	global $config;
	global $couch;
	
	
	switch ($namespace)
	{
		case 'oclc':
			$url = '_design/oclc/_view/count?group_level=2';
			break;
			
		case 'issn':
		default:
			$url = '_design/issn/_view/count?group_level=2';
			break;
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
			
			// group into years	
			$obj->journals = array();
			foreach ($response_obj->rows as $row)
			{
				switch ($namespace)
				{
					case 'oclc':
						$oclc = $row->key[0];
						if (!isset($obj->journals[$oclc]))
						{
							$obj->journals[$oclc] = new stdclass;
							$obj->journals[$oclc]->count = 0;
							$obj->journals[$oclc]->name = $row->key[1];					
						}
						$obj->journals[$oclc]->count += $row->value;
						break;
						
					case 'issn':
					default:
						$issn = $row->key[0];
						if (!isset($obj->journals[$issn]))
						{
							$obj->journals[$issn] = new stdclass;
							$obj->journals[$issn]->count = 0;
							$obj->journals[$issn]->name = $row->key[1];					
						}
						$obj->journals[$issn]->count += $row->value;
						break;
				}
			}	
		}
	}
	
	api_output($obj, $callback);
	
}


//--------------------------------------------------------------------------------------------------
// Geometry of articles
function display_article_geometry($namespace, $value, $callback = '')
{
	global $config;
	global $couch;
	
	
	switch ($namespace)
	{
		case 'oclc':
			$url = '_design/oclc/_view/points?key="' . $value . '"';
			break;
			
		case 'issn':
		default:
			$url = '_design/issn/_view/points?key="' . $value . '"';
			break;
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
			
			// group into years	
			$obj->coordinates = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->coordinates[] = $row->value;
			}	
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
	
	// Optional fields to include
	$fields = array('all');
	if (isset($_GET['fields']))
	{	
		$field_string = $_GET['fields'];
		$fields = explode(",", $field_string);
	}
	
	
	if (!$handled)
	{
		// OCLC
		if (isset($_GET['oclc']))
		{	
			$oclc = $_GET['oclc'];
			
			if (!$handled)
			{
				if (isset($_GET['volumes']))
				{
					display_article_decade_volumes('oclc', $oclc, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{
				if (isset($_GET['volume']) && isset($_GET['year']))
				{
					$year = $_GET['year'];
					$volume = $_GET['volume'];
					display_articles_year_volume('oclc', $oclc, $year, $volume, $callback);
					$handled = true;
				}	
			}
			
			
			if (!$handled)
			{
				if (isset($_GET['articles']))
				{
					if (isset($_GET['identifiers']))
					{
						display_article_identifiers('oclc', $oclc, $callback);
						$handled = true;
					}			
				
					if (!$handled)
					{
						display_articles('oclc', $oclc, $fields, $callback);
						$handled = true;
					}
				}			
			}
			
			if (!$handled)
			{
				if (isset($_GET['geometry']) )
				{
					display_article_geometry('oclc', $oclc, $callback);
					$handled = true;
				}			
			}
			
						
			if (!$handled)
			{
				if (isset($_GET['count']) )
				{
					display_article_count('oclc', $callback);
					$handled = true;
				}			
			}
			
			
			if (!$handled)
			{
				display_oclc($oclc, $callback);
				$handled = true;			
			}
			
		}
		
	
		// ISSN	
		if (isset($_GET['issn']))
		{	
			$issn = $_GET['issn'];
			
			if (!$handled)
			{
				if (isset($_GET['volumes']))
				{
					display_article_decade_volumes('issn', $issn, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{
				if (isset($_GET['volume']) && isset($_GET['year']))
				{
					$year = $_GET['year'];
					$volume = $_GET['volume'];
					display_articles_year_volume('issn', $issn, $year, $volume, $callback);
					$handled = true;
				}	
			}
			
			if (!$handled)
			{
				if (isset($_GET['articles']))
				{
					if (isset($_GET['identifiers']))
					{
						display_article_identifiers('issn', $issn, $callback);
						$handled = true;
					}			
				
					if (!$handled)
					{
						display_articles('issn', $issn, $fields, $callback);
						$handled = true;
					}
				}			
			}
			
			if (!$handled)
			{
				if (isset($_GET['geometry']) )
				{
					display_article_geometry('issn', $issn, $callback);
					$handled = true;
				}			
			}
			
						
			if (!$handled)
			{
				if (isset($_GET['count']) )
				{
					display_article_count('issn', $callback);
					$handled = true;
				}			
			}
			
				
			
			if (!$handled)
			{
				display_issn($issn, $callback);
				$handled = true;			
			}
			
		}
		

	}

	




}



main();

?>
