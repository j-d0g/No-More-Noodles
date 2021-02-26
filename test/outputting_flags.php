<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="tables.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>

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
    echo "User id: ". $_POST['user_id'] . "<br>";

    $sql = "SELECT flag_list FROM user WHERE userId=" . $_POST['user_id'];
    $records = $conn->query($sql);

    while ($row = $records->fetch_assoc()) {
      $flags = $row["flag_list"];
    }

    $flags_array = str_split($flags);
    $flag_names = array(
                    0 => "Dairy free",
                    1 => "Egg allergy",
                    2 => "Gluten free",
                    3 => "Halal",
                    4 => "Nut allergy",
                    5 => "Vegan",
                    6 => "Vegatarian"
    );

    $output = "<table border='2'>
                <th>Flags</th>
                <th>Value</th>";

    $output .= "<tr>";
    for ($i = 0; $i <= 6; $i++) {
      if ($flags_array[$i] == '0') {
        $output .= "<td>" . $flag_names[$i] . "</td>";
        $output .= "<td>False</td>";
      }
      else {
        $output .= "<td>" . $flag_names[$i] . "</td>";
        $output .= "<td>True</td>";
      }
      $output .= "<tr>";
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
