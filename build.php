<?php
	session_start();
	include "helper.php";
	
	// set the game parameters for the appropriate game
	switch($_GET["game_name"]) {
		case "jesus":
			$_SESSION["source"] = getJesusLink();
			$_SESSION["target"] = "Jesus";
			$_SESSION["time_limit"] = NULL;
			$_SESSION["click_limit"] = 5;
			$url = "game_jesus.php";
			break;
		case "donald":
			$_SESSION["source"] = "Donald_Duck";
			$_SESSION["target"] = "Donald_Trump";
			$_SESSION["time_limit"] = 240;
			$_SESSION["click_limit"] = NULL;
			$url = "game_donald.php";
			break;
		case "race":
			setLinks($_SESSION["source"], $_SESSION["target"]);
			$_SESSION["time_limit"] = 180;
			$_SESSION["click_limit"] = NULL;
			$url = "game_race.php";
			break;
		case "norace";
			//setLinks($_SESSION["source"], $_SESSION["target"]);
			$_SESSION["source"] = "Microsoft";
			$_SESSION["target"] = "Bill_Gates";
			$_SESSION["time_limit"] = NULL;
			$_SESSION["click_limit"] = NULL;
			$url = "game_norace.php";
			break;
		default:
			echo "Error..... whatever<br>";
	}
	
	$_SESSION["traversed"] = array($_SESSION["source"]);
	$_SESSION["numClicks"] = 0;
	header("Location: $url");
?>

