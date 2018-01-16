<?php
	session_start();
	session_destroy();
	
	header("location: wiki_game.php");

?>