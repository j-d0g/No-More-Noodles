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
			//if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
     		//echo "Email not valid!";
     		//die();

			//}

			$query = "SELECT email FROM login WHERE email = '$em'";

			if(!empty($s_name)&& !empty($f_name) && !is_numeric($em) && !empty($pw) && ($pw == $cpw) && filter_var($em, FILTER_VALIDATE_EMAIL))
			{
				//save to db

				$pw = password_hash($pw, PASSWORD_BCRYPT);
				$query = "SELECT email from login where email='$em'";
				$records = $conn->query($query);
				$result = "";
				while ($row = $records->fetch_assoc()) {
					$result = $row['email'];
				}
				if ($result == "") {
						$query = "INSERT INTO login (surname, forename, email, password) VALUES ('$s_name','$f_name','$em','$pw')";
				}
				else {
					$_SESSION['a_error'] = 'e';
					header("Location: ../registration.php");
					die();
				}
				if(!mysqli_query($conn,$query))
				{
					echo "Error: "  . "<br>" . mysqli_error($conn);
				}
				else{
					$sql = "SELECT userId FROM login WHERE email='$em'";
					$records = $conn->query($sql);
					while ($row = $records->fetch_assoc()) {
				    $_SESSION['user_id'] = $row['userId'];
						unset($_SESSION['a_error']);
				  }
					header("Location: registration-settings.php");
					die();
				}
			}
			else
			{
				if ($pw != $cpw) {
					$_SESSION['a_error'] = 'p';
				}
				else if (!filter_var($em, FILTER_VALIDATE_EMAIL)){
					$_SESSION['a_error'] = 'ev';
				}
				else {
					$_SESSION['a_error'] = 'f';
				}
				header("Location: ../registration.php");
				die();
			}
		}
		header("Location: ../registration.php");
		die();
?>
