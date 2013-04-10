<?php

$id = $_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>BioNames API Demo: Concept</title>
	
	<style type="text/css" title="text/css">
		body { font-family:sans-serif; }
		
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
		function show_classification(concept)
		{
			$("#classification").html("");
			
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
							html += '<a href="?id=' + sourcePrefix[data.source] + '/' + data.ancestors[data.ancestors.length-1].sourceIdentifier + '">' + data.ancestors[data.ancestors.length-1].scientificName + '</a>';
						}
						
						// This taxon
						html += '<ul class="classification">';
						html += '<li class="lastchild">' 
							+ '<a href="?id=' + sourcePrefix[data.source] + '/' +  data.sourceIdentifier + '">'
							+ '<span style="background-color:yellow">' + data.scientificName + '</span>'
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
								html += '<a href="?id=' + sourcePrefix[data.source] + '/' +  data.children[j].sourceIdentifier + '">' + '<p style="line-height:16px;padding:0px;margin:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;width:100%;">' + data.children[j].scientificName + '</p>' + '</a>' + '</li>';
							}
							html += '</ul>';
						}
						html += '</li>'
						html += '</ul>'; // this taxon				
						
						html += '</li>'; // root
						html += '</ul>';
						
						$("#classification").html(html);
						
						
						$("#name").html(data.scientificName);
						
					}
				});
		}
		
	</script>
	
	
</head>
<body>

	<h1>Taxon concept</h1>
	
	<div style="position:relative;">
		<div style="float:right;top:0px;width:400px;border-left:1px black solid;padding-left:10px;">
		<h3>Classification</h3>
		<div id="classification">[classification]</div>
		</div>
	
		<h2 id="name">[name]</h2>
		
		<p>[map to names goes here]</p>
	
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>
	
	<script>
		var concept = "<?php echo $id;?>";
		show_classification(concept);
	</script>


</body>
</html>
