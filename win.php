<?php
	session_start();
	include "connect.php";
	
	function unsetGame() {
		unset($_SESSION["time_limit"]);
		unset($_SESSION["click_limit"]);
		unset($_SESSION["source"]);
		unset($_SESSION["target"]);
		unset($_SESSION["traversed"]);
		unset($_SESSION["numClicks"]);
	}
	
	$uname = $_SESSION["uname"];
	$clicks = $_SESSION["numClicks"];
	$gname = $_POST["gname"];
	$secs = $_POST["seconds"];
	
	/*
	insert into wiki_games (g_name, g_uname, time_taken, num_clicks)
	values('jesus', 'nprassas07', 43, 2)
	on duplicate key update
	time_taken = least(time_taken, values(time_taken));
	*/
	
	$mydb = new DB;
	//$result = $mydb->query("insert into wiki_games values(\"$gname\", \"$uname\", \"$secs\", \"$clicks\")");
	
	$result = $mydb->query("insert into wiki_games (g_name, g_uname, time_taken, num_clicks) 
							values(\"$gname\", \"$uname\", \"$secs\", \"$clicks\")
							on duplicate key update
							time_taken = least(time_taken, values(time_taken))"
							);

	/*
	echo "User: " . $uname . "<br>";
	echo "Game: " . $gname . "<br>";
	echo "Seconds: " . $secs . "<br>";
	echo "Clicks: " .$clicks . "<br>"; */
	
	/* return to home page */
	header("Location:wiki_home.php");
	
?>