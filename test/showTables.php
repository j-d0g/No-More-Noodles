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
// $servername = "localhost";
// $username = "root";
// $password = "root";

// If on UoM
$servername = "dbhost.cs.man.ac.uk";
$username = "m67064lh";
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

$sql = "SELECT * FROM login";
$records = $conn->query($sql);

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


$sql = "SELECT * FROM recipes";
$records = $conn->query($sql);
$output = "<table border='2'>
              <th>Recipe ID</th>
              <th>Recipe name</th>
              <th>Image</th>
              <th>Calories</th>
              <th>Fat</th>
              <th>Carbs</th>
              <th>Protein</th>
              <th>Salt</th>
              <th>Sugar</th>
              <th>Time</th>
              <th>Difficulty</th>
              <th>Ingredients</th>
              <th>Method</th>
              <th>Flags</th>
              <th>User rating</th>
              <th>Popularity</th>";

while ($row = $records->fetch_assoc()) {
  $output .= "<tr>
                  <td>$row[recipeId]</td>
                  <td>$row[recipe_name]</td>
                  <td>$row[image]</td>
                  <td>$row[calories]</td>
                  <td>$row[fat]</td>
                  <td>$row[carbs]</td>
                  <td>$row[protein]</td>
                  <td>$row[salt]</td>
                  <td>$row[sugar]</td>
                  <td>$row[time]</td>
                  <td>$row[difficulty]</td>
                  <td>$row[ingredients]</td>
                  <td>$row[method]</td>
                  <td>$row[flags]</td>
                  <td>$row[user_rating]</td>
                  <td>$row[popularity]</td>";
}
echo "<h1>Recipe table</h1>";
echo $output;
?>