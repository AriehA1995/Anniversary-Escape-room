<?php
/*
This page is where cities are displayed
*/
	session_start();
	if (isset($_GET["id"])){
		$id = $_GET["id"];
	}
	else {
		$id = "1"; // Jerusalem default city
	}
	$places = json_decode(file_get_contents("places.json"));
	$homes = $places[$id]->clue;
	$city = $places[$id]->name;
	switch ($city){
		case "jerusalem":
			$picture = $city . ".jpg";
			break;
		case "kohav":
		case "bet el":
		default:
			$picture = $city . ".png";
			break;
	}
	/*
		להוסיף קישור לקובץ שלוקח את הערים
		להוסיף כותרת מתאימה לעמוד
		להוסיף תמונה מתאימה
		להתאים עיצוב
		למקם נקודות
		להוסיף קישור לעמוד הראשי
		להוסיף קישור מתאים לכל עיר בנפרד
	*/
?>
<!DOCTYPE html>
<html class="citymap">
<head>
	<title>יום הולדת לישועה - חדר בריחה</title>
	<meta charset="utf8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript"> pageId = <?php echo $id; ?>; </script>
	<script type="text/javascript" src="gamedata.js"></script>
</head>
<body dir="rtl" class="citymap">
	<article class="citymap">
	<?php
		if (isset($_SESSION["alert"])){
			echo '<script type="text/javascript">setTimeout(function(){alert("' . $_SESSION["alert"] . '");}, 100);</script>';
			unset ($_SESSION["alert"]);
		}
		echo "\t".'<img src="pictures/' . $picture . '" class="citymap" />'."\n";
		foreach($homes as $index => $home){
			echo "\t\t".'<div class="home" name="' . $home->name . '" style="left: ' . $home->coordonee[0] . 'px; top: ' . $home->coordonee[1] . 'px;" id="' . $index . '">';
			echo '<div class="point"></div>'."</div>\n";
		}
		$page = "city"; // needed for sides.php
		include("sides.php");
	?>
	</article>
</body>
</html>