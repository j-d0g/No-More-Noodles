<?php

// If local:
// $servername = "localhost";
// $username = "root";
// $password = "root";

// If on UoM
$servername = "dbhost.cs.man.ac.uk";
$username = "m37064lh";
$password = "SQLDatabaseP";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully" . "<br />";

$conn->select_db("2020_comp10120_y1");
// if UoM $conn->select_db("2020_comp10120_y1");
if (!$conn) {
  echo ("Error: " . $conn->error . "<br />");
}

if (isset($_POST)) {
  $flag_str = "";
  for ($i = 0; $i < 7; $i++) {
    $flag_name = "flag" . strval($i);
    if (isset($_POST[$flag_name])) {
      $flag_str .= '1';
    } else {
      $flag_str .= '0';
    }
  }

  $sql = "INSERT INTO user (flag_list) VALUES ('$flag_str')";
  if ($conn->query($sql)) {
    echo "User added successfully" . "<br />";
    header("Location: ../../index.php");
    die();
  } else {
    echo "Error: " . $conn->error . "<br />";
  }
}
