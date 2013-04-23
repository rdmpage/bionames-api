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
						var title = data.nameComplete;
						
						if (data.taxonAuthor)
						{
							title += ' ' + data.taxonAuthor;
						}
						
						$("#title").html(title);
						document.title = title;
						
						
						
						var html = '';
						
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
						
						$("#cluster").html(html);
						
						show_publications(data.nameComplete);
						
					}
				});
				
			
		}
		
		function show_concepts(id)
		{
			$("#concepts").html("");
			
			$.getJSON("http://bionames.org/bionames-api/name/" + id + "/concepts?callback=?",
				function(data){
					if (data.status == 200)
					{	
						if (data.concepts.length > 0) {
							var html = '<h3>Concept(s) using this name</h3>';
							for (var i in data.concepts) {	
								html += '<div>' + '<b>' + data.concepts[i].name + '</b>' + '</div>';
								html += '<div>' + '<a href="concept.php?id=' + data.concepts[i].concept + '" >' + data.concepts[i].concept + '</a>' + '</div>';
								
								if (data.concepts[i].eol)
								{
									html += '<a href="concept.php?id=' + data.concepts[i].concept + '" >';
									html += '<img src="http://bionames.org/bionames-api/taxon/eol/' + data.concepts[i].eol + '/thumbnail" /></div>';
									html += '</a>';
								}
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
								$('#publications').html(html + display_reference(data.years[i][j]));
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
								s = s.replace(epithet, '<b>' + epithet + '</b>');
								html += s + '<br />';
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


<div style="top:0px;height:40px;">&nbsp;</div>
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
	<p>Publications with this name</p>
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