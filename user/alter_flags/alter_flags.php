<?php

  session_start();
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

  // Obtains the value of each checkbox
  if(isset($_POST)) {
    $flag_str = "";
    for ($i = 0; $i < 7; $i++) {
      $flag_name = "flag" . strval($i);
      if (isset($_POST[$flag_name])) {
        $flag_str .= '1';
      }
      else {
        $flag_str .= '0';
      }
    }

    // Updates cell in table
    $sql = "UPDATE user SET flag_list='$flag_str' WHERE userId=". $_SESSION['user_id'];
    if ($conn->query($sql)) {
      header("Location: ../../index.php");
      die();
    }
    else {
      echo "Error: " . $conn->error . "<br />";
    }

  }
