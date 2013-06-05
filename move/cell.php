<?php


require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

global $config;
global $couch;


function get_cells($id)
{

	// Get node in classiifcation
	$url = 'http://bionames.org/bionames-api/taxon/' . $id;
	$json = get($url);
	$parent = json_decode($json);
	
	// Get children and the number of immediate descendants of each child
	
	$cells = array();
	
	if (isset($parent->children))
	{
		foreach ($parent->children as $child)
		{
			$level_1_id = 'gbif/' . $child->sourceIdentifier;
			
			// Get info on child
			$url = 'http://bionames.org/bionames-api/taxon/' . $level_1_id;
			$json = get($url);
			
			$level_1 = json_decode($json);
			
			if (isset($level_1->children))
			{
				$cell = new stdclass;
				$cell->count = count($level_1->children);
				$cell->label = $level_1->canonicalName;
				
				foreach ($level_1->children as $level_1_child)
				{
					$cell->ids[] = $level_1_child->sourceIdentifier;
				}
				$cells[] = $cell;		
			}
			else
			{
				$cell = new stdclass;
				$cell->count = 1;
				$cell->label = $level_1->canonicalName;
				$cell->ids[] = $level_1->sourceIdentifier;
				$cells[] = $cell;		
			}
		}
	}
	else
	{
		$cell = new stdclass;
		$cell->count = 1;
		$cell->label = $parent->canonicalName;
		$cell->ids[] = $parent->sourceIdentifier;
		$cells[] = $cell;
	}

	return $cells;
}	


function main()
{
	$callback = '';
	if (isset($_GET['callback']))
	{	
		$callback = $_GET['callback'];
	}
	
	$id = $_GET['id'];
	
	$obj = new stdclass;
	$obj->status = 200;
	$obj->cells = get_cells($id);
	
	header("Content-type: text/plain");
	
	if ($callback != '')
	{
		echo $callback . '(';
	}
	
	//print_r($obj);
	
	echo json_format(json_encode($obj));
//	echo json_encode($obj);
	if ($callback != '')
	{
		echo ')';
	}
}	


main();



?>