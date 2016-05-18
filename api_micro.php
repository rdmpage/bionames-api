<?php


// Microcitation



require_once (dirname(__FILE__) . '/couchsimple.php');

require_once (dirname(__FILE__) . '/api_utils.php');

/*

$micro = array('Fieldiana Zool., n.s.', 70, 37);

$micro = array('J. Mammal.',15,154);
$micro = array("Ann. Mag. Nat. Hist., ser. 9",8,137);
$micro = array("Annals. Magazine. Natural. History., ser. 9",8,137);
$micro = array("Ann. Mag. Nat. Hist., ser. 6"	,1		,158);	
$micro = array("Ann. Mag. Nat. Hist., ser. 6"	,'i'		,158);	

$micro = array('Proc. Biol. Soc. Wash.'	,12	,	95);
$micro = array('Notes Leyden Mus.'	,33		,234);
$micro = array('Rec. W. Aust. Mus.',	14	,	39);
$micro =  array('Mem. Queensl. Mus.',	48		,257);


*/

function find_micro(&$openurl_result)
{
	global $config;
	global $couch;
	
	$journal = $openurl_result->micro[0];

	//echo "journal=$journal\n";

	
	
	// Convert accented characters
	/*
	$journal = strtr(utf8_decode($journal), 
			utf8_decode(
			"ÀÁÂÃÄÅàáâãäåĀāĂăĄąÇçĆćĈĉĊċČčÐðĎďĐđÈÉÊËèéêëĒēĔĕĖėĘęĚěĜĝĞğĠġĢģĤĥĦħÌÍÎÏìíîïĨĩĪīĬĭĮįİıĴĵĶķĸĹĺĻļĽľĿŀŁłÑñŃńŅņŇňŉŊŋÒÓÔÕÖØòóôõöøŌōŎŏŐőŔŕŖŗŘřŚśŜŝŞşŠšſŢţŤťŦŧÙÚÛÜùúûüŨũŪūŬŭŮůŰűŲųŴŵÝýÿŶŷŸŹźŻżŽž"),
			"aaaaaaaaaaaaaaaaaaccccccccccddddddeeeeeeeeeeeeeeeeeegggggggghhhhiiiiiiiiiiiiiiiiiijjkkkllllllllllnnnnnnnnnnnoooooooooooooooooorrrrrrsssssssssttttttuuuuuuuuuuuuuuuuuuuuwwyyyyyyzzzzzz");
		 
	$journal = utf8_encode($journal);
	*/
	//echo "converted journal=$journal\n";
	

	// extraneous stuff
	$journal = preg_replace('/,?\s+n.s.$/Uu', '', $journal);
	$journal = preg_replace('/, ser. \d+$/Uu', '', $journal);
	$journal = preg_replace('/, \[ser. \d+\]$/Uu', '', $journal);
				
	$journal = strtolower($journal);
	
	$journal = preg_replace('/\bfor\b/', '', $journal);
	$journal = preg_replace('/\band\b/', '', $journal);
	$journal = preg_replace('/\bof\b/', '', $journal);
	$journal = preg_replace('/\bthe\b/', '', $journal);
	
	$journal = preg_replace('/\bde\b/', '', $journal);
	$journal = preg_replace('/\bla\b/', '', $journal);
	$journal = preg_replace('/\bet\b/', '', $journal);
	
	// whitespace
	$journal = preg_replace('/\s+/', '', $journal);
	
	// punctuation
	$journal = preg_replace('/[\.|,|\'|\(|\)]+/', '', $journal);
	
	$openurl_result->journal = $journal;
	
	
	
	//echo "journal=$journal\n";
	
	$volume = $openurl_result->micro[1];
				

	// i. get ISSN
	$issn = '';
	
	$oclc = '';
	
	$url =  $config['couchdb_options']['database'] . "/_design/openurl/_view/journal_to_issn?key=" . urlencode('"' . $journal . '"');
	
	if ($config['stale'])
	{
		$url .= '&stale=ok';
	}	
	
	//echo $url;				
				
	$resp = $couch->send("GET", "/" . $url . '&limit=1' );
	$result = json_decode($resp);
	
	/*
	echo '<pre>';
	print_r($result);
	echo '</pre>';
	*/
	
	if (count($result->rows) == 1)
	{
		// we have an ISSN for this journal
		$issn = $result->rows[0]->value;
	}
	else
	{
		// fudge
		switch ($journal)
		{
			case 'actatheriol':
				$issn = '0001-7051';
				break;
				
			case 'actazoolacadscienthungaricae':
				$issn = '1217-8837';
				break;
				
			case 'animconserv':
				$issn = '0365-4508';
				break;
				
			case 'anthropolpapamermusnathist':
				$issn = '0065-9452';
				break;
				
			case 'arquivosmuseunacionalriojaneiro':
			case 'arquivosdemuseunacionalriodejaneiro':
				$issn = '0365-4508';
				break;
			
			case 'actualidadesbiologicas':
				$issn = '0304-3584';
				break;
			
			case 'amjprimatol':
				$issn = '0275-2565';
				break;
		
			case 'ammusnovit':
				$issn = '0003-0082';
				break;
			
			case 'annmagnathist':
				$issn = '0374-5481';
				break;
				
			case 'annsafrmus':
				$issn = '0303-2515';
				break;
				
			case 'anntransvmus':
			case 'anntransvaalmus':
				$issn = '0041-1752';
				break;
				
			case 'austmammal':
				$issn = '0310-0049';
				break;
				
			case 'ausjzool':
				$issn = '0004-959X';
				break;
				
			case 'australianzool':
				$issn = '0067-2238';
				break;
				
			case 'biotemas':				
				$issn = '0103-1643';
				break;
				
			case 'bullamnathist':
			case 'bullammusnathist':
				$issn = '0003-0090';
				break;
				
			case 'bolmusparaemiliogoeldiserzool':
				$issn = '0077-2232';
				break;
				
			case 'bonnzoolbeitr':
				$issn = '0006-7172';
				break;
				
			case 'bullinstroyscinatbelgiquebiol':
				$issn = '0374-6429';
				break;
				
			case 'bullnathistmuslondzool':
				$issn = '0968-0470';
				break;

			case 'bullscaliforniaacadsci':
				$issn = '0038-3872';
				break;
				
			case 'bullsoczoolfrance':
				$issn = '0037-962X';
				break;
				
			case 'fieldianazoolns':
				$issn = '0015-0754';
				break;
				
			case 'fieldmusnathistpublzoolser':
				$issn = '0895-0237';
				break;
				
			case 'goeldianazoologia':
				$issn = '0103-6076';
				break;
				
			case 'intjprimatol':
				$issn = '0164-0291';
				break;
				
			case 'jasiatsocbengal':
				$oclc = 1824093;
				break;
				
			case 'jzool':
				$issn = '0952-8369';
				break;
				
			case 'mammbiol':
				$issn = '1616-5047';
				break;

			case 'mammstudy':
				$issn = '1343-4152';
				break;
				
			case 'marmamsci':
				$issn = '0824-0469';
				break;
				
			case 'mastozooltrop':
				$issn = '0327-9383';
				break;
				
			case 'mittzoolmusberlin':
				$issn = '0373-8493';
				break;		
				
			case 'memfundlasalleciencnat':
				$issn = '0037-8518';
				break;
				
			case 'memqldmus':
			case 'memqueenslmus':
				$issn = '0079-8835';
				break;

			case 'nature':
				$issn = '0028-0836';
				break;
				
			case 'occpapmustexastechuniv':
				$issn = '0149-175X';
				break;
				
			// Papeis Avulsos de Zoologia (São Paolo)
			case 'papeisavulsosdezoologia':
			case 'papeisavulsosdezoologiasaopaolo':
				$issn = '0031-1049';
				break;
				
			case 'proccaliforniaacadsci':
				$issn = '0068-547X';
				break;
				
			case 'proclinnsocnsw':
				$issn = '0370-047X';
				break;				
			
			case 'procusnatlmus':
				$issn = '0096-3801';
				break;			
				
			case 'proczoolsoclond':
				$issn = '0370-2774';
				break;			
				
			case 'publzoolunivcalpress':
				$issn = '0068-6506';
				break;			
						
			case 'recwaustmus':
			case 'recwestaustmus':
				$issn = '0312-3162';
				break;
				
			case 'rafflesbulletinzoology':
				$issn = '0217-2445';
				break;
				
			case 'revacadcolombcienc':
				$issn = '0370-3908';
				break;
				
			case 'revbraszool':
				$issn = '0101-8175';
				break;
				
			case 'revchilenahistnat':
				$issn = '0716-078X';
				break;
				
			case 'revsuissezool':
				$issn = '0035-418X';
				break;
				
			case 'russianjtheriol':
			case 'russianjournaltheriology':
			case 'russianjournaloftheriology':
				$issn = '1682-3559';
				break;
				
				
			case 'safrjzool':
				$issn = '0254-1858';
				break;
				
				
			case 'senkbiol':
			case 'senckenbergianabiologica':
				$issn = '0037-2102';
				break;
				
			case 'smithsmisccoll':
			case 'smithsonmisccoll':
			case 'smithsonianmisccoll':
				$oclc = 1824093;
				break;
				
			case 'studneotropfaunaenvir':
			case 'studiesonneotropicalfaunaandenvironment':
				$issn = '0165-0521';
				break;
				
			case 'transrsocsaust':
				$issn = '0372-1426';
				break;
				
			case 'tropzool':
			case 'tropicalzoology':
				$issn = '0394-6975';
				break;

			case 'zoolresearch':
				$issn = '0254-5853';
				break;

			case 'zoolsci':
				$issn = '0289-0003';
				break;

			case 'zsaugetierk':
			case 'zsaeugetierk':
			case 'zsäugetierk':
				$issn = '0044-3468';
				break;
				
			default:
				break;
		}
	}
	
	if ($issn != '')
	{
		
		$openurl_result->issn = $issn;
		
		// build partial [ISSN, volume]			
		$startkey= array(
			$issn, 
			(string)$volume,
			);
	
		$endkey= array(
			$issn, 
			(string)$volume,
			new stdclass,
			);
			
	
		$url = $config['couchdb_options']['database'] . '/_design/openurl/_view/triple?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&reduce=false&include_docs=true';
		
		//echo $url . '<br />';
	
		if ($config['stale'])
		{
			$url .= '&stale=ok';
		}			
	
		$resp = $couch->send("GET", "/" . $url );
		$r = json_decode($resp);
		//print_r($r);
		
		foreach ($r->rows as $row)
		{
			if (isset($row->doc->journal))
			{
				if (isset($row->doc->journal->pages))
				{
					if (preg_match('/^(?<spage>\d+)--(?<epage>\d+)$/', $row->doc->journal->pages, $m))
					{
						if (($openurl_result->micro[2] >= $m['spage']) && ($openurl_result->micro[2] <= $m['epage']))
						{
							$openurl_result->status = 200;
							$openurl_result->results[] = $row->doc;
						}
					}
				}
			}
		
		
		}
	}
	
	if ($oclc != '')
	{
		
		$openurl_result->oclc = $oclc;
		
		// build partial [oclc, volume]			
		$startkey= array(
			(Integer)$oclc, 
			(string)$volume,
			);
	
		$endkey= array(
			(Integer)$oclc, 
			(string)$volume,
			new stdclass,
			);
			
	
		$url = $config['couchdb_options']['database'] . '/_design/openurl/_view/oclc_triple?startkey=' . json_encode($startkey) . '&endkey=' . json_encode($endkey) . '&reduce=false&include_docs=true';
		
		echo $url . '<br />';
	
		if ($config['stale'])
		{
			$url .= '&stale=ok';
		}			
	
		$resp = $couch->send("GET", "/" . $url );
		$r = json_decode($resp);
		//print_r($r);
		
		foreach ($r->rows as $row)
		{
			if (isset($row->doc->journal))
			{
				if (isset($row->doc->journal->pages))
				{
					if (preg_match('/^(?<spage>\d+)--(?<epage>\d+)$/', $row->doc->journal->pages, $m))
					{
						if (($openurl_result->micro[2] >= $m['spage']) && ($openurl_result->micro[2] <= $m['epage']))
						{
							$openurl_result->status = 200;
							$openurl_result->results[] = $row->doc;
						}
					}
				}
			}
		
		
		}
	}	
	
}

//--------------------------------------------------------------------------------------------------
function main()
{
	global $config;
	global $couch;
	
	//print_r($_GET);
	
	$callback = '';
			
	// If no query parameters 
	if (count($_GET) == 0)
	{
		//display_form();
		exit(0);
	}	
	
	if (isset($_GET['callback']))
	{	
		$callback = $_GET['callback'];
	}
	
	
	$journal = $volume = $page = '';
	
	if (isset($_GET['journal']))
	{
		$journal = $_GET['journal'];
	}
	
	if (isset($_GET['volume']))
	{
		$volume = $_GET['volume'];
	}

	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	
	$openurl_result = new stdclass;
	//$openurl_result->status = 404;
	
	$openurl_result->results = array();
	
	
	if (
		($journal != '')
		&& ($volume != '')
		&& ($page != '') )
	{
		$openurl_result->micro = array();
		$openurl_result->micro[] = $journal;
		$openurl_result->micro[] = $volume;
		$openurl_result->micro[] = $page;
		
		find_micro($openurl_result);
	
	
	
	
	}
	
	api_output($openurl_result, $callback);
	
	
}
	





main();

?>