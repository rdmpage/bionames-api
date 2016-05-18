<?php

// timeline

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');

//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
// Timeline for a group (where group is a JSON array of the path to the group)
function display_group_timeline ($group, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;	
	
	$path_array = json_decode(stripcslashes($group));
	
	$startkey = array($path_array, (Integer)0);
	$endkey = array($path_array, (Integer)2016);
	
	$url = '_design/ion/_view/group?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&group_level=2';
	
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
		$obj->status = 200;
		$obj->group = $path_array;
		$obj->years = array();
		
		foreach ($response_obj->rows as $row)
		{
			$obj->years[$row->key[1]] = $row->value;
		}	
		
	}

	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Names in a year for a group (where group is a JSON array of the path to the group)
function display_group_names_year ($group, $year, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;	
	
	$path_array = json_decode(stripcslashes($group));
	
	$key = array($path_array, (Integer)$year);
	
	
	$url = '_design/ion/_view/group?key=' . json_encode($key) .  '&reduce=false';
	
	$include_docs = true;
	if ($include_docs)
	{	
		$url .= '&include_docs=true';
	}
	
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
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
		$obj->group = $path_array;
		$obj->num_results = $response_obj->total_rows;
		$obj->offset = $response_obj->offset;
		$obj->clusters = array();
		
		foreach ($response_obj->rows as $row)
		{
			if ($include_docs)
			{
				$obj->clusters[] = $row->doc;
			}
			else
			{
				$obj->clusters[] = $row->id;				
			}
		}	
		
	}

	api_output($obj, $callback);
}


//--------------------------------------------------------------------------------------------------
// Number of names with publications in a given group
function display_group_count ($group, $callback = '')
{
	global $config;
	global $couch;
	
	global $stale_ok;	
	
	$path_array = json_decode(stripcslashes($group));
	
	$startkey = array($path_array, (Integer)0);
	$endkey = array($path_array, (Integer)2016);
	
	$url = '_design/ion/_view/group?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&reduce=true';
	
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
		$obj->status = 200;
		$obj->group = $path_array;
		$obj->count = $response_obj->rows[0]->value;
		
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
	
		if (isset($_GET['group']))
		{	
			$group = $_GET['group'];
			
			if (isset($_GET['year']))
			{	
				$year = $_GET['year'];
				
				//print_r($_GET);
				
				if (!$handled)
				{
					display_group_names_year($group, $year, $callback);
					$handled = true;
				}
			}
			
			if (isset($_GET['count']))
			{
				display_group_count($group, $callback);
				$handled = true;
			}			
			
			if (!$handled)
			{
				display_group_timeline($group, $callback);
				$handled = true;
			}
		}

	}

}



main();

?>
