<!DOCTYPE html>
<html class = 'a'>
  <head>
    <div>
      <h1 class = 'a'>Sunshine Coast Air Quality</h1>
      <input class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
      <input class = 'option2' value = 'Current Values' onclick = "window.location.href = '/Current_values.php'">
      <input class = 'option3' value = 'Search Engine' onclick = "window.location.href = '/search.php'">
   </div>
    <style>
      @import url('current_vals.css');
    </style>
  </head>
  <body>
    <br>
    <?php
      $servername = "localhost";
      $username = "airdata";
      $password = "AESl0uis!";
      $dbname = "airdata";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error)
      {
        die("Connection failed: " . $conn->connect_error);
      }

      $sort = $_POST['order'];
      $v = $_POST['radDir'];
      $leng = $_POST['limit'];
      $sort_region = $_POST['region'];

      $region = ("'" . $sort_region . "'");

      $sql = "SELECT * FROM monitor_data WHERE Region = $region ORDER BY $sort $v LIMIT $leng";
      $result = $conn->query($sql);

      if ($result->num_rows > 0)
      {
        echo
        "<table border ='1'>
         <tr>
           <th>ID</th>
           <th>Location</th>
           <th>Air Quality Value</th>
           <th>Last Modified</th>

         </tr>";

        while($row = $result->fetch_assoc())
        {
            $id = $row["ID"];
            $label = $row["Label"];
            $value = $row["PM2_5Value"];
            $last = $row["lastModified"];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$label</td>";
            echo "<td>$value</td>";
            echo "<td>$last</td>";
        }
      }
      else
      {
        echo "0 results";
      }
      $conn->close();
    ?>
  </body>
</html>
