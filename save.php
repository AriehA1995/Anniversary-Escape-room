<?php
	session_start();
	if (isset($_POST["save"])){
		$_SESSION["usersave"] = $_POST["usersave"];
		$_SESSION["passsave"] = $_POST["passsave"];
		$_SESSION["save"] = true;
		$_SESSION["alert"] = "ההשערות נשמרו בהצלחה!";
	}
	if (isset($_GET["redirect"])){
		$to = $_GET["redirect"];
		header("location: cities.php?id=" . $to);
	}
	else {
		header("location: game.php");
	}
	exit();
?>