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
		<link rel="stylesheet" href="common.css"/>
		<link href="game.css" type="text/css" rel="stylesheet" />
		<link href="modal.css" type="text/css" rel="stylesheet" />
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  		
  		<script>
  			var x, minutes, seconds, secondsRemaining;
  			var secondsPassed = 0;
  			
  			function startTimer(duration) {
			//var x;
	
				var start = Date.now(),
					diff;
					//minutes,
					//seconds;
				function timer() {
					// get the number of seconds that have elapsed since 
					// startTimer() was called
					diff = duration - (((Date.now() - start) / 1000) | 0);

					// does the same job as parseInt truncates the float
					minutes = (diff / 60) | 0;
					seconds = (diff % 60) | 0;

					minutes = minutes < 10 ? "0" + minutes : minutes;
					seconds = seconds < 10 ? "0" + seconds : seconds;
		
					document.getElementById("demo").innerHTML = minutes + ":" + seconds;
					//document.getElementById("demo2").innerHTML = secondsPassed;

					if (diff <= 0) {
						// add one second so that the count down starts at the full duration
						// example 05:00 not 04:59
						//start = Date.now() + 1000;
						new Audio('sad_trombone.mp3').play();
						clearInterval(x);
						loseModal.style.display = "block";
						//window.location = "lose.php";
						//document.getElementById("demo").innerHTML = "Time's Up!!!";
					}
					secondsPassed+= 1;
				};
				// we don't want to wait a full second before the timer starts
				timer();
				x = setInterval(timer, 1000);
			}
  		</script>
	</head>

	<body style="background-color: white">
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
				width: 90%;
				/*height: 50%; */
				/*text-align: center; */
				/*margin: 0 auto; */
				border: 1px solid black;
				padding: 10px;
				overflow-y:scroll; /* used so that wiki pages don't extent the page so far down */
				height: 600px; /* this will probably be adjusted later */
				background-color: #F8F8F8;
  			}
  		
			div.game_param {
				width: 170px;
				background-color: #ff4d4d;
				float:left;
				height: 200px;
				margin-right: 20px;
				margin-bottom: 20px;
				margin-top: 140px;
				/*text-align: center; */
			}
	
			h3.game_param, p.game_param {
				text-align:center;
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
		
	<?php
			if (isset($_GET["url"])) {
				$url = $_GET["url"];
				$remaining = $_GET["secondsRemaining"];
				$_SESSION["numClicks"]++;
				$_SESSION["traversed"][] = substr($url, 30);
			} else {
				$url = "https://en.wikipedia.org/wiki/" . $_SESSION["source"];
				$remaining = $_SESSION["time_limit"];
			}
	?>
	
	<div class="side_bar"></div>
	<img id = "owl_icon" src="crow_quill.gif" alt="owl">
	<div class="game_param">
			<h3 class="game_param"> Start: <?php echo $_SESSION["source"]; ?> </h3>
			<h3 class="game_param"> Finish: <?php echo $_SESSION["target"]; ?> </h3>
			<p id="demo" style="text-align: center"></p>
			<h3 style="text-align:center;"> Clicks: <?php echo $_SESSION["numClicks"]; ?> </h3>
	</div>
	
	<div>
		<div class="menu_bar">
			<ul>
				<li id="menu_option"> <a href = "logout.php"> Logout </a></li>
				<li id="menu_option"> <a href = "#"> Top Wiki-Gamers </a></li>
				<li id="menu_option"> <a href = "#"> About </a></li>
				<li id="menu_option"> <a href = "#"> Contact </a></li>
			</ul>
		</div>
	</div>
		
	<!-- ***************************************************************************************************** -->
	<div id="game-container">
		
		
		
		<!-- 
		<div class="game_param">
			<h3 style="text-align:center; line-height:1em;">Time Remaining</h3>
			<p id="demo" style="text-align: center"></p>
		</div>
		
		
		<div class="game_param">
			<h3 style="text-align:center;"> Clicks: <?php echo $_SESSION["numClicks"]; ?> </h3>
		</div>
		-->
		
		<!-- The Winning Modal index of 0 hopefully-->
		<div id="winModal" class="modal">
		  <!-- Modal content -->
		  <div class="modal-content">
			<span class="close">&times;</span>
			<h1 style="text-align:center">Victory!</h1>
			
			<?php
				$links = $_SESSION["traversed"];
				
				for ($i = 0; $i < sizeof($links); $i++) { ?>
					<p style="display:inline"><?= $links[$i] ?> &nbsp; </p>
					<p style="display:inline; line-height: 50px"> ~~~~ &nbsp; </p>
			<?php } ?>
			
			<!-- <p id="check" style="text-align:center">You WIN!</p> -->
			<p>Number of Seconds: <span id="sec"></span> </p>
			<p> Number of Clicks:<span> <?= $_SESSION["numClicks"] ?><span></p>
		  </div>
		</div>
		
		<!-- Losing Modal index of 1 hopefully-->
		<div id="loseModal" class="modal">
		  <!-- Modal content -->
		  <div class="modal-content">
			<span class="close">&times;</span>
			<h1 style="text-align:center">Sorry! Better Luck Next Time!</h1>
			<img style="display:block; margin-left: auto; margin-right: auto" height="400px" src="sad-piggy.png" />
		  </div>
		</div>
		
		
		<!-- Hidden Form to pass the number of seconds passed along with 
			 the game name upon victory -->
		<form action="win.php" method="post" id="hidden_form">
			<input type="hidden" name="seconds" id="seconds"></input>
			<input type="hidden" name="gname" id="gname" value="race"></input>
		</form>
		
		<script>
			// Get the modal
			var winModal = document.getElementById('winModal');
			var loseModal = document.getElementById('loseModal');

			// Get the <span> element that closes the modal
			var spanWin = document.getElementsByClassName("close")[0];
			var spanLose = document.getElementsByClassName("close")[1];
			
			// When the user clicks on <span> (x), go to home page
			spanWin.onclick = function() {
    			//modal.style.display = "none";
    			//window.location = "wiki_home.php";
    			var element = document.getElementById("seconds");
				element.value = sessionStorage.seconds;
				sessionStorage.clear();
				element.form.submit();
			}
			
			// When the user clicks on <span> (x), go to home page
			spanLose.onclick = function() {
    			//modal.style.display = "none";
    			//window.location = "wiki_home.php";
    			window.location="wiki_home.php";
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
						document.getElementById("sec").innerHTML = sessionStorage.seconds;
						new Audio('happy_trombone.mp3').play();
						winModal.style.display = "block";
					</script>
				<?php } ?>
				
				
			?>
		</div>
	</div>
		
		<script>
			
			$('a[href^="/wiki"]').click(function(e) {
				e.preventDefault();
				var href = $(this).attr('href');
				var title = $(this).attr('title');
				//alert(href);
				
				/******************************/
				var url = "https://en.wikipedia.org" + href;
				var secondsRemaining = parseInt(minutes * 60) + parseInt(seconds);
				
				if(sessionStorage.seconds) {  
					sessionStorage.seconds = Number(sessionStorage.seconds) + secondsPassed;
				} else {
					sessionStorage.seconds = secondsPassed;
				}
				
				//alert(minutes + ", " + seconds + ", " + secondsRemaining);
				window.location="game_race.php?url=" + url + "&secondsRemaining=" + secondsRemaining;
				clearInterval(x);
				
			});
		</script>
		
	</body>
</html>

