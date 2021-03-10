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
        echo "Got ingredient " . $_POST['ingredient'];
        update_ingredients();
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

        $current_ingredients .= " " . $_POST['ingredient'] . "~";

        $sql = "UPDATE user SET owned_ingredients='$current_ingredients' WHERE userId=". $_SESSION['user_id'];
        if ($_SESSION['conn']->query($sql)) {
          $_SESSION['prev_ingredient'] = $_POST['ingredient'];
          unset($_SESSION['ingredient']);
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
    <div class="form">
  		<h1>Account settings</h1>
  		<div class='ingredient_form'>
  			<form method='post' action='setting_ingredients.php'>
  				<span>Add an ingredient</span><br>
  				<input type='text' name='ingredient'>
  				<input type='submit' value='Submit' name='submit'>
  			</form>
  		</div>
      <?php
        if (isset($_SESSION['prev_ingredient'])) {
          echo "<p>successfully added: " . $_SESSION['prev_ingredient'] . " to your saved ingredients</p>";
          unset($_SESSION['prev_ingredient']);
        }
      ?>
  	</div>
  </body>
</html>
