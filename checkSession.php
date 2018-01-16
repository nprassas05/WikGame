<?php
	session_start();
	if (!isset($_SESSION["uname"])) {
		header("location: wiki_game.php");
	}
?>