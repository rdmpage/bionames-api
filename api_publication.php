<?php

// Taxon name

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');


//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
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
			foreach ($response_obj->rows as $row)
			{
				$obj->names[] = $row->value;				
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
		}
	}

}



main();

?>
