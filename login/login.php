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
							header("Location: index.php");
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
<!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 </head>
 <body>
 
 	<style type="text/css">
 		#text{
 			height: 25px;
 			border-radius: 5px;
 			padding: 4px;
 			border solid thin #aaa;
 		}

 		#button{
 			padding : 10px;
 			width: 100px;
 			color: white;
 			background-color: lightblue;
 			border: none;
 		}
 		#box{
 			background-color: grey;
 			margin: auto;
 			width: 300px;
 			padding: 20px;
 		}

 	</style>

 	<div id="box">
 		<form method = "post">
 			<div >Login</div><br><br>
 			Email<input  type="text" name="email"><br><br>
 			Password<input type="password" name="password"><br><br>
 			<input type="submit" name="Login"><br><br>
 			<a href="signup.php">Signup</a>
 		</form>
 	</div>
 </body>
 </html>