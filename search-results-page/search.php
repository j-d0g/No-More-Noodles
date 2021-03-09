<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Search recipes</title>
  <link rel="stylesheet" type="text/css" href="search-results.css">
  <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
</head>
<body>
  <div class="form">
    <a href="#"><img id="logo" src="../index-page/logo.png"></a>
    <div class="line"></div>


    <?php
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $db = "Y1";

  $conn = mysqli_connect($servername, $username, $password, $db);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //echo "Connected successfully" . "<br />";

  // ---- NEEDS search POSTED FROM SEARCH BUTTON CODE-----

  $searchResults = array();

  //if the user is logged in
  if(isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    //select their flags using userID
    $sql = "SELECT flag_list FROM user WHERE userId = '$userID'";
    $userFlags = $conn->query($sql);
    $userFlags = $userFlags->fetch_assoc();
    $userFlags = $userFlags['flag_list'];
  }

  //take user input as posted value 'search', then splits that input string into an array of words
  //search should always have a value because the input field has attribute 'required'
  $search = $_POST['search'];
  $searchWords = explode(" ", $search);

  //to make this a good search function, we should probably exclude small words like 'and'
  //but we can implement that once we know the format of the recipe titles we will be using
  //just remove the meaningless words from $searchWords

  foreach ($searchWords as $word) {

    $word = mysqli_real_escape_string($conn, $word);
    //escapes special characters to prevent SQL injection

    //looks for recipes with the word inside of it at any point
    $sql = "SELECT recipeId, recipe_name, image, flags FROM recipes WHERE recipe_name LIKE '%".$word."%'";
    $matches = $conn->query($sql);

    //if the user is not logged in
    if(!isset($_SESSION['user_id'])) {
      //display all results regardless of flags
      while ($row = $matches->fetch_assoc()) {
        $recipeData = [$row['recipeId'], $row['recipe_name'], $row['image']];
        array_push($searchResults, $recipeData);
      }
    } else {
      //the user is logged in, so search results must match flags

      $userFlagList = str_split($userFlags);

      while ($row = $matches->fetch_assoc()) {

        $recipeFlagList = str_split($row['flags']);
        $matchesFlags = true;

        for ($i = 0; $i < 7; $i++) {
          if ($userFlagList[$i] == "1" and $recipeFlagList[$i] != "1") {
            //if the user's flag is 1, the recipe's flag MUST also be 1
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
    }
  }

  //$searchResults is now an array containing [recipeID, recipe_name, image] for each recipe that matches search criteria
  //displaying this as a table (outputs image, recipe_name and recipeID in three columns):

  //if we decide to take out the column headings just change this to "<table>"; and comment out the next 5 lines
  $output = "";
  //            <tr>
  //             <th>Recipe image</th>
  //              <th>Recipe name</th>
  //              <th>Recipe ID</th>
  //            </tr>";

  foreach ($searchResults as $x) {
    $output .= "  <a href='method.php?recipeId=$x[0]'><div class='inside-form'>
                   <img class='img' src = '../recipes-page/$x[2]'>
                   <h2>$x[1]</h2>
                  </div></a>";
  // <td>$x[0]</td> to display recipe ID
  }



  //outputting data in formatted html
  echo '<h1>Search results for ' . '“' . $search . '”' . '</h1>';
  echo $output;
?>


</div>
</body>
</html>

