<?php
	session_start();
	if (isset($_SESSION["start"])){
		unset($_SESSION["start"]);
		session_destroy();
	}
	$noaction = true;
	include ("update.php");
	updateStatus ("all",0);
	header("location: form.php");
	exit();
?>