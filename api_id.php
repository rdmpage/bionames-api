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
// One item (of any kind)
function display_record ($id, $callback = '')
{
	global $config;
	global $couch;
	
	// grab JSON from CouchDB
	$couch_id = $id;
		
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
// Display thumbnail image
function display_thumbnail_image ($id, $callback = '')
{
	global $config;
	global $couch;
	
	// grab JSON from CouchDB
	$couch_id = $id;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	$found = false;
	
	if (isset($response_obj->thumbnail))
	{
		$image = $response_obj->thumbnail;
		if (preg_match('/^data:(?<mime>image\/.*);base64/', $image, $m))
		{
			$found = true;
			header("Content-type: " . $m['mime']);
			header("Cache-control: max-age=3600");
			$image = preg_replace('/^data:(?<mime>image\/.*);base64/', '', $image);
			echo base64_decode($image);
		}
	}
	
	if (!$found)
	{
		header('HTTP/1.1 404 Not Found');
	}
}

//--------------------------------------------------------------------------------------------------
// Display information on thumbnail
function display_thumbnail ($id, $callback = '')
{
	global $config;
	global $couch;
	
	// grab JSON from CouchDB
	$couch_id = $id;	
	
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
		if (isset($response_obj->thumbnail))
		{
			$obj->thumbnail_url = 'id/' . $id . '/thumbnail/image';
			$obj->status = 200;
		}
	}


	if ($status == 404)
	{
		header('HTTP/1.1 404 Not Found');
	}	
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// One item in a given namespace
function display_record_namespace ($id, $namespace, $callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/identifier/_view/' . $namespace . '?key=' . urlencode('"' . $id . '"') . '&include_docs=true';
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
		
	//echo $url;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);

	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
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
			$obj = $response_obj->rows[0]->doc;
			$obj->status = 200;
		}
	}


	if ($status == 404)
	{
		header('HTTP/1.1 404 Not Found');
	}	
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
function display_namespace_count ($namespace, $callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/count/_view/identifier?key=' . urlencode('"' . $namespace . '"') . '&reduce=true';
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
		
	//echo $url;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	header("Content-type: text/plain");
	echo json_format($resp);
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
		
	// Show record based on identifier in a given namespace
	if (isset($_GET['count']) && isset($_GET['namespace']))
	{	
		$namespace = $_GET['namespace'];
		display_namespace_count($namespace, $callback);
		$handled = true;
	}				
	
	if (!$handled)
	{
		// If show a single record
		if (isset($_GET['id']))
		{	
			$id = $_GET['id'];
	
			// Thumbnail image 
			if (isset($_GET['id']) && isset($_GET['thumbnail']))
			{	
				$id = $_GET['id'];
				
				if (isset($_GET['image']))
				{
					display_thumbnail_image($id, $callback);
					$handled = true;
				}
				
				if (!$handled)
				{
					display_thumbnail($id, $callback);
					$handled = true;
				}					
			}					
	
			// Show record based on identifier in a given namespace
			if (isset($_GET['id']) && isset($_GET['namespace']))
			{	
				$id = $_GET['id'];
				$namespace = $_GET['namespace'];
				display_record_namespace($id, $namespace, $callback);
				$handled = true;
			}				
			
			if (!$handled)
			{
				display_record($id, $callback);
				$handled = true;
			}
		}

	}

	




}



main();

?>
