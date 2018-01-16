<!DOCTYPE html>
<html>
	
	<head>
		<title>The Wiki Game</title>
		
		<meta charset="utf-8" />
		<link href='//fonts.googleapis.com/css?family=Anaheim' rel='stylesheet'>
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<link rel="stylesheet" type="text/css" href="wiki.css"/>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<script>
		/* 	The function below is called whenever the user
			clicks the modal login button.  The information entered
			by user is sent to serverside php file which verifies
			the login and returns the result to calling
			ajax method. */
		 $(document).ready(function(){
			  $('#submit-button').click(function() {
				var uname = $('#uname').val();  
				var passwd = $('#passwd').val();  
				 $.ajax({
					   type:"post",
					   url:"verify_login.php",
					   data: {uname:uname, passwd:passwd},  
					   success: function(response){
							if (response.trim() == "NO") {
 							   	document.getElementById("msg").innerHTML = "Invalid username or password";
					   		} else {
								window.location = "wiki_home.php";					   
							}
					   }
				 });
			  });
		   });
		   
		   
		   /* The function below is called when user tries to sign up with a new account.
		   	  The username and password entered by user is sent to serverside php file
		   	  which checks if the username entered already exists in the database or not.
		   	  If it does not exist the sign up will be succesful, otherwise the user will
		   	  get a notification that they must pick a different username.
		   */
		    $(document).ready(function(){
			  $('#signupbtn').click(function() {
				var uname = $('#new_uname').val();  
				var passwd = $('#new_passwd').val();  
				 $.ajax({
					   type:"post",
					   url:"verify_signup.php",
					   data: {uname:uname, passwd:passwd},  
					   success: function(response){
							if (response.trim() == "NO") {
 							   	document.getElementById("signup").innerHTML = "The Username Already Exists.<br>"
 							   		+ "Please Try a Different Username.";
					   		} else {
								document.getElementById("signup").innerHTML = "Sign up Complete! You can now log in<br>"
									+ " and begin Wiki-Gaming.";	   
							}
					   }
				 });
			  });
		   });
	</script>

	<body>
	
	<div class="side_bar"></div>
	<img id = "owl_icon" src="crow_quill.gif" alt="owl">
	<div class="row">
		<div class="left"></div>
		<div class="menu_bar">
			<ul>
				<li> <a href = "#"> About </a></li>
				<li> <a href = "#"> Contact </a></li>
				<li><a href="" type="button" data-toggle="modal" data-target="#myModal">Login</a></li>
			</ul>
		</div>
	</div>
	
	<h2 id="wiki">Signup</h2>
	<hr noshade style="height:6px;width: 800px">
	<br>
	<hr noshade style="height:7px;width: 1000px; ">
	<!-- Hi Niko! You should be able to drop your own code inside any div and it'll be 
		accurately represented -->
	<div class = "Form">	
	
	<div class="container">
		<br><label><b>Username</b></label>
		<br><input type="text" placeholder="Enter Username" id="new_uname" name="new_uname" required>
		
		<h4 id="signup" style="float:right; color:#660033"><strong></strong></h4>

		<br><label><b>Password</b></label>
		<br><input type="password" placeholder="Enter Password" id="new_passwd" name="new_passwd" required>

		<!-- 
		<br><label><b>Repeat Password</b></label>
		<br><input type="password" placeholder="Repeat Password" name="psw-repeat" required>
		-->

		<div class="clearfix">
		  <button type="submit" id="signupbtn" class="signupbtn">Sign Up</button> 
		</div>
	</div>
	
	</div>
	<!-- NIKO: This is where the div ends for the page content-->
	<!--<blockquote class="oval-thought-border">
		<p style = "color: white;padding:0;font-size: 5px;">blockquote.oval-thought-border::before</p>
		<p><center> Check out our <br>Rankings!<br></center></p>
		<p style = "color: white;padding:0;font-size: 10px;">blockquote.oval-thought-border::after</p>
	</blockquote>-->
	
	 <!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
	
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button style="float:right" type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4>Login</h4>
					</div>
					<div class="modal-body" style="text-align:center">
						<input type="text" name="uname" id="uname" placeholder="username"></input><br><br>
						<input type="password" name="passwd" id="passwd" placeholder="password"></input><br>
						<button id="submit-button">Login</button>
					</div>
					<div class="modal-footer">
						<p id="msg" style="text-align:center; color: red"></p>
					</div>
				  </div>
	  
				</div>
		  </div>
	</body>
</html>




