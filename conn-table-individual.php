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

      $v = $_POST['radDir'];
      $sensor_id = $_POST['id_box'];
      $time = $_POST['time_drop'];
      $leng = $_POST['limit'];

      #if the user wants to view hourly data, set the right query and column titles
      if ($time == 'hour')
      {
        $sql = "SELECT id, Label, ROUND(AVG(PM2_5Value), 2) AS Average, ROUND(MAX(PM2_5Value), 2) AS Maximum, LastModified FROM monitor_data WHERE id = $sensor_id GROUP BY id, YEAR(LastModified), MONTH(LastModified), DAY(LastModified), HOUR(LastModified) ORDER BY LastModified $v LIMIT $leng";
        $header_string = "<table border ='1'>
        <tr>
          <th>ID</th>
          <th>Location</th> 
          <th>Hourly Average</th>
          <th>Hourly Maximum</th>
          <th>Last Modified</th>
        </tr>";
      }
      #if the user wants to view daily data, set the right query and column titles
      elseif ($time == 'day')
      {
        $sql = "SELECT id, Label, ROUND(AVG(PM2_5Value), 2) AS Average, ROUND(MAX(PM2_5Value), 2) AS Maximum, LastModified FROM monitor_data WHERE id = $sensor_id GROUP BY id, YEAR(LastModified), MONTH(LastModified), DAY(LastModified) ORDER BY LastModified $v LIMIT $leng";
        $header_string = "<table border ='1'>
        <tr>
          <th>ID</th>
          <th>Location</th>
          <th>Daily Average</th>
          <th>Daily Maximum</th>
          <th>Last Modified</th>
        </tr>";
      }
      $result = $conn->query($sql);

      if ($result->num_rows > 0)
      {
        echo $header_string;

        while($row = $result->fetch_assoc())
        {
            $id = $row["id"];
            $label = $row["Label"];
            $avg = $row["Average"];
            $max = $row["Maximum"];
            $last = $row["LastModified"];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$label</td>";
            echo "<td>$avg</td>";
            echo "<td>$max</td>";
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
