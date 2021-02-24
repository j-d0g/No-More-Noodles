<?php 
session_start();

	include("connection.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
		{//Something was posted
			$s_name = $_POST['surname'];
			$f_name = $_POST['forename'];
			$em = $_POST['email'];
			$pw = $_POST['password'];
			
			$query = "SELECT email FROM login WHERE email = '$em'";

			if(!empty($s_name)&& !empty($f_name) && !is_numeric($em) && !empty($pw))
			{
				//save to db
				
				$query = "INSERT INTO login (surname, forename, email, password) VALUES ('$s_name','$f_name','$em','$pw')";


				if(!mysqli_query($conn,$query))
				{
					echo "Error: "  . "<br>" . mysqli_error($conn);
				}
				else{
				header("Location: registration.php");
				die;
			}
			}
			else
			{
				echo "Enter valid information";
			}
		}

?>
