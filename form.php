<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>שלום ישועה!</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body dir="rtl">
	<h1>שלום, ישועה!</h1>
	<p>מזל טוב ליום הולדתך ה- 22! בשביל לראות את המכתב שכתבתי לך, עלייך להזין שם משתמש וסיסמא.</p>
	<form autocomplete="off" action="letter.php" method="post" id="form">
	<?php
		if (isset($_SESSION["msg"])){
			echo '<div id="red">' . $_SESSION["msg"] . '</div>';
			unset ($_SESSION["msg"]);
		}
	?>
		<label class="index">שם משתמש:</label>
		<input type="text" name="username" class="index" />
		<label class="index">סיסמא:</label>
		<input type="password" name="pass" class="index" />
		<input type="submit" name="sub" value="כניסה" class="index" />
	</form>
	<a title="שכחתי סיסמא" href="game.php">שכחתי סיסמא</a>
	<img src="pictures/balloons.png" title="בלונים" alt="balloons" id="right" class="balon" />
	<img src="pictures/balloons.png" title="בלונים" alt="balloons" id="left" class="balon" />
</body>
</html>