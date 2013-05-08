<?php

// mockup of publication display

$id = $_GET['id'];

?>

<html>
<head>
	<base href="/bionames-api/" />
	<!-- <base href="/~rpage/bionames-api/" /> -->
	<title>Publication</title>
	
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

<div style="top:40px;height:40px;background-color:rgb(240,240,240);width:100%;">
	<span id="title" style="font-size:150%;font-weight-bold;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;"></span>
</div>

<div style="top:0px;float:right;width:280px;padding:10px;">
	<div id="metadata"></div>
	<h3>❝Cite</h3>
	<div id="cite"></div>
	<h3>Names published</h3>
	<div id="names"></div>

	<!-- to do -->
	<h3>Localities, specimens, cites/cited by, sequences, phylogeny, etc.</h3>
	
</div>

<div id="doc"><span>Display object here</span></div>

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
					var html = '';
					
					html += '<div class="pub">';
					
					if (data.thumbnail)
					{
						html += '<div ><img style="border:1px solid rgb(128,128,128);" src="' + data.thumbnail + '" height="100" /></div>';
					}					
					
					if (data.title)
					{
						html += '<div class="title">' + data.title + '</div>';
						document.title = data.title;
						
						$('#title').html(data.title);
					}
										
					html += '<div class="meta">';
					
					
					html += '<div>';
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
					if (data.journal)
					{
						if (data.journal.name)
						{
							html += '<span class="journal">';
							
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
											issn = data.journal.identifier[j].id;
											break;

										case 'oclc':
											oclc = data.journal.identifier[j].id;
											break;
											
										default:
											break;
									}
								}
							}
							
							if (issn != '')
							{
								html += '<a href="mockup_journal.php?issn=' + issn + '">';
							}
							else
							{
								if (oclc != '') {
								html += '<a href="mockup_journal.php?oclc=' + oclc + '">';
								} else {								
									html += '<a href="mockup_journal.php?journal=' + data.journal.name + '">';	
								}
							}
							html += data.journal.name;
							
							html += '</a>';
							
							html += '</span>';
						}
						if (data.journal.volume)
						{
							html += ' ' + data.journal.volume;
						}
						if (data.journal.pages)
						{
							html += ' pages ' + data.journal.pages;
						}
					}
					html += '</div>';
					
					if (data.identifier)
					{
						html += '<ul>';
						for (var j in data.identifier)
						{
							switch (data.identifier[j].type)
							{
								case "ark":
									html += "<li><a href=\"http://gallica.bnf.fr/ark:/" + data.identifier[j].id + "\" target=\"_new\">ark:/" + data.identifier[j].id + "</a></li>";
									break;

								case "biostor":
									html += "<li><a href=\"http://biostor.org/reference/" + data.identifier[j].id + "\" target=\"_new\">biostor.org/reference/" + data.identifier[j].id + "</a></li>";
									break;

								case "cinii":
									html += "<li><a href=\"http://ci.nii.ac.jp/naid/" + data.identifier[j].id + "\" target=\"_new\">ci.nii.ac.jp/naid/" + data.identifier[j].id + "</a></li>";
									break;
									
								case "doi":
									html += "<li><a href=\"http://dx.doi.org/" + data.identifier[j].id + "\" target=\"_new\">dx.doi.org/" + data.identifier[j].id + "</a></li>";
									break;

								case "handle":
									html += "<li><a href=\"http://hdl.handle.net/" + data.identifier[j].id + "\" target=\"_new\">hdl.handle.net/" + data.identifier[j].id + "</a></li>";
									break;

								case "jstor":
									html += "<li><a href=\"http://www.jstor.org/stable" + data.identifier[j].id + "\" target=\"_new\">www.jstor.org/stable/" + data.identifier[j].id + "</a></li>";
									break;
									
								default:
									break;
							}
						}	
						html += '</ul>';
					}
					

					html += '</div>';
					
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
									docUrl = 'http://bionames.org/gallica/documentcloud/' + match[2] + 'f' + match[3] + '.json';
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
								docUrl = 'http://bionames.org/archive/documentcloud/' + data.file.sha1 + '.json';
							}
						}
					
					}
					
					console.log(docUrl);
					
					if (docUrl != '')
					{
						DV.load(docUrl, {
							container: '#doc',
							/*width:windowWidth,*/
							width:700,
							height:windowHeight - 40,
							/* height:windowHeight, */
							sidebar: false
						});	
					}
					else
					{
						if (data.thumbnail)
						{
							var html = '';
							html += '<div style="text-align:center;">';
							html += '<div>∅ Restricted access digital version available</div>';
							html += '<img style="border:1px solid rgb(128,128,128);padding:10px;" src="' + data.thumbnail + '" width="400" />';
							html += '</div>';
							$('#doc').html(html);
						}
						else
						{
							var html = '';
							html += '<div style="text-align:center;">';
							html += '<div>Unable to display</div>';
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

	// http://stackoverflow.com/questions/6762564/setting-div-width-according-to-the-screen-size-of-user
	$(window).resize(function() { 
		var windowWidth = $(window).width() - 300;
//		var windowHeight =$(window).height();
		var windowHeight =$(window).height() - 40;
		
		$('#doc').css({'width':windowWidth,'height':windowHeight });
	});
	
</script>



</body>
</html>