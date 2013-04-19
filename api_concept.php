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

//--------------------------------------------------------------------------------------------------
// Publication dates for all taxa rooted on this node in classification
function taxon_timeline ($id, $callback = '')
{
	global $config;
	global $couch;
	
	$id = str_replace('gbif/', '', $id);
	
	$startkey = array((Integer)$id);
	$endkey = array((Integer)$id, date("Y"));
	
	$url = '_design/classification/_view/gbif_year?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&group_level=2';
	
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
			$obj->years = array();
			foreach ($response_obj->rows as $row)
			{
				$obj->years[$row->key[1]] = $row->value; 
			}
		}
	}
	
	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Display taxon thumbnail (currently EOL only)
function taxon_thumbnail ($id, $callback = '')
{	
	global $config;
	global $couch;
	
	$has_image = false;

	// For GBIF try and grab EOL identifier
	if (preg_match('/gbif\/(?<id>\d+)$/', $id, $m))
	{
		// Get mapping to EOL...
		// grab JSON from CouchDB
		$couch_id = $id;
			
		$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
		
		$response_obj = json_decode($resp);
		
		if (isset($response_obj->error))
		{
		}
		else
		{
			$obj = json_decode($resp);
			
			if (isset($obj->identifier))
			{
				if (isset($obj->identifier->eol))
				{
					$id = 'eol/' . $obj->identifier->eol[0];
				}
			}
		}
	}

	if (preg_match('/eol\/(?<id>\d+)$/', $id, $m))
	{
		$eol_id = $m['id'];
		
		$dir = floor($eol_id / 1000);
		
		$dir = dirname(__FILE__) . '/tmp/' . $dir;
		if (!file_exists($dir))
		{
			$oldumask = umask(0); 
			mkdir($dir, 0777);
			umask($oldumask);
		}		

		$image_filename = $dir . '/' . $eol_id . '.jpg';
		
		if (!file_exists($image_filename))
		{
			// go fetch image
			$image_url = ''; 
			$url = 'http://eol.org/api/pages/1.0/' . $eol_id . '.json?images=2&details=true';
			
			$json = get($url);
			
			//echo $json;
			
			if ($json != '')
			{
				$obj = json_decode($json);
				
				foreach ($obj->dataObjects as $dataObject)
				{
					if (($dataObject->dataType == 'http://purl.org/dc/dcmitype/StillImage') && ($image_url == ''))
					{
						if (isset($dataObject->eolThumbnailURL))
						{
							$image_url = $dataObject->eolThumbnailURL;
							
							// hack to get 88x88 image
							
							if (preg_match('/_(\d+)_(\d+).jpg/', $image_url))
							{
								$image_url = preg_replace('/_(\d+)_(\d+).jpg/', '_88_88.jpg', $image_url);
							}
							
							//echo $image_url . "\n";
							
							
						}
					}
				}
				
				if ($image_url != '')
				{
					// grab image and cache it
					
					$image = get($image_url);
					if ($image)
					{
						file_put_contents($image_filename, $image);
					}
		
					
					
				}
			}
		}
		
		if (file_exists($image_filename))
		{
			$has_image = true;
			$image = file_get_contents($image_filename);
			header("Content-type: image/jpeg");
			echo $image;
		}
	}
	
	if (!$has_image)
	{
		$image = file_get_contents(dirname(__FILE__) . '/images/88x88.png');
		header("Content-type: image/png");
		echo $image;
	}
	
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
			
			if (isset($_GET['timeline']))
			{	
				taxon_timeline($id, $callback);
				$handled = true;
			}

			if (isset($_GET['thumbnail']))
			{	
				taxon_thumbnail($id, $callback);
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
	
			// Default is just show this object.
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
