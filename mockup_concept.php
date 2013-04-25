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
						html = '<img src="http://data.gbif.org/species/' + data.sourceIdentifier + '/overviewMap.png" width="360"/>';
						$("#info").html(html);
						
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
						  	 
						  	 var publishedInCitation = [];
						  	 var html ='';
						  	 html += '<div style="border:1px solid black;width:400px;background-color:rgb(228,228,228);">';
						  	 html += '<b>Names</b>';
						  	 html += '<ul>';
						     for (var j in data.identifier.ion)
						     {
						     	html += '<li>';
						     	html += '<span>';
						     	html += '<a href="mockup_taxon_name.php?id=cluster/' + j + '">';
						     	html += data.identifier.ion[j].nameComplete;
						     	html += '</a>';
						   	    html += '</span>';
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
						   }
						}
						
						// Now flesh out publication details
						show_name_publications(publishedInCitation);
						
						
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
						$("#publications").html(html);
						
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

<div style="top:40px;height:40px;background-color:#66FF66;">
<div style="float:right"><img src="images/logo_leaf.gif" height="40"/></div>
</div>

	<div style="position:relative;">
		
		<div style="float:right;top:0px;width:400px;border-left:1px black solid;padding-left:10px;">
		<div id="eol"></div>
		<div id="chart" style="width:300px;height:100px;">[chart]</div>	
		<h3>Classification</h3>
		<div id="classification">[classification]</div>
		
			<h3>Info</h3>
			<div id="info">[info]</div>	
		
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
	
	<script>
		var concept = "<?php echo $id;?>";
		show_classification(concept);
		show_timeline(concept);
		
		//show_wall(concept);
		
	</script>


</body>
</html>
