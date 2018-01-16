<?php
	include "connect.php";
	$mydb = new DB;
	$criteria = "time_taken"; // order by time taken by default
	
	if (isset($_GET["criteria"])) {
		$criteria = $_GET["criteria"];
	}
		
		
	$result1 = $mydb->query("select * from wiki_games where g_name = 'race' order by $criteria limit 3;");
	$result2 = $mydb->query("select * from wiki_games where g_name = 'norace' order by $criteria limit 10;");
	$result3 = $mydb->query("select * from wiki_games where g_name = 'jesus' order by $criteria limit 10;");
	$result4 = $mydb->query("select * from wiki_games where g_name = 'donald' order by $criteria limit 10;");
	
	/*while ($row = mysql_fetch_assoc($result)) {
		echo $row["game_username"] . " " . $row["time_taken"] . " " . $row["num_clicks"] . "<br>";
	} */

?>

<html>
<head>
<style>
table.out {
    border-collapse: collapse;
    width: 	25%;
    float: left;
    margin: 5px 20px 25px 20px;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
th {
	color: white;
}

#g1 {
    background-color: #4CAF50;
}

#g2 {
    background-color: #B22222;
}

#g3 {
    background-color: #4682B4;
}

#g4 {
    background-color: #FF8C00;
}

div.tbl {
	float: left;
}

#dropdown {
	margin: 0 auto;
	text-align: center;
}


</style>
</head>

<body>

<h1 style="text-align:center">Top Wiki Gamers</h1>

<div style="margin: 0 auto; text-align: center">
<form id="myform" action="topUsers.php">
	<select id="order" name="criteria"  onchange="this.form.submit();">
		<option value="-1">Order By</option>
		<option value="time_taken">Time</option> 
		<option value="num_clicks">Clicks</option>                  
	</select>
</form>
</div>

<div class="tbl">
<h2 style="text-align:center">Race</h2>
<table class="out">
  <tr>
    <th id="g1">Username</th>
    <th id="g1">Time</th> 
    <th id="g1">Clicks</th>
  </tr>
  <?php
  	while ($row = mysql_fetch_assoc($result1)) { 
  ?>
  <tr>
  	<td><?= $row["g_uname"] ?></td>
  	<td><?= $row["time_taken"]?></td>
  	<td><?= $row["num_clicks"]?></td>
  </tr>
  <?php } ?>	
</table>
</div>

<div class="tbl">
<h2 style="text-align:center">No Deadline</h2>
<table class="out">
  <tr>
    <th id="g2">Username</th>
    <th id="g2">Time</th> 
    <th id="g2">Clicks</th>
  </tr>
  <?php
  	while ($row = mysql_fetch_assoc($result2)) { 
  ?>
  <tr>
  	<td><?= $row["game_uname"] ?></td>
  	<td><?= $row["time_taken"]?></td>
  	<td><?= $row["num_clicks"]?></td>
  </tr>
  <?php } ?>	
</table>
</div>

<div class="tbl">
<h2 style="text-align:center">5 Clicks to Jesus</h2>
<table class="out">
  <tr>
    <th id="g3">Username</th>
    <th id="g3">Time</th> 
    <th id="g3">Clicks</th>
  </tr>
<?php
  	while ($row = mysql_fetch_assoc($result3)) { 
  ?>
  <tr>
  	<td><?= $row["g_uname"] ?></td>
  	<td><?= $row["time_taken"]?></td>
  	<td><?= $row["num_clicks"]?></td>
  </tr>
  <?php } ?>	
</table>
</div>

<div class="tbl">
<h2 style="text-align:center">Donald to Donald</h2>
<table class="out">
  <tr>
    <th id="g4">Username</th>
    <th id="g4">Time</th> 
    <th id="g4">Clicks</th>
  </tr>
  <?php
  	while ($row = mysql_fetch_assoc($result4)) { 
  ?>
  <tr>
  	<td><?= $row["game_uname"] ?></td>
  	<td><?= $row["time_taken"]?></td>
  	<td><?= $row["num_clicks"]?></td>
  </tr>
  <?php } ?>	
</table>
</div>

</body>

<html>
