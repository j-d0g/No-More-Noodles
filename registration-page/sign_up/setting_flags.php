<?php

// If local:
  $servername = "localhost";
  $username = "root";
  $password = "root";

/* If on UoM
  $servername = "dbhost.cs.man.ac.uk";
  $username = "m67064lh";
  $password = "SQLDatabaseP";
*/

  // Create connection
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully" . "<br />";

  $conn->select_db("Y1");
  // if UoM $conn->select_db("2020_comp10120_y1");
  if (!$conn) {
    echo("Error: " . $conn->error . "<br />");
  }

  if(isset($_POST)) {
    $flag_int = 0;
    for ($i = 0; $i < 8; $i++) {
      $flag_name = "flag" . strval($i);
      if (isset($_POST[$flag_name])) {
        $flag_int += pow(10, $i);
      }
    }

    $sql = "INSERT INTO user (flag_list) VALUES ('$flag_int')";
    if ($conn->query($sql)) {
      echo "User added successfully" . "<br />";
      header("Location: ../../index.php");
      die();
    }
    else {
      echo "Error: " . $conn->error . "<br />";
    }

  }



?>
