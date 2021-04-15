<!DOCTYPE html>
<html>

<head>


	<title>Account settings</title>
	<link rel="stylesheet" type="text/css" href="registration-settings.css">
	<link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">

</head>

<body>

	<!-- NAVIGATION PANEL -->
	<img src="../../index-page/black-img.jpg" id="black-img" class="opacify-animation">
	<img src="../../index-page/logo.png" id="logo" class="opacify-animation">
	<a href="../../index.php" id="Home" class="navigation opacify-animation">Home</a>

	<div class="php">
		<!-- <img src="reg-background.jpg" id="bg"> -->
		<div class="form">
			<a href=""><img src="../../index-page/logo.png"></a>
			<form method='post' action="alter_flags.php" id="divider2">
				<h2 id="allergies-header">Allergies</h2>
				<input class="allergies-checkbox" type="checkbox" name="flag0">
				<label class="allergies-checkbox" for="flag0">Dairy free</label><br>
				<input class="allergies-checkbox" type="checkbox" name="flag1">
				<label class="allergies-checkbox" for="flag1">Eggs allergy</label><br>
				<input class="allergies-checkbox" type="checkbox" name="flag2">
				<label class="allergies-checkbox" for="flag2">Gluten free</label><br>
				<input class="allergies-checkbox" type="checkbox" name="flag4">
				<label class="allergies-checkbox" for="flag4">Nuts allergy</label><br>

				<h2 id="cuisines-header">Dietary requirements</h2>
				<input class="cuisines-checkbox" type="checkbox" name="flag3">
				<label class="cuisines-checkbox" for="flag3">Halal</label><br>
				<input class="cuisines-checkbox" type="checkbox" name="flag5">
				<label class="cuisines-checkbox" for="flag5">Vegan</label><br>
				<input class="cuisines-checkbox" type="checkbox" name="flag6">
				<label class="cuisines-checkbox" for="flag6">Vegetarian</label><br>
				<input class="save-button" type="submit" name="login" value="Save and exit">

			</form>
		</div>
	</div>
</body>

</html>