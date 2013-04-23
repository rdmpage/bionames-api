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
	
	</style>
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

</head>
<body>

<div style="top:0px;height:40px;">&nbsp;</div>
<div style="top:0px;float:right;width:280px;padding:10px;">
	<div id="metadata">Metadata</div>
	<div id="coauthors">Coauthors</div>
	<div id="timeline">Timeline</div>
	<div id="taxa">Names published</div>
	<div id="related">Related names</div>
</div>

	<div id="title" style="font-size:200%;line-height:150%"></div>
	<div id="publications">Publications</div>


	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>

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
						html += '<h3>Coauthors</h3>';
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
							html += '<h3>Related names</h3>';
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
			
			$.getJSON("http://bionames.org/bionames-api/authors/" + encodeURIComponent(name) + "/publications" + "?callback=?",
				function(data){
					if (data.status == 200)
					{		
						for (var i in data.publications)
						{
							var html = $('#publications').html();
							$('#publications').html(html + display_reference(data.publications[i]));
						}
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
	
		show_related_names(name);
		show_coauthors(name);
		show_taxa(name);		
		//show_timeline(name);
		show_publications(name);
	

	
</script>



</body>
</html>