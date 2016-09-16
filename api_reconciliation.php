<?php

// BioNames reconcilation service (citations)

require_once (dirname(__FILE__) . '/reconciliation_api.php');

require_once (dirname(__FILE__) . '/couchsimple.php');

require_once (dirname(__FILE__) . '/fingerprint.php');
require_once (dirname(__FILE__) . '/lcs2.php');
require_once (dirname(__FILE__) . '/lib.php');


//----------------------------------------------------------------------------------------
class BioNamesService extends ReconciliationService
{
	//----------------------------------------------------------------------------------------------
	function __construct()
	{
		$this->name 			= 'BioNames Reference';
		
		$this->identifierSpace 	= 'http://bionames.org/';
		$this->schemaSpace 		= 'http://rdf.freebase.com/ns/type.object.id';
		$this->Types();
		
		$view_url = 'http://bionames.org/references/{{id}}';

		$preview_url = '';	
		$width = 430;
		$height = 300;
		
		if ($view_url != '')
		{
			$this->View($view_url);
		}
		if ($preview_url != '')
		{
			$this->Preview($preview_url, $width, $height);
		}
	}
	
	//----------------------------------------------------------------------------------------------
	function Types()
	{
		$type = new stdclass;
		$type->id = 'https://schema.org/CreativeWork';
		$type->name = 'CreativeWork';
		$this->defaultTypes[] = $type;
	} 	
		
	//----------------------------------------------------------------------------------------------
	// Handle an individual query
	function OneQuery($query_key, $text, $limit = 1, $properties = null)
	{
		global $config;
		global $couch;
		
		// clean text
		$text = str_replace(':', '', $text);
		$text = str_replace('"', '', $text);
		
		//echo $text;
		
		// Cloudant search..
		$url = '_design/citation/_search/all?q=' . urlencode($text) . '&limit=' . $limit;
		$url .= '&include_docs=true';
		
		$url = 'https://bionames:peacrab280398@bionames.cloudant.com/bionames' . '/' . $url;
		//echo $url;

		$json = get($url);
		//echo $json;		
		
		//file_put_contents('/tmp/q.txt', $json, FILE_APPEND);

		if ($json != '')
		{
			$obj = json_decode($json);
			
			//print_r($obj);
			
			if (isset($obj->rows))
			{
				//foreach ($obj->rows as $row)
				
				//$row = $obj->rows[0];
				for ($i = 0; $i < 3; $i++)
				{
					$row = $obj->rows[$i];
					// check 
					
					$v1 = finger_print($text);
					$v2 = finger_print($row->doc->citation_string);
					
					$lcs = new LongestCommonSequence($v1, $v2);
					$d = $lcs->score();
					
					//echo $d + "|";
					
					$score = min($d / strlen($v1), $d / strlen($v2));
					
					if ($score > 0.80)
					{
						$hit = new stdclass;
						$hit->id 	= str_replace('biostor/', '', $row->id);
				
						$hit->name 	= $row->doc->title;
				
						$hit->score = $score;
						$hit->match = true;
						$this->StoreHit($query_key, $hit);
					}				
				
				
				}
			}
		}
		

		
	}
	
	
}

$service = new BioNamesService();


if (0)
{
	file_put_contents('/tmp/q.txt', $_REQUEST['queries'], FILE_APPEND);
}


$service->Call($_REQUEST);

?>