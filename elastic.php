<?php

require_once (dirname(__FILE__) . '/lcs.php');


//--------------------------------------------------------------------------------------------------
function clean_string($str)
{
	$str = preg_replace("/[\.\?!\-|\s|:|,|;|\(|\)\[|\]]+/", ' ', $str);
	$str = preg_replace("/\s\s+/", ' ', $str);
	
	return $str;
}

//--------------------------------------------------------------------------------------------------
function find_citation($citation, &$result, $threshold = 0.8)
{
	$q = clean_string($citation);

	// Query object
	$query = new stdclass;
	$query->query = new stdclass;
	$query->query->match = new stdclass;
	$query->query->match->citation_string = $q;
		
	$url = 'http://localhost:9200/bionames/_search?pretty=true';
	
	//echo json_encode($query);

	$ch = curl_init(); 
	curl_setopt ($ch, CURLOPT_URL, $url); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt ($ch, CURLOPT_POST, TRUE);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($query));
	
	$response = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	if (curl_errno ($ch) != 0 )
	{
		echo "CURL error: ", curl_errno ($ch), " ", curl_error($ch);
	}
	
	$result->status = $http_code;
		
	$obj = json_decode($response);
	
	if (isset($obj->hits))
	{
		$best_hit = 0;
	
		$q = strtolower($q);
	
		foreach ($obj->hits->hits as $row)
		{
			$hit = $row->_source->citation_string;
			$hit_original = $hit;
			$hit = clean_string($hit);
	
			$hit = strtolower($hit);
				
			$query_length = strlen($q);
			$hit_length = strlen($hit);
				
			$C = LCSLength($hit, $q);
				
			// length of subsequence as percentage of query string
			$subsequence_length =  round((100.0 * $C[$hit_length][$query_length])/$query_length);
					
			$symdiff = 1.0 - ($query_length + $hit_length - 2 * $C[$hit_length][$query_length])/($query_length + $hit_length);
			
			if ($symdiff > $threshold)
			{
				if ($symdiff >= $best_hit)
				{
					$best_hit = $symdiff;
					
					$match = new stdclass;
					$match->text = $citation;
					$match->hit = $hit_original;
					$match->match = true;
					$match->id = $row->_id;
					$match->score = $row->_score;
					$match->symdiff = $symdiff;
					
					if ($symdiff > $best_hit)
					{
						$result->results = array();
					}						
					$result->results[] = $match;
				}
			}
		}
	}
	
	
	return (count($result->results) > 1); 
}

// test
if (0)
{
	$text = '(2003) A revision of the Scaphiophryne marmorata complex of marbled toads from Madagascar, including the description of a new species. Herpetological Journal, 13(2): 69--79';

	$result = new stdclass;
	find_citation($text, $result);
	
	print_r($result);
}

?>