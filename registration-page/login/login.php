<?php

	session_start();
	include("../connection.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
		{//Something was posted

			$em = $_POST['email'];
			$pw = $_POST['password'];

			if(!is_numeric($em) && !empty($pw))
			{
				//read from db

				$query = "SELECT * FROM login WHERE email = '$em'";
				$result = mysqli_query($conn,$query);

				if($result)
				{
					if($result && mysqli_num_rows($result) > 0)
					{
						$user_data = mysqli_fetch_assoc($result);

						if(password_verify($pw, $user_data['password']))
						{
							unset($_SESSION['a_error']);
							$_SESSION['user_id'] = $user_data['userId'];
							header("Location: ../../index.php");
							die();
						}
					}
				}
				$_SESSION['a_error'] = 'd';
				header("Location: ../registration.php");
				die();
			}
			else
			{
				$_SESSION['a_error'] = 'i';
				header("Location: ../registration.php");
				die();
			}
		}


?>
