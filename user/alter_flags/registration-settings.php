<!DOCTYPE html>
<html>
<head>


	<title>Account settings</title>
	<link rel="stylesheet" type="text/css" href="registration-settings.css">
	<link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
	<?php session_start(); ?>
</head>
<body>
	<div class="form">
		<h1>Account settings</h1>
		<div class='flag_checklist'>
			<form method='post' action='alter_flags.php'>
				<span>Select your new flags</span><br>
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

	<div class="current_flags">
		<?php
		// If local:
		  $servername = "localhost";
		  $username = "root";
		  $password = "root";

		/* If on UoM
		  $servername = "dbhost.cs.man.ac.uk";
		  $username = "m67064lh";
		  $password = "SQLDatabaseP";
		*/

		  // Create connection
		  $conn = mysqli_connect($servername, $username, $password);

		  // Check connection
		  if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		  }

		  $conn->select_db("Y1");
		  // if UoM $conn->select_db("2020_comp10120_y1");
		  if (!$conn) {
		    echo("Error: " . $conn->error . "<br />");
		  }


	    $sql = "SELECT flag_list FROM user WHERE userId=" . $_SESSION['user_id'];
	    $records = $conn->query($sql);

	    while ($row = $records->fetch_assoc()) {
	      $flags = $row["flag_list"];
	    }

	    $flags_array = str_split($flags);
	    $flag_names = array(
	                    0 => "Dairy free",
	                    1 => "Egg allergy",
	                    2 => "Gluten free",
	                    3 => "Halal",
	                    4 => "Nut allergy",
	                    5 => "Vegan",
	                    6 => "Vegatarian"
	    );

	    $output = "<table border='2'>
	                <th>Flags</th>
	                <th>Value</th>";

	    $output .= "<tr>";
	    for ($i = 0; $i <= 6; $i++) {
	      if ($flags_array[$i] == '0') {
	        $output .= "<td>" . $flag_names[$i] . "</td>";
	        $output .= "<td>False</td>";
	      }
	      else {
	        $output .= "<td>" . $flag_names[$i] . "</td>";
	        $output .= "<td>True</td>";
	      }
	      $output .= "<tr>";
	    }
			echo "<h2>Current flags</h2>";
	    echo $output;

		?>
	</div>

</body>
</html>
