<?php
	session_start();
	
	include "connect.php";
	$uname = $_POST["uname"];
	$passwd = $_POST["passwd"];
	
	
	$mydb = new DB;
	$result = $mydb->query("select exists(
							select * from members where binary uname = \"$uname\")");			
	$row = mysql_fetch_row($result);


	/*	if the username entered already exists in database, send back and error message
	   	so that duplicate users in the database have the same username.  If the
	   	username does not already exists, then add the new username and password combo
	   	to the database */
 	if ($row[0] == 1) {
 		echo "NO";
 	} else {
 		$result = $mydb->query("insert into members values(\"$uname\", \"$passwd\")");
 		echo "YES";
	}
	
?>