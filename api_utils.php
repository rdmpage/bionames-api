<?php

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

//--------------------------------------------------------------------------------------------------
function api_output($obj, $callback)
{
	if ($obj->status == 404)
	{
		header('HTTP/1.1 404 Not Found');
	}
	
	header("Content-type: text/plain");
	
	if ($callback != '')
	{
		echo $callback . '(';
	}
	echo json_format(json_encode($obj));
	if ($callback != '')
	{
		echo ')';
	}
}

//--------------------------------------------------------------------------------------------------
// One item (of any kind)
function api_get_document ($id)
{
	global $config;
	global $couch;
	
	$document = null;
	
	// grab JSON from CouchDB
	$couch_id = $id;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	if (isset($response_obj->error))
	{
	}
	else
	{
		$document = json_decode($resp);
	}

	return $document;
}

//--------------------------------------------------------------------------------------------------
// One item (of any kind)
function api_get_document_simplified ($id)
{
	global $config;
	global $couch;
	
	$document = null;
	
	// grab JSON from CouchDB
	$couch_id = $id;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	if (isset($response_obj->error))
	{
	}
	else
	{
		$document = json_decode($resp);
		
		// simplify
		
		if (isset($document->thumbnail))
		{
			unset($document->thumbnail);
			$document->thumbnail_url = 'id/' . $id . '/thumbnail/image';
		}
		if (isset($document->names))
		{
			unset($document->names);
		}
		if (isset($document->geometrey))
		{
			unset($document->geometrey);
		}
		
		
	}

	return $document;
}


?>