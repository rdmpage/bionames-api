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
	
	// clean
	$query = str_replace(",", "", $query);
	
	
	/*
	$facets = array('name', 'canonicalName', 'title', 'publication');
	//$facets = array('publication');
	
	$search_terms = array();
	foreach ($facets as $key)
	{
		$search_terms[] =  $key . ':"' . addcslashes($query, '"') . '"';
	}
	
	$url = "_design/search/_search/all?q=" . urlencode(join(" OR ", $search_terms)) . '&limit=100';
	*/

	$url = "_design/search/_view/short?key=" . urlencode(json_encode($query)) . '&limit=100';

	
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
	
	
	$results = new stdclass;
	$results->facets = array();
	
	foreach ($response_obj->rows as $row)
	{
		$type = $row->value->type;
		if (!isset($results->facets[$type]))
		{
			$results->facets[$type] = array();
		}
		if (!isset($results->facets[$type][$row->id]))
		{
			$results->facets[$type][$row->id] = new stdclass;
			$results->facets[$type][$row->id]->count = 0;
			$results->facets[$type][$row->id]->term = $row->value->term;
		}
		$results->facets[$type][$row->id]->count++;
	}
	
	/*
	echo '<pre>';
	print_r($results);
	echo '</pre>';
	*/
	
	
	// aggregate
	/*
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
	*/
	//exit();
	
	
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
		
		foreach ($hits as $id => $value)
		{
			echo '<div style="padding-bottom:20px;padding-left:20px;">';
			echo '<div style="float:right;border:1px solid rgb(228,228,228);width:16px;font-size:100%;text-align:center;">»</div>';
		
			switch ($facet)
			{
				case 'nameCluster':
					echo '<a href="mockup_taxon_name.php?id=' . $id . '">';
					echo $value->term;
					echo '</a>';					
					break;
					
				case 'taxonConcept':
					echo '<a href="mockup_concept.php?id=' . $id . '">';
					echo $value->term ;
					echo '</a>';
					break;

				case 'article':
					echo '<a href="mockup_publication.php?id=' . $id . '">';
					echo $value->term ;
					echo '</a>';
					break;
					
					
				default:
					echo '[unknown]';
					break;
			}
			
			echo '</div>';
		}
		
		
		/*
		//$n = min(10, count($hits));
		$n = count($hits);
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
		*/
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

?>

<html>
<head>
	<base href="/bionames-api/" />
	<!-- <base href="/~rpage/bionames-api/" /> -->
	<title>Search</title>
	
	<!-- standard stuff -->
	<meta charset="utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'> 
	
	<style type="text/css" title="text/css">
			
	body {
	  font-family: 'Open Sans', sans-serif;
	  font-weight: 400;
	  font-size: 14px;
	  line-height: 20px;
	  color: #2e3033;
	}
	
	
	.search-input {
		font-size:24px;
	}
		
	.pub .thumbnail {
	  float: left;
	  width: 40px;
	  height: 60px;
	  overflow: hidden;
	  background-color: rgba(0,0,0,0.1);
	  border: 1px solid rgba(0,0,0,0.05);
	  border-radius: 2px;
	}
	
	.pub .thumbnail img {
	  display: block;
	  width: 40px;
	  height: 60px;
	  border-radius: 2px;
	}
	
	.pub .citation {
	  margin-left: 60px;
	  padding-right: 10px;
	}
	
	.pub .title {
	  font-weight: 700;
	}
	
	.pub .meta {
	  font-size: 12px;
	}
	
	.pub .meta,
	.pub .meta span.j-sep{
	  color: #737880;
	}
	
	.pub .meta span {
	  color: #45494d;
	}
	
	.pub .journal {
	  font-style: italic;
	}
	
	</style>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	
	<!-- documentcloud -->
	<!--[if (!IE)|(gte IE 8)]><!-->
	<link href="public/assets/viewer-datauri.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="public/assets/plain-datauri.css" media="screen" rel="stylesheet" type="text/css" />
	<!--<![endif]-->
	<!--[if lte IE 7]>
	<link href="public/assets/viewer.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="public/assets/plain.css" media="screen" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<script src="public/assets/viewer.js" type="text/javascript" charset="utf-8"></script>
	<script src="public/assets/templates.js" type="text/javascript" charset="utf-8"></script>			

</head>
<body>

<div style="top:0px;height:40px;">
	<div style="float:right;">
		<a href="mockup_index.php">Home</a>
		&nbsp;
		<a href="mockup_dashboard.php">Dashboard</a>
	</div>

	<form method="GET" action="mockup_search.php">
		<input class="search-input" name="q" placeholder="Search" style="width: 22em; padding-left: 2em;" type="text" value="<?php echo $q; ?>">
		<input type="submit" value="Search">
	</form>
</div>

<div>

<h1>Search</h1>

<?php

search($q);

?>

<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>


</body>
</html>
