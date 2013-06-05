<?php

$id = $_GET['id'];

?>

<html>
<head>
<base href="/bionames-api/" />
<title>Page</title>

<style type="text/css" title="text/css">
body {
  font-family: 'Open Sans', sans-serif;
  font-weight: 400;
  font-size: 14px;
  line-height: 20px;
  color: #2e3033;
}

</style>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>

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

<div style="top:0px;float:right;width:280px;padding:10px;">
	<div id="metadata"></div>
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
					
					if (data.title)
					{
						html += '<span>' + data.title + '</span>';
						document.title = data.title;
					}
					
					if (data.thumbnail)
					{
						html += '<div><img src="' + data.thumbnail + '" height="100" /></div>';
					}
					
					$("#metadata").html(html);
					
					// Display document viewer if we have a document
					var docUrl = '';					
					if (data.identifier)
					{
						for (var j in data.identifier)
						{
							console.log(data.identifier[j].type);
							switch (data.identifier[j].type)
							{
								case "biostor":
									docUrl = 'http://biostor.org/dv/' + data.identifier[j].id + '.json';
									break;
																		
								default:
									break;
							}
						}
					}
					
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
							height:windowHeight,
							sidebar: false
						});	
					}	
				}
			});
	}
					
					
	$("#metadata").html("Object &quot;" + id + "&quot; not found");
		
	display_publication(id);

	// http://stackoverflow.com/questions/6762564/setting-div-width-according-to-the-screen-size-of-user
	$(window).resize(function() { 
		var windowWidth = $(window).width() - 300;
		var windowHeight =$(window).height();
		
		$('#doc').css({'width':windowWidth,'height':windowHeight });
	});
	
</script>



</body>
</html>