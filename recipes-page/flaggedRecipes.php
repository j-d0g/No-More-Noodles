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
    $output .= "  <a href='method.php?recipeId=$x[0]'><div class='inside-form'>
                   <img class='img' src = '../recipes-page/$x[2]'>
                   <h2>$x[1]</h2>
                  </div></a>";
}

echo "<h1>Results:</h1>";
echo $output;

?>
</body>
</html>