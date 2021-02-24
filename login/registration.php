<!DOCTYPE html>
<html>
<head>
	<title>Login/Register account</title>
	<link rel="stylesheet" type="text/css" href="registration.css">
	<link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
	<script src="registration.js"></script>
</head>
<body>
	<div class="form" method = "POST">
		<!-- LOGIN FORM -->
		<a href="../index.html" id="x-button">X</a>
		<div class="line login-form"></div>
		<img id="logo" src="logo.png">

		<form class="login-form" action = "login.php" method = "post">
		<input type="text" name="email" placeholder="email address" class="input-email login-form">
		<input type="password" name="password" placeholder="password" class="input-password login-form">

		<input type="checkbox" name="checkbox" class="checkbox login-form">
		<span class="remember-text login-form">remember password</span>
		<input type="submit" name="Login" value="Login">
	</form>

		<p class="login-form text">If you are new make sure to sign up below!</p>
		<button onclick="swapToRegister()" class="login-form sign-up-button">Sign up</button>

		<!-- REGISTER FORM -->
		<form class="register-form" action="signup.php" method = "post">
		<input  class="input-name register-form"  type="text" name="forename" placeholder="Forename">
		<input  class="input-name register-form"  type="text" name="surname" placeholder="Surname">
		<input class="input-email register-form" type="text" name="email" placeholder="Email address">
		<input class="input-password register-form" type="password" name="password" placeholder="password">
		
		<!--<input class="register-form" type="password" name="confirm-password" placeholder="confirm password">-->
		<input type="submit" name="Register" value="Register">
	</form>

		<div class="line-2 register-form"></div>
		<button onclick="swapToLogin()" class="register-form login-button-2">Login here</button>
		<img src="noodles.gif" id="gif">
	</div>

</body>
</html>