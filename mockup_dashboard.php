<?php

// mockup of dashboard

?>

<html>
<head>
	<base href="/bionames-api/" />
	<!-- <base href="/~rpage/bionames-api/" /> -->
	<title>Dashboard</title>
	
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

<h1>Dashboard</h1>



<div id="issn" style="float:right;margin:20px;width:500px;">Journals</div>
<div id="publishers" style="float:right;margin:20px;width:500px;">Journals</div>
<div id="identifiers" style="float:right;margin:20px;">Identifiers</div>
<div id="links" style="float:right;margin:20px;">Links</div>
<div id="documents" style="float:right;margin:20px;">Documents</div>


	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>

<script type="text/javascript">
	
		function show_identifiers()
		{
			$("#identifiers").html("");
			
			$.getJSON("http://bionames.org/bionames-api/api_dashboard.php?identifiers&callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						html += '<b>Identifiers</b>';
						html += '<table style="border:1px solid black;">';
						for (var i in data.rows)
						{
							html += '<tr>';
							html += '<td>';
							html += data.rows[i].key;
							html += '</td>';
							html += '<td align="right">';
							html += data.rows[i].value;
							html += '</td>';
							html += '</tr>';
						}
						html += '</table>';
						
						$("#identifiers").html(html);
					}
				});
		}
		
		function show_links()
		{
			$("#links").html("");
			
			$.getJSON("http://bionames.org/bionames-api/api_dashboard.php?links&callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						html += '<b>Links</b>';
						html += '<table style="border:1px solid black;">';
						for (var i in data.rows)
						{
							html += '<tr>';
							html += '<td>';
							html += data.rows[i].key;
							html += '</td>';
							html += '<td align="right">';
							html += data.rows[i].value;
							html += '</td>';
							html += '</tr>';
						}
						html += '</table>';
						
						$("#links").html(html);
					}
				});
		}

		function show_documents()
		{
			$("#documents").html("");
			
			$.getJSON("http://bionames.org/bionames-api/api_dashboard.php?documents&callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						html += '<b>Documents</b>';
						html += '<table style="border:1px solid black;">';
						for (var i in data.rows)
						{
							html += '<tr>';
							html += '<td>';
							html += data.rows[i].key;
							html += '</td>';
							html += '<td align="right">';
							html += data.rows[i].value;
							html += '</td>';
							html += '</tr>';
						}
						html += '</table>';
						
						$("#documents").html(html);
					}
				});
		}
		
		function show_issn()
		{
			$("#issn").html("<b>Journals with ISSNs</b>");
		
			$.getJSON("http://bionames.org/bionames-api/api_dashboard.php?issn&callback=?",
				function(data){
					if (data.status == 200)
					{
						var r = jQuery("#issn").width(),
							format = d3.format(",d"),
							fill = d3.scale.category20c();
						var bubble = d3.layout.pack()
							.sort(null)
							.size([r, r]);
						var vis = d3.select("#issn").append("svg:svg")
							.attr("width", r)
							.attr("height", r)
							.attr("class", "bubble")
						var node = vis.selectAll("g.node")
							.data(bubble(data)
							.filter(function(d) { return !d.children; }))
							.enter().append("svg:g")
							.attr("class", "node")
							.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
						node.append("svg:title")
							.text(function(d) { return d.data.name + " : " + format(d.data.value) + " articles"})
						node.append("svg:circle")
							.attr("r", function(d) { return d.r; })
							.style("fill", function(d) { return fill(d.data.name); })
						node.append("svg:text")
							.attr("text-anchor", "middle")
							.attr("dy", ".3em")
							.attr("style", "font-size:10px")
							.text(function(d) { if (d.data.name) { return d.data.name.substr(0, d.r/3);} else { return ""; } })
						node.on("click",function(d) {
							clickbubble(d.data.issn)});
					
					}
				});
		}
		
        var clickbubble = function(issn) {
            window.location = "mockup_journal.php?issn=" + issn;
        };
        
		function show_publishers()
		{
			$("#publishers").html("<b>Publishers (data from CrossRef)</b>");
		
			$.getJSON("http://bionames.org/bionames-api/api_dashboard.php?publishers&callback=?",
				function(data){
					if (data.status == 200)
					{
						var r = jQuery("#publishers").width(),
							format = d3.format(",d"),
							fill = d3.scale.category20c();
						var bubble = d3.layout.pack()
							.sort(null)
							.size([r, r]);
						var vis = d3.select("#publishers").append("svg:svg")
							.attr("width", r)
							.attr("height", r)
							.attr("class", "bubble")
						var node = vis.selectAll("g.node")
							.data(bubble(data)
							.filter(function(d) { return !d.children; }))
							.enter().append("svg:g")
							.attr("class", "node")
							.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
						node.append("svg:title")
							.text(function(d) { return d.data.name + " : " + format(d.data.value) + " articles"})
						node.append("svg:circle")
							.attr("r", function(d) { return d.r; })
							.style("fill", function(d) { return fill(d.data.name); })
						node.append("svg:text")
							.attr("text-anchor", "middle")
							.attr("dy", ".3em")
							.attr("style", "font-size:10px")
							.text(function(d) { if (d.data.name) { return d.data.name.substr(0, d.r/3);} else { return ""; } }
							);
					
					}
				});
		}
        
		
		
		

		show_identifiers();
		show_links();
		show_documents();
		show_issn();
		show_publishers();
	
</script>



</body>
</html>