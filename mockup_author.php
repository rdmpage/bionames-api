<?php

// mockup template

// do PHP stuff here to get query parameters...
if (isset($_GET['name']))
{
	$name = $_GET['name'];
}


?>
<!DOCTYPE html>
<html>
<head>
	<base href="/bionames-api/" />
	<title>Title</title>
	
	<!-- standard stuff -->
	<meta charset="utf-8" />
	<?php require 'stylesheets.inc.php'; ?>
	
	<?php require 'javascripts.inc.php'; ?>
	
</head>
<body class="author">

	<?php require 'navbar.inc.php'; ?>
	
	<div style="margin-top:50px;" class="container-fluid">
		<div class="row-fluid">
	  		<div class="span9">
		        <div id="publication-timeline" class="publication-timeline">
		            <h3>Publications</h3>
		            <div id="pubHistogram" class="chart"></div>
		            <div id="pubList"></div>
		        </div>
			</div>
	  		<div class="span3">
	  			<h4 id="title"></h4>
				<div id="metadata"></div>
				<div id="coauthors">Coauthors</div>
				<div id="taxa">Names published</div>
	  		</div>
		</div>
	</div>

	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>
	<script src="js/publication.js"></script>


<script type="text/javascript">
	var name = "<?php echo $name;?>";
	
	
		function show_coauthors(name)
		{
			$("#coauthors").html("");
			
			$.getJSON("http://bionames.org/bionames-api/authors/" + name + "/coauthors?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						html += '<h5>Coauthors</h5>';
						html += '<ul>';
						for (var i in data.coauthors)
						{
							html += '<a href="mockup_author.php?name=' + data.coauthors[i] + '">';
							html += '<li>' + data.coauthors[i] + '</li>';
							html += '</a>';
						}
						html += '</ul>';
						$("#coauthors").html(html);
					}
				});
		}
		
		function show_taxa(name)
		{
			$("#taxa").html("");
			
			$.getJSON("http://bionames.org/bionames-api/authors/" + name + "/publications/taxa?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						html += '<h5>Names published</h5>';
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
						$("#taxa").html(html);
					}
				});
		}
		
		function show_related_names(name)
		{
			$("#related").html("");
			
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
							html += '<h5>Related names</h5>';
							html += '<ul>';
							for (var i in data.firstnames)
							{
								html += '<a href="mockup_author.php?name=' + data.firstnames[i] + ' ' + lastname + '">';
								html += '<li>' + data.firstnames[i] + ' ' + lastname + '</li>';
								html += '</a>';
							}
							html += '</ul>';
							$("#related").html(html);
						}
					});
			}
		}
		
		
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
		
		
		
		function show_timeline(name)
		{
			$("#timeline").html("");
			
			$.getJSON("http://bionames.org/bionames-api/authors/" + name + "/publications/years?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '<ul>';
						for (var i in data.years)
						{
							html += '<li>' + i + ' ' + data.years[i] + '</li>';
						}
						html += '</ul>';
						$("#timeline").html(html);
					}
				});
		}
		
		$("#title").html(name);
		
		document.title = name;
	
		show_related_names(name);
		show_coauthors(name);
		show_taxa(name);		
		//show_timeline(name);
		show_publications(name);

<!-- typeahead for search box -->
	$("#q").typeahead({
	  source: function (query, process) {
		$.getJSON('http://bionames.org/bionames-api/name/' + query + '/suggestions?callback=?', 
		function (data) {
		  //data = ['Plecopt', 'Peas'];
		  
		  var suggestions = data.suggestions;
		  process(suggestions)
		})
	  }
	})		

	
</script>

</body>
</html>
