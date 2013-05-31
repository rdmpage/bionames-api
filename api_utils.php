<?php

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

//--------------------------------------------------------------------------------------------------
function api_output($obj, $callback)
{
	if ($obj->status == 404)
	{
		header('HTTP/1.1 404 Not Found');
	}
	
	header("Content-type: text/plain");
	header('Cache-Control: max-age=28800');

//	header("Content-type: application/json");
	
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

//--------------------------------------------------------------------------------------------------
// One item (of any kind)
function api_get_document ($id)
{
	global $config;
	global $couch;
	
	$document = null;
	
	// grab JSON from CouchDB
	$couch_id = $id;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	if (isset($response_obj->error))
	{
	}
	else
	{
		$document = json_decode($resp);
	}

	return $document;
}

//--------------------------------------------------------------------------------------------------
// One item (of any kind)
function api_get_document_simplified ($id, $fields=array('all'))
{
	global $config;
	global $couch;
	
	$document = null;
	
	// grab JSON from CouchDB
	$couch_id = $id;
	
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
	
	$response_obj = json_decode($resp);
	
	if (isset($response_obj->error))
	{
	}
	else
	{
		$document = json_decode($resp);
		
		$document = api_simplify_document($document, $fields);
	}

	return $document;
}

//--------------------------------------------------------------------------------------------------
// Retain only certain fields in document
function api_simplify_document ($document, $fields=array('all'))
{		
	if (in_array('all', $fields))
	{
		return $document;
	}
	else
	{		
		$doc = new stdclass;
		
		$doc->_id = $document->_id; // ensure
		
		// simplify
		foreach ($document as $key => $value)
		{
			switch ($key)
			{
				case 'title':
				case 'year':
				case 'author':
				case 'identifier':
				case 'journal':
					if (in_array($key, $fields))
					{
						$doc->{$key} = $document->{$key};
					}
					break;
					
				/*case 'journal':
					foreach ($document->journal as $subkey => $subvalue)
					{
						if (in_array($subkey, $fields))
						{
							$doc->{$subkey} = $document->journal->{$subkey};
						}
					}
					break; */
					
				case 'thumbnail':
					if (in_array($key, $fields))
					{
						$doc->thumbnail_url = 'id/' . $document->_id . '/thumbnail/image';
					}
					break;
					
				default:
					break;
			}
		}
		
		return $doc;
	}	
}

?>