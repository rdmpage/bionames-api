<?php

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');


//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}


//--------------------------------------------------------------------------------------------------
// Set of names that share the same lastname
function display_lastname ($lastname, $callback = '')
{
	global $config;
	global $couch;
	
	$startkey = array($lastname);
	$endkey = array($lastname, "香");
	
	$url = '_design/author/_view/lastname_firstname?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&group_level=2';
	
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
			$obj->firstnames = array();
			foreach ($response_obj->rows as $row)
			{
				/*
				$lastname = $row->key[0];
				if (!isset($obj->names[$lastname]))
				{
					$obj->names[$lastname] = array();
				}
				$obj->names[$lastname][] = $row->key[1];
				*/
				$obj->firstnames[] = $row->key[1];
			}
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Publications authored
function display_authored ($name, $fields=array('all'), $callback = '', $include_docs = false)
{
	global $config;
	global $couch;
		
	$url = '_design/author/_view/name?key=' . urlencode(json_encode($name));
	
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
			$obj->publications = array();
			foreach ($response_obj->rows as $row)
			{
				if ($include_docs)
				{
					$document = api_simplify_document($row->doc, $fields);
					$obj->publications[] = $document;
					//$obj->publications[] = $row->doc;
				}
				else
				{
					$obj->publications[] = $row->value;				
				}
			}
		}
	}
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Taxa authored in publications
function taxa_published ($publication)
{
	global $config;
	global $couch;


	$names = array();

	$url = '_design/publication/_view/names_published?key=' . urlencode('"' . $publication . '"');
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}		
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);

	$response_obj = json_decode($resp);
	
	if (!isset($response_obj->error))
	{
		foreach ($response_obj->rows as $row)
		{
			$names[] = $row->value;				
		}
	}	
		
	return $names;
}


//--------------------------------------------------------------------------------------------------
// Taxa authored
function display_taxa_authored ($name, $callback = '')
{
	global $config;
	global $couch;
		
	// Get list of publications	
	$url = '_design/author/_view/name?key=' . urlencode(json_encode($name));
	
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
			$obj->names = array();
			
			$publications = array();
			
			
			foreach ($response_obj->rows as $row)
			{
				$obj->names = array_merge($obj->names, taxa_published($row->value));
			}
			
			$keys = array();
			foreach ($obj->names as $name)
			{
				$keys[] = $name->nameComplete;
			}
			array_multisort($obj->names, SORT_ASC, SORT_NUMERIC, $keys);
			
			
			
			// sort alphabetically
			//sort($obj->names);

		}
	}
	
	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Publications authored grouped by year (support timelines)
function display_authored_years ($name, $callback = '')
{
	global $config;
	global $couch;
		
	$startkey = array($name);
	$endkey = array($name, new stdclass);
	$url = '_design/author/_view/year?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&group_level=2';
	
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
			$obj->years = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->years[$row->key[1]] = $row->value;				
			}
		}
	}
	
	//print_r($obj);
	
	api_output($obj, $callback);

}

//--------------------------------------------------------------------------------------------------
// Coauthors
function display_coauthors ($name, $callback = '')
{
	global $config;
	global $couch;
		
	$startkey = array($name);
	$endkey = array($name, new stdclass);
	$url = '_design/author/_view/coauthor?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&group_level=2';
			
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
			
	//echo $url;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
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
			$obj->coauthors = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->coauthors[] = $row->key[1];
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
		if (isset($_GET['lastname']))
		{	
			$lastname = $_GET['lastname'];
	
			// show author(s) with a last name
			display_lastname($lastname, $callback);
		}
		
		if (isset($_GET['name']) && isset($_GET['coauthors']))
		{	
			$name = $_GET['name'];
			
			//if (isset($
	
			// show author(s) with a last name
			display_coauthors($name, $callback);
		}
		
		
		if (isset($_GET['name']) && isset($_GET['publications']))
		{	
			$name = $_GET['name'];
			
			if (!$handled)
			{			
				if (isset($_GET['years']))
				{
					display_authored_years($name, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{			
				if (isset($_GET['taxa']))
				{
					display_taxa_authored($name, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{			
				// show publications
				display_authored($name, $fields, $callback,$include_docs);
				$handled = true;
			}
		}
		

	}

	




}



main();

?>
