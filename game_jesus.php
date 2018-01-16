<?php
	session_start();
	include "helper.php";
?>
<!DOCTYPE html>
<html>
	
	<head>
		<title>The Wiki Game</title>
		
		<meta charset="utf-8" />
		<!-- <link href='//fonts.googleapis.com/css?family=Anaheim' rel='stylesheet'> -->
		<link href="game.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="common.css"/>
		<link href="modal.css" type="text/css" rel="stylesheet" />
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		
  		<script>
  			var x;
  			var secondsPassed = 0;
  			function startTimer(duration) {
	
				function timer() {
					
					secondsPassed += 1;
				};
				
				// we don't want to wait a full second before the timer starts
				timer();
				x = setInterval(timer, 1000);
			}
  		</script>
  		
	</head>

	<body>
	<div class = "title">
						<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
				 width="600px" height="90px" viewBox="0 0 600 100">
			<style type="text/css">

			<![CDATA[

				text {
					filter: url(#filter);
					fill: #e33415;
					font-family: 'Share Tech Mono', sans-serif;
					font-size: 80px;
					float:left;
					-webkit-font-smoothing: antialiased;
					-moz-osx-font-smoothing: grayscale;
						}
			]]>
			
			#wiki_holder {
				/*background-color: #99ffdd;*/
				width: 75%;
				/*height: 50%; */
				/*text-align: center; */
				/*margin: 0 auto; */
				border: 1px solid black;
				padding: 10px;
				overflow-y:scroll; /* used so that wiki pages don't extent the page so far down */
				height: 600px; /* this will probably be adjusted later */
  			}
  		
			div.game_param {
				width: 22%;
				background-color: #ff4d4d;
				border: 2px solid black;
				float: left;
				height: 85px;
				margin-right: 20px;
				margin-bottom: 20px;
				/*text-align: center; */
			}
	
			h3.game_param, p.game_param {
				margin-left: 25px;
				line-height:1em;
			}
			
			#demo {
				font-size: 28px;
				font-weight: bold;
				line-height:1em;
				margin-top: 10px;
				margin-top: 10px;
			}
			</style>
				
			<!--<g>
				<text x="0" y="100">WIKI GAME</text>
			</g> -->
			</svg>
		</div>
	
	<div class="side_bar"></div>
		<img id = "owl_icon" src="crow_quill.gif" alt="owl">
		
	<div>
		<div class="menu_bar">
			<ul>
				<li id="menu_option"> <a href = "#"> Top Wiki-Gamers </a></li>
				<li id="menu_option"> <a href = "#"> Logout </a></li>
				<li id="menu_option"> <a href = "#"> About </a></li>
				<li id="menu_option"> <a href = "#"> Contact </a></li>
			</ul>
		</div>
	</div>
		
	<!-- ***************************************************************************************************** -->
	<div id="game-container">
		<?php
			if (isset($_GET["url"])) {
				$url = $_GET["url"];
				$_SESSION["numClicks"]++;
				$_SESSION["traversed"][] = substr($url, 30);
				
				if ($_SESSION["numClicks"] == $_SESSION["click_limit"]) {
					header("location: lose.php");
				}
			} else {
				$url = "https://en.wikipedia.org/wiki/" . $_SESSION["source"];
			}
		?>
		
		<div class="game_param">
			<h3 class="game_param"> Start: <?php echo $_SESSION["source"]; ?> </h3>
			<h3 class="game_param"> Finish: <?php echo $_SESSION["target"]; ?> </h3>
		</div>
		
		
		<div class="game_param">
			<h3 style="text-align:center;"> Clicks: <?php echo $_SESSION["numClicks"]; ?> </h3>
		</div>
		
				<!-- The Modal -->
		<div id="myModal" class="modal">
		  <!-- Modal content -->
		  <div class="modal-content">
			<span class="close">&times;</span>
			
			<?php
				/*$user = "carlos";
				$numClicks = $_SESSION["numClicks"];
				$game = "race";
				$time = 15;
				
				echo "<p>$user</p>";
				echo "<p>$numClicks</p>";
				echo "<p>$game</p>";
				echo "<p>$time</p>"; */
				print_r($_SESSION["traversed"]);
				
			?>
			
			<p id="check">You WIN!</p>
	
		  </div>
		</div>
		
		<!-- Hidden Form to pass the number of seconds passed along with 
			 the game name upon victory -->
		<form action="win.php" method="post" id="hidden_form">
			<input type="hidden" name="seconds" id="seconds"></input>
			<input type="hidden" name="gname" id="gname" value="jesus"></input>
		</form>
		
		
		<script>
			// Get the modal
			var modal = document.getElementById('myModal');

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];
			
			// When the user clicks on <span> (x), go to home page
			span.onclick = function() {
    			//modal.style.display = "none";
    			//window.location = "wiki_home.php";
    			var element = document.getElementById("seconds");
				element.value = sessionStorage.seconds;
				sessionStorage.clear();
				element.form.submit();
			}
		</script>
		
		<div id="wiki_holder">
			<?php
				error_reporting(0);
				displayTags($url);
				
				if ($url != "https://en.wikipedia.org/wiki/" . $_SESSION["target"]) {
					echo "<script>startTimer($remaining);</script>";
				} else { ?>
					<script>
						modal.style.display = "block";
					</script>
				<?php } ?>
			?>
		</div>
	</div>

	<script>
		$('a').click(function(e) {
			e.preventDefault();
			var href = $(this).attr('href');
			var title = $(this).attr('title');
				
			/******************************/
			var url = "https://en.wikipedia.org" + href;
			
			if(sessionStorage.seconds) {  
				sessionStorage.seconds = Number(sessionStorage.seconds) + secondsPassed;
			} else {
				sessionStorage.seconds = secondsPassed;
			}
			
			window.location="game_jesus.php?url=" + url;
			clearInterval(x);
				
		});
	</script>
	
	</body>
</html>