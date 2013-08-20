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
function display_tasks ($callback = '')
{
	global $config;
	global $couch;
	
	$resp = $couch->send("GET", "/_active_tasks");
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 200;
	$obj->url = $url;
	$obj->tasks = $response_obj;

	api_output($obj, $callback);
}



//--------------------------------------------------------------------------------------------------
function main()
{
	//print_r($_GET);
	
	$callback = '';
	$handled = false;
	
	/*
	// If no query parameters 
	if (count($_GET) == 0)
	{
		default_display();
		exit(0);
	}
	*/
	
	if (isset($_GET['callback']))
	{	
		$callback = $_GET['callback'];
	}
	
	if (!$handled)
	{
		display_tasks($callback);
		$handled = true;
	}	

}



main();

?>
