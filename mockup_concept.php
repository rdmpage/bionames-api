<?php

$id = $_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>BioNames API Demo: Concept</title>
	
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'> 

	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>

	<!-- Google Maps -->
    <!-- <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
	<!--
	<script>
    	var map; // Google map
    
      function initialize() {
        var myOptions = {
        	center: new google.maps.LatLng(0, 0),
          	zoom: 2,
           mapTypeId: google.maps.MapTypeId.TERRAIN,
           streetViewControl: false
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      }
	</script>	
	-->
	
	
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
		
		
		/* Simple tree */
		.classification
		{
			list-style-type:none;
			margin-left:6px;
			padding:0px;
		}
		
		.root 
		{
		  margin-left: 0px;
		  padding: 0px 0px 0px 10px;
		  background: url("images/root.png") no-repeat 0 0;
		  line-height:16x;
		}	
		
		.child 
		{
		  margin-left: 0px;
		  padding: 0px 0px 0px 10px;
		  background: url("images/child.png") no-repeat 0 0;
		  line-height:16x;
		}	
		
		.lastchild 
		{
		  margin-left: 0px;
		  padding: 0px 0px 0px 10px;
		  background: url("images/lastchild.png") no-repeat 0 0;
		  line-height:16x;
		}	
				
				
	.pub .thumbnail {
	  float: left;
	  width: 40px;
	  height: 60px;
	  overflow: hidden;
	  /*
	  background-color: rgba(0,0,0,0.1);
	  border: 1px solid rgba(0,0,0,0.05);
	  border-radius: 2px;*/
	  
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
 	background-color:white;
 	border-bottom:1px solid rgb(192,192,192);
	border-right:1px solid rgb(192,192,192);
	border-top:1px solid rgb(228,228,228);
	border-left:1px solid rgb(228,228,228);
 	padding:10px;
 	width:300px;
 	margin:10px;
 	height:120px;
 	overflow:hidden;
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
 
 .snippet .details_wide {
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
	
	<script>
		google.load("visualization", "1", {packages:["corechart"]});
		
		function show_timeline(concept)
		{
			$("#chart").html("");
			$("#chart").height(0);
			
			$.getJSON("http://bionames.org/bionames-api/taxon/" + concept + "/timeline?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var chart_data = [];
						chart_data.push(new Array('Year','Count'));		
						
						for (var year in data.years)
						{						
							chart_data.push(new Array(year, data.years[year]));
						}
						$("#chart").height(100);
						
						var options = { title: name };
						var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
        				chart.draw(google.visualization.arrayToDataTable(chart_data), options);
        			}
        		});
        }
        

      function gbif_map(id)
      {
      	/*
      	$.getJSON("get_gbif_geojson.php?id=" + id + "&callback=?",
			function(geojson){

        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < geojson.coordinates.length; i++) {
          var coords = geojson.coordinates[i];
          var cell = coords[0];
          
			var square = [
				new google.maps.LatLng(cell[0][1],cell[0][0]),
				new google.maps.LatLng(cell[1][1],cell[1][0]),
				new google.maps.LatLng(cell[2][1],cell[2][0]),
				new google.maps.LatLng(cell[3][1],cell[3][0]),
				new google.maps.LatLng(cell[0][1],cell[0][0])
				];
			bounds.extend(square[0]);
			bounds.extend(square[2]);
			
			var polygon = new google.maps.Polygon({
				paths: square,
				strokeColor: 'blue',
				strokeOpacity: 0.7,
				strokeWeight: 1.0,
				fillColor: 'blue',
				fillOpacity: 0.7,
				map:map
				});
        }
        map.fitBounds(bounds); 

						

			}
		);
		*/
      
      }        
      
      function show_images(concept)
      {
			$("#images").html("");
			$.getJSON("http://bionames.org/bionames-api/taxon/" + concept + "/thumbnail?callback=?",
				function(data){
					if (data.status == 200) {
						if (data.thumbnails.length != 0) {
							var html = '';
							html += '<div>';
							var n = Math.min(4, data.thumbnails.length);
							for (var i=0;i<n;i++) {
								html += '<img style="padding:4px;" src="' + data.thumbnails[i] + '" />';
							}
							html += '<div>Images from <a href="http://eol.org/pages/' + data.eol + '">EOL</a></div>';
							html += '</div>';
						
							$("#images").html(html);
						}
					}
				});
	 }
					
			
	
	
		function show_classification(concept)
		{
			$("#classification").html("");
			$("#namemap").html("");
			
			$.getJSON("http://bionames.org/bionames-api/taxon/" + concept + "?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						
						var sourcePrefix = [];
						sourcePrefix['http://ecat-dev.gbif.org/checklist/1'] = 'gbif';
						sourcePrefix['http://www.ncbi.nlm.nih.gov/taxonomy'] = 'ncbi';
						
						// logo
						switch (sourcePrefix[data.source])
						{
							case 'gbif':
								$('#logo').attr('src', 'images/logo_leaf.gif');
								break;
								
							case 'ncbi':
								$('#logo').attr('src','images/ncbi-twitter.jpg');
								break;
								
							default:
								break;
						}
								
						
						
						// Classification (nodes immediately above and below)	
						html += '<ul class="classification">';
						
						// Parent taxon
						html += '<li class="root">';
						if (data.ancestors)
						{
							html += '<a href="?id=' + sourcePrefix[data.source] + '/' + data.ancestors[data.ancestors.length-1].sourceIdentifier + '">' + '<p style="line-height:16px;padding:0px;margin:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:100%;opacity:0.6">' + data.ancestors[data.ancestors.length-1].scientificName + '</p>' + '</a>';
						}
						
						// This taxon
						html += '<ul class="classification">';
						html += '<li class="lastchild">' 
							+ '<a href="?id=' + sourcePrefix[data.source] + '/' +  data.sourceIdentifier + '">'
//							+ '<span style="background-color:yellow">' + data.scientificName + '</span>'
							+ '<span>' + data.scientificName + '</span>'
							+ '</a>';						
						
						// Child taxa
						if (data.children)
						{
							html += '<ul class="classification">';
							var num_children = data.children.length;
							for (j = 0; j < num_children; j++)
							{
								if (j == (num_children - 1))
								{
									html += '<li class="lastchild">';
								}
								else
								{
									html += '<li class="child">';
								}
								html += '<a href="?id=' + sourcePrefix[data.source] + '/' +  data.children[j].sourceIdentifier + '">' + '<p style="line-height:16px;padding:0px;margin:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:100%;opacity:0.6">' + data.children[j].scientificName + '</p>' + '</a>' + '</li>';
							}
							html += '</ul>';
						}
						html += '</li>'
						html += '</ul>'; // this taxon				
						
						html += '</li>'; // root
						html += '</ul>';
						
						// Classification
						$("#classification").html(html);
						
						// Classification-specific info
						/*
						html = '<img src="http://data.gbif.org/species/' + data.sourceIdentifier + '/overviewMap.png" width="360"/>';
						$("#info").html(html);
						*/
						
						switch (sourcePrefix[data.source])
						{
							case 'gbif':
								gbif_map(data.sourceIdentifier);
								break;
								
							case 'ncbi':
								$('#map_canvas').hide();
								break;
								
							default:
								break;
						}
						
						
						// Accepted name

						$("#title").html(data.scientificName);
						
						if (data.namePublishedIn) {
							$("#namePublishedIn").html(data.namePublishedIn);
						}
						
						// Thumbnail
						
						// Taxon names
						if (data.identifier)
						{
						  if (data.identifier.eol)
						  {
						  	var html = '';
						  	html = 'EOL:' + data.identifier.eol[0] + '<br />';
						  	html += '<img style="border:1px solid rgb(228,228,228);" src="http://bionames.org/bionames-api/taxon/eol/' + data.identifier.eol[0] + '/thumbnail" />';
						  	$("#eol").html(html);
						  	
						  }

						  if (data.identifier.ion)
						  {
						  	 var html ='';
						  	 html += '<div>';
						  	 html += '<b>Names</b>';
						     for (var j in data.identifier.ion) {
						     	var element_id = 'cluster/' + j;
						  		html += '<div id="id' + element_id.replace(/\//, '_') + '"></div>';
						  	 }
						  	 html += '</div>';
						  	 $("#namemap").html(html);
						     for (var j in data.identifier.ion) {
						     	var element_id = 'cluster/' + j;
						  		display_snippets(element_id);
						  	 }
						  
						  	 /*
						  	 var publishedInCitation = [];
						  	 var html ='';
						  	 html += '<div style="border:1px solid black;width:400px;background-color:rgb(228,228,228);">';
						  	 html += '<b>Names</b>';
						  	 html += '<ul>';
						     for (var j in data.identifier.ion)
						     {
						     	html += '<li>';
						     	html += '<span style="padding:2px;background-color:orange;-webkit-border-radius:4px;">';
						     	html += '<a href="mockup_taxon_name.php?id=cluster/' + j + '">';
						     	html += data.identifier.ion[j].nameComplete;
						     	html += '</a>';
						   	    html += '</span>';
						   	    
						   	    // identifier
						   	    
						   	    html += '<ul>';
						   	    html += '<li>';
						   	    html += 'urn:lsid:organismnames.com:name:' + j;
						   	    html += '</li>';
						   	    html += '</ul>';
						   	    
						   	    
						   	    // publication
						   	    html += '<ul>';
						     	if (data.identifier.ion[j].publication)
						     	{
						     		html += '<li>';
									html += '<div ';
									if (data.identifier.ion[j].publishedInCitation) {
										publishedInCitation.push(data.identifier.ion[j].publishedInCitation);
										html += ' id="publication' + data.identifier.ion[j].publishedInCitation + '"';
									}								
									html += '>';
									html += data.identifier.ion[j].publication;
									html += '</div>';
									html += '</li>';
								}
								html += '</ul>';
								html += '</li>';
						     }
						     html += '</ul>';
						     html += '</div>';
						     $("#namemap").html(html);
						     */
						   }
						}
						
						// Now flesh out publication details
						//show_name_publications(publishedInCitation);
						
						
						// Timeline
						
						// Publications
						show_publications(data.canonicalName);						
						
						
					}
				});
		}
		
		function show_name_publications(publishedInCitation)
		{
			for (var id in publishedInCitation)
			{
				$.getJSON("http://bionames.org/bionames-api/id/" + publishedInCitation[id] + "?callback=?",
					function(data){
						if (data.status == 200) {
							$('#publication' + publishedInCitation[id]).html(display_reference(data));
						}
					});
			}
				
		}	
		
		// Publications with a timeline
		function show_publications(name)
		{
			$("#publications").html("");
			
			$.getJSON("http://bionames.org/bionames-api/name/" + name + "/publications?fields=title,thumbnail,identifier,author" + "&callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';						
						
						
						/*
						html = '<ul>';
						if (data.years)
						{
							for (var year in data.years)
							{
								var count = 0;
								
								html += '<li>' + year;
								
								html += '<ul>';
								
								for (var i in data.years[year])
								{
									count++;
									html += '<li>';
									html += '<div class="pub article">';
									
									html += '<div class="thumbnail">';
									if (data.years[year][i].thumbnail_url) 
									{ 
										html += '<img style="border:1px solid rgb(228,228,228);" src="http://bionames.org/bionames-api/' + data.years[year][i].thumbnail_url + '" width="40"/>'; 
									}
									html += '</div>';
									
									html += '<div class="citation">';
									html += '<div class="title">';
									
									html += '<a href="mockup_publication.php?id=' +i + '">';
									html += data.years[year][i].title;
									html += '</a>';
									html += '</div>';
									
									html += '<div class="meta">';
									
									if (data.years[year][i].author)
									{
										for (var j in data.years[year][i].author)
										{
											html += data.years[year][i].author[j].name + ' ';
										}
									}
									
									if (data.years[year][i].identifier)
									{
										html += '<ul>';
										for (var j in data.years[year][i].identifier)
										{
											switch (data.years[year][i].identifier[j].type)
											{
												case "biostor":
													html += "<li><a href=\"http://biostor.org/reference/" + data.years[year][i].identifier[j].id + "\" target=\"_new\">biostor.org/reference/" + data.years[year][i].identifier[j].id + "</a></li>";
													break;

												case "cinii":
													html += "<li><a href=\"http://ci.nii.ac.jp/naid/" + data.years[year][i].identifier[j].id + "\" target=\"_new\">ci.nii.ac.jp/naid/" + data.years[year][i].identifier[j].id + "</a></li>";
													break;
													
												case "doi":
													html += "<li><a href=\"http://dx.doi.org/" + data.years[year][i].identifier[j].id + "\" target=\"_new\">dx.doi.org/" + data.years[year][i].identifier[j].id + "</a></li>";
													break;

												case "handle":
													html += "<li><a href=\"http://hdl.handle.net/" + data.years[year][i].identifier[j].id + "\" target=\"_new\">hdl.handle.net/" + data.years[year][i].identifier[j].id + "</a></li>";
													break;

												case "jstor":
													html += "<li><a href=\"http://www.jstor.org/stable" + data.years[year][i].identifier[j].id + "\" target=\"_new\">www.jstor.org/stable/" + data.years[year][i].identifier[j].id + "</a></li>";
													break;
													
												default:
													break;
											}
										}	
										html += '</ul>';
									}
									html += '</div>';
									
									html += '</div>';
									html += '</div>';
									
									html += '</li>';
								}
								
								html += '</ul>';
								html += '</li>';

							}
						}
						html += '</ul>';
						*/
						if (data.publications)
						{
							html += '<ul>';
							var ids = [];
							for (var i in data.publications)
							{
								html += '<li>';
								html += '<div id="id' + data.publications[i] + '">' + data.publications[i] + '</div>';
								ids.push(data.publications[i]);
								//html += data.publications[i]._id;
								html += '</li>';
							}							
							html += '</ul>';

							// display details
							for (var id in ids) {
								html += '<script>display_publications("' + ids[id] + '");<\/script>';
							}
							
						}						
						$("#publications").html(html);
						
					}
				});
		}		
		
		// Coloured boxes indicating presence or absence of publication
		function show_child_publications(concept)
		{
			$("#child_publications").html("");
			
			$.getJSON("http://bionames.org/bionames-api/taxon/" + concept + "/publications/children?callback=?",
				function(data){					
					if (data.status == 200)
					{			
							var html = '<h3>Publications</h3>';
							html += '<div style="width:200px;position:relative;">';
							for (var i in data.children) {
								var colour = 'rgb(228,228,228)';
								if (data.children[i].length > 0) {
									colour = 'green';
								}
								html += '<div style="float:left;width:20px;height:20px;">';
								html += '<a href="mockup_concept.php?id=' + i + '">';
								html += '<div style="width:16px;height:16px;background-color:' + colour + ';margin:2px;"></div>';
								html += '</a>';
								html += '</div>';
							}
							html += '<div style="clear:both;"></div>';
							html += '</div>';
							
							$("#child_publications").html(html);
					}
					
				});
		}
		
		// 
		function show_child_publication_thumbnails(concept)
		{
			$("#child_publication_thumbnails").html("");
			
			$.getJSON("http://bionames.org/bionames-api/taxon/" + concept + "/publications/children?callback=?",
				function(data){					
					if (data.status == 200)
					{			
						var ids = [];
						
						var count = 0;
					
						var html = '<h3>Publication thumbnails</h3>';
						html += '<div style="width:200px;">';
						for (var i in data.children) {
							if (data.children[i].length > 0) {
								for (var j in data.children[i]) {
									count++;
									var dom_id = 'thumbnail' + count;
									html += '<div style="float:left;" id="' + dom_id + '" data-id="' + data.children[i][j] + '">' + data.children[i][j] + '</div>';
									ids.push(dom_id);
								}
							} else {
								html += '<div style="float:left;border:1px solid black;width:64px;height:80px;text-align:center;">?</div>';
							}
						}
						html += '</div>';
							
						// display details
						for (var id in ids) {
							html += '<script>display_publication_thumbnails_data_id("' + ids[id] + '");<\/script>';
						}
						
						$("#child_publication_thumbnails").html(html);
					}
					
				});
		}		
		
				
		
	</script>
	
	
</head>
<!-- <body onload="initialize()"> -->
<body>

<div style="top:0px;height:40px;">
	<div style="float:right;">
		<a href="mockup_index.php">Home</a>
		&nbsp;
		<a href="mockup_dashboard.php">Dashboard</a>
	</div>

	<form method="GET" action="mockup_search.php">
		<input class="search-input" name="q" placeholder="Search" style="width: 22em; padding-left: 2em;" type="text" value="">
		<input type="submit" value="Search">
	</form>
</div>

<div style="top:40px;height:40px;background-color:#66FF66;">
<!-- <div style="float:right"><img src="images/logo_leaf.gif" height="40"/></div> -->
<!--<div style="float:right"><img id="logo" src="images/ncbi-twitter.jpg" height="40"/></div> -->
<div style="float:right"><img id="logo" src="" height="40"/></div>
</div>

	<div style="position:relative;">
		
		<div style="float:right;top:0px;width:400px;border-left:1px black solid;padding-left:10px;">
		<div id="images"></div>
		<!-- 
		<div id="chart" style="width:300px;height:100px;">[chart]</div>	
		-->
		<h3>Classification</h3>
		<div id="classification">[classification]</div>
		<div id="child_publications">xxx</div>
		<div id="child_publication_thumbnails">xxx</div>
		
			<h3>Info</h3>
			<!--<div id="info">[info]</div>	-->
			<!--<div id="map_canvas" style="width:400px; height:200px;float:right;top:0px;"></div> -->
		
		</div>
	
		<div id="title" style="font-size:200%;line-height:150%"></div>

		<div id="namePublishedIn" style="padding-left:20px;color:rgb(192,192,192);"></div>

		<div id="namemap">Names</div>
		
		<h3>Publications</h3>
		<div id="publications">[publications]</div>
	
	</div>
		
	

	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>
	<script src="js/publication.js"></script>
	<script src="js/snippet.js"></script>
	
	<script>
		var concept = "<?php echo $id;?>";
		show_images(concept);
		show_classification(concept);
		//show_timeline(concept);
		show_child_publications(concept);
		
		show_child_publication_thumbnails(concept);
		
		//show_wall(concept);
		
	</script>


</body>
</html>
