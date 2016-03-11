<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');


	$importKey = "<import.io KEY>";
	$url = "<URL of page>&page=";
	$pageNumber = 1;
	$breakOut = 0;
	$count = 0;

	$finalArrayJSON = array();
	$interArrayJSON = array();

	$counterID = 0;

	while(true)
	{
		if($breakOut == 1)
		{
			break;
		}
		$currentUrl = $url.$pageNumber;
		$pageNumber = $pageNumber + 1;
		$pageImportUrl = urlencode($currentUrl);
		$rawPageImportUrl = 'https://api.import.io/store/connector/_magic?url='.$pageImportUrl.'&format=JSON&js=false&_apikey='.$importKey;
		$getPageJsonData = file_get_contents($rawPageImportUrl);
		$decodePageJsonData = json_decode($getPageJsonData, JSON_PRETTY_PRINT);

		for($i = 0; $i < 10; $i++)
		{
		
			if(!isset($decodePageJsonData['tables'][0]['results'][$i]['link']))
			{
				$breakOut = 1;
				break;
			}

			$rawUrl = $decodePageJsonData['tables'][0]['results'][$i]['link'];
			$importUrl = urlencode($rawUrl);
			$rawImportUrl = 'https://api.import.io/store/connector/_magic?url='.$rawUrl.'&format=JSON&js=false&_apikey='.$importKey;
			$getJsonData = file_get_contents($rawImportUrl);
			$decodeJsonData = json_decode($getJsonData, JSON_PRETTY_PRINT);
			$addressJson = $decodeJsonData['tables'][0]['results'][2]['style14_content'];
			$cityJson = $decodeJsonData['tables'][0]['results'][3]['style14_content'];
			$districtJson = $decodeJsonData['tables'][0]['results'][4]['style14_content'];
			$stateJson = $decodeJsonData['tables'][0]['results'][5]['style14_content'];

			$counterID = $counterID + 1;

			$interArrayJSON["id"] = $counterID;
			$interArrayJSON["address"] = $addressJson;
			$interArrayJSON["city"] = $cityJson;
			$interArrayJSON["district"] = $districtJson;
			$interArrayJSON["state"] = $stateJson;

			array_push($finalArrayJSON, $interArrayJSON);

			echo "done $count \n";
			$count = $count + 1;
			
		}

	}

	$fp = fopen('Filename.json', 'w');
	fwrite($fp, json_encode($finalArrayJSON, JSON_PRETTY_PRINT));
	fclose($fp);
?>
