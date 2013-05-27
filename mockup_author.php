<?php

// mockup of journal display

$name = '';

if (isset($_GET['name']))
{
	$name = $_GET['name'];
}


?>

<html>
<head>
	<base href="/bionames-api/" />
	<!-- <base href="/~rpage/bionames-api/" /> -->
	<title>Author</title>
	
	<!-- standard stuff -->
	<meta charset="utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'> 
	
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="stylesheets/style.css" rel="stylesheet" media="screen">
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="js/lib/d3.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/lib/crossfilter.1.2.0.js" type="text/javascript" charset="utf-8"></script>

	<script src="js/openurl.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/display.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/snippet.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/filter_widgets.js" type="text/javascript" charset="utf-8"></script>
</head>
<body class="author">
    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="index.html">BioNames</a>
        </div>
      </div>
    </div>
   <div class="container-fluid">
  <div class="row-fluid">
    <div class="main-content span9">
        <div class="page-header">
            <h1 id="title"></h1>
        </div>
        <div id="publication-timeline" class="publication-timeline">
            <h3>Publications</h3>
            <div id="pubHistogram" class="chart"></div>
            <div id="pubList"></div>
        </div>
    </div>
    <div class="sidebar span3">
        <div id="coauthors" class="sidebar-section"></div>
        <div id="taxa" class="sidebar-section"></div>
        <div id="related" class="sidebar-section"></div>
    </div>
  </div>
</div>



<script type="text/javascript">
	var name = "<?php echo $name;?>";
	
			function show_coauthors(name)
			{
				$("#coauthors").html("").hide(); // RMS added hide() to keep emtpy divs from cramping my margin style
			
				$.getJSON("http://bionames.org/bionames-api/authors/" + name + "/coauthors?callback=?",
					function(data){
						if (data.status == 200)
						{		
							var html = '';
							html += '<h3>Coauthors</h3>';
							html += '<ul>';
							for (var i in data.coauthors)
							{
								html += '<a href="mockup_author.php?name=' + data.coauthors[i] + '">';
								html += '<li>' + data.coauthors[i] + '</li>';
								html += '</a>';
							}
							html += '</ul>';
							$("#coauthors").html(html).show(); // RMS
						}
					});
			}
		
			function show_taxa(name)
			{
				$("#taxa").html("").hide(); // RMS added hide() to keep emtpy divs from cramping my margin style
			
				$.getJSON("http://bionames.org/bionames-api/authors/" + name + "/publications/taxa?callback=?",
					function(data){
						if (data.status == 200)
						{		
							var html = '';
							html += '<h3>Names published</h3>';
							html += '<ul>';
							for (var i in data.names) {
								html += '<li>';
								html += '<a href="mockup_taxon_name.php?id=' + data.names[i].cluster + '">';
								html += data.names[i].nameComplete;
								html += '</a>';
								//html += '<br/>';
								//html += '<span style="color:rgb(128,128,128);font-size:70%">' + data.names[i].id + '</span>';						
								html += '</li>';
							}
							html += '</ul>';
							$("#taxa").html(html).show(); // RMS 
						}
					});
			}
		
			function show_related_names(name)
			{
				$("#related").html("").hide(); // RMS added hide() to keep emtpy divs from cramping my margin style
			
				var lastname = '';
				var match = name.match(/(\w+)$/);
				if (match.length > 0)
				{
					lastname = match[1];
			
					$.getJSON("http://bionames.org/bionames-api/authors/lastname/" + lastname + "?callback=?",
						function(data){
							if (data.status == 200)
							{		
								var html = '';
								html += '<h3>Related names</h3>';
								html += '<ul>';
								for (var i in data.firstnames)
								{
	                                html += "<li>"
									html += '<a href="mockup_author.php?name=' + data.firstnames[i] + ' ' + lastname + '">';
									html += data.firstnames[i] + ' ' + lastname
	                                html += '</li>';
									html += '</a>';
								}
								html += '</ul>';
								$("#related").html(html).show();
							}
						});
				}
			}
		
			// RMS changed this function to do d3/crossfilter
			function show_publications(name)
			{
				$("#publications").html("");
			
				$.getJSON("http://bionames.org/bionames-api/authors/" + encodeURIComponent(name) + "/publications?fields=title,thumbnail,identifier,author,journal,year&include_docs" + "&callback=?",
					function(data){
						if (data.status == 200)
						{		
	                        // Type cast years into integers
							for (var i in data.publications)
							{
	                            data.publications[i].year = +data.publications[i].year;
							}
                                                
	                        // Crossfilter, dimensions, and groups
	                        var publication = crossfilter(data.publications),
	                            year = publication.dimension(function(d){ return d.year; }),
	                            years = year.group();
    
	                        var yearsExtent = d3.extent( years.all(), function(d){ return d.key; })
    
	                        // Nest operator for grouping the list by decade
	                        var nestByDecade = d3.nest()
	                            .key(function(d){ return Math.floor(d.year/10) * 10; });
                            
                            
	                            // Charts
	                            var histograms = [
	                                filterWidgets.histogram()
	                                    .dimension(year)
	                                    .group(years)
	                                    .round( Math.floor )
	                                    .xScale( d3.scale.linear()
	                                        .domain([ yearsExtent[0], yearsExtent[1]+1])
	                                        .rangeRound([0, 400])
	                                        .nice())
	                                    .yScale( d3.scale.linear().rangeRound([0, 60]) )
	                            ];
    
	                            var lists = [
	                                filterWidgets.publicationList().dimension(year).nest(nestByDecade)
	                            ];
                            
                            
	                            // Given an array of histogram definitions, bind them to
	                            // charts in the DOM, which we assume are in the same order
	                            var chart = d3.selectAll(".chart")
	                                .data(histograms)
	                                .each(function(c){ c.on("brush", renderAll).on("brushend", renderAll); })
    
	                            var list = d3.selectAll("#pubList")
	                                .data(lists);
    
	                            function renderAll(){
	                                chart.each(render);
	                                list.each(render);
	                            }
    
	                            function render( method ) {
	                                d3.select(this).call(method);
	                            }
    
	                            renderAll();
						}
					});
			}
		
			$("#title").html(name);
	
			show_related_names(name);
			show_coauthors(name);
			show_taxa(name);		
			show_publications(name);
	

	
	</script> 



</body>
</html>