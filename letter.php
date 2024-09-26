<?php
/*
This file checks if the username and the password are correct.
If yes, show the letter. Else, redirect to the form page.
*/
	session_start();
	if (!isset($_POST["sub"])){ //username and password not posted
		header ("location:form.php");
		exit();
	}
	elseif (strtolower($_POST["username"]) == "yeshua5780" && $_POST["pass"] == "יומולדת22שמח"){
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>יום הולדת שמח!!</title>
		<meta charset="utf8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript">alert ("כל הכבוד! הצלחת לגלות את שם המשתמש והסיסמא!\nמיד תעברי למכתב :)");</script>
	</head>
	<body dir="rtl" id="letter">
		<article>
			<p id="little">בס"ד</p>
			<p class="left">ליל יום שני, אור לי"ד תמוז תש"פ</p>
			<p>תוכן המכתב חסוי</p>
		</article>
	</body>
	</html>
<?php
	}
	else { // incorrect username or password
		$_SESSION["msg"] = "אחד הפרטים שהזנת שגויים. אנא נסי שנית.";
		header ("location:form.php");
		exit();
	}
?>