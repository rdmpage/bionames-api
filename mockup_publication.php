<?php

// mockup template

// do PHP stuff here to get query parameters...
$id = $_GET['id'];


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
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">	-->
	
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- documentcloud -->
	<!--[if (!IE)|(gte IE 8)]><!-->
	<link href="public/assets/viewer-datauri.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="public/assets/plain-datauri.css" media="screen" rel="stylesheet" type="text/css" />
	<!--<![endif]-->
	<!--[if lte IE 7]>
	<link href="public/assets/viewer.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="public/assets/plain.css" media="screen" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<script src="public/assets/viewer.js" type="text/javascript" charset="utf-8"></script>
	<script src="public/assets/templates.js" type="text/javascript" charset="utf-8"></script>			    
	
</head>
<body onload="$(window).resize()">

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
	
<div style="margin-top:41px;padding:0px;" class="container-fluid">

<ul class="nav nav-tabs">
  <li class="active" ><a href="#view-tab" data-toggle="tab">View</a></li>
  <li><a href="#about-tab" data-toggle="tab">About</a></li>
<!--  <li><a href="#map-tab" data-toggle="tab">Map</a></li> -->
  <li><a href="#data-tab" data-toggle="tab">Data</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="view-tab">
	<div id="document-viewer-span">
		<div id="doc" >Loading...</div>
	</div>  
  </div>
  
  <div class="tab-pane" id="about-tab">
	<div id="metadata" style="padding:20px;"></div>  
  </div>
  
<!--  <div class="tab-pane" id="map-tab">...</div> -->
  <div class="tab-pane" id="data-tab">...</div>
</div>


<!--
	<div class="row-fluid">
		<div id="document-viewer-span" class="span8">
			<div id="doc" >Loading...</div>
		</div>
		<div class="span4" id="metadata">
		</div>
	</div>
-->
</div>


<script type="text/javascript">
	var id = "<?php echo $id;?>";
	
	var windowWidth = $(window).width();
	var windowHeight =$(window).height();
	
	// Display an object
	function display_publication (id)
	{
		$.getJSON("http://bionames.org/bionames-api/id/" + id + "?callback=?",
			function(data){
				if (data.status == 200)
				{
					// Bibliographic details as a table
					var html = '';
									
										
					html += '<table class="table table-bordered">';
					html += '<thead></thead>';
					html += '<tbody>';
					
					if (data.title)
					{
						html += '<tr><td>Title</td><td>' + data.title + '</td></tr>';
						document.title = data.title;
					}
					
					if (data.thumbnail)
					{
						html += '<tr><td>Thumbnail</td><td><img style="border:1px solid rgb(128,128,128);" src="' + data.thumbnail + '" width="100" /></td</tr>';
					}					
					
					/*
					if (data.author)
					{
						html += 'by ';
						for (var j in data.author)
						{
							html += '<a href="mockup_author.php?name=' + data.author[j].name + '">';
							html += data.author[j].name + ' ';
							html += '</a>';
							html += '; ';
						}
					}
					html += '</div>';
					
					html += '<div>';
					*/
					
					// Journal
					if (data.journal)
					{
						if (data.journal.name)
						{
							html += '<tr><td>Journal</td><td>' + data.journal.name + '</td></tr>';
							
							// Do we have an ISSN?
							var issn = '';
							var oclc = '';
							if (data.journal.identifier)
							{
								for (var j in data.journal.identifier)
								{
									switch (data.journal.identifier[j].type)
									{
										case 'issn':
											html += '<tr><td>ISSN</td><td><a href="mockup_journal.php?issn=' + data.journal.identifier[j].id + '">' + data.journal.identifier[j].id + '</a></td></tr>';
											break;

										case 'oclc':
											html += '<tr><td>OCLC</td><td><a href="mockup_journal.php?oclc=' + data.journal.identifier[j].id + '">' + data.journal.identifier[j].id + '</a></td></tr>';
											break;
											
										default:
											break;
									}
								}
							}
						}
						
						if (data.journal.volume)
						{
							html += '<tr><td>Volume</td><td>' + data.journal.volume + '</td></tr>';
						}
						if (data.journal.pages)
						{
							html += '<tr><td>Pages</td><td>' + data.journal.pages + '</td></tr>';
						}
					}
					// Item-level identifiers
					if (data.identifier)
					{
						for (var j in data.identifier)
						{
							switch (data.identifier[j].type)
							{
								case "ark":
									html += '<tr><td>ARK</td><td><a href="http://gallica.bnf.fr/ark:/' + data.identifier[j].id + '" target="_new">ark:/' + data.identifier[j].id + '</a></td></tr>';
									break;

								case "biostor":
									html += '<tr><td>BioStor</td><td><a href="http://biostor.org/reference/' + data.identifier[j].id + '" target="_new">' + data.identifier[j].id + '</a></td></tr>';
									break;

								case "cinii":
									html += '<tr><td>CiNii</td><td><a href="http://ci.nii.ac.jp/naid/' + data.identifier[j].id + '" target="_new">' + data.identifier[j].id + '</a></td></tr>';
									break;
									
								case "doi":
									html += '<tr><td>DOI</td><td><a href="http://dx.doi.org/' + data.identifier[j].id + '" target="_new">' + data.identifier[j].id + '</a></td></tr>';
									break;

								case "handle":
									html += '<tr><td>Handle</td><td><a href="http://hdl.handle.net' + data.identifier[j].id + '" target="_new">' + data.identifier[j].id + '</a></td></tr>';
									break;

								case "isbn":
									html += '<tr><td>ISBN</td><td>' + data.identifier[j].id + '</td></tr>';
									break;

								case "jstor":
									html += '<tr><td>JSTOR</td><td><a href="http://www.jstor.org/stable/' + data.identifier[j].id + '" target="_new">' + data.identifier[j].id + '</a></td></tr>';
									break;

								case "oclc":
									html += '<tr><td>OCLC</td><td><a href="http://www.worldcat.org/oclc/' + data.identifier[j].id + '" target="_new">' + data.identifier[j].id + '</a></td></tr>';
									break;

								case "pmc":
									html += '<tr><td>JSTOR</td><td><a href="http://www.ncbi.nlm.nih.gov/pmc/PMC' + data.identifier[j].id + '" target="_new">' + 'PMC' + data.identifier[j].id + '</a></td></tr>';
									break;

								case "pmid":
									html += '<tr><td>PMID</td><td><a href="www.ncbi.nlm.nih.gov/pubmed/' + data.identifier[j].id + '" target="_new">' + data.identifier[j].id + '</a></td></tr>';
									break;
									
								default:
									break;
							}
						}	
					}
					
					// Item-level links
					if (data.link)
					{
						for (var j in data.link)
						{
							switch (data.link[j].anchor)
							{
								case "PDF":
									html += '<tr><td>PDF</td><td><a href="' + data.link[j].url + '" target="_new">' +  data.link[j].url + '</a></td></tr>';
									break;

								case "LINK":
									html += '<tr><td>URL</td><td><a href="' + data.link[j].url + '" target="_new">' +  data.link[j].url + '</a></td></tr>';
									break;
									
								default:
									break;
							}
						}
					}
					
					if (data.file)
					{
						html += '<tr><td>SHA1</td><td>' +  data.file.sha1 + '</td></tr>';
					}
					
					// Date
					if (data.year)
					{
						html += '<tr><td>Year</td><td>' +  data.year + '</td></tr>';
					}
					/*
					if (data.issued)
					{
						html += '<tr><td>Year</td><td>' +  data.year + '</td></tr>';
					}
					*/
					
					
					html += '</tbody>';
					html += '</table>';
					
					$("#metadata").html(html);
					
					// Display document viewer if we have a document
					var docUrl = '';					
					if (data.identifier)
					{
						for (var j in data.identifier)
						{
							//console.log(data.identifier[j].type);
							switch (data.identifier[j].type)
							{
								case "ark":
									// ark:/12148/bpt6k61536173/f400
									
									var ark_pattern = /(.*)\/(.*)\/f(\d+)/;
									var ark = data.identifier[j].id;
									//console.log(ark);
									var match = ark.match(ark_pattern);
									docUrl = 'http://bionames.org/bionames-gallica/documentcloud/' + match[2] + 'f' + match[3] + '.json';
									break;
							
								case "biostor":
									docUrl = 'http://biostor.org/dv/' + data.identifier[j].id + '.json';
									break;
																		
								default:
									break;
							}
						}
					}
					
					
					
					html += '</div>';
					
					if (docUrl == '')
					{
						if (data.file)
						{
							if (data.file.sha1)
							{
								docUrl = 'http://bionames.org/bionames-archive/documentcloud/' + data.file.sha1 + '.json';
							}
						}
					
					}
					
					console.log(docUrl);
					
					if (docUrl != '')
					{
						DV.load(docUrl, {
							container: '#doc',
							width:$('#document-viewer-span').width(),
							height:$('#document-viewer-span').height(),
							sidebar: false
						});	
					}
					else
					{
						if (data.thumbnail)
						{
							var html = '';
							html += '<div style="text-align:center;">';
							html += '<div class="alert">';
							html += '<strong>Limited access!</strong> You may need a subscription to access this item.';
							html += '</div>';
							html += '<img style="border:1px solid rgb(128,128,128);padding:10px;" src="' + data.thumbnail + '" width="400" />';
							html += '</div>';
							$('#doc').html(html);
						}
						else
						{
							var html = '';
							html += '<div style="text-align:center;">';
							html += '<div class="alert">';
							html += 'Unable to display this item.';
							html += '</div>';
							html += '</div>';
							
							$('#doc').html(html);
						}
					}
				}
			});
	}
	
	function display_publication_names (id)
	{
		$.getJSON("http://bionames.org/bionames-api/publication/" + id + "/names?callback=?",
			function(data){
				if (data.status == 200)
				{
					var html = '';
					
					html += '<ul>';
					for (var i in data.names) {
						html += '<li>';
						html += '<a href="mockup_taxon_name.php?id=' + data.names[i].cluster + '">';
						html += data.names[i].nameComplete;
						html += '</a>';
						html += '<br/>';
						html += '<span style="color:rgb(128,128,128);font-size:70%">' + data.names[i].id + '</span>';						
						html += '</li>';
					}
					html += '</ul>';
					
					$('#names').html(html);
				}
			});
	}
					
					
	$("#metadata").html("Object &quot;" + id + "&quot; not found");
		
	display_publication(id);
	display_publication_names(id);
	
	// to do: clicking on tab (e.g. "about") breaks doc viewer (it will display only a few documant pages)
	// looks like an event gets sent to docviewer that is invalid
	// horrible horrible hack to fix this redisplays the viewer :O 
	$('a[data-toggle="tab"]').on('shown', function (e) {
  
  		var t = $(e.target).text().toLowerCase();
  		if (t == 'view') {
   			display_publication(id); // horrible
  		} else {
 			//e.stopImmediatePropagation();
  			//console.log('hi');
  		}
  		
	})	

	// http://stackoverflow.com/questions/6762564/setting-div-width-according-to-the-screen-size-of-user
	$(window).resize(function() { 
		var windowWidth = $('#document-viewer-span').width();
		var windowHeight =$(window).height() -  $('#document-viewer-span').offset().top;
		$('#doc').css({'height':windowHeight, 'width':windowWidth });
	});
	

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