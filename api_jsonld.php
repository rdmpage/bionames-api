<?php

// JSON-LD output

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

require_once (dirname(__FILE__) . '/api_utils.php');


function cluster_to_jsonld($obj)
{
	$data = new stdclass;

	$data->{'@context'} = new stdclass;
	$data->{'@context'}->{'@vocab'} = 'http://schema.org/';
	$data->{'@context'}->dwc = 'http://rs.tdwg.org/dwc/terms/';

	$data->{'@context'}->co = 'http://rs.tdwg.org/ontology/voc/Common#';
	$data->{'@context'}->tn = 'http://rs.tdwg.org/ontology/voc/TaxonName#'; 

	$data->{'@id'} = 'http://bionames.org/' . $obj->_id;

	$data->{'@type'} = 'DataFeed';
	$data->dataFeedElement = array();

	foreach ($obj->names as $name)
	{
		$item = new stdclass;
	
		$item->{'@id'} = $name->id;
		$item->{'@type'} = 'tn:TaxonName';
	
	
		$lsid = new stdclass;
		$lsid->{'@id'} = $name->id;
		$item->{'dc:identifier'}[] = $lsid;
	
		$item->url = 'http://www.organismnames.com/namedetails.htm?lsid=' . str_replace('urn:lsid:organismnames.com:name:', '', $name->id);
	
		/*
		$item->sameAs[] = 'http://www.organismnames.com/namedetails.htm?lsid=' . str_replace('urn:lsid:organismnames.com:name:', '', $name->id);
		*/
	
		$item->name = $name->nameComplete;
	
		// TaxonName
		$keys = array(
			"nameComplete",
			"uninomial",
			"genusPart",
			"infragenericEpithet",
			"specificEpithet",
			"infraspecificEpithet",
			"rankString",
			"taxonAuthor",
			"nomenclaturalCode"
		);
	
		foreach ($keys as $key)
		{
			if (isset($name->{$key}))
			{
				$item->{'tn:' . $key} = $name->{$key};
			}
		}
	
		// Common
		if (isset($name->publication))
		{
			$item->{'co:publishedIn'} = $name->publication;
		}
	
	
		if (isset($name->publishedInCitation))
		{
			$publishedInCitation = new stdclass;
			$publishedInCitation->{'@id'} = 'http://bionames.org/references/' . $name->publishedInCitation;
			$item->{'co:publishedInCitation'}[] = $publishedInCitation;
		}
	
		if (isset($name->microreference))
		{
			$item->{'co:microreference'} = $name->microreference;
		}
		

	

		$data->dataFeedElement[] = $item;
	}
	
	return $data;
}


//--------------------------------------------------------------------------------------------------
function default_display()
{
	echo "hi";
}

//--------------------------------------------------------------------------------------------------
// One item (of any kind)
function display_cluster ($id, $callback = '')
{
	global $config;
	global $couch;
	
	// grab JSON from CouchDB
	$couch_id = $id;
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	$obj = new stdclass;
	$obj->status = 404;
	if (isset($response_obj->error))
	{
		$obj->error = $response_obj->error;
	}
	else
	{
		//print_r($response_obj);
		$obj = cluster_to_jsonld($response_obj);
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
	
		if (isset($_GET['id']))
		{	
			$id = $_GET['id'];
	
			display_cluster($id);
		}
	
	
	}

	




}



main();

?>
