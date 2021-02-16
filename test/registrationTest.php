<?php

	include("loginFile.php");


function getInput(){
	$startForm = "<form action = '$_SERVER[PHP_SELF]' method = 'POST'>";
	$inputForename = "<input type ='text' name = 'firstname'>";
	$inputSurname = "<input type ='text' name = 'lastname'>";
	$inputPassword = "<input type = 'password' name = 'pw'>";
	$inputEmail = "<input type ='text' name = 'email'>";
	$submitAndEndForm = "<input type = 'submit' value='Register'></form>";

	echo("<h1>Register</h1>
		$startForm
		<table>
		<tr><td>Email</td><td>$inputEmail</td><tr>
		<tr><td>Forname</td><td>$inputForename</td><tr>
		<tr><td>Surname</td><td>$inputSurname</td><tr>
		<tr><td>Password</td><td>$inputPassword</td><tr>
		</table>
		$submitAndEndForm");
}

function processInput(){
	$fname = $_POST['firstname'];
	$sname = $_POST['lastname'];
	$pw = $_POST['pw'];
	$em = $_POST['email'];

	$pw = password_hash($pw, PASSWORD_BCRYPT);
	$sql = "INSERT INTO login (forename, surname, email, password) VALUES ('$fname','$sname','$em','$pw')";

	/*if($conn->query($sql))
		echo("User created successfully");
	else
		echo("Error: ". $conn->error);*/
}

if(!isset($_POST['firstname']))
	getInput();
else
	processInput();

$output = "<table border='2'>
              <th>User ID</th>
              <th>Forename</th>
              <th>Surname</th>
              <th>Email</th>
              <th>Password</th>";

  while ($row = $records->fetch_assoc()) {
    $output .= "<tr>
                  <td>$row[userId]</td>
                  <td>$row[forename]</td>
                  <td>$row[surname]</td>
                  <td>$row[email]</td>
                  <td>$row[password]</td>";
  }
  echo "<h1>Login table</h1>";
  echo $output;

?>