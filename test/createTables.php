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
  $username = "m37064lh";
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
            flag_list CHAR(7) NOT NULL
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
            protein SMALLINT NOT NULL,
            salt FLOAT NOT NULL,
            sugar SMALLINT NOT NULL,
            time SMALLINT NOT NULL,
            difficulty TINYINT,
            ingredients TEXT NOT NULL,
            method TEXT NOT NULL,
            flags CHAR(7) NOT NULL,
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
            VALUES ('Test: favourite_recipes', 'Test: owned_ingredients', '0000100')";
  if ($conn->query($sql)) {
    echo "User added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  // Ve V N H G E D

  //Inserting test1 recipe
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('test gluten free', 'db_images/test1.jpeg',
          100, 2, 30, 10, 0.2, 10, 30, 2, 'Test ingredients', 'Test method',
          '0000100', 4.1, 9.8)";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }

  //Inserting test2 recipe
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('test halal', 'db_images/test2.jpeg',
          30, 20, 3, 100, 0.2, 10, 30, 2, 'Test ingredients', 'Test method',
          '0001000', 4.1, 9.8)";
  if ($conn->query($sql)) {
    echo "Recipe added successfully" . "<br />";
  }
  else {
    echo "Error: " . $conn->error . "<br />";
  }
  //Inserting a test recipe: doughnuts
  $sql = "INSERT INTO recipes (recipe_name, image, calories, fat,
          carbs, protein, salt, sugar, time, difficulty, ingredients, method,
          flags, user_rating, popularity) VALUES ('Jam doughnuts', 'db_images/doughnut.webp',
          233, 9, 32, 5, 0.6, 13, 85, 3, '500g Strong white bread flour~ 60g Golden caster sugar~
                                          15g Fresh yeast~ 4 Medium eggs~ 0.5 Lemon~ 2tsp Sea salt
                                          125g Softened unsalted butter~ 2 litres Sunflower oil~
                                          Caster sugar - for tossing~ 300g Jam\' ', 'Put 150g water and all the dough ingredients, apart from the butter, into the bowl of a mixer with a beater paddle. Mix on a medium speed for 8 mins or until the dough starts coming away from the sides and forms a ball. Turn off the mixer and let the dough rest for 1 min.~
                                          Start the mixer up again on a medium speed and slowly add the butter to the dough – about 25g at a time. Once it\'s all incorporated, mix on high speed for 5 mins until the dough is glossy, smooth and very elastic when pulled.~
                                          Cover the bowl with cling film or a clean tea towel and leave to prove until it\'s doubled in size. Knock back the dough in the bowl briefly, then re-cover and put in the fridge to chill overnight.~
                                          The next day, take the dough out of the fridge and cut it into 50g pieces (you should get about 20).~
                                          Roll the dough pieces into smooth, tight buns and place them on a floured baking tray, leaving plenty of room between them, as you don’t want them to stick together while they prove.~
                                          Cover loosely with cling film and leave for 4 hrs or until doubled in size. Fill your deep-fat fryer or heavy-based saucepan halfway with oil. Heat the oil to 180C.~
                                          When the oil is heated, carefully slide the doughnuts from the tray using a floured pastry scraper. Taking care not to deflate them, put them into the oil. Do 2-3 per batch, depending on the size of your fryer or pan.~
                                          Fry for 2 mins each side until golden brown – they puff up and float, so you may need to gently push them down after about 1 min to help them colour evenly.~
                                          Remove the doughnuts from the fryer and place them on kitchen paper.~
                                          Toss the doughnuts in a bowl of caster sugar while still warm. Repeat the steps until all the doughnuts are fried, but keep checking the oil temperature is correct – if it\'s too high, they will burn and be raw in the middle; if it\'s too low, the oil will be absorbed into the doughnuts and they will become greasy. Set aside to cool before filling.~
                                          To fill the doughnuts, make a hole with a small knife in the crease of each one, anywhere around the white line between the fried top and bottom.~',
          '0011000', 4.1, 9.8)";
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
