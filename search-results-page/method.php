<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Method</title>
  <link rel="stylesheet" type="text/css" href="selected-result.css">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <style>
    hr {
      height: 1px;
      background-color: grey;
      border: none;
    }
  </style>
</head>

<body>
  <div class="header">
    <!-- NAVIGATION PANEL -->
    <img src="../index-page/black-img.jpg" id="black-img" class="opacify-animation">
    <img src="../index-page/logo.png" id="logo" class="opacify-animation">
    <a href="../index.php" id="Home" class="navigation opacify-animation">Home</a>
  </div>
  <script type="text/javascript">
    function owned(x) {
      document.getElementById(x).style.color = "rgb(150, 150, 150)";
    }

    function unowned(x) {
      document.getElementById(x).style.color = "rgb(255, 255, 255)";
    }
  </script>

  <?php
  error_reporting(0);
  require('fpdf181/fpdf.php');
  // If local:
  // $servername = "localhost";
  // $username = "root";
  // $password = "root";

  // If on UoM
  $servername = "dbhost.cs.man.ac.uk";
  $username = "m67064lh";
  $password = "SQLDatabaseP";

  $db = "2020_comp10120_y1";

  $conn = mysqli_connect($servername, $username, $password, $db);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //echo "Connected successfully" . "<br />";

  //has to be get so it works as a link
  //not necessarily a bad thing as each recipe page has a unique URL
  $recipeID = $_GET['recipeId'];

  //uses recipeID to fetch name, image, ingredients, nutritional info, time, difficulty, method
  //not fetched but could be: user rating, popularity, flags
  $sql = "SELECT recipe_name, image, ingredients, calories, fat, carbs, salt, sugar, time, difficulty, method
  FROM recipes WHERE recipeId = '$recipeID'";
  $records = $conn->query($sql);
  $records = $records->fetch_assoc();
  //--- DISPLAY RECIPE IMAGE ---
  echo "<img class='img' src = ../recipes-page/$records[image]>";

  echo "<div class='form'>";
  echo "<a href='#'><img id='logo' src='../index-page/logo.png'></a>";

  //--- DISPLAY RECIPE NAME ---
  echo ("<h1>$records[recipe_name]</h1>");
  $_SESSION['name'] = $records['recipe_name'];


  //--- DISPLAY NUTRITIONAL INFORMATION SECTION ---

  echo "<div class='nutritional-facts-container'>";
  echo "<h2>Nutritional information</h2>";
  $output =  "<table>
  	           <tr>
  	            <th>Calories</th>
  	            <th>Fat</th>
  	            <th>Carbohydrates</th>
  	            <th>Salt</th>
  	            <th>Sugar</th>
  	           </tr>
  	           <tr>
  	            <td>$records[calories]</td>
  	            <td>$records[fat]</td>
  	            <td>$records[carbs]</td>
  	            <td>$records[salt]</td>
  	            <td>$records[sugar]</td>
  	           </tr>
  	          </table>";

  echo $output;

  //display time (inside nutritional info container)
  echo "<p>Time: $records[time]</p>";

  switch ($records["difficulty"]) {
    case 1:
      echo "<p>Difficulty rating: Easy</p>";
      break;
    case 2:
      echo "<p>Difficulty rating: More effort</p>";
      break;
    case 3:
      echo "<p>Difficulty rating: Skilled</p>";
      break;
  }


  echo "<form action='create_shopping_pdf.php' class='button1' method = 'post'>";
  echo "<input type = 'submit' value = ' Get shopping list'>  ";
  echo "</form>";
  echo "<form action='create_method_pdf.php' class='button2' method = 'post'>";
  echo "<input type = 'submit' value = ' Get method'>  ";
  echo "</form>";
  //display difficulty (inside nutritional info container)
  echo "</div>"; //close nutritional info container

  //--- DISPLAY INGREDIENTS SECTION ---
  echo "<div class='ingredients-container'>";
  echo "<h2>Ingredients</h2>";

  //split $records[ingredients] by the regex /~/
  $ingArray = preg_split("/~/", $records['ingredients']);
  $_SESSION['ingredients'] = $ingArray;
  $i = 0;
  echo "<ul>";
  foreach ($ingArray as $ing) {
    echo "<li id=ig" . $i . ">" . str_replace("+", " ", $ing) . "</li>";
    $i++;
  }
  echo "</ul>";
  echo "</div>";

  //--- DISPLAY METHOD SECTION ---
  //(much the same as ingredients)
  echo "<div class='steps-container'>";
  echo "<h2>Method</h2>";

  //split $records[method] by the regex /~/
  $metArray = preg_split("/~/", $records['method']);
  $_SESSION['method'] = $metArray;
  echo "<ol class='meth'>";
  foreach ($metArray as $met) {
    echo "<li>$met<hr></li>";
  }
  echo "</ol>";
  echo "</div>";


  if (isset($_SESSION['user_id'])) {
    // Selects owned ingredient
    $sql = "SELECT owned_ingredients FROM user WHERE userId=" . $_SESSION['user_id'];
    if ($conn->query($sql)) {
      $records = $conn->query($sql);
      while ($row = $records->fetch_assoc()) {
        $current_ingredients = $row['owned_ingredients'];
      }
    } else {
      echo "Error: " . $conn->error . "<br />";
    }
    // Uses Luke's code from search-results
    $current_ingredientsArray = preg_split("/~/", $current_ingredients);
    $counter = 0;
    $owned_ingredients = array();
    $unowned_ingredients = array();
    $indexes = array();

    foreach ($ingArray as $ing) {
      $match = 0;
      foreach ($current_ingredientsArray as $ingredient) {
        $ingredient = trim($ingredient);
        $processed_string = trim(strtolower($ing));
        $temp = preg_split("/\+/", $processed_string);
        $processed_string = $temp[1];
        if ($ingredient == $processed_string) {
          $match = 1;
        }
      }
      if ($match == 1) {
        array_push($owned_ingredients, str_replace("+", " ", $ing));
        array_push($indexes, $counter);
      } else {
        array_push($unowned_ingredients, str_replace("+", " ", $ing));
      }
      $counter++;
    }

    $_SESSION['unowned_ingredients'] = $unowned_ingredients;
    $_SESSION['owned_ingredients'] = $owned_ingredients;

    for ($x = 0; $x < count($ingArray); $x++) {
      $owned = 0;
      foreach ($indexes as $index) {
        if ($x == $index) {
          $owned = 1;
        }
      }
      if ($owned == 1) {
        echo "<script type='text/javascript'>owned('ig" . $x . "');</script>";
      } else {
        echo "<script type='text/javascript'>unowned('ig" . $x . "');</script>";
      }
      $owned = 0;
    }
  }

  ?>
  </div>
</body>

</html>