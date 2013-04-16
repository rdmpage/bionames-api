<?php

$id = $_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>BioNames API Demo: Concept</title>
	
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'> 
<!-- <link rel="stylesheet" href="../bionames-design/mockups/pubTimeline/style.css" type="text/css" media="screen" title="no title" charset="utf-8">  -->
	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
	<style type="text/css" title="text/css">
		
body {
  font-family: 'Open Sans', sans-serif;
  font-weight: 400;
  font-size: 14px;
  line-height: 20px;
  color: #2e3033;
}


/* Publication Lists */
.decadeYear {
  background: url(images/decade_dot.gif) no-repeat left center;
  padding-left: 10px;
  color: #bbbfc6;
  font-weight: 700;
  line-height: 30px;  
}

.pub {
  overflow: hidden; /* clearfix */
  margin-left: 3px;
  padding: 1em;
  background-color: #fafafa;
  border-bottom: 1px solid #fff;
  border-left: 2px solid #c3c7ce;
 }
 
 .pub:nth-child(2) {
   border-top: 1px solid #f9f9f9;
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


svg .bars {
  shape-rendering: crispEdges;
}
svg .axis path,
svg .axis line {
    fill: none;
    stroke: #737880;
    stroke-width: 1;
    shape-rendering: crispEdges;
}

svg .axis .domain {
  display: none;
}
        
svg .axis text {
    font-size: 11px;
}

svg .brush .extent {
  fill: rgba(0,0,0, 0.08);
  stroke: none;
}

svg .brush .resize path {
  fill: #fff;
  stroke: #737880;
  stroke-width: 1;
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
				
		
	</style>	
	
	<script>
		google.load("visualization", "1", {packages:["corechart"]});
		
		function show_timeline(concept)
		{
			$("#chart").html("");
			
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
						$("#name").html(data.scientificName);
						
						// Thumbnail
						
						// Taxon names
						if (data.identifier)
						{
						  if (data.identifier.eol)
						  {
						  	var html = '';
						  	html = 'EOL:' + data.identifier.eol[0] + '<br />';
						  	html += '<img style="border:1px solid rgb(228,228,228);" src="taxon/eol/' + data.identifier.eol[0] + '/thumbnail" />';
						  	$("#eol").html(html);
						  	
						  }

						  if (data.identifier.ion)
						  {
						  	 var html ='';
						  	 html += '<ul>';
						     for (var j in data.identifier.ion)
						     {
						     	html += '<li>';
						     	html += data.identifier.ion[j].nameComplete;
						     	
						     	if (data.identifier.ion[j].publication)
						     	{
						     		html += '<br />' + data.identifier.ion[j].publication;
						     	}
						     	if (data.identifier.ion[j].publishedInCitation)
						     	{
						     		html += '<br /><img src="http://placehold.it/60x60" />';
						     	}
						     	
						     	html += '</li>';
						     }
						     html += '</ul>';
						     $("#namemap").html(html);
						   }
						}
						
						// Timeline
						
						// Publications
						show_publications(data.canonicalName);						
						
						
					}
				});
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
									html += '<div class="pub article">';
									
									html += '<div class="thumbnail">';
									if (data.years[year][i].thumbnail_url) 
									{ 
										html += '<img style="border:1px solid rgb(228,228,228);" src="' + data.years[year][i].thumbnail_url + '" width="40"/>'; 
									}
									html += '</div>';
									
									html += '<div class="citation">';
									html += '<div class="title">';
									html += data.years[year][i].title;
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

	<h1>Taxon concept</h1>
	
	<div style="position:relative;">
		<div style="float:right;top:0px;width:400px;border-left:1px rgb(128,128,128) dotted;padding-left:10px;">
			<div id="eol"></div>
			<div id="chart" style="width:300px;height:100px;">[chart]</div>	
			<h3>Classification</h3>
			<div id="classification">[classification]</div>
			<h3>Info</h3>
			<div id="info">[info]</div>		
		</div>
	
		<h2 id="name">[name]</h2>
		
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
	</script>


</body>
</html>
