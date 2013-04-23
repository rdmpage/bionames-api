<?php


require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');



//--------------------------------------------------------------------------------------------------
function search($query, $callback = '')
{
	global $config;
	global $couch;
	
	// Query
	
	$search_terms = array();
	
	$facets = array('name', 'canonicalName', 'title', 'publication');
	//$facets = array('publication');
	
	$search_terms = array();
	foreach ($facets as $key)
	{
		$search_terms[] =  $key . ':"' . addcslashes($query, '"') . '"';
	}
	
	$url = "_design/search/_search/all?q=" . urlencode(join(" OR ", $search_terms)) . '&limit=100';
	
	//echo $url;
		
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
	}
	
	//print_r($response_obj);
	
	// aggregate
	
	$results = new stdclass;
	$results->facets = array();
	
	foreach ($response_obj->rows as $row)
	{
		if (isset($row->fields->type))
		{
			$type = $row->fields->type;
			if (!isset($results->facets[$type]))
			{
				$results->facets[$type] = array();
			}
			$results->facets[$type][] = $row;
		}
	}
	
	
	echo '<div style="width:600px;">';
	foreach ($results->facets as $facet => $hits)
	{
		echo '<div style="font-size:150%">';
		
		switch ($facet)
		{
			case 'nameCluster':
				echo 'Name';
				break;
				
			case 'taxonConcept':
				echo 'Taxon';
				break;
				
			case 'article':
				echo 'Publication';
				break;
			
			default:
				echo '[unknown]';
				break;
		}
		
		
		echo '</div>';
		
		$n = min(10, count($hits));
		for ($i=0;$i<$n;$i++)
		{
			echo '<div style="padding-bottom:20px;padding-left:20px;">';
			echo '<div style="float:right;border:1px solid rgb(228,228,228);width:16px;font-size:100%;text-align:center;">»</div>';
			
			foreach ($hits[$i]->fields as $k => $v)
			{
				switch ($k)
				{
					case 'name':
						echo '<a href="mockup_taxon_name.php?id=' . $hits[$i]->id . '">';
						echo $v;
						echo '</a>';
						break;
						
					case 'canonicalName':
						echo $v;
						break;
						
					case 'publication':
						echo '<a href="mockup_publication.php?id=' . $hits[$i]->id . '">';
						echo $v;
						echo '</a>';
						break;
						
					default:
						break;
				}
			}
			
			echo '</div>';
		}
		if ($n < count($hits))
		{
			echo '<div>More...</div>';
		}
	}
	echo '</div>';	

	/*
	echo '<pre>';
	print_r($results);
	echo '</pre>';
	
	foreach ($response_obj->rows as $row)
	{
	
		echo '<div>';
		echo $row->id;
		
		foreach ($row->fields as $k => $v)
		{
			switch ($k)
			{
				case 'name':
				case 'canonicalName':
				case 'publication':
					echo $v;
					break;
					
				default:
					break;
			}
		}
		echo '</div>';
	
	}
	*/
}

$q = $_GET['q'];
search($q);

?>
