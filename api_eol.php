<?php

// EOL-based identifiers (should merge with concept API at some point)

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');

require_once (dirname(__FILE__) . '/CiteProc.php');
require_once (dirname(__FILE__) . '/reference.php');



//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
function format_citation ($obj, $style = 'apa')
{
	if (!isset($obj->author))
	{
		$obj->author = array();
		$author = new stdclass;
		$obj->author[] = $author;
	}
	
	// convert
	$citeproc_obj = reference_to_citeprocjs($obj, 'ITEM-1');

	// for some reason we need to convert to JSON and back for this to work!
	$json = json_encode($citeproc_obj);
	$citeproc_obj = json_decode($json);	
		
	$style_file = dirname(__FILE__) . '/style/' . $style . '.csl';

	$csl = file_get_contents($style_file);

	$citeproc = new citeproc($csl);
	$output = $citeproc->render($citeproc_obj, 'bibliography');
	
	return $output;	

}

//--------------------------------------------------------------------------------------------------
function get_eol_publications($eol_id, $callback)
{
	global $config;
	global $couch;
	
	$key = $eol_id;
	
	$url = '_design/classification/_view/eol_to_ion?key=' . $key;
	$url .= '&include_docs=true';
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}				

	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" .  $url);
	
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
		//$obj->hits = $response_obj->rows;
		
		$hits = array();
		
		$obj->results = array();
		
		foreach ($response_obj->rows as $row)
		{
			if (isset($row->doc->identifier))
			{
				if (isset($row->doc->identifier->ion))
				{
					foreach ($row->doc->identifier->ion as $k => $v)
					{
						if (isset($v->publishedInCitation)) 
						{
							foreach($v->publishedInCitation as $p)
							{
								$hits[] = $p;
							}
						}
					}
				}
			}
		}
		
		$hits = array_unique($hits);
		foreach ($hits as $hit)
		{
			// get publication details
			
			$publication = api_get_document($hit);
			$publication->formatted_citation = format_citation($publication);
			
			$obj->results[] = $publication;
		}
				
		//$obj->hits = $response_obj->rows;
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
		// If show a single record
		if (isset($_GET['id']))
		{	
			$id = $_GET['id'];
			
			//echo __LINE__;
			
			if (isset($_GET['publications']))
			{					
				if (!$handled)
				{
					get_eol_publications($id, $callback);
					$handled = true;
				}
			}
	
			/*
			// Default is just show this object.
			if (!$handled)
			{
				display_concept($id, $callback);
				$handled = true;
			}
			*/
		}

	}

	




}



main();

?>
