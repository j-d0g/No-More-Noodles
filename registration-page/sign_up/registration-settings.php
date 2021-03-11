<!DOCTYPE html>
<html>
<head>


	<title>Account settings</title>
	<link rel="stylesheet" type="text/css" href="registration-settings.css">
	<link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">

</head>
<body>
	<div class="form">
		<h1>Account settings</h1>
		<div class='flag_checklist'>
			<form method='post' action='setting_flags.php'>
				<span>Select your flags</span><br>
				<input type='checkbox' name='flag0' value='flag0'>Dairy free<br>
				<input type='checkbox' name='flag1' value='flag1'>Egg allergy<br>
				<input type='checkbox' name='flag2' value='flag2'>Gluten free<br>
				<input type='checkbox' name='flag3' value='flag3'>Halal<br>
				<input type='checkbox' name='flag4' value='flag4'>Nut allergy<br>
				<input type='checkbox' name='flag5' value='flag5'>Vegan<br>
				<input type='checkbox' name='flag6' value='flag6'>Vegatarian<br>
				<input type='submit' value='Submit' name='submit'>
			</form>
		</div>
		<input  class="save-button" type="submit" name="login" value="Save and exit">
		<hr id="divider1">
	</div>

</body>
</html>
