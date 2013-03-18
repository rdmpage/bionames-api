<?php

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');
require_once (dirname(__FILE__) . '/reference.php');

//--------------------------------------------------------------------------------------------------
function display_record($id)
{
	global $config;
	global $couch;
	
	$reference = null;
	
	if (0)
	{
		// for now grab this from BioStor
		$json = get('http://biostor.org/reference/' . $id . '.bibjson');
		$reference = json_decode($json);
	}
	else
	{
		// grab JSON from CouchDB
		$couch_id = $id;
		
		$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . urlencode($couch_id));
		
		$reference = json_decode($resp);
		if (isset($reference->error))
		{
			// bounce
			header('Location: ' . $config['web_root'] . "\n\n");
			exit(0);
		}
	}
	

	// HTML template
    $template = <<<EOT
<!DOCTYPE html>
	<html>
        <head>
            <meta charset="utf-8"/>
            
            <base href="<BASE>" />
            
            <title><TITLE></title>

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
		<body onload="$(window).resize();">

		<div id="doc">Loading...</div>
		
	   <!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="assets/js/jquery.js"></script>
		

		<script type="text/javascript">
			
			var windowWidth = $(window).width();
			var windowHeight =$(window).height();
		
			/* Viewer */
			<DOCVIEWER>

			// http://stackoverflow.com/questions/6762564/setting-div-width-according-to-the-screen-size-of-user
			$(window).resize(function() { 
				var windowHeight =$(window).height();				
				$('#doc').css({'width':'100%' ,'height':windowHeight });
				$('#metadata').css({'height':windowHeight });
			});
			
		</script>
		
		</body>
	</html>
EOT;

	
	$template = str_replace('<BASE>', $config['web_server'] . $config['web_root'], $template);

	$viewer = '';
	
	$identifiers = reference_identifiers($reference);
	
	// BioStor?
	if ($viewer == '')
	{
		if (isset($identifiers['biostor']))
		{
			$viewer = "var docUrl = 'http://biostor.org/dv/" . $identifiers['biostor'] . ".json';
				DV.load(docUrl, {
					container: '#doc',
					width:700,
					height:windowHeight,
					sidebar: false
				});";
		}
	}
	
	// PDF?
	if ($viewer == '')
	{
		// Do we have a PDF file?
		if (isset($reference->file))
		{
			// If we have a PDF sha1 and a thumbnail then this is a cached, viewable PDF
			if (isset($reference->file->sha1) && isset($reference->thumbnail))
			{
				$viewer = "var docUrl = 'http://bionames.org/archive/documentcloud/" . $reference->file->sha1 . ".json';
					DV.load(docUrl, {
						container: '#doc',
						width:700,
						height:windowHeight,
						sidebar: false
					});";
			}
		}
	}
	
	// Gallica
	if ($viewer == '')
	{
		if (isset($identifiers['ark']))
		{
			if (preg_match('/(?<namespace>\d+)\/(?<id>.*)\/f(?<page>\d+)$/', $identifiers['ark'], $m))
			{
				$namespace 	= $m['namespace'];
				$arkid 		= $m['id'];
				$start_page = $m['page'];

				$viewer = "var docUrl = 'http://bionames.org/gallica/documentcloud/" . $arkid . "f" . $start_page . ".json';
					DV.load(docUrl, {
						container: '#doc',
						width:700,
						height:windowHeight,
						sidebar: false
					});";
			}
		}
	}
	
	// DOI
	if ($viewer == '')
	{
		if (isset($identifiers['doi']))
		{
			$viewer = '$("#doc").html(\'<iframe src="http://dx.doi.org/' . $identifiers['doi'] . '" width="700" height="100%" style="border: none;"></iframe>\');';
		}
	}

	// JSTOR
	if ($viewer == '')
	{
		if (isset($identifiers['jstor']))
		{
			$viewer = '$("#doc").html(\'<iframe src="http://www.jstor.org/stable/' . $identifiers['jstor'] . '" width="700" height="100%" style="border: none;"></iframe>\');';
		}
	}
	
	// CiNii
	if ($viewer == '')
	{
		if (isset($identifiers['cinii']))
		{
			$viewer = '$("#doc").html(\'<iframe src="http://ci.nii.ac.jp/naid/' . $identifiers['cinii'] . '" width="700" height="100%" style="border: none;"></iframe>\');';
		}
	}

	// Handle
	if ($viewer == '')
	{
		if (isset($identifiers['handle']))
		{
			$viewer = '$("#doc").html(\'<iframe src="http://hdl.handle.net/' . $identifiers['handle'] . '" width="700" height="100%" style="border: none;"></iframe>\');';
		}
	}
	
	
	$template = str_replace('<DOCVIEWER>', $viewer, $template);

	$template = str_replace('<TITLE>', $reference->title, $template);
	$template = str_replace('<COINS>', reference_to_coins($reference), $template);
	


    echo $template;



}
$id = '0752c5337f238927a742bf154167a431';
$id = '6f30264a973c8d40c48c1fc6d113807e';
display_record($id);

?>