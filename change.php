<?php
	function wi ($x, $a){
		return $x-(0.3*$a);
	}
	function he ($y, $b){
		return $y-(0.01*$b);
	}
	$places = json_decode(file_get_contents("places.json"));
	foreach ($places as $city){
		$co = $city->coordonee;
		$city->coordonee[1] += 5;
		echo implode(", ", $city->coordonee) . "<br />";
	}
	file_put_contents ("places.json", json_encode($places, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
?>