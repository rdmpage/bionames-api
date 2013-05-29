<?php


// do PHP stuff here to get query parameters...
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}


?>
<!DOCTYPE html>
<html>
<head>
	<!--<base href="/bionames-api/" />-->
	<title>Title</title>
	
	<!-- standard stuff -->
	<meta charset="utf-8" />
	<?php require 'stylesheets.inc.php'; ?>
	
	<?php require 'javascripts.inc.php'; ?>
	
</head>
<body class="concept">

	<?php require 'navbar.inc.php'; ?>
	
<div class="container-fluid">
	<div class="row-fluid">
  		<div class="span8">
			<ul class="nav nav-tabs">
			  <li class="active" ><a href="#name-tab" data-toggle="tab">Name</a></li>
			  <li><a href="#biblio-tab" data-toggle="tab">Bibliography</a></li>
			  <li><a href="#data-tab" data-toggle="tab">Data</a></li>
			</ul>
			
			<div class="tab-content">
			  <div class="tab-pane active" id="name-tab">
				Scientific name(s)
			  </div>
			  
			  <div class="tab-pane" id="biblio-tab">
				Bibliography 
			  </div>
			  
			  <div class="tab-pane" id="data-tab">...</div>
			</div>			
			
			
			
			
		</div>
		
  		<div class="sidebar span4">
			<div class="sidebar-header">
				<h1 id="title"></h1>
			</div>
			<div id="metadata" class="sidebar-metadata">
				<div id="stats" class="stats"></div>
			</div>
			<div id="images" class="sidebar-section"></div>
			<div id="classification" class="sidebar-section"></div>
  		</div>
	</div>
</div>

	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>
	<script src="js/publication.js"></script>

	<script>
		var concept = "<?php echo $id;?>";
		show_images(concept);
		show_classification(concept);
		show_publications(concept);
		//show_timeline(concept);
		//show_child_publications(concept);
		
		//show_child_publication_thumbnails(concept);
		
		//show_wall(concept);
		
		function add_metadata_stat(title,value) {
			$(display_stat(title,value)).appendTo($('#stats'));		
		}
	
		
      function show_images(concept)
      {
			$("#images").html("");
			$.getJSON("http://bionames.org/bionames-api/taxon/" + concept + "/thumbnail?callback=?",
				function(data){
					if (data.status == 200) {
						if (data.thumbnails.length != 0) {
							var html = '';
							html += '<h3>Images</h3>';
							html += '<div class="image-gallery">';
							var n = Math.min(8, data.thumbnails.length);
							for (var i=0;i<n;i++) {
								html += '<img src="' + data.thumbnails[i] + '" />';
							}
							html += '</div>';
							html += '<div>Images from <a href="http://eol.org/pages/' + data.eol + '">EOL</a></div>';
							
						
							$("#images").html(html);
						}
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
						
						$("#title").html(data.scientificName);
						document.title = data.scientificName;
						
						add_metadata_stat("Rank", data.taxonRank);
						
						var sourcePrefix = [];
						sourcePrefix['http://ecat-dev.gbif.org/checklist/1'] = 'gbif';
						sourcePrefix['http://www.ncbi.nlm.nih.gov/taxonomy'] = 'ncbi';
						
						// logo
						switch (sourcePrefix[data.source])
						{
							case 'gbif':
								$('#logo').attr('src', 'images/logo_leaf.gif');
								break;
								
							case 'ncbi':
								$('#logo').attr('src','images/ncbi-twitter.jpg');
								break;
								
							default:
								break;
						}
								
						
						
						// Classification (nodes immediately above and below)
						html += '<h3>Classification</h3>';
							
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
							//+ '<a href="?id=' + sourcePrefix[data.source] + '/' +  data.sourceIdentifier + '">'
//							+ '<span style="background-color:yellow">' + data.scientificName + '</span>'
							+ '<span>' + data.scientificName + '</span>'
							//+ '</a>';						
						
						// Child taxa
						if (data.children)
						{
							
							add_metadata_stat("children", data.children.length);
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
						/*
						html = '<img src="http://data.gbif.org/species/' + data.sourceIdentifier + '/overviewMap.png" width="360"/>';
						$("#info").html(html);
						*/
						
						switch (sourcePrefix[data.source])
						{
							case 'gbif':
								gbif_map(data.sourceIdentifier);
								break;
								
							case 'ncbi':
								$('#map_canvas').hide();
								break;
								
							default:
								break;
						}
						
						
						// Accepted name

						$("#title").html(data.scientificName);
						
						if (data.namePublishedIn) {
							$("#namePublishedIn").html(data.namePublishedIn);
						}
						
						// Thumbnail
						
						// Taxon names
						if (data.identifier)
						{
							var num_names = 0;
							
						  if (data.identifier.ion)
						  {
						  	 var html ='';
						  	 html += '<div>';
						  	 html += '<b>Names</b>';
						     for (var j in data.identifier.ion) {
								 num_names++;
						     	var element_id = 'cluster/' + j;
						  		html += '<div id="id' + element_id.replace(/\//, '_') + '"></div>';
						  	 }
						  	 html += '</div>';
						  	 $("#namemap").html(html);
						     for (var j in data.identifier.ion) {
						     	var element_id = 'cluster/' + j;
						  		display_snippets(element_id);
						  	 }
							 
						  
							 if(num_names > 0) add_metadata_stat("Names", num_names);
						  	 /*
						  	 var publishedInCitation = [];
						  	 var html ='';
						  	 html += '<div style="border:1px solid black;width:400px;background-color:rgb(228,228,228);">';
						  	 html += '<b>Names</b>';
						  	 html += '<ul>';
						     for (var j in data.identifier.ion)
						     {
						     	html += '<li>';
						     	html += '<span style="padding:2px;background-color:orange;-webkit-border-radius:4px;">';
						     	html += '<a href="mockup_taxon_name.php?id=cluster/' + j + '">';
						     	html += data.identifier.ion[j].nameComplete;
						     	html += '</a>';
						   	    html += '</span>';
						   	    
						   	    // identifier
						   	    
						   	    html += '<ul>';
						   	    html += '<li>';
						   	    html += 'urn:lsid:organismnames.com:name:' + j;
						   	    html += '</li>';
						   	    html += '</ul>';
						   	    
						   	    
						   	    // publication
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
						     */
						   }
						}
						
						// Now flesh out publication details
						//show_name_publications(publishedInCitation);
						
						
						// Timeline
						
						// Publications
						//show_publications(data.canonicalName);						
						
						
					}
				});
		} 
		
		
		function show_publications(concept) {
			$.getJSON("http://bionames.org/bionames-api/taxon/" + concept + "/publications?fields=title,thumbnail,identifier,author,journal,year&include_docs&callback=?", function(data){
				
				
				add_metadata_stat("Publications", data.publications.length);
				
			});
			
		}

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