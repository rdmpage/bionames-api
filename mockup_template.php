<?php

// mockup template

// do PHP stuff here to get query parameters...
if (isset($_GET['x']))
{
	$x = $_GET['x'];
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
	<div class="row">
  		<div class="span3">
  			<div id="volumes" class="affix"></div>  			
  		</div>
  		<div class="span8">
  			<div id="articles"></div>
  		</div>
  		<div class="span1">
  			<div id="metadata"></div>
  			<div id="identifiers"></div>
  		</div>
	</div>
</div>

<script type="text/javascript">
	var x = "<?php echo $x;?>";


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