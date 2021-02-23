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

  if(isset($_POST['user_id'])) {
    echo $_POST['user_id'];

    $sql = "SELECT flag_list FROM user WHERE userId=" . $_POST['user_id'];
    $records = $conn->query($sql);

    while ($row = $records->fetch_assoc()) {
      $flags = $row["flag_list"];
    }

    $output = "<table border='2'>
                <th>Flag 7</th>
                <th>Flag 6</th>
                <th>Flag 5</th>
                <th>Flag 4</th>
                <th>Flag 3</th>
                <th>Flag 2</th>
                <th>Flag 1</th>
                <th>Flag 0</th>";

    $output .= "<tr>";
    for ($i = 7; $i >= 0; $i--) {
      if (intdiv($flags, pow(10, $i)) == 1) {
        $flags = $flags % pow(10, $i);
        $output .= "<td>1</td>";
      }
      else {
        $output .= "<td>0</td>";
      }
    }

    echo "<h1>User " . $_POST['user_id'] . " flags</h1>";
    echo $output;


    $sql = "SELECT * FROM user";
    $records = $conn->query($sql);

    $output = "<table border='2'>
                <th>User ID</th>
                <th>Favourite recipes</th>
                <th>Owned ingredients</th>
                <th>Flag list</th>";

    while ($row = $records->fetch_assoc()) {
      $output .= "<tr>
                    <td>$row[userId]</td>
                    <td>$row[favourite_recipes]</td>
                    <td>$row[owned_ingredients]</td>
                    <td>$row[flag_list]</td>";
    }
    echo "<h1>User table</h1>";
    echo $output;

  }

?>
