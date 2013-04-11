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
// One taxon concept
function display_concept ($id, $callback = '')
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
// Publications with name(s) used for taxon concept
function publications_with_name($id, $fields=array('all'), $callback = '')
{
	global $config;
	global $couch;
	
	// 1. Get concept 
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
		$obj->status = 200;
		
		$taxon_concept = json_decode($resp);
		
		// Build list of names for this concept
		$obj->names = array();
		$obj->names[] = $taxon_concept->canonicalName;
		
		// Concept synonyms
		if (isset($taxon_concept->synonyms))
		{
			foreach ($taxon_concept->synonyms as $synonym)
			{
				$obj->names[] = $synonym->canonicalName;
			}
		}
		
		$obj->names = array_unique($obj->names);
		
		$obj->hits = array();
		
		// now search for these names
		foreach ($obj->names as $name)
		{
		
			$startkey = array($name);
			$endkey = array($name, new stdclass);
			
			$url = '_design/publication/_view/tags?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&reduce=false';
			$include_docs = false;
	
			$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
			$response_obj = json_decode($resp);

			if (isset($response_obj->error))
			{
			}
			else
			{
				foreach ($response_obj->rows as $row)
				{
					$obj->hits[$name][] = $row->value;				
				}				
			}
		}
		
		// Post process
		foreach ($obj->hits as $k => $v)
		{
			foreach ($v as $publication_id)
			{
				if (!isset($obj->publications[$publication_id]))
				{
					$obj->publications[$publication_id] = api_get_document_simplified($publication_id, array('title', 'author', 'year', 'journal', 'thumbnail'));
				}
				$obj->publications[$publication_id]->tags[] = $k;
			}
		
		}
		
		unset($obj->hits);
		
	}	
	
	api_output($obj, $callback);
}

/*
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
*/


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
	
	// Optional fields to include
	$fields = array('all');
	if (isset($_GET['fields']))
	{	
		$field_string = $_GET['fields'];
		$fields = explode(",", $field_string);
	}
	
			
	if (!$handled)
	{
		// If show a single record
		if (isset($_GET['id']))
		{	
			$id = $_GET['id'];
			
			if (isset($_GET['publications']))
			{	
				publications_with_name($id, $fields, $callback);
				$handled = true;
			}
				
			/*
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
			
			*/			
	
			if (!$handled)
			{
				display_concept($id, $callback);
				$handled = true;
			}
		}

	}

	




}



main();

?>
