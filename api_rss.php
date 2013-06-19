<?php

// RSS feed

require_once (dirname(__FILE__) . '/couchsimple.php');
require_once (dirname(__FILE__) . '/lib.php');

//--------------------------------------------------------------------------------------------------
/**
 * @brief Generate UUID
 *
 * From http://www.ajaxray.com/blog/2008/02/06/php-uuid-generator-function/
 *
  * @author     Anis uddin Ahmad <admin@ajaxray.com>
  * @param      string  an optional prefix
  * @return     string  the formatted uuid
  */
function uuid($prefix = '')
{
	$chars = md5(uniqid(mt_rand(), true));
	$uuid  = substr($chars,0,8) . '-';
	$uuid .= substr($chars,8,4) . '-';
	$uuid .= substr($chars,12,4) . '-';
	$uuid .= substr($chars,16,4) . '-';
	$uuid .= substr($chars,20,12);
	
	return $prefix . $uuid;
} 

//--------------------------------------------------------------------------------------------------
function api_rss($limit = 50)
{
	global $config;
	global $couch;
	
	$xml = '';
	
	$url = '_changes?limit=' . $limit . '&descending=true&include_docs=true';
		
	$resp = $couch->send("GET", "/" . $config['couchdb_options']['database'] . "/" . $url);
	
	$response_obj = json_decode($resp);
	
	$feed = new DomDocument('1.0', 'UTF-8');

	$rss = $feed->createElement('feed');
	$rss->setAttribute('xmlns', 'http://www.w3.org/2005/Atom');
	$rss->setAttribute('xmlns:geo', 'http://www.w3.org/2003/01/geo/wgs84_pos#');
	$rss->setAttribute('xmlns:georss', 'http://www.georss.org/georss');
	$rss = $feed->appendChild($rss);
		
	// feed
	
	// title
	$title = $feed->createElement('title');
	$title = $rss->appendChild($title);
	$value = $feed->createTextNode('BioNames');
	$value = $title->appendChild($value);
		
	// link
	$link = $feed->createElement('link');
	$link->setAttribute('href', 'http://bionames.org');
	$link = $rss->appendChild($link);
		
	$link = $feed->createElement('link');
	$link->setAttribute('rel', 'self');
	$link->setAttribute('type', 'application/atom+xml');
	$link->setAttribute('href', 'http://bionames.org/api/rss');
	$link = $rss->appendChild($link);
				
	// updated
	$updated = $feed->createElement('updated');
	$updated = $rss->appendChild($updated);
	$value = $feed->createTextNode(date(DATE_ATOM));
	$value = $updated->appendChild($value);
		
	// id
	$id = $feed->createElement('id');
	$id = $rss->appendChild($id);
	$id->appendChild($feed->createTextNode('urn:uuid:' . uuid()));

	// author
	$author = $feed->createElement('author');
	$author = $rss->appendChild($author);
	
	$name = $feed->createElement('name');
	$name = $author->appendChild($name);
	$name->appendChild($feed->createTextNode('BioNames'));
		
	
	if (isset($response_obj->results))
	{
		foreach ($response_obj->results as $result)
		{
			//$xml .= $result->doc->_id . "\n";
			
			switch ($result->doc->type)
			{
				case 'article':
				case 'book':				
				case 'chapter':
				case 'generic':
					$entry = $feed->createElement('entry');
					$entry = $rss->appendChild($entry);
					
					// title
					$title = $entry->appendChild($feed->createElement('title'));
					$title->appendChild($feed->createTextNode($result->doc->title));

					// link
					$link = $entry->appendChild($feed->createElement('link'));
					$link->setAttribute('rel', 'alternate');
					$link->setAttribute('type', 'text/html');
					$link->setAttribute('href', 'http://bionames.org/references/' . $result->doc->_id);

					// dates
					$updated = $entry->appendChild($feed->createElement('updated'));
					$updated->appendChild($feed->createTextNode(date(DATE_ATOM, time())));
	
					$created = $entry->appendChild($feed->createElement('published'));
					$created->appendChild($feed->createTextNode(date(DATE_ATOM, time())));

					// id
					$id = $entry->appendChild($feed->createElement('id'));
					$id->appendChild($feed->createTextNode($result->doc->_id));

					$description = '<div>' . $result->doc->citation_string;
					if ($result->doc->thumbnail)
					{
						$description .= '<div>' . '<img src="' . $result->doc->thumbnail . '" height="100" />' . '</div>';
					}
					$description .= '</div>';
					
					// content
					$content = $entry->appendChild($feed->createElement('content'));
					$content->setAttribute('type', 'html');
					$content->appendChild($feed->createTextNode($description));

					// summary
					$summary = $entry->appendChild($feed->createElement('summary'));
					$summary->setAttribute('type', 'html');
					$summary->appendChild($feed->createTextNode($description));
				
					break;
					
				default:
					break;
			}
			
		}
	}
	
	
	
	
	return $feed->saveXML();
}


function main()
{
	$xml = api_rss(100);
	
	header("Content-type: text/xml;charset=utf-8");
	echo $xml;
}

main();

?>