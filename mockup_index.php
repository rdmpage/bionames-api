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
<div><a href="mockup_concept.php?id=gbif/2433223"><img src="http://bionames.org/bionames-api/taxon/eol/42168/thumbnail" />Lonchophylla</a></div>
<div><a href="mockup_concept.php?id=ncbi/102659"><img src="http://media.eol.org/content/2010/12/10/05/04007_88_88.jpg" />Opisthoteuthis</a></div>
<div><a href="mockup_concept.php?id=ncbi/39093"><img src="http://media.eol.org/content/2011/10/06/10/11305_88_88.jpg" />Typhlops</a></div>
<div><a href="mockup_concept.php?id=ncbi/169145"><img src="http://media.eol.org/content/2011/10/14/16/42548_88_88.jpg" />Ammothella</a></div>
<div><a href="mockup_concept.php?id=ncbi/80974"><img src="http://media.eol.org/content/2008/10/08/12/14254_88_88.jpg" />Chromis</a></div>


<h3>People</h3>
<p><a href="http://bionames.org/bionames-api/mockup_author.php?name=C%20Van%20Achterberg">C Van Achterberg</a></p>



	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>



</body>
</html>