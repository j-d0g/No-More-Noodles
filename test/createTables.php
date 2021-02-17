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

// -- Only on local
  $sql = "DROP DATABASE Y1";
  if ($conn->query($sql)) {
    echo "DATABASE reset" . "<br />";
  }
  else {
    echo("Error: " . $conn->error . "<br />");
  }

  // Creates the db
  $sql = "CREATE DATABASE Y1";

  if ($conn->query($sql)) {
    echo("Database created successfully" . "<br />");
  }
  else {
    echo("Error: " . $conn->error . "<br />");
  }
//

  $conn->select_db("Y1");
  // if UoM $conn->select_db("2020_comp10120_y1");
  if (!$conn) {
    echo("Error: " . $conn->error . "<br />");
  }

  // Creates login table
  $sql = "
          CREATE TABLE login (
            userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            forename VARCHAR(30) NOT NULL,
            surname VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(256) NOT NULL
            )
  ";

  if ($conn->query($sql)) {
    echo "Login table created successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Creates user table
  $sql = "
          CREATE TABLE user (
            userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY REFERENCES login(userId),
            favourite_recipes TEXT,
            owned_ingredients TEXT,
            flag_list INT NOT NULL
            )
  ";

  if ($conn->query($sql)) {
    echo "User table created successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Creates recipe table
  $sql = "
          CREATE TABLE recipes (
            recipeId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            recipe_name VARCHAR(60) NOT NULL,
            image VARCHAR(200) NOT NULL,
            calories SMALLINT NOT NULL,
            fat SMALLINT NOT NULL,
            carbs SMALLINT NOT NULL,
            salt FLOAT NOT NULL,
            sugar SMALLINT NOT NULL,
            time SMALLINT NOT NULL,
            difficulty TINYINT,
            ingredients TEXT NOT NULL,
            method TEXT NOT NULL,
            flags INT NOT NULL,
            user_rating FLOAT,
            popularity FLOAT
            )
  ";

  if ($conn->query($sql)) {
    echo "Recipe table created successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Inserting a test user
  $password = password_hash('test', PASSWORD_BCRYPT);
  $sql = "INSERT INTO login (forename, surname, email, password)
            VALUES ('Lawrence', 'Hunter', 'lh@lh.com', '$password')";
  if ($conn->query($sql)) {
    echo "Login added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Inserting a test user
  $sql = "INSERT INTO user (favourite_recipes, owned_ingredients, flag_list)
            VALUES ('Test: favourite_recipes', 'Test: owned_ingredients', 100)";
  if ($conn->query($sql)) {
    echo "User added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }


  //Inserting a test recipe
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('test name', 'test path',
          100, 2, 30, 0.2, 10, 30, 2, 'Test ingredients', 'Test method',
          100, 4.1, 9.8)";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
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
