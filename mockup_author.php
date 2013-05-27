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
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	
	<!-- responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">	
	
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    
	
</head>
<body>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
	 <a class="brand" href="mockup_index.php">BioNames</a>
	 <ul class="nav">
	  <li><form class="navbar-search pull-left" method="get" action="mockup_search.php">
		<input type="text" id='q' name='q' data-provide="typeahead" class="search-query" placeholder="Search" autocomplete="off" value="<?php echo $q; ?>">
		</form> 
	  </li>
	  <li><a href="#">More...</a></li>
	  </ul>
	</div>
</div>
	
<div style="margin-top:50px;" class="container-fluid">
	<div class="row-fluid">
  		<div class="span9">
			<div id="publications">Publications</div>
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
			
			$.getJSON("http://bionames.org/bionames-api/authors/" + encodeURIComponent(name) + "/publications" + "?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
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
							
						$("#publications").html(html);
						
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