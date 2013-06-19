<?php

// Phylogeny 

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/api_utils.php');


//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
// Get tree object
function get_tree($tree, $callback)
{
	global $config;
	$phylota_couch = new CouchSimple($config['phylota_couchdb_options']);
	
	$couch_id = $tree;
	
	$resp = $phylota_couch->send("GET", "/" . $config['phylota_couchdb_options']['database'] . "/" . urlencode($couch_id));
	
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
// Get tree in NEXUS format
function get_tree_nexus($tree)
{
	global $config;
	$phylota_couch = new CouchSimple($config['phylota_couchdb_options']);
		
	$url = "_design/tree/_view/nexus?key=" . urlencode('"' . $tree . '"');
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}		

	$resp = $phylota_couch->send("GET", "/" . $config['phylota_couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	
	//print_r($response_obj);
	
	if (isset($response_obj->error))
	{
		// error
	}
	else
	{
		if (count($response_obj->rows) == 0)
		{
			// error
		}
		else
		{
			$nexus = $response_obj->rows[0]->value;
			header('Content-Type:text/plain'); 
			echo $nexus;
		}
	}
	
	
	
}


//--------------------------------------------------------------------------------------------------
// Get tree ids for a given tax_id
function get_trees_for_taxon($tax_id, $callback)
{
	global $config;
	$phylota_couch = new CouchSimple($config['phylota_couchdb_options']);
	
	// PhyLoTA index (tax_id is root of tree)
	$url = "/_design/tree/_view/tax_id?key=" . $tax_id . '&reduce=false'; 
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}		
	
	$resp = $phylota_couch->send("GET", "/" . $config['phylota_couchdb_options']['database'] . $url);
	
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
		$obj->trees = array();
		foreach ($response_obj->rows as $row)
		{
			$obj->trees[] = $row->id;				
		}		
	}
	
	/*
	// Trees that contain this tax_id
	http://direct.bionames.org:5984/phylota_184/_design/taxa/_view/tax_id_tree?start_key=[237995]&end_key=[237995,{}]&group_level=2
	
	$start_key 	= array((Integer)$tax_id);
	$end_key 	= array((Integer)$tax_id, new stdclass);
	
	$url = "/_design/taxa/_view/tax_id_tree?start_key=" . urlencode(json_encode($start_key)) . '&end_key=' . urlencode(json_encode($end_key)) . '&group_level=2'; 
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}		
	
	$resp = $phylota_couch->send("GET", "/" . $config['phylota_couchdb_options']['database'] . $url);
	$response_obj = json_decode($resp);

	if (isset($response_obj->error))
	{
	}
	else
	{
		if (isset($obj->error))
		{
			unset($obj->error);
		}
		$obj->status = 200;
		foreach ($response_obj->rows as $row)
		{
			$obj->trees[] = $row->key[1];				
		}		
	}
	
	$obj->trees = array_unique($obj->trees);	
	*/
	
	api_output($obj, $callback);
}

//--------------------------------------------------------------------------------------------------
// Get newick strings for a given tax_id
function get_newick_strings_for_taxon($tax_id, $callback)
{
	global $config;
	$phylota_couch = new CouchSimple($config['phylota_couchdb_options']);
	
	$url = "/_design/tree/_view/newick?key=" . $tax_id . '&reduce=false'; 
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}		
	
	$resp = $phylota_couch->send("GET", "/" . $config['phylota_couchdb_options']['database'] . $url);
	
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
		$obj->trees = array();
		foreach ($response_obj->rows as $row)
		{
			$obj->trees[$row->id] = $row->value;				
		}
		
	}
	
	// get tags 
	$url = "/_design/tree/_view/tags?key=" . $tax_id; 
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}		
	
	$resp = $phylota_couch->send("GET", "/" . $config['phylota_couchdb_options']['database'] . $url);
	
	$response_obj = json_decode($resp);
	if (isset($response_obj->error))
	{
	}
	else
	{
		$obj->tags = array();
		foreach ($response_obj->rows as $row)
		{
			$obj->tags[$row->id] = $row->value;				
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
	
		
	if (!$handled)
	{	
		if (isset($_GET['taxon']))
		{	
			$taxon = $_GET['taxon'];
			
			if (preg_match('/ncbi\/(?<tax_id>\d+)/', $taxon, $m))
			{
				$tax_id = $m['tax_id'];
				
				if (isset($_GET['format']))
				{	
					$format = $_GET['format'];
					
					switch ($format)
					{
						case 'newick':					
							get_newick_strings_for_taxon($tax_id, $callback);
							$handled = true;
							break;
							
						default:
							break;
					}
				}
				
				if (!$handled)
				{
					get_trees_for_taxon($tax_id, $callback);
					$handled = true;
				}
			}			
		}
	
		if (isset($_GET['tree']))
		{	
			$tree = $_GET['tree'];
					
			if (!$handled)
			{
				if (isset($_GET['format']))
				{	
					$format = $_GET['format'];
					
					switch ($format)
					{
						case 'nexus':					
							get_tree_nexus($tree);
							$handled = true;
							break;
							
						default:
							break;
					}
				}
			}
			
			if (!$handled)
			{
				get_tree($tree, $callback);
				$handled = true;				
			}
		}
		
	}
	
	if (!$handled)
	{
		$obj = new stdclass;
		$obj->status = 400;
		api_output($obj, $callback);	
	}

}



main();

?>
