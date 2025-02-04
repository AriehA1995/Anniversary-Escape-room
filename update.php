<?php

/*
This page is a API that can update the status of a place.
The parameters are:
id = the id of the place - a number given by the order of the places file can also be "all"
status = the status to be updated. can be 1 or 0
hid = used in a city with multiple indices

update the places.json file according to the request

return a json object with 2 keys:
code = can be "changed" or "no changes"
data = all the content of the updated places.json file

*/
	class response {
		public $code;
		public $data;
	}
	function updateStatus($placeId, $status, $clueId = 0){
		$places = json_decode(file_get_contents("places.json"));
		$answer = new response();
		if ($status && $status != "false"){
			$status = 1;
		}
		else {
			$status = 0;
		}
		if ($placeId == "all"){
			foreach ($places as $city){
				if (is_array($city->clue)){
					foreach ($city->clue as $home){
						if ($home->status != $status){
							$home->status = $status;
						}
					}
				}
				else {
					if ($city->status != $status){
						$city->status = $status;
					}
				}
			}
			$answer->code = "changed";
			$answer->data = $places;
			file_put_contents ("places.json", json_encode($places, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
			return json_encode($answer, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
		
	//check if there is a place with this id. if not, no change will happen
		elseif (!isset($places[$placeId])){
			$answer->code = "no changes";
			$answer->data = $places;
			return json_encode($answer, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
		elseif (is_array($places[$placeId]->clue)){
			if (!isset($places[$placeId]->clue[$clueId])){
				$answer->code = "no changes";
				$answer->data = $places[$placeId];
				return json_encode($answer, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			}
			$clue = $places[$placeId]->clue[$clueId];
		}
		else {
			$clue = $places[$placeId];
		}
		if ($clue->status == $status){
			$answer->code = "no changes";
		}
		else {
			$clue->status = $status;
			$answer->code = "changed";
		}
		$answer->data = $clue;
		if ($answer->code == "changed"){
			file_put_contents ("places.json", json_encode($places, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
		}
		return json_encode($answer, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
	// the noaction variable is used if we get access to the file via php.
	// should be true if we want to use the updateStatus function and not to access the API
	if (!isset ($noaction) || $noaction == false){
		if (!isset($_GET["id"]) || !isset($_GET["status"])){
			echo updateStatus("a",1); // no change
		}
		else {
			$id = $_GET["id"];
			$stat = $_GET["status"];
			if (!isset($_GET["hid"])){
				$hid = 0;
			}
			else {
				$hid = $_GET["hid"];
			}
			echo updateStatus($id, $stat, $hid);
		}
	}
?>