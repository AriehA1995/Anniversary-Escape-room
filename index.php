<?php
/*
This file is the index file.
Reset everything and initialize the website.
*/
	session_start();
	if (isset($_SESSION["start"])){
		unset($_SESSION["start"]);
		session_destroy(); //destroy the session
	}
	$noaction = true; // this variable is used inside update.php
	include ("update.php");
	updateStatus ("all",0); // change the status of all the places and indices to undiscovered
	header("location: form.php"); // go to the form page
	exit();
?>