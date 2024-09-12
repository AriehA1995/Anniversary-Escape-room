<?php
	if (isset($_SESSION["save"]) && $_SESSION["save"]){
		$usersave = $_SESSION["usersave"];
		$passsave = $_SESSION["passsave"];
	}
	else {
		$usersave = "";
		$passsave = "";
	}
	$clues = json_decode(file_get_contents("indice.json"), true);
	$discovered = array();
	$i = 0;
	foreach ($places as $city){
		if (isset($city->status)){
			if ($city->status == 1){
				$discovered[$i] = array("name" => $city->label, "id" => $city->clue, "clue" => $clues[$city->clue]["text"]);
				$i++;
			}
		}
		elseif (is_array($city->clue)){
			foreach ($city->clue as $home){	
				if ($home->status == 1){
					$discovered[$i] = array("name" => $city->label . " - " . $home->label, "id" => $home->clue, "clue" => $clues[$home->clue]["text"]);
					$i++;
				}
			}
		}
	}
	$totalSee = 0;
	foreach ($discovered as $disco){
		if ($disco["id"] != "X0" && $disco["id"] != "G1"){
			$totalSee++;
		}
	}
	$totalVisit = count($discovered);
	$counterSee = $totalSee . "/" . (count($clues)-2);
	$counterVisit = $totalVisit . "/" . (count($places) + count($places[1]->clue) + count($places[3]->clue) + count($places[5]->clue) -3);
?>
<aside id="right">
	<section id="links">
		<a href="form.php"><button class="link">חזרה לטופס הכניסה</button></a>
	<?php
		if ($page == "city"){
			echo '<a href="game.php"><button class="link">חזרה למפה</button></a>';
		}
		else {
	?>
		<a href="index.php"><button class="link">משחק חדש</button></a>
	<?php
		}
	?>
	</section>
	<section id="found">
		<h1>רמזים שמצאת</h1>
		<div class="fclue counter"><?php echo $counterSee; ?></div>
		<div class="scroll">
		<?php
			foreach ($discovered as $disco){
				if ($disco["id"] != "X0" && $disco["id"] != "G1"){
					echo '<div class="fclue">' . $disco["clue"] . '</div>';
				}
			}
		?>
		</div>
	</section>
</aside>
<aside id="left">
	<section id="save">
		<h1>איזור הניחושים</h1>
		<form method="post" action="save.php<?php if ($page == "city"){echo '?redirect=' . $id ;} ?>" autocomplete="off">
			<label>שם משתמש</label>
			<input type="text" name="usersave" value="<?php echo $usersave; ?>" />
			<label>סיסמא</label>
			<input type="text" name="passsave" value="<?php echo $passsave; ?>" />
			<input type="submit" value="שמור השערות" class="link" name="save" />
		</form>
	</section>
	<section id="visited">
		<h1>מקומות שביקרת בהן</h1>
		<div class="vcity counter"><?php echo $counterVisit; ?></div>
		<div class="scroll">
		<?php
			foreach ($discovered as $disco){
				echo '<div class="vcity">' . $disco["name"] . '</div>';
			}
		?>
		</div>
	</section>
</aside>