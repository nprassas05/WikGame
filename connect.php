<?php

class DB {
	private $host = 'dbinstance.clu675rzclhs.us-west-2.rds.amazonaws.com'; //'localhost';
	private $username = ''; // root
	private $passwd = '';
	private $db = '';
	
	// Constructor
    public function __construct() {
        mysql_connect($this->host,$this->username,$this->passwd);
        mysql_select_db($this->db);
    }
    
    // execute query
    public function query($query) {
    	return mysql_query($query);
    }

}

function connectDB() {
	$host = 'localhost';
	$username = 'root';
	$passwd = '';
	$db = 'wikidb';
	$conn = mysql_connect($host, $username, $passwd);
	
	if ($conn) {
		echo "yes";
	} else {
		echo "no";
	}
	
    mysql_select_db($db);
}


/* Connect to mySQL */
function connect_db()
{
	$server = "localhost";
	$username = "root";
	$password = "";
	$db = "wkidb";
	// Create connection
	$conn = mysqli_connect($server, $username, $password, $db);
	// Check connection
	if (!$conn) {
		die("Connection failed");
	}
	
	return $conn;
}


/* $mydb = new DB;

$result = $mydb->query("select * from users;");

while ($row = mysql_fetch_assoc($result)) {
	$name = $row["fname"] . "  ";
   	echo $name;
} */

?>

