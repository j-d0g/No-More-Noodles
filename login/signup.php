<?php 
session_start();

	include("connection.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
		{//Something was posted
			$s_name = $_POST['surename'];
			$f_name = $_POST['forename'];
			$em = $_POST['email'];
			$pw = $_POST['password'];
			
			if(!empty($s_name)&& !empty($f_name) && !is_numeric($em) && !empty($pw))
			{
				//save to db
				
				$query = "INSERT INTO login (surename, forename, email, password) VALUES ('$s_name','$f_name','$em','$pw')";
				mysqli_query($conn,$query);

				header("Location: login.php");
				die;
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
 	<title>Signup</title>
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
 			<div >Signup</div><br><br>
 			<input  type="text" name="forename"><br><br>
 			<input  type="text" name="surname"><br><br>
 			<input  type="text" name="email"><br><br>
 			<input type="password" name="password"><br><br>
 			<input type="submit" name="Signup"><br><br>
 			<a href="login.php">Login</a>
 		</form>
 	</div>
 </body>
 </html>