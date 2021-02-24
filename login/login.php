<?php 
session_start();

	include("connection.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
		{//Something was posted
			
			$em = $_POST['email'];
			$pw = $_POST['password'];
			
			if(!is_numeric($em) && !empty($pw))
			{
				//read from db
				
				$query = "SELECT * FROM login WHERE email = '$em' limit 1";	
				$result = mysqli_query($conn,$query);

				if($result)
				{
					if($result && mysqli_num_rows($result) > 0)
					{
						$user_data = mysqli_fetch_assoc($result);

						if($user_data['password'] == $pw)
						{
							$_SESSION['user_id'] = $user_data['userId'];
							header("Location: /GitRepos/first_group_project/website/index-page/index.php");
							die;
						}
					}
				}

				echo "wrong username or password!";
			}
			else
			{
				echo "Enter valid information";
			}
		}

?>
