<?php
	session_start();
	
	include "connect.php";
	$uname = $_POST["uname"];
	$passwd = $_POST["passwd"];
	
	
	/*if (strtolower($uname) == "bob" and strtolower($passwd) == "jim") {
		echo "Good Job";
	} else {
		echo "NO";
	}*/
	
	$mydb = new DB;
	$result = $mydb->query("select exists(
							select * from members where binary uname = \"$uname\"
							and  binary passwd = \"$passwd\")");
	$row = mysql_fetch_row($result);

	/* check if the returned value was 1, which indicates that the username and
 	`  password entered does indeed exist in the database */
 	if ($row[0] == 1) {
 		$_SESSION["uname"] = $uname;
 		echo "YES";
 	} else {
 		echo "NO";
	}
	
?>