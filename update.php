<?php
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
		
	//check if there is a place with this id. if not, no change will be started
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
	if (!isset ($noaction) || $noaction == false){
		if (!isset($_GET["id"]) || !isset($_GET["status"])){
			echo updateStatus("a",1);
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