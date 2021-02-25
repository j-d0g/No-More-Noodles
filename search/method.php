<?php

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $db = "Y1";

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

  //we can change all of these echo statements when we decide on a page layout

  //display recipe name
  echo ("<b>$records[recipe_name]</b><br>");

  //display recipe image
  echo "<img src = $records[image]>";

  //display ingredients
  echo "<p>$records[ingredients]</p>";

  //display nutritional info as table
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
  	            <td>$records[sugar]r</td>
  	           </tr>
  	          </table>";

  echo $output;

  //display time
  echo "<p>$records[time]</p>";

  //display difficulty
  echo "<p>$records[difficulty]</p>";

  //display method
  echo "<p>$records[method]</p>";

?>