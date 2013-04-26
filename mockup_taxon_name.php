<?php

// mockup of taxon name display

$id = $_GET['id'];

?>

<html>
<head>
	<base href="/bionames-api/" />
	<!-- <base href="/~rpage/bionames-api/" /> -->
	<title>Taxon name</title>
	
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
	
	</style>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	
	<script>
		function show_cluster(id)
		{
			$("#cluster").html("");
			
			$.getJSON("http://bionames.org/bionames-api/id/" + id + "?callback=?",
				function(data){
					if (data.status == 200)
					{		
						// Display name
						var title = data.nameComplete;
						
						if (data.taxonAuthor)
						{
							title += ' ' + data.taxonAuthor;
						}
						
						$("#title").html(title);
						
						// Make browser window the name
						document.title = title;
						
						// Human readable
						
						var html = '';
						
						if (data.taxonAuthor)
						{	
							var author = data.taxonAuthor;
          					author = author.replace(/\(/, '');
          					author = author.replace(/\)/, '');  	
							
							html += '<span style="color:rgb(128,128,128);">This name was published by </span><b>' + author + '</b>' + ' ' + '<a href="mockup_search.php?q=' + encodeURIComponent(author) + '">more by this author...</a>';
						}
						$("#cluster").html(html);
						
						
						// Publications
						var publications = [];
						for (var i in data.names)
						{
							if (data.names[i].publication)
							{
								var html = $("#cluster").html();
								html += '<div style="padding-left:60px;"';
								if (data.names[i].publishedInCitation) {
									html += ' id="publication' + data.names[i].publishedInCitation + '"';
								}								
								html += '>';
								html += data.names[i].publication;
								html += '</div>';
								$("#cluster").html(html);
							}
						}
						
						
						
						
						// Sidebar
						
						
						// Concepts
						show_concepts(id);
						
						// Variants and related names
						var epithet = '';
						if (data.infraspecificEpithet) {
							epithet = data.infraspecificEpithet;
						} else if (data.specificEpithet) {
							epithet = data.specificEpithet;
						}

						if (epithet != '') {
							if (data.taxonAuthor) { 
							  var author =  data.taxonAuthor;
							  author = author.replace(/\(/, '');
							  author = author.replace(/\)/, '');  
							  
							  epithet = epithet + ' ' + author;
							  show_epithet(epithet);
							}
						}
						
						
						
						// Publications with this name string
						show_publications(data.nameComplete);
						
						// Now flesh out publication details
						if (data.publishedInCitation) {
							show_name_publications(data.publishedInCitation);
						}
						
						
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
		
		
		function show_concepts(id)
		{
			$("#concepts").html("");
			
			$.getJSON("http://bionames.org/bionames-api/name/" + id + "/concepts?callback=?",
				function(data){
					if (data.status == 200)
					{	
						if (data.concepts.length > 0) {
							var html = '<h3>This name has been used for these taxa</h3>';
							for (var i in data.concepts) {
							
								var accepted = (data.concepts[i].nameComplete ==  data.concepts[i].canonicalName);
								
								
								var style = 'border:1px solid black;padding:10px;';
								
								if (accepted)
								{
									style += 'background-color:00FF00;';
								}
								else
								{
									style += 'background-color:#FF0000;';
								}
								
								html += '<div style="' + style + '">';
								
								if (accepted) 
								{
									html += '<div style="float:right;color:white;font-weight:bold;font-size:300%">✓</div>';
								} 
								else 
								{
									html += '<div style="float:right;color:white;font-weight:bold;font-size:300%">✗</div>';
								}								
								
														
								html += '<div>' + '<b>' + data.concepts[i].scientificName + '</b>' + '</div>';
								html += '<div>' + '<a href="mockup_concept.php?id=' + data.concepts[i].concept + '" >' + data.concepts[i].concept + '</a>' + '</div>';
								
								if (data.concepts[i].concept.match(/gbif/))
								{
										html += '<div>' + 'According to GBIF';										
										html += '<div style="float:right;"><img src="images/logo_leaf.gif" width="48"/></div>';
										html += '</div>';
								}									
								
								if (data.concepts[i].eol)
								{
									html += '<div>';
									html += '<a href="concept.php?id=' + data.concepts[i].concept + '" >';
									html += '<img src="http://bionames.org/bionames-api/taxon/eol/' + data.concepts[i].eol + '/thumbnail" /></div>';
									html += '</a>';
									html += '</div>';
								}
								
															
								
								html += '<div style="clear:both;" />';
								html += '</div>';
								
								
								
							}
							$("#concepts").html(html);
						}
					}
				});
		}
		
	
		function show_publications(name)
		{
			$("#publications").html("");
			
			$.getJSON("http://bionames.org/bionames-api/name/" + encodeURIComponent(name) + "/publications?fields=title,thumbnail,identifier,author,journal,year" + "&callback=?",
				function(data){
					if (data.status == 200)
					{		
						for (var i in data.years)
						{
							
							for (j in data.years[i])
							{
								var html = $('#publications').html();
								$('#publications').html(html + display_reference(data.years[i][j]) + '<br/>');
							}
						}
					}
				});
		}
		
		function show_epithet(epithet)
		{
			$("#epithet").html("");
			
			$.getJSON("http://bionames.org/bionames-api/name/" + encodeURIComponent(epithet) + "/epithet?callback=?",
				function(data){
					if (data.status == 200)
					{	
						if (data.names.length > 1) {					
							var html = '<h3>Names with same epithet</h3>';
							html += '<div style="text-align:right">';
							for (var i in data.names)
							{
								var s = data.names[i];
								html += '<a href="mockup_search.php?q=' + encodeURIComponent(s) + '">' + s + '</a>' + '<br />';
							}
							html += '</div>';
							var current_html = $("#epithet").html();
							$("#epithet").html(current_html + html);
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
		<input class="search-input" name="q" placeholder="Search" style="width: 22em; padding-left: 2em;" type="text" value="">
		<input type="submit" value="Search">
	</form>
</div>


<div style="top:0px;float:right;width:280px;padding:10px;">
	<div id="metadata"></div>
	<!-- <h3>Stuff</h3>
	
	<p>Names with same epithet + author, names with same epithet that co-occur, names with same genus, any name we have evidence may be related.</p>
	-->
	<div id="concepts"></div>	
	<div id="epithet"></div>
	
</div>
	<div id="title" style="font-size:200%;line-height:150%"></div>

	<div id="cluster"></div>

	<h3>Publications mentioning this name</h3>
	<div style="border:1px solid rgb(128,128,128);height:60px;width:400px;">timeline thingy</div>
	<div id="publications">[list]</div>	

	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>


<script type="text/javascript">
		var id = "<?php echo $id;?>";
		show_cluster(id);
</script>		
</body>
</html>