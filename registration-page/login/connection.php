<?php

//local 
// $servername = "localhost";
// $username = "root";
// $password = "root";
// If on UoM
$servername = "dbhost.cs.man.ac.uk";
$username = "m67064lh";
$password = "SQLDatabaseP";

if (!$conn = mysqli_connect($servername, $username, $password)) {
	die("failed to connect!");
}
$conn->select_db("2020_comp10120_y1");
if (!$conn) {
	echo ("Error: " . $conn->error . "<br />");
}
