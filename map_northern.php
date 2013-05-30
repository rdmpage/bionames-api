<?php

$coordinates = json_decode($_GET['coordinates']);

$xml = '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns:xlink="http://www.w3.org/1999/xlink" 
xmlns="http://www.w3.org/2000/svg" 
width="180px" height="180px">
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
  <rect id="dot" x="-1" y="-1" width="2" height="2" style="stroke:none; stroke-width:0; fill:yellow"/>
 <!-- <rect id="dot" x="-10" y="-1" width="2" height="2" style="stroke:none; stroke-width:0; fill:black"/> -->
 <image x="0" y="0" width="180" height="180" xlink:href="' . 'images/gbif_northern180x180.png"/>

 <g transform="translate(90,90) scale(1,-1) rotate(-90) ">';
 

foreach ($coordinates as $loc)
{
	if ($loc[1] >= 0)
	{
		$radius = 90; // pixels
		
		$latitude = $loc[1] * M_PI/180;
		$longitude = $loc[0] * M_PI/180;
		
		$xml .= '<!--' . $latitude . '-->';
		
		$x = $radius * cos($latitude) * cos($longitude);
		$y = $radius * cos($latitude) * sin($longitude);
	
	
		$xml .= '   <use xlink:href="#dot" transform="translate(' . $x . ',' . $y . ')" />';
	}
}

$xml .= '
      </g>
	</svg>';
	
	
header("Content-type: image/svg+xml");

echo $xml;

?>

