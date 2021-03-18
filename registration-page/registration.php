<!DOCTYPE html>
<html>
<head>
	<title>Login/Register account</title>
	<link rel="stylesheet" type="text/css" href="registration.css">
	<link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
	<script src="registration.js"></script>
	<?php session_start();
	?>
</head>
<body>

		<div id="email_modal" class="modal">
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <h1>Email already taken</h1>
		  </div>
		</div>

		<div id="password_modal" class="modal">
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <h1>Passwords do not match</h1>
		  </div>
		</div>

		<div id="field_modal" class="modal">
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <h1>Please complete all fields</h1>
		  </div>
		</div>

		<div id="invalid_modal" class="modal">
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <h1>Email or password is invalud</h1>
		  </div>
		</div>

		<div id="de_modal" class="modal">
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <h1>A user with these credentials does not exist</h1>
		  </div>
		</div>

		<div id="ev_modal" class="modal">
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <h1>Email is not valid</h1>
		  </div>
		</div>

		<script type="text/javascript">
			var email_modal = document.getElementById("email_modal");
			var password_modal = document.getElementById("password_modal");
			var field_modal = document.getElementById("field_modal");
			var invalid_modal = document.getElementById("invalid_modal");
			var de_modal = document.getElementById("de_modal");
			var ev_modal = document.getElementById("ev_modal");

			var email_span = document.getElementsByClassName("close")[0];
			var password_span = document.getElementsByClassName("close")[1];
			var field_span = document.getElementsByClassName("close")[2];
			var invalid_span = document.getElementsByClassName("close")[3];
			var de_span = document.getElementsByClassName("close")[4];
			var ev_span = document.getElementsByClassName("close")[5];

			function email_error() {
				email_modal.style.display = "block";
			}

			function password_error() {
				password_modal.style.display = "block";
			}

			function field_error() {
				field_modal.style.display = "block";
			}

			function invalid_error() {
				invalid_modal.style.display = "block";
			}

			function de_error() {
				de_modal.style.display = "block";
			}

			function ev_error() {
				ev_modal.style.display = "block";
			}

			email_span.onclick = function() {
				email_modal.style.display = "none";
			}

			password_span.onclick = function() {
				password_modal.style.display = "none";
			}

			field_span.onclick = function() {
				field_modal.style.display = "none";
			}

			invalid_span.onclick = function() {
				invalid_modal.style.display = "none";
			}

			de_span.onclick = function() {
				de_modal.style.display = "none";
			}

			ev_span.onclick = function() {
				ev_modal.style.display = "none";
			}

			window.onclick = function(event) {
				if (event.target == email_modal) {
					email_modal.style.display = "none";
				}
				else if (event.target == password_modal) {
					password_modal.style.display = "none";
				}
				else if (event.target == field_modal) {
					field_modal.style.display = "none";
				}
				else if (event.target == invalid_modal) {
					invalid_modal.style.display = "none";
				}
				else if (event.target == de_modal) {
					de_modal.style.display = "none";
				}
				else if (event.target == ev_modal) {
					ev_modal.style.display = "none";
				}
			}
		</script>

		<?php
		if (isset($_SESSION['a_error'])) {
			if ($_SESSION['a_error'] == 'e') {
				echo "<script type='text/javascript'>email_error();</script>";
			}
			else if ($_SESSION['a_error'] == 'p') {
				echo "<script type='text/javascript'>password_error();</script>";
			}
			else if ($_SESSION['a_error'] == 'f') {
				echo "<script type='text/javascript'>field_error();</script>";
			}
			else if ($_SESSION['a_error'] == 'i') {
				echo "<script type='text/javascript'>invalid_error();</script>";
			}
			else if ($_SESSION['a_error'] == 'd') {
				echo "<script type='text/javascript'>de_error();</script>";
			}
			else if ($_SESSION['a_error'] == 'ev') {
				echo "<script type='text/javascript'>ev_error();</script>";
			}
		}
		?>

	<div class="form">

		<!-- LOGIN FORM -->
		<a href="../index.php" id="x-button">X</a>
		<div class="line login-form"></div>
		<img id="logo" src="logo.png">
		<form class="login_form" action = "login/login.php" method = "post">
			<input type="text" name="email" placeholder="email address" class="input-email login-form">
			<input type="password" name="password" placeholder="password" class="input-password login-form">

			<input type="checkbox" name="checkbox" class="checkbox login-form">
			<span class="remember-text login-form">remember password</span>
			<input  class="login-button login-form" type="submit" name="login" value="login">
		</form>
		<p class="login-form text">New here? Click below to sign up!</p>
		<button onclick="swapToRegister()" class="login-form sign-up-button">Sign up</button>

		<!-- REGISTER FORM -->
		<form class="register_form" action="sign_up/signup.php" method = "post">
			<input  class="input-name register-form" id="forename"  type="text" name="forename" placeholder="Forename">
			<input  class="input-name register-form" id="surname"   type="text" name="surname" placeholder="Surname">
			<input class="input-email register-form" id="email"  type="text" name="email" placeholder="Email address">
			<input class="input-password register-form" id="password"  type="password" name="password" placeholder="password">
			<input class="input-password register-form" id="confirm-password" type="password" name="confirm-password" placeholder="confirm password">
			<input id ="register-button" class="register-form" type="submit" name="Register" value="Register">
		</form>
		<div class="line-2 register-form"></div>
		<button onclick="swapToLogin()" class="register-form login-button-2">Login here</button>
		<img src="noodles.gif" id="gif">
	</div>

</body>
</html>
