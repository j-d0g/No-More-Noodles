<?php

	session_start();
	include("../connection.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
		{//Something was posted
			$s_name = $_POST['surname'];
			$f_name = $_POST['forename'];
			$em = $_POST['email'];
			$pw = $_POST['password'];
			$cpw = $_POST['confirm-password'];

			// Hello

			$query = "SELECT email FROM login WHERE email = '$em'";

			if(!empty($s_name)&& !empty($f_name) && !is_numeric($em) && !empty($pw) && ($pw == $cpw))
			{
				//save to db

				$pw = password_hash($pw, PASSWORD_BCRYPT);
				$query = "INSERT INTO login (surname, forename, email, password) VALUES ('$s_name','$f_name','$em','$pw')";

				if(!mysqli_query($conn,$query))
				{
					echo "Error: "  . "<br>" . mysqli_error($conn);
				}
				else{
					$sql = "SELECT userId FROM login WHERE email='$em'";
					$records = $conn->query($sql);
					while ($row = $records->fetch_assoc()) {
				    $_SESSION['user_id'] = $row['userId'];
				  }
					header("Location: registration-settings.php");
					die();
				}
			}
			else
			{
				header("Location: ../registration.php");
				die();
			}
		}
		header("Location: ../registration.php");
		die();
?>
