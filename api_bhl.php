<?php

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');


//--------------------------------------------------------------------------------------------------
// http://www.php.net/manual/en/function.str-getcsv.php#95132
function csv_to_array($csv, $delimiter = ',', $enclosure = '"', $escape = '\\', $terminator = "\n") { 
    $r = array(); 
    $rows = explode($terminator,trim($csv)); 
    $names = array_shift($rows); 
    $names = str_getcsv($names,$delimiter,$enclosure,$escape); 
    $nc = count($names); 
    foreach ($rows as $row) { 
        if (trim($row)) { 
            $values = str_getcsv($row,$delimiter,$enclosure,$escape); 
            if (!$values) $values = array_fill(0,$nc,null); 
            $r[] = array_combine($names,$values); 
        } 
    } 
    return $r; 
} 

//--------------------------------------------------------------------------------------------------
function get_bhl_page($PageID)
{
	$page = null;
	
	$parameters = array(
	'op' 		=> 'GetPageMetadata',
	'pageid' 	=> $PageID,
	'ocr' 		=> 'f',
	'names' 	=> 't',
	'apikey' 	=> '0d4f0303-712e-49e0-92c5-2113a5959159',
	'format' 	=> 'json'
	);

	$url = 'http://www.biodiversitylibrary.org/api2/httpquery.ashx?' . http_build_query($parameters);
	
	$json = get($url);
	if ($json != '')
	{
		$response = json_decode($json);
		if ($response->Status == 'ok')
		{
			$page = $response->Result;
			$page->_id = 'page/' . $page->PageID;
			$page->type = 'page';
		}
	}
	
	return $page;
}


//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}




//--------------------------------------------------------------------------------------------------
// Search BHL for documents containing name, caching results 
function bhl_name_search($name)
{
	global $config;
	global $couch;

	$parameters = array(
		'type' => 'c',
		'name' => $name,
		'lang' => ''
		);
		
	$url = 'http://www.biodiversitylibrary.org/Services/NameListDownloadService.ashx?' . http_build_query($parameters);
		
	$csv = get($url);

	//echo $csv;
	
	$r = csv_to_array($csv);
	
	if (1)
	{
		echo '<pre>';
		print_r($r);	
		echo '</pre>';
	}
	
	foreach ($r as $row)
	{
		if (is_array($row))
		{
			if (isset($row['Url']))
			{
				$PageID = str_replace('http://www.biodiversitylibrary.org/page/', '', $row['Url']);
				
				$page = get_bhl_page($PageID);
				if ($page)
				{
					//print_r($page);
					
					if (isset($row['Date']))
					{
						$page->year = $row['Date'];
					}

					if (isset($row['Title']))
					{
						$page->title = $row['Title'];
					}
					
					if (1)
					{
						echo "CouchDB...\n";
						$couch->add_update_or_delete_document($page,  $page->_id);
					}
	
				}
			}
		}
	}
}

//--------------------------------------------------------------------------------------------------

function name_timeline($name, $callback = '')
{
	global $config;
	global $couch;
	
	$url = '_design/bhl/_view/name_pageid?key=' . urlencode(json_encode($name));
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	//echo $resp;
	
	$response_obj = json_decode($resp);
	
	//print_r($response_obj);
	
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
			
			// Get pages
			$obj->pages = array();
			$obj->biostor = array();
			$obj->biostor_pages = array();
			$obj->items = array();
			$obj->pages_years = array();
			
			// Get pages that are in BioStor articles
			foreach ($response_obj->rows as $row)
			{			
				if (isset($row->value->biostor))
				{
					$obj->biostor_pages[] = $row->value->PageID;
					$obj->pages_years[$row->value->PageID] = $row->value->year;
				}
				else
				{
					if (isset($row->value->year))
					{
						if (!isset($obj->pages_years[$row->value->PageID]))
						{
							$obj->pages_years[$row->value->PageID] = $row->value->year;
						}
					}
				}
			}
			
			// Assign pages to items, ignoring those in BioStor
			foreach ($response_obj->rows as $row)
			{
				if (!in_array($row->value->PageID, $obj->biostor_pages))
				{
					if (isset($row->value->ItemID))
					{
						if (!isset($obj->items[$row->value->ItemID]))
						{
							$obj->items[$row->value->ItemID] = new stdclass;
							$obj->items[$row->value->ItemID]->pages = array();
							if (isset($row->value->year))
							{
								$obj->items[$row->value->ItemID]->year = $row->value->year;
							}
							if (isset($row->value->title))
							{
								$obj->items[$row->value->ItemID]->title = $row->value->title;
							}
						}						
						$obj->items[$row->value->ItemID]->pages[] = $row->value->PageID;
					}
				}
				else
				{
					if (isset($row->value->biostor))
					{
						if (!isset($obj->biostor[$row->value->biostor]))
						{
							$obj->biostor[$row->value->biostor] = new stdclass;
							$obj->biostor[$row->value->biostor]->pages = array();
							if (isset($row->value->year))
							{
								$obj->biostor[$row->value->biostor]->year = $row->value->year;
							}
						}						
						$obj->biostor[$row->value->biostor]->pages[] = $row->value->PageID;
					}
				}
			}
			
			// Create output of documents grouped by year
			$obj->years = array();
			foreach ($obj->items as $ItemID => $item)
			{				
				if (!isset($obj->years[$item->year]))
				{
					$obj->years[$item->year] = array();
				}
				
				$i = new stdclass;
				$i->type = 'item';
				$i->id = $ItemID;
				$i->pages = $item->pages;
				$i->title = $item->title;
				
				$obj->years[$item->year][] = $i;
			}
			foreach ($obj->biostor as $biostor => $item)
			{				
				if (!isset($obj->years[$item->year]))
				{
					$obj->years[$item->year] = array();
				}
				
				$i = new stdclass;
				$i->type = 'biostor';
				$i->id = $biostor;
				$i->pages = $item->pages;
				
				$obj->years[$item->year][] = $i;
			}
			
			
			// Sort by year
			ksort($obj->years);
			
			// clean up helper fields
			unset($obj->pages);
			unset($obj->biostor);
			unset($obj->biostor_pages);
			unset($obj->pages_years);
			unset($obj->items);
	
			
			// Dump
			//print_r($obj);
		}
	}

	api_output($obj, $callback);
}

/*

$name = 'Synthetocaulus';
$name = 'Dictyocaulus';
$name = 'Pararhabditis';

$name = 'Lophuromys nudicaudus';

$name = 'Lophuromys';

// 0. check whether we've cached this

// 1. search BHL

// Synthetocaulus

//bhl_name_search($name);

$callback = $_GET['callback'];

name_timeline($name, $callback);
*/

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
	
	if (!$handled)
	{
		if (isset($_GET['name']))
		{	
			$name = $_GET['name'];
			
			if (!$handled)
			{
				name_timeline($name, $callback);
				$handled = true;
			}
		}
	}

}



main();

?>

