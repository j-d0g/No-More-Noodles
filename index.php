<!DOCTYPE html>
<html>

<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="index-page/styles.css">
	<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
	<script src="index-page/index.js"></script>
	<title>No more noodles</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php session_start();
	unset($_SESSION['a_error']);
	?>
</head>

<body id="body">

	<!-- RECIPE IMAGES -->
	<div>
		<!-- Links homepage image 1 to recipe index 1 -->
		<a href='search-results-page/method.php?recipeId=1' id="img1">
			<img src="recipes-page/db_images/1.jpg" class="img" id="img1">
		</a>

		<!-- Link homepage image 2 to recipe index 2 -->
		<a href='search-results-page/method.php?recipeId=2' id="img2">
			<img src="recipes-page/db_images/2.jpg" class="img" id="img2">
		</a>
	</div>

	<!-- THE SIDEPANEL -->

	<div class="sidepanel-bg">
		<p class="nomore-text sidepanel" id="no-more" style="cursor: default;">NO MORE &nbsp;
			<span>n</span>
			<span>o</span>
			<span>o</span>
			<span>d</span>
			<span>l</span>
			<span>e</span>
			<span>s</span>
			<span>!</span>
		</p>
		<p id="intro-text" class="sidepanel">Explore easy and fast cooking recipes that are delicate and exquisite. Search recipes, ingredients, and cuisines below:<br><br>
			<!-- <div class="searchbar"> -->
		<form class="form" method="POST" action="search-results-page/search.php">
			<input class="searchbar" type="text" placeholder="Search recipes..." name="search" required>
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>
		<!-- </div> -->
		</p>
	</div>


	<!-- NAVIGATION PANEL -->
	<img src="index-page/black-img.jpg" id="black-img" class="opacify-animation">
	<img src="index-page/logo.png" id="logo" class="opacify-animation">
	<a href="registration-page/login/logout.php" class="navigation opacify-animation" style="display: none" id="logout_button">Logout</a>
	<a href="user/set_ingredients/setting_ingredients.php" class="navigation opacify-animation" style="display: none;" id="settings_button1">Ingredients</a>
	<a href="user/alter_flags/registration-settings.php" class="navigation opacify-animation" style="display: none;" id="settings_button2">Flags</a>

	<a href="registration-page/registration.php" class="navigation opacify-animation" style="display: inline-block;" id="login_button">Login/Register</a>
	<a onclick="openForm()" class="navigation opacify-animation">Faq</a>
	<a href="recipes-page/recipes.html" class="navigation opacify-animation" id="dropdown">Recipes</a>
	<a href="index.php" id="Home" class="navigation opacify-animation">Home</a>





	<!-- SUGGESTED RECIPES HEADER -->

	<!-- FAQ -->
	<div id="FAQ" class="FAQ">
		<div>

		</div>
		<div>
			<a onclick="closeForm()" id="x-button">X</a>
		</div>
		<br>
		<p class="question">1. Do I have to register/sign up in order to use your website?</p>
		<p class="answer">Nope, just extra features if you do!</p>
		<p class="question">2. I have a dietary requirement, how do I find recipes that are suitable?</p>
		<p class="answer">You can select and save filters by signing up with us and logging into your account.</p>
		<p class="question">3. How do I edit my filters?</p>
		<p class="answer">Hover over settings and a dropdown will appear.</p>



		<!-- Calls a js function to change visibility if user is logged in -->

		<?php
		if (isset($_SESSION['user_id'])) {
			$logged_in = True;
			echo "<script type='text/javascript'>logged_in();</script>";
		} else {
		}
		?>

</body>

</html>