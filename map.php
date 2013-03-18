<?php


require_once (dirname(__FILE__) . '/lib.php');


$coordinates = array();

if (isset($_GET['issn']))
{
	$issn = $_GET['issn'];
	$url = "http://bionames.org/bionames-api/journals/issn/" . $issn . "/geometry";
	$json = get($url);
	
	$obj = json_decode($json);
	
	$coordinates = $obj->coordinates;
}


$xml = '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns:xlink="http://www.w3.org/1999/xlink" 
xmlns="http://www.w3.org/2000/svg" 
width="360px" height="180px">
   <style type="text/css">
      <![CDATA[     
      .region 
      { 
        fill:blue; 
        opacity:0.4; 
        stroke:blue;
      }
      ]]>
   </style>
<!--  <rect id="dot" x="-3" y="-3" width="6" height="6" style="stroke:black; stroke-width:1; fill:white"/> -->
  <rect id="dot" x="-1" y="-1" width="2" height="2" style="stroke:none; stroke-width:0; fill:yellow;opacity:0.7;"/>
 <!-- <rect id="dot" x="-10" y="-1" width="2" height="2" style="stroke:none; stroke-width:0; fill:black"/> -->
 <image x="0" y="0" width="360" height="180" xlink:href="' . 'images/gbif.png"/>

 <g transform="translate(180,90) scale(1,-1)">';
 

foreach ($coordinates as $loc)
{
	$xml .= '   <use xlink:href="#dot" transform="translate(' . $loc[0] . ',' . $loc[1] . ')" />';
}

$xml .= '
      </g>
	</svg>';
	
	
header("Content-type: image/svg+xml");

echo $xml;

?>

