<?php
	session_start();
	/*
	This is the main page of the game.
	*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>יום הולדת לישועה - חדר בריחה</title>
	<meta charset="utf8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="gamedata.js"></script>
	<?php
		if (!isset($_SESSION["start"]) || $_SESSION["start"] != true){
			$_SESSION["start"] = true; // this is the first time the user is on this page
	?>
	<script type="text/javascript">
		var startTitle = "שכחת סיסמא??";
		var startMsg = "כמה מצער! היינו עוזרים לך בשמחה לשחזר את הסיסמא, אולם יש בעיה קטנה, גם אנחנו שכחנו אותה...</p>";
		startMsg += "<p>אבל, זה בסדר. התגלגלה לידינו שמועה, שאדם חכם במיוחד טמן רמזים מיוחדים ברחבי הארץ. הרמזים נמצאים במקומות הקשורים לכלת יום ההולדת. אם תבקרי במקומות אלה, תוכלי למצוא רמזים שיעזרו לך לשחזר את הסיסמא.</p>";
		startMsg += "<p>האם את מוכנה לצאת לדרך? שימי לב! ייתכן שסידור הביקורים שלך בסדר מסויים יוכל לעזור לך בהבנת הרמזים!</p>";
		startMsg += "<p><a href='index.php'><button>לחזרה לטופס הכניסה</button></a>";
		$(function(){
			message(startTitle, startMsg);
			$("button").eq(3).text("להתחלת מסע החיפושים הגדול!");
			$("button").attr("class","link");
			$("button").eq(2).width("50%");
			$("button").eq(2).css("margin", "5px 25%");
			$("button").eq(3).css("margin", "1% 34% 1% 36%");
		});
	</script>
	<?php
		}
		if (isset($_SESSION["alert"])){
			echo '<script type="text/javascript">setTimeout(function(){alert("' . $_SESSION["alert"] . '");}, 100);</script>';
			unset ($_SESSION["alert"]);
		}
	// מסוק, שערי צדק, נצרים, כוכב השחר, כפר פינס, בית אל, אדם, ירושלים, מבשרת ציון, אחיה
	// כוכב השחר: בית כנסת, בית, ספריה, צבי ותחיה, מעלה שלמה
	// ירושלים: שערי צדק, מכון טל, רוממה, הר חומה, הר המנוחות, סבתא שרה, הר נוף
	// בית אל: תל חיים, אולפנה

	// שם משתמש: yeshua5780
	// סיסמא: יומולדת22שמח

	// 6 אותיות בשם משתמש, 10 אותיות בסיסמא.
	// שני מספרים
	// גילוי האותיות, גילוי מאפיינים
	// 20 מקומות
		$places = json_decode(file_get_contents("places.json"));
	?>
</head>
<body dir="rtl">
	<article>
		<img src="pictures/israelmap.gif" id="israelmap" />
	<?php
		foreach($places as $index => $city){
			echo "\t".'<div class="place" name="' . $city->name . '" style="left: ' . $city->coordonee[0] . 'px; top: ' . $city->coordonee[1] . 'px;" id="' . $index . '">';
			if ($city->name == "elicopter"){
				echo '<img src="pictures/helicopter.png" id="hel" />';
				echo "</div>\n\t";
			}
			else {
				echo '<div class="point"></div>';
				if ($places[0]->status == 1){
					echo '<div class="label">' . $city->label . '</div>';
				}
				echo "</div>\n\t";
			}
		}
		$page = "game"; // this is needed for sides.php page
		include("sides.php");
	?>
	</article>
</body>
</html>