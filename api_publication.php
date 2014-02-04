<?php

// Publication (a reference)

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');


//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
// Get raw fulltext for article
function get_text($id, $callback = '')
{
	global $config;
	global $couch;
	
	// 1. Get this publication

	// grab JSON from CouchDB
	$couch_id = $id;
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->id = $id;
	$obj->status = 404;
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		$obj->status = 200;
		$reference = json_decode($resp);
		
		// case 1: PDF
		if (isset($reference->file->sha1))
		{
			$sha1 = $reference->file->sha1;

			// get text from PDF
			$url = 'http://bionames.org/bionames-archive/api_get_text.php?sha1=' . $sha1;
			$json = get($url);
			if ($json != '')
			{
				$obj = json_decode($json);
			}
		}		
		
	}
	
	api_output($obj, $callback);
}	
	

//--------------------------------------------------------------------------------------------------
function cited_by($id, $callback = '')
{
	global $config;
	global $couch;
	
	// 1. Get this publication

	// grab JSON from CouchDB
	$couch_id = $id;
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->id = $id;
	$obj->status = 404;
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		$obj->status = 200;
		$doc = json_decode($resp);
		
		$obj->references = array();
		
		
		// 2. Iterate over identifiers and collect hits
		
		$keys = array();
		
		// Get list of identifiers for this reference
		if (isset($doc->identifier))
		{
			foreach ($doc->identifier as $identifier)
			{
				
				if (is_numeric($identifier->id))
				{
					$keys[] = $identifier;
				}
				else
				{
					// provide upper and lower case versions of alphanumeric identifiers
					$identifier_lc = new stdclass;
					$identifier_lc->type = $identifier->type;
					$identifier_lc->id = strtolower($identifier->id);
					
					$keys[] = $identifier_lc;

					$identifier_uc = new stdclass;
					$identifier_uc->type = $identifier->type;
					$identifier_uc->id = strtoupper($identifier->id);
					
					$keys[] = $identifier_lc;
				}					
			}
		}
		else
		{
			// use local BioNames id
			$identifier = new stdclass;
			$identifier->type = "bionames";
			$identifier->id = $id;
			
			$keys[] = $identifier;
		}
		
		$citedby = array();
		
		foreach ($keys as $key)
		{
			$url = '_design/references/_view/cited_by?key=' . urlencode(json_encode($key));

			if ($config['stale'])
			{
				$url .= '&stale=ok';
			}			
			
			$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
			
			$response_obj = json_decode($resp);
						
			if (isset($response_obj->error))
			{
				$obj->error = $response_obj->error;
			}
			else
			{
				foreach ($response_obj->rows as $row)
				{
					$citedby[] = $row->id;
					
					// Store local id of reference (gives us a list of different ways this article is cited)
					$obj->references[$row->id] = $row->value;
				}
			}			
		}
		
		// get each document
		
		$citedby = array_unique($citedby);
		
		$obj->citedby = array();
		foreach ($citedby as $cite)
		{
			$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($cite));
			$response_obj = json_decode($resp);
			
			$obj->citedby[] = $response_obj;

		}
		
	}
	
	api_output($obj, $callback);
}	
	


//--------------------------------------------------------------------------------------------------
function names_published($id, $callback = '')
{
	global $config;
	global $couch;
		
	$include_docs = true;
	
	$url = '_design/publication/_view/names_published?key=' . urlencode(json_encode($id));
	
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
			
			$keys = array();
			
			foreach ($response_obj->rows as $row)
			{				
				$obj->names[] = $row->value;				
				
				$keys[] = $row->value->nameComplete;
			}
			array_multisort($keys, SORT_ASC, $obj->names);
			
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
	
	//print_r($_GET);
	
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
		if (isset($_GET['id']))
		{	
			$id = $_GET['id'];		
			
			if (!$handled)
			{
				if (isset($_GET['names']))
				{	
					names_published($id, $callback);
					$handled = true;
				}
			}
			
			if (!$handled)
			{
				if (isset($_GET['text']))
				{	
					get_text($id, $callback);
					$handled = true;
				}
			}
			
			
			if (!$handled)
			{
				if (isset($_GET['citedby']))
				{	
					cited_by($id, $callback);
					$handled = true;
				}
			}
			
			
		}
	}

}



main();

?>
