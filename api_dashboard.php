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
// Identifiers
function display_identifier_count ($callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/count/_view/identifier?reduce=true&group_level=1';
	
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
		$obj = json_decode($resp);
		$obj->status = 200;
	}

	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Links
function display_link_count ($callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/count/_view/link?reduce=true&group_level=1';
	
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
		$obj = json_decode($resp);
		$obj->status = 200;
	}

	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Links
function display_document_count ($callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/count/_view/document?reduce=true&group_level=1';
	
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
		$obj = json_decode($resp);
		$obj->status = 200;
	}

	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Journals
function display_issn_count ($callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/issn/_view/count?group_level=2';
	
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
		$obj->status = 200;
		$obj->children = array();
		
		foreach ($response_obj->rows as $row)
		{
			$c = new stdclass;
			$c->name = $row->key[1];
			$c->issn = $row->key[0];
			$c->value=$row->value;
			
			$obj->children[] = $c;
		}	
		
		
	}

	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Publishers
function display_publisher_count ($callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/publication/_view/publisher?group_level=1';
	
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
		$obj->status = 200;
		$obj->children = array();
		
		foreach ($response_obj->rows as $row)
		{
			$c = new stdclass;
			$c->name = $row->key;
			$c->value=$row->value;
			
			$obj->children[] = $c;
		}	
		
		
	}

	api_output($obj, $callback);
}



//--------------------------------------------------------------------------------------------------
function main()
{
	//print_r($_GET);
	
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
	
	if (!$handled)
	{
		if (isset($_GET['identifiers']))
		{	
			display_identifier_count($callback);
			$handled = true;
		}	
		if (isset($_GET['links']))
		{	
			display_link_count($callback);
			$handled = true;
		}	
		if (isset($_GET['documents']))
		{	
			display_document_count($callback);
			$handled = true;
		}	
		if (isset($_GET['issn']))
		{	
			display_issn_count($callback);
			$handled = true;
		}	
		if (isset($_GET['publishers']))
		{	
			display_publisher_count($callback);
			$handled = true;
		}	
		

	}

}



main();

?>
