<!DOCTYPE html>
<html>
<head>
	<title>Login/Register account</title>
	<link rel="stylesheet" type="text/css" href="registration.css">
	<link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
	<script src="registration.js"></script>
</head>
<body>
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
		<p class="login-form text">If you are new make sure to sign up below!</p>
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
