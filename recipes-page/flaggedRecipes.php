<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Search recipes</title>
  <link rel="stylesheet" type="text/css" href="../search-results-page/search-results.css">
  <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
</head>

<body>

  <?php

  //include db connection
  include "../registration-page/connection.php";

  //get the required flag list from post
  $inputFlags = $_POST['flagsIn'];
  //convert to an array
  $inputFlagsList = str_split($inputFlags);

  //get all recipes in the database
  $sql = "SELECT recipeId, recipe_name, image, flags FROM recipes";
  $matches = $conn->query($sql);

  $searchResults = array();

  //iterate through each recipe
  while ($row = $matches->fetch_assoc()) {

    $recipeFlagList = str_split($row['flags']);
    $matchesFlags = true;

    for ($i = 0; $i < 7; $i++) {
      if ($inputFlagsList[$i] == "1" and $recipeFlagList[$i] != "1") {
        //if the input flag is 1, the recipe's flag MUST also be 1
        $matchesFlags = false;
      } else {
        //all other combinations of flags is okay
        continue;
      }
    }

    if ($matchesFlags) {
      $recipeData = [$row['recipeId'], $row['recipe_name'], $row['image']];
      array_push($searchResults, $recipeData);
    }
  }

  $output = "";
  foreach ($searchResults as $x) {
    $output .= "  <a href='../search-results-page/method.php?recipeId=$x[0]'><div class='inside-form'>
                   <img class='img' src = '../recipes-page/$x[2]'>
                   <h2>$x[1]</h2>
                  </div></a>";
  }

//output different heading depending on flags
  switch ($inputFlags) {
    case "1000000":
      echo "<h1>Dairy free recipes:</h1>";
      break;
    case "0100000":
      echo "<h1>Egg free recipes:</h1>";
      break;
    case "0010000":
      echo "<h1>Gluten free recipes:</h1>";
      break;
    case "0001000":
      echo "<h1>Halal recipes:</h1>";
      break;
    case "0000100":
      echo "<h1>Nut free recipes:</h1>";
      break;
    case "0000010":
      echo "<h1>Vegan recipes:</h1>";
      break;
    case "0000001":
      echo "<h1>Vegetarian recipes:</h1>";
      break;
    default:
    echo "<h1>Results:</h1>";
  }

  echo $output;

  ?>
</body>

</html>
