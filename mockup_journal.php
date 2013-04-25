<?php

// mockup of journal display

$issn = '';
$oclc = '';
$journal = '';

if (isset($_GET['issn']))
{
	$issn = $_GET['issn'];
}
if (isset($_GET['oclc']))
{
	$oclc = $_GET['oclc'];
}
if (isset($_GET['journal']))
{
	$journal = $_GET['journal'];
}

?>

<html>
<head>
	<base href="/bionames-api/" />
	<!-- <base href="/~rpage/bionames-api/" /> -->
	<title>Journal</title>
	
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

<div style="top:0px;float:right;width:280px;padding:10px;">
	<div id="metadata">Metadata</div>
	<div id="identifiers">Identifiers</div>
</div>

<div id="title" style="font-size:200%;line-height:150%"></div>

	<div style="position:relative;width:600px;height:400px;">
		<div id="volumes" style="position:absolute;left:0px;top:0px;width:300px;">[volumes]</div>
		<div id="articles" style="position:absolute;left:300px;top:0px;width:auto;"></div>
	</div>


	<script src="js/jquery.js"></script>
	<script src="js/display.js"></script>
	<script src="js/openurl.js"></script>

<script type="text/javascript">
	var issn = "<?php echo $issn;?>";
	var oclc = "<?php echo $oclc;?>";
	var journal = "<?php echo $journal;?>";

	

	// Details about journal
	function display_journal_from_issn (issn)
	{
		$.getJSON("http://bionames.org/bionames-api/journals/issn/" + issn + "?callback=?",
			function(data){
				if (data.status == 200)
				{
					$('#title').html(data.title);
				
				
					var html = '';
					html += '<img style="border:1px solid rgb(128,128,128);" src="http://bioguid.info/issn/image.php?issn=' + issn + '" width="128"/>';
					
					html += '<table>';
					html += '<tbody style="font-size:80%;">';
					
					for (var i in data) {
						switch (i)
						{
							case 'issnl':
								html += '<tr>';
								html += '<td align="right" valign="top" style="color:rgb(128,128,128);">' + i + '</td>';
								html += '<td valign="top">' + '<a href="mockup_journal.php?issn=' + data[i] + '">' + data[i] + '</a>' + '</td>';
								html += '</tr>';
								break;
						
							case 'issn':
							case 'publisher':
							case 'rawcoverage':
								html += '<tr>';
								html += '<td align="right" valign="top" style="color:rgb(128,128,128);">' + i + '</td>';
								html += '<td valign="top">' + data[i] + '</td>';
								html += '</tr>';
								break;
							case 'rssurl':
								html += '<tr>';
								html += '<td align="right" valign="top" style="color:rgb(128,128,128);">' + i + '</td>';
								html += '<td valign="top">' + '<a href="' + data[i] + '">' + 'RSS' + '</a>' + '</td>';
								html += '</tr>';
								break;
							
								break;
							default:
								break;
						}
					}
					html += '</tbody>';
					html += '</table>';
					
							
					if (data.preceding)
					{
						if (data.preceding.length > 0 )
						{
							html += '<b>Preceding</b>';
							html += '<ul>';
							for (var i in data.preceding)
							{
								html += '<li>' + '<a href="mockup_journal.php?issn=' + data.preceding[i] + '">' + data.preceding[i] + '</a>' + '</li>';
							}
							html += '</ul>';
						}
					}
					if (data.succeeding)
					{
						if (data.succeeding.length > 0 )
						{
							html += '<b>Succeeding</b>';
							html += '<ul>';
							for (var i in data.succeeding)
							{
								html += '<li>' + '<a href="mockup_journal.php?issn=' + data.succeeding[i] + '">' + data.succeeding[i] + '</a>' + '</li>';
							}
							html += '</ul>';
						}
					}
					if (data.other)
					{
						if (data.other.length > 0 )
						{
							html += '<b>Other</b>';
							html += '<ul>';
							for (var i in data.other)
							{
								html += '<li>' + '<a href="mockup_journal.php?issn=' + data.other[i] + '">' + data.other[i] + '</a>' + '</li>';
							}
							html += '</ul>';
						}
					}
					
					/*
					// Other ISSNs
					if (data.other)
					{
					if (data.other.length > 0)
					{
						html += '<h3>Other ISSNs</h3>';
						html += '<div class="row">';
						
						html += '<div class="span2">';
						html += '<ul>';
						for (var i in data.other)
						{
							html += '<li>' + '<a href="../issn/' + data.other[i] + '">' + data.other[i] + '</a>' + '</li>';
						}
						html += '</ul>';
						html += '</div>';

						html += '</div>';							
					}					
					*/
					$('#metadata').html(html);
				}
			});
	}
	
		function year_volume_articles(issn, volume, year)
		{
			$("#articles").html("");
			
			$.getJSON("journals/issn/" + issn + "/volumes/" + volume + "/year/" + year + "?callback=?",
				function(data){
					if (data.status == 200)
					{					
						$("#articles").html('<div style="font-size:150%;padding:10px;">Volume ' + volume + " (" + year + ")</div>");
						for (var i in data.articles)
						{
							var html = $("#articles").html();
							
							html += display_reference(data.articles[i]);
							$("#articles").html(html);
						}
					}
				});
		}
						
	
	
			 function show_journal_volumes_from_issn(issn)
			  {
				$("#volumes").html("");
				
				$.getJSON("http://bionames.org/bionames-api/journals/issn/" + issn + "/volumes?callback=?",
					function(data){
						var html = '';
						if (data.status == 200)
						{							
							html += '<h3>Volumes</h3>';
							
							html += '<ul>';
							
							if (data.decades)
							{
								for (var decade in data.decades)
								{
									html += '<li>' + decade + '\'s';
									html += '<ul>'
									
									for (var year in data.decades[decade])
									{
										html += '<li>' + year ;
										html += '<ul>'
										for (volume in data.decades[decade][year])
										{
											html += '<li>';
											html += '<span onclick="year_volume_articles(\'' + issn + '\',\'' + data.decades[decade][year][volume].volume + '\',' + year + ')">';
											html += ' vol. ' + data.decades[decade][year][volume].volume + ' (' +  data.decades[decade][year][volume].count + ' article(s))';
											html += '</span>';	
											html += '</li>';	
										}
										html += '</ul>';
										html += '</li>';
									}
									html += '</ul>'
									html += '</li>';
								}
							}
							
							html += '</ul>';
						}
						else
						{
							html += 'Badness';
						}
						$("#volumes").html(html);
					});
				}
	
		function show_article_identifiers(issn)
		{
			$("#identifiers").html("");
			
			$.getJSON("http://bionames.org/bionames-api/journals/issn/" + issn + "/articles/identifiers?callback=?",
				function(data){
					var html = '';
					if (data.status == 200)
					{			
						html += '<h3>Identifiers</h3>';
						html += '<div style="width:200px;position:relative;">';
						for (var i in data.years)
						{
							for (j in data.years[i])
							{
								var colour = 'rgb(228,228,228)';
								for (k in data.years[i][j])
								{
									if (data.years[i][j][k].indexOf('biostor') != -1)
									{
										colour = 'orange';
									}
									if (data.years[i][j][k].indexOf('cinii') != -1)
									{
										colour = 'purple';
									}
									if (data.years[i][j][k].indexOf('doi') != -1)
									{
										colour = 'green';
									}
									if (data.years[i][j][k].indexOf('handle') != -1)
									{
										colour = 'blue';
									}
									if (data.years[i][j][k].indexOf('pmid') != -1)
									{
										colour = 'yellow';
									}
									
								}
								html += '<div style="float:left;width:20px;height:20px;">';
								html += '<a href="mockup_publication.php?id=' + j + '">';
								html += '<div style="width:16px;height:16px;background-color:' + colour + ';margin:2px;"></div>';
								html += '</a>';
								html += '</div>';
							}
						}
						html += '<div style="clear:both;"></div>';
						html += '</div>';

						html += '<h3>Links</h3>';
						html += '<div style="width:200px;position:relative;">';
						for (var i in data.years)
						{
							for (j in data.years[i])
							{
								var colour = 'rgb(228,228,228)';
								for (k in data.years[i][j])
								{
									if (data.years[i][j][k].indexOf('LINK') != -1)
									{
										colour = 'orange';
									}
									if (data.years[i][j][k].indexOf('PDF') != -1)
									{
										colour = 'green';
									}
								}
								html += '<div style="float:left;width:20px;height:20px;">';
								html += '<a href="mockup_publication.php?id=' + j + '">';
								html += '<div style="width:16px;height:16px;background-color:' + colour + ';margin:2px;"></div>';
								html += '</a>';
								html += '</div>';
							}
						}
						html += '<div style="clear:both;"></div>';
						html += '</div>';


						
					}
					$("#identifiers").html(html);
				});
		}
	
					
					
	if (issn != '')
	{
		display_journal_from_issn(issn);
		show_journal_volumes_from_issn(issn);
		show_article_identifiers(issn);
	}

	
</script>



</body>
</html>