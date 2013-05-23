<?php

$q='';
if (isset($_GET['q']))
{
	$q = trim($_GET['q']);
}

?>
<!DOCTYPE html>
<html>
<head>
	<base href="/bionames-api/" />
	<title>Search</title>
	
	<!-- standard stuff -->
	<meta charset="utf-8" />
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">	

	<link href="snippet.css" rel="stylesheet">	

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
	<script src="js/snippet.js"></script>
    

</head>
<body>
	
	<form class="navbar-search pull-left" method="get" action="ms.php">
	<input type="text" id='q' name='q' data-provide="typeahead" data-minLength="3" class="search-query" placeholder="Search" autocomplete="off" value="<?php echo $q; ?>">
	<input type="submit" value="Search">
	</form>      


<div id="didyoumean"></div>
<div id="results"><div>


	<script>
		function search(q) {
		
			$.getJSON("http://bionames.org/bionames-api/search/" + encodeURIComponent(q) + "?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						
						if (data.results) {
							var ids=[];
							
							// order in which we want to display facets
							var facet_key_order = [
								'nameCluster',
								'taxonConcept',
								'article',
								'book',
								'chapter',
								'generic'
								];		
							
							for (var facet in facet_key_order) {
								console.log(facet_key_order[facet]);
								
								//console.log(data.results.facets[facet_key_order[facet]]);
								
							//}
							//for (var facet in data.results.facets) {
								if (data.results.facets[facet_key_order[facet]]) {
								
								switch(facet_key_order[facet]) {
									case 'nameCluster':
										html += '<div style="background-color:green;color:white;">Names</div>';
										break;
									case 'taxonConcept':
										html += '<div style="background-color:green;color:white;">Taxa</div>';
										break;
									case 'article':
										html += '<div style="background-color:green;color:white;">Article</div>';
										break;
									case 'book':
									case 'chapter':
									case 'generic':
										html += '<div style="background-color:green;color:white;">Publication</div>';
										break;
									default:
										html += '<div style="background-color:green;color:white;">Unknown facet</div>';
										break;
								}
								
								// output
								html += '<div>';
								for (var hit in data.results.facets[facet_key_order[facet]]) {
									var id = hit;
									ids.push(id);
									id = hit.replace(/\//, '_');
									
									html += '<div style="float:left;">';
									
									switch(facet_key_order[facet]) {
										case 'nameCluster':
											html += '<div>' + data.results.facets[facet_key_order[facet]][hit].term + '</div>';
											break;
										default:
											html += '<div id="id' + id + '">' + id + '</div>';
											break;
									}
									
									html += '</div>';
								}							
								html += '<div style="clear:both;">';
								html += '</div>';
								
								
								// end of facet
								html += '</div>';
								}
							}
						}
						
						// display details
						for (var id in ids) {
							html += '<script>display_snippets("' + ids[id] + '");<\/script>';
						}
						
						
						$('#results').html(html);
					}
				
				
				});
		}
	
	
		function did_you_mean(name)
		{
			$("#didyoumean").html("");
			
			$.getJSON("http://bionames.org/bionames-api/name/" + encodeURIComponent(name) + "/didyoumean?callback=?",
				function(data){
					if (data.status == 200)
					{		
						var html = '';
						if (data.names.length > 0) {
							html += '<b>Did you mean:</b>';
							html += '<ul>';
							
							for (var i in data.names) {
								html += '<li>';
								html += '<a href="mockup_search.php?q=' + encodeURIComponent(data.names[i]) + '">' + data.names[i] + '</a>';
								html += '</li>';
							}
							html += '</ul>';
							
							$("#didyoumean").html(html);
						}
					}
				});
		}
	</script>


<?php
	echo '<script>
		search(\'' . addcslashes($q, "'") . '\');
		did_you_mean(\'' . addcslashes($q, "'") . '\');
	</script>';
?>	
	
	
	<!-- typeahead for search box -->
	<script>
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
