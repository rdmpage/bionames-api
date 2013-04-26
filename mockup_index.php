<?php

// mockup of dashboard

?>

<html>
<head>
	<base href="/bionames-api/" />
	<!-- <base href="/~rpage/bionames-api/" /> -->
	<title>BioNames</title>
	
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
	
	
	</style>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="js/d3.v3.min.js"></script>

</head>
<body>

<div style="top:0px;height:40px;">
	<form method="GET" action="mockup_search.php">
		<input class="search-input" name="q" placeholder="Search" style="width: 22em; padding-left: 2em;" type="text" value="">
		<input type="submit" value="Search">
	</form>
</div>

<h1>BioNames Home Page</h1>

<div><a href="mockup_dashboard.php">Dashboard</a></div>

<h2>Examples</h2>

<div><a href="mockup_concept.php?id=gbif/2432854"><img src="http://bionames.org/bionames-api/taxon/eol/15607/thumbnail" />Pteropus</a></div>


	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>



</body>
</html>