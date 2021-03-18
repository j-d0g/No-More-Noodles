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
        <a href='search-results-page/method.php?recipeid=1'>
            <img src="recipes-page/db_images/1.jpg" class="img" id="img1">
        </a>

        <!-- Link homepage image 2 to recipe index 2 -->
        <a href='search-results-page/method.php?recipeid=2'>
            <img src="recipes-page/db_images/2.jpg" class="img" id = "img2">
        </a>
	</div>

	<!-- THE SIDEPANEL -->

	<div class="sidepanel-bg">
		<p class= "nomore-text sidepanel" id="no-more" style="cursor: default;">NO MORE &nbsp;
			<span>n</span>
			<span>o</span>
			<span>o</span>
			<span>d</span>
			<span>l</span>
			<span>e</span>
			<span>s</span>
			<span>!</span>
		</p>
		<p id="intro-text" class="sidepanel">Explore Easy and fast cooking recipes that are delicate<br>and exquisite. Search recipes, ingredients, and <br>cuisines below:<br><br>
		<!-- <div class="searchbar"> -->
			<form class="form" method = "POST" action="search-results-page/search.php">
		    	<input class="searchbar" type="text" placeholder="Search recipes..." name="search" required>
		    	<button type="submit"><i class="fa fa-search"></i></button>
		    </form>
		<!-- </div> -->
		</p>
	</div>


 	<!-- NAVIGATION PANEL -->
	<img src="index-page/black-img.jpg" id="black-img" class="opacify-animation">
	<img src="index-page/logo.png" id="logo" class="opacify-animation">
	<a href="index.php" id="Home" class="navigation opacify-animation">Home</a>
	<a href="recipes-page/recipes.html" class="navigation opacify-animation" id="dropdown">Recipes</a>
	<a onclick="openForm()" class="navigation opacify-animation">Faq</a>
	<a href="registration-page/registration.php" class="navigation opacify-animation" style="visibility: visible;" id="login_button">Login/Register</a>
	<a href="registration-page/login/logout.php" class="navigation opacify-animation" style="visibility: hidden" id="logout_button">Logout</a>
	<a href="user/show_settings.php" class="navigation opacify-animation" style="visibility: hidden;" id="settings_button">Settings</a>


	<!-- SUGGESTED RECIPES HEADER -->

	<!-- FAQ -->
	<div id="FAQ" class="FAQ">
		<div>

		</div>
		<div>
			<a onclick="closeForm()" id="x-button">X</a>
		</div>
		<br>
		<p class="question">1. bla bla bla bla?</p>
		<p class="answer">bla bla bla bla?</p>
		<p class="question">2.bla bla bla bla? bla bla bla bla?</p>
		<p class="answer">bla bla bla bla?</p>
		<p class="question">3. bla bla bla bla? bla bla bla bla?</p>
		<p class="answer">bla bla bla bla?</p>
		<p class="question">4. bla bla bla bla? bla bla bla bla? bla bla bla bla? bla bla bla bla? bla bla bla bla?</p>
		<p class="answer">bla bla bla bla?</p>



<!-- Calls a js function to change visibility if user is logged in -->

		<?php
			if (isset($_SESSION['user_id'])) {
				$logged_in = True;
				echo "<script type='text/javascript'>logged_in();</script>";
			}
			else {
			}
		?>

</body>
</html>
