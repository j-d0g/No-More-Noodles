<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Settings</title>
  </head>
  <body>
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

      if (isset($_SESSION['user_id'])) {

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

        if(isset($_SESSION['user_id'])) {

          $sql = "SELECT forename FROM login WHERE userId=" . $_SESSION['user_id'];
          $records = $conn->query($sql);

          while ($row = $records->fetch_assoc()) {
            echo "<h1>Hello, " . $row["forename"] . "!</h1>";
            echo "<h2>How can we help?</h2>";
            echo "<a href='alter_flags/registration-settings.php'><button>Change flags</button></a>";
            echo "<a href='set_ingredients/setting_ingredients.php'><button>Change ingredients</button></a>";
          }
        }
      }
      else {
        echo "Not logged in";
      }
    ?>

  </body>
</html>
