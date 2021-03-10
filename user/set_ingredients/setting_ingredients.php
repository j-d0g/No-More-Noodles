<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Change ingredients</title>
    <?php
      session_start();
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

      $conn->select_db("Y1");
      // if UoM $conn->select_db("2020_comp10120_y1");
      if (!$conn) {
        echo("Error: " . $conn->error . "<br />");
      }
      $_SESSION['conn'] = $conn;

      if (isset($_POST['ingredient'])) {
        update_ingredients();
      }

      if (isset($_POST['ingredient_r'])) {
        echo "Got ingredient " . $_POST['ingredient_r'];
        remove_ingredients();
      }

    ?>

    <?php
      function update_ingredients() {
        $sql = "SELECT owned_ingredients FROM user WHERE userId=". $_SESSION['user_id'];
        if ($_SESSION['conn']->query($sql)) {
          $records = $_SESSION['conn']->query($sql);
          while ($row = $records->fetch_assoc()) {
            $current_ingredients = $row['owned_ingredients'];
          }
        }
        else {
          echo "Error: " . $_SESSION['conn']->error . "<br />";
        }

        $ingArray = preg_split("/~/", $current_ingredients);
        $current_ingredients = "";
        $counter = 0;
        foreach ($ingArray as $ing) {
          $ing = trim($ing);
          if ($ing != "") {
              $current_ingredients .= " " . $ing . "~";
          }
          if ($ing == $_POST['ingredient']) {
            $counter += 1;
          }
        }

        if ($counter == 0) {
          $current_ingredients .= " " . $_POST['ingredient'] . "~";
        }

        $sql = "UPDATE user SET owned_ingredients='$current_ingredients' WHERE userId=". $_SESSION['user_id'];
        if ($_SESSION['conn']->query($sql)) {
          if ($counter > 0) {
            $_SESSION['prev_ingredient'] = "e";
          }
          else {
            $_SESSION['prev_ingredient'] = $_POST['ingredient'];
          }
          unset($_SESSION['ingredient']);
          header("Location: setting_ingredients.php");
          die();
        }
        else {
          echo "Error: " . $_SESSION['conn']->error . "<br />";
        }
      }


      function remove_ingredients() {
        $sql = "SELECT owned_ingredients FROM user WHERE userId=". $_SESSION['user_id'];
        if ($_SESSION['conn']->query($sql)) {
          $records = $_SESSION['conn']->query($sql);
          while ($row = $records->fetch_assoc()) {
            $current_ingredients = $row['owned_ingredients'];
          }
        }
        else {
          echo "Error: " . $_SESSION['conn']->error . "<br />";
        }

        $ingArray = preg_split("/~/", $current_ingredients);
        $current_ingredients = "";
        $counter = 0;
        foreach ($ingArray as $ing) {
          $ing = trim($ing);
          if ($ing != $_POST['ingredient_r']) {
            if ($ing != "") {
                $current_ingredients .= " " . $ing . "~";
            }
          }
          else {
            $counter += 1;
          }
        }

        $sql = "UPDATE user SET owned_ingredients='$current_ingredients' WHERE userId=". $_SESSION['user_id'];
        if ($_SESSION['conn']->query($sql)) {
          if ($counter > 0) {
              $_SESSION['prev_ingredient_r'] = $_POST['ingredient_r'];
          }
          else {
            $_SESSION['prev_ingredient_r'] = "e";
          };
          unset($_SESSION['ingredient_r']);
          header("Location: setting_ingredients.php");
          die();
        }
        else {
          echo "Error: " . $_SESSION['conn']->error . "<br />";
        }
      }
    ?>

  </head>
  <body>

    <div class="owned_ingredients">
      <h2>Your ingredients</h2>
      <?php

        $sql = "SELECT owned_ingredients FROM user WHERE userId=". $_SESSION['user_id'];
        if ($_SESSION['conn']->query($sql)) {
          $records = $_SESSION['conn']->query($sql);
          while ($row = $records->fetch_assoc()) {
            $current_ingredients = $row['owned_ingredients'];
          }
        }
        else {
          echo "Error: " . $_SESSION['conn']->error . "<br />";
        }

        //split $records[ingredients] by the regex /~/
        $ingArray = preg_split("/~/", $current_ingredients);
        echo "<ul>";
        foreach ($ingArray as $ing) {
          if ($ing != "") {
            echo "<li>$ing</li>";
          }
        }
        echo "</ul>";
        echo "</div>"; ?>
    </div>

    <div class="form">
  		<div class='add_ingredient_form'>
        <h2>Add an ingredient</h2>
  			<form method='post' action='setting_ingredients.php'>
  				<input type='text' name='ingredient'>
  				<input type='submit' value='Submit' name='submit'>
  			</form>
  		</div>
      <?php
        if (isset($_SESSION['prev_ingredient'])) {
          if ($_SESSION['prev_ingredient'] == 'e') {
            echo "<p>ingredient already exists.</p>";
          }
          else {
            echo "<p>successfully added: " . $_SESSION['prev_ingredient'] . " to your saved ingredients</p>";
          }
          unset($_SESSION['prev_ingredient']);
        }
      ?>
  	</div>

    <div class="form">
      <div class='add_ingredient_form'>
        <h2>Remove ingredient</h2>
        <form method='post' action='setting_ingredients.php'>
          <input type='text' name='ingredient_r'>
          <input type='submit' value='Submit' name='submit'>
        </form>
      </div>
      <?php
        if (isset($_SESSION['prev_ingredient_r'])) {
          if ($_SESSION['prev_ingredient_r'] == 'e') {
            echo "<p>ingredient didn't exist.</p>";
          }
          else {
            echo "<p>successfully removed: " . $_SESSION['prev_ingredient_r'] . " from your saved ingredients</p>";
          }
          unset($_SESSION['prev_ingredient_r']);
        }
      ?>
    </div>
  </body>
</html>
