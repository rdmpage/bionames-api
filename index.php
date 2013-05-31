<?php

// Home page
?>
<!DOCTYPE html>
<html>
<head>
	<base href="/bionames-api/" />
	<title>BioNames</title>
	
	<!-- standard stuff -->
	<meta charset="utf-8" />
	<?php require 'stylesheets.inc.php'; ?>
	
	<?php require 'javascripts.inc.php'; ?>
	<?php require 'uservoice.inc.php'; ?>
</head>
<body class="home">
	<?php require 'analyticstracking.inc.php'; ?>
	<?php require 'navbar.inc.php'; ?>
	

	<div class="hero-unit jumbo">
		<h1>BioNames</h1>
		<p>Taxa, text, and trees (oh my)</p>
	</div>
	
	<div class="homepage-search">
		<h4>Find names, taxa, and publications in one search</h4>
		<form method="get" action="mockup_search.php">
			<input type="text" id='q' name='q' data-provide="typeahead" class="search-query" placeholder="Search" autocomplete="off" value="Bathynomus">
			<input type="submit" value="Search" class="btn">
		</form> 
	</div>

	<div class="container-fluid">
		<div class="row-fluid homepage-features">
			<div class="span6">
				<div class="feature">
					<h3>Original descriptions</h3>
					<p><a href="mockup_publication.php?id=08bc3b58adc3961d4cd39319bdd139a6">Read the original description of <em>Calumma tarzan</em></a></p>
					<div class="homepage-snippet-wrapper">
						<div class="snippet"><a href="mockup_publication.php?id=08bc3b58adc3961d4cd39319bdd139a6"><img class="thumbnail" src="images/homepage-tarzan-yell.png"></a><div class="details"><a href="mockup_publication.php?id=08bc3b58adc3961d4cd39319bdd139a6"><div class="title">A Tarzan yell for conservation: a new chameleon, Calumma tarzan sp. n., proposed as a flagship species for the creation of new nature reserves in Madagascar</div><div class="metadata"><div><span class="journal">Salamandra</span> <span class="volume">46</span>(3) pages 167--179 (2010)</div></div></a></div><div style="clear:both;"></div></div>
					</div>
				</div>
			</div>
			
			<div class="span6">
				<div class="feature">
					<h3>Interactive timelines</h3>
					<p><a href="mockup_concept.php?id=gbif/2432946">View interactive timelines for synonyms of <em>Rousettus</em> Gray, 1821</a></p>
					<div class="homepage-snippet-wrapper">
						<div class="snippet"><div id="thumb-idgbif_2432946" class="thumbnail concept-thumb"><a href="mockup_concept.php?id=gbif/2432946"><img src="http://media.eol.org/content/2012/06/27/23/55183_88_88.jpg"></a></div><div class="details"><a href="mockup_concept.php?id=gbif/2432946"><div class="title">Rousettus Gray, 1821</div><!-- metadata --><div class="metadata gbif">According to GBIF 2432946</div><div class="logo"><img src="images/logo-gbif.png"></div></a></div><div style="clear:both;"></div></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid homepage-features">
			<div class="span6">
				<div class="feature">
					<h3>Maps</h3>
					<p><a href="mockup_publication.php?id=ab2e0def5e24b38064ae74d4230b2e67">View localities extracted from a paper</a></p>
					<div class="homepage-snippet-wrapper">
						<div class="snippet"><div class="thumbnail concept-thumb"><a href="mockup_publication.php?id=ab2e0def5e24b38064ae74d4230b2e67"><img src="images/homepage-map.png"></a></div><div class="details"><a href="mockup_publication.php?id=ab2e0def5e24b38064ae74d4230b2e67"><div class="title">Bats (Mammalia: Chiroptera) from Indo-Australia</div><div class="metadata"><!-- begin metadata --><div>by J E Hill; <span class="journal">Bulletin of the British Museum (Natural History) Zoology</span> <span class="volume">45</span>(3) pages 103--208 (1983)</div></div><!-- end metadata --></a></div><div style="clear:both;"></div></div>
					</div>
				</div>
			</div>
			
			<div class="span6">
				<div class="feature">
					<h3>Authors</h3>
					<p><a href="mockup_author.php?name=C%20Van%20Achterberg">Explore publications by individual authors</a></p>
					<div class="homepage-snippet-wrapper">
						<div class="snippet"><div id="thumb-idgbif_2432946" class="thumbnail concept-thumb"><a href="mockup_author.php?name=C%20Van%20Achterberg"><img src="images/homepage-c-van-achterberg.jpg"></a></div><div class="details"><a href="mockup_author.php?name=C%20Van%20Achterberg"><div class="title">C Van Achterber</div></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--
      <div class="footer">
        <p>Cyndy, it's coming, almost certainly…</p>
      </div>
	-->
	
 



	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

  </body>
</html>	
