<?php

// Views (HTML)

require_once (dirname(__FILE__) . '/couchsimple.php');

//--------------------------------------------------------------------------------------------------
function get_view($id)
{
	global $config;
	global $couch;
	
	$html = '';
	
	$url = '_design/html/_show/object/' . $id;
		
	$html = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	return $html;
}

//--------------------------------------------------------------------------------------------------
function main()
{
	$id = $_GET['id'];
	
	$html = get_view($id);
	
	//header("Content-type: text/xml;charset=utf-8");
	header("Content-type: text/html;charset=utf-8");
	echo $html;
}

main();

?>