<?php

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/api_utils.php');
require_once (dirname(__FILE__) . '/CiteProc.php');
require_once (dirname(__FILE__) . '/reference.php');

//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
function format_citation ($id, $style = 'apa')
{
	$obj = api_get_document($id);
	
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
	echo $output;	
}

//--------------------------------------------------------------------------------------------------
function main()
{
	$callback = '';
	
	// If no query parameters 
	if (count($_GET) == 0)
	{
		default_display();
		exit(0);
	}
	
	//print_r($_GET);
		
	$style = 'apa';
	if (isset($_GET['style']))
	{	
		$style = $_GET['style'];
	}	
			
	if (isset($_GET['id']))
	{	
		$id = $_GET['id'];
		
		format_citation($id, $style);
	}

}



main();

?>
