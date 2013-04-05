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
// One journal
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
function display_articles_year_volume ($issn, $year, $volume, $callback = '')
{
	global $config;
	global $couch;
	
	$decade = floor($year/10) * 10;
	
	$startkey = array($issn, $decade, (Integer)$year, $volume);
	$endkey = array($issn, $decade, (Integer)$year, $volume, new stdclass);
	$url = '_design/issn/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&reduce=false&include_docs=true';
	
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
			
			// group into decades	
			$obj->articles = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->articles[] = $row->doc;
			}	
						
			
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// All articles in a journal
function display_articles ($issn, $fields=array('all'), $callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/issn/_view/articles?key=' . json_encode($issn);
	
	$include_docs = true;
	
	if ($include_docs)
	{
		$url .= '&include_docs=true';
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
function display_issn_decade_volumes ($issn, $callback = '')
{
	global $config;
	global $couch;
	
	$startkey = array($issn);
	$endkey = array($issn, new stdclass);
	
	$url = '_design/issn/_view/year?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&group_level=4';
	
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
function display_issn_identifiers ($issn, $callback = '')
{
	global $config;
	global $couch;
	
	$startkey = array($issn);
	$endkey = array($issn, new stdclass);
	
	$url = '_design/issn/_view/identifier?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey);
	
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
function display_issn_count ($callback = '')
{
	global $config;
	global $couch;
	
	
	$url = '_design/issn/_view/count?group_level=2';
	
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
				$issn = $row->key[0];
				if (!isset($obj->journals[$issn]))
				{
					$obj->journals[$issn] = new stdclass;
					$obj->journals[$issn]->count = 0;
					$obj->journals[$issn]->name = $row->key[1];					
				}
				$obj->journals[$issn]->count += $row->value;
			}	
		}
	}
	
	api_output($obj, $callback);
	
}


//--------------------------------------------------------------------------------------------------
// Geometry of articles
function display_issn_geometry($issn, $callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/issn/_view/points?key="' . $issn . '"';
	
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
		
		if (isset($_GET['issn']))
		{	
			$issn = $_GET['issn'];
			
			if (!$handled)
			{
				if (isset($_GET['volumes']))
				{
					display_issn_decade_volumes($issn, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{
				if (isset($_GET['volume']) && isset($_GET['year']))
				{
					$year = $_GET['year'];
					$volume = $_GET['volume'];
					display_articles_year_volume($issn, $year, $volume, $callback);
					$handled = true;
				}	
			}
			
			if (!$handled)
			{
				if (isset($_GET['articles']))
				{
					if (isset($_GET['identifiers']))
					{
						display_issn_identifiers($issn, $callback);
						$handled = true;
					}			
				
					if (!$handled)
					{
						display_articles($issn, $fields, $callback);
						$handled = true;
					}
				}			
			}
			
			if (!$handled)
			{
				if (isset($_GET['geometry']) )
				{
					display_issn_geometry($issn, $callback);
					$handled = true;
				}			
			}
			
						
			if (!$handled)
			{
				if (isset($_GET['count']) )
				{
					display_issn_count($callback);
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
