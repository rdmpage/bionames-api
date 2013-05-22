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
	

	$url = "_design/search/_view/short?key=" . urlencode(json_encode($query)) . '&limit=1000';

		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
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
		if (!isset($results->facets[$type][$row->value->id]))
		{
			$results->facets[$type][$row->value->id] = new stdclass;
			$results->facets[$type][$row->value->id]->count = 0;
			$results->facets[$type][$row->value->id]->term = $row->value->term;
		}
		$results->facets[$type][$row->value->id]->count++;
	}
	
	/*
	echo '<pre>';
	print_r($results);
	echo '</pre>';
	*/
	
	// Apply any prior ordering of results here...
	
	// sort names alphabetically
	// sort names by how closely they resemble query
	
	if (isset($results->facets['nameCluster']))
	{
		if (count($results->facets['nameCluster']))
		{
			$distances = array();
			foreach ($results->facets['nameCluster'] as $k => $v)
			{
				$distances[$v->term] = levenshtein($query, $v->term);
			}	
			$scores = array_values($distances);
			array_multisort($results->facets['nameCluster'], SORT_ASC, SORT_NUMERIC, $scores);
		}
	}
	
	/*
	echo '<pre>';
	print_r($distances);
	print_r($results->facets['nameCluster']);
	echo '</pre>';
	*/
	
	$ids = array();
	
	$facet_key_order = array(
		'nameCluster',

		'taxonConcept',
		'article',
		'book',
		'chapter',
		'generic'
	);
	
//	foreach ($results->facets as $facet => $hits)

	foreach ($facet_key_order as $facet)
	{
		if (isset($results->facets[$facet]))
		{
			echo '<div class="facet">';
			
			switch ($facet)
			{
				case 'nameCluster':
					echo '<h2 class="names">Names</h2>';
					break;
					
				case 'taxonConcept':
					echo '<h2 class="taxa">Taxa</h2>';
					break;
					
				case 'article':
					echo '<h2 class="articles">Articles</h2>';
					break;
					
				case 'book':
				case 'chapter':
				case 'generic':
					echo '<h2 class="publications">Publications</h2>';
					break;
				
				default:
					echo '[unknown] facet "' . $facet . '"';
					break;
			}
		
			
			
			$hits = $results->facets[$facet];
			
			foreach ($hits as $id => $value)
			{
				$ids[] =  $id;
	//			echo '<div style="padding-bottom:20px;padding-left:20px;">';
	//			echo '<div style="float:right;border:1px solid rgb(228,228,228);width:16px;font-size:100%;text-align:center;">»</div>';
	
				//echo '<div style="float:right;">';
				// echo '<div style="float:left;">';
			
				switch ($facet)
				{
					case 'nameCluster':
						echo '<div class="name-cluster">';
						echo '<a href="mockup_taxon_name.php?id=' . $id . '">';
						echo $value->term;
						echo '</a>';					
						//echo ' [' . $value->count . ']';
						echo '</div>';
						break;
						
					case 'taxonConcept':
						if (1)
						{
							echo '<div id="id' . str_replace("/", "_", $id) . '" class="snippet-wrapper"></div>';
						}
						else
						{
							echo '<a href="mockup_concept.php?id=' . $id . '">';
							echo $value->term ;
							echo '</a>';
							echo ' [' . $value->count . ']';
						}
						break;
	
					case 'article':
					case 'book':
					case 'chapter':
					case 'generic':
						if (1)
						{
							echo '<div id="id' . str_replace("/", "_", $id) . '" class="snippet-wrapper"></div>';
						}
						else
						{
							echo '<a href="mockup_publication.php?id=' . $id . '">';
							echo $value->term ;
							echo '</a>';
							echo ' [' . $value->count . ']';
						}
						break;
						
						
					default:
						echo '[unknown]';
						break;
				}				
			}
		}
		echo '</div>';
	}
	//echo '</div>';
	
	
	echo '<script>
		did_you_mean(\'' . addcslashes($query, "'") . '\');
	</script>';
	
	echo '<script>';
	foreach ($ids as $id)
	{
		echo 'display_snippets("' . $id . '");';
	}
	echo '</script>';
}

$q = trim($_GET['q']);

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
	  background-color:rgb(242,242,242);
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
	
	/* snippet */

 .snippet {
 	border-bottom:1px solid rgb(192,192,192);
	border-right:1px solid rgb(192,192,192);
	border-top:1px solid rgb(228,228,228);
	border-left:1px solid rgb(228,228,228);
 	padding:10px;
 	width:300px;
 	margin:10px;
 	height:120px;
 	overflow:hidden;
 	background-color:white;
-moz-box-shadow: 0px 2px 2px #888;
-webkit-box-shadow: 0px 2px 2px #888;
box-shadow: 0px 2px 2px #888; 	
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
 }
 
 
  .snippet a {
	text-decoration: none;
	color:inherit;
 } 
 
  .snippet .thumbnail_blank {
 	float: left;
 	width:60px;
 	height:88px;
 	border:1px solid rgb(228,228,228);
 	background-color:rgb(242,242,242);
 }
 
 .snippet .thumbnail {
 	float: left;
 	height:88px;
 	border:1px solid rgb(228,228,228);
 }
 
 .snippet .details {
 	margin-left:100px;
 	width:200px;
 	overflow:hidden;
 } 
 
 .snippet .title {
 	white-space: nowrap;
 	overflow:hidden;
	text-overflow: ellipsis;
	padding-bottom:0.5em;
 	
 }
 
 .snippet .metadata {
 	color: rgb(128,128,128);
 	font-size:80%;
 } 
 
 .snippet .journal {
	font-style:italic;
 }
 

.snippet .identifier {
 	list-style-type: none; padding: 0px; margin: 0px;
 } 
 
 .snippet .identifier li {
 	color:black;
 	white-space: nowrap;
 	overflow:hidden;
	text-overflow: ellipsis;
 }	
		
	
	</style>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	
	<script src="js/snippet.js"></script>
	
	
	<script>
		function did_you_mean(name)
		{
			$("#didyoumean").html("");
			
			$.getJSON("http://bionames.org/bionames-api/name/" + encodeURIComponent(name) + "/didyoumean?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						if (data.names.length > 0) {
							html += '<b>Did you mean:</b>';
							html += '<ul>';
							
							for (var i in data.names) {
								html += '<li>';
								html += '<a href="mockup_search.php?q=' + encodeURIComponent(data.names[i]) + '">' + data.names[i] + '</a>';
								html += '</li>';
							}
							html += '</ul>';
							
							$("#didyoumean").html(html);
						}
					}
				});
		}
		
		
		
	</script>


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

<div id="didyoumean"></div>

<?php

search($q);

?>

<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>



</body>
</html>
