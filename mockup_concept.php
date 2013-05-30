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
			  <li class="bibliography"><a href="#biblio-tab" data-toggle="tab">Bibliography</a></li>
			  <li><a href="#data-tab" data-toggle="tab">Data</a></li>
			</ul>
			
			<div class="tab-content">
			  <div class="tab-pane active" id="name-tab">
				Scientific name(s)
			  </div>
			  
			  <div class="tab-pane" id="biblio-tab">
				<div id="publication-timeline" class="publication-timeline">
					<div class="pub-timeline">
					    <table id="synonymTimeline">
					        <thead><tr><td></td><td><div class="axis top"></div></td></tr></thead>
					        <tbody id="nameTimelines"></tbody>
					        <tfoot><tr><td></td><td><div class="axis bottom"></div></td></tr></thead>
					    </table>
					</div>
				    <div id="pubList"></div>
				</div>
			  </div>
			  
			  <div class="tab-pane" id="data-tab">...</div>
			</div>			
			
			
			
			
		</div>
		
  		<div class="sidebar span4">
			<div class="sidebar-header">
				<h1 id="title"></h1>
			</div>
			<div id="metadata" class="sidebar-metadata">
				<div id="stats" class="stats">
					<div class="metadatum">
						<div class="metadatum-title source">Source</div>
						<div class="metadatum-value"><img src="" id="logo" /></div>
					</div>
				</div>
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
								$('#logo').attr('src', 'images/logo-gbif-stats.png');
								break;
								
							case 'ncbi':
								$('#logo').attr('src','images/logo-ncbi-stats.png');
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
				
				if( data.publications.length == 0 ) return;
				
				var publication_list = [];
    
			    // Clean up and type cast the JSON objects where necessary.
			    for(var i in data.publications) {
			        var pub = data.publications[i];
        
			        pub.year = +pub.year; // Cast to integer
			        pub.tags = pub.tags.sort();
        
        
			        // For each tag, we need to create a new object. Hacky I know, but 
			        // Crossfilter doesn't handle dimensions where an object can have multiple values
			        for(var t = 0; t < pub.tags.length; t++) {
			            var newPub = {};
            
			            for(var prop in pub) {
			                newPub[prop] = pub[prop];
			            }
            
			            newPub.tag  = pub.tags[t];            
			            publication_list.push(newPub);
			        }
			    }
    

			    // Crossfilter
			    var pubs = crossfilter( publication_list );
    
			    // Dimensions and groups
			    var pubsByYear = pubs.dimension( function(d){ return d.year; } );
			    var years = pubsByYear.group();
			    var pubsByName = pubs.dimension( function(d){ return d.tag; } );
			    var names = pubsByName.group();
    
    
			    // Nest for grouping publication list by decade
			    var nestByDecade = d3.nest().key(function(d){ return Math.floor(d.year/10) * 10; });
    
    
			    // Used to set the maximum domain of the y-axis of timelines
			    countMax = 0;
			    names.all().forEach(function(n){
			        var name = n.key,
			            maxForName;
            
			        pubsByName.filter(name);
			        maxForName = d3.max(years.all(), function(v){ return v.value});
			        countMax = d3.max([countMax, maxForName]);
			    });
			    pubsByName.filterAll();
    
			    // Used in the x-axis of timelines
			    var yearExtent = d3.extent( years.all(), function(d){ return d.key; } );
    
			    // Crossfilter unfortunately does not support union filters, so we have to kind of build our own
			    // This set will keep track of which names have been selected with the checkboxes,
			    // and the unionNames function is used later to filter pubsByName by the selectedNames
			    var selectedNames = d3.set( names.all().map(function(d){ return d.key; }) );
			    var unionNames = function(d){ return selectedNames.has(d); };
    
			    var xScale = d3.scale.linear()
			            .domain([ yearExtent[0], yearExtent[1]+1])
			            .rangeRound([0, 600]);
			    var yScale = d3.scale.linear().domain([0, countMax]).rangeRound([0, 30]);
    
			    var nameTimeline = d3.select("#nameTimelines").selectAll(".nameTimeline")
			        .data( names.all().map(function(d){ return d.key; }) ) 
			        .enter().append('tr')
			            .attr('class', 'nameTimeline')
    
			    var nameLabel = nameTimeline.append('td').append('label')
			    nameLabel.append('input')
			        .attr({type: 'checkbox', checked: 'checked' })
			        .on('change', function(d){
			            d3.select(this.parentNode.parentNode.parentNode).classed("disabled", !this.checked);
			            this.checked ? selectedNames.add(d) : selectedNames.remove(d);
			            pubsByName.filter(unionNames);
			            renderAll();
			        });
			    nameLabel.append('span').text(function(d){ return d; });
    
			    nameTimeline.append('td').append('div').attr("class", "chart")
    
			    var charts = names.all().map(function(n){
			        var name = n.key;
			        return (filterWidgets.histogram()
			            .dimension(pubsByYear)
			            .group(years)
			            .beforeDraw( function(){ pubsByName.filter(name); })
			            .afterDraw( function(){ pubsByName.filterAll(); })
			            .round( Math.round )
			            .xScale( xScale )
			            .yScale( yScale )
			            .margin({ top: 5, right: 12, bottom: 0, left: 12 })
			        );
			    });
    
			    var axes = [
			        filterWidgets.axis()
			            .xScale( xScale )
			            .orient('top'),
			        filterWidgets.axis()
			            .xScale( xScale )
			            .orient('bottom')
			    ];
    
			    var lists = [
			        filterWidgets.publicationList().dimension(pubsByYear).nest(nestByDecade)
			    ];
    
    
			    var chart = d3.selectAll(".nameTimeline .chart")
			        .data(charts)
			        .each(function(chart) {
			             chart.on("brush", function(c){
			                 charts.forEach(function(chrt){ chrt.filter(c.brush().extent())});
			                 renderAll()
			             }).on("brushend", renderAll); });
    
			    var axis = d3.selectAll(".axis")
			        .data(axes);
    
			    var list = d3.selectAll("#pubList")
			        .data(lists);

			    function renderAll(){
			        list.each(render);
			        axis.each(render);
			        chart.each(render);
			    }

			    function render( method ) {
			        d3.select(this).call(method);
			    }

			    renderAll();
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
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

</body>
</html>