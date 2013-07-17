<?php

// Search 

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');


//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
// Simple search for phylogenies with a taxon name in them
function simple_phylogeny_search($query)
{
	global $config;
	
	$tree = array();
		
	$phylota_couch = new CouchSimple($config['phylota_couchdb_options']);
	
	$startkey = array($query);
	$endkey = array($query, new stdclass);


	$url = '_design/taxa/_view/tree?startkey=' . urlencode(json_encode($startkey)) . '&endkey=' . urlencode(json_encode($endkey)) . '&group_level=2&limit=5';

	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	

	$resp = $phylota_couch->send("GET", "/" . $config['phylota_couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	
	
	if (isset($response_obj->error))
	{
	}
	else
	{
		foreach ($response_obj->rows as $row)
		{
			$tree[$row->key[1]] = new stdclass;
			$tree[$row->key[1]]->count = $row->value;
			$tree[$row->key[1]]->term = $row->key[0];
		}
		
	}	
	
	return $tree;
}



//--------------------------------------------------------------------------------------------------
// Simple search
function simple_search($query, $callback = '')
{
	global $config;
	global $couch;
		
	// clean
	$query = str_replace(",", "", $query);
	
	$url = "_design/search/_view/short?key=" . urlencode(json_encode($query)) . '&limit=1000';
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}		
		
	if (1)
	{
		$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	}
	else
	{
		// Cloudant
		$test_config['couchdb_options'] = array(
			'database' => 'bionames',
			'host' => 'rdmpage:peacrab@rdmpage.cloudant.com',
			'port' => 5984
			);	
		$test_couch = new CouchSimple($test_config['couchdb_options']);

		$resp = $test_couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	}
	
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
	
		$obj->results = new stdclass;
		$obj->results->facets = array();
		
		foreach ($response_obj->rows as $row)
		{
			$type = $row->value->type;
			
			// Filter out EOL concepts as we're not ready for this just yet...
			if (($type == 'taxonConcept') && preg_match('/^eol/', $row->value->id))
			{
			}
			else
			{
				if (!isset($obj->results->facets[$type]))
				{
					$obj->results->facets[$type] = array();
				}
				if (!isset($obj->results->facets[$type][$row->value->id]))
				{
					$obj->results->facets[$type][$row->value->id] = new stdclass;
					$obj->results->facets[$type][$row->value->id]->count = 0;
					$obj->results->facets[$type][$row->value->id]->term = $row->value->term;
				}
				$obj->results->facets[$type][$row->value->id]->count++;
			}
		}
		
		
		// Apply any prior ordering of results here...
		
		// sort names alphabetically
		// sort names by how closely they resemble query
		
		if (isset($obj->results->facets['nameCluster']))
		{
			if (count($obj->results->facets['nameCluster']) != 0)
			{
				$scores = array();
				foreach ($obj->results->facets['nameCluster'] as $k => $v)
				{
					$scores[] = levenshtein($query, $v->term);
				}					
				array_multisort($obj->results->facets['nameCluster'], SORT_ASC, SORT_NUMERIC, $scores);
			}
		}
		
		// trees
		$tree = simple_phylogeny_search($query);
		if (count($tree) > 0)
		{
			$obj->results->facets['tree'] = $tree;
		}
		
		
		
		
		//print_r($obj);
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
		if (isset($_GET['q']))
		{	
			$query = $_GET['q'];
					
			simple_search($query, $callback);
			$handled = true;
		}
	}

}



main();

?>
