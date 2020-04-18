<!DOCTYPE html>
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

      $sort_region = $_POST['region'];

      $region = ("'" . $sort_region . "'");

      $sql = "SELECT * FROM (SELECT *, max(lastModified) AS max_date FROM monitor_data GROUP BY ID) AS aggregated_table INNER JOIN monitor_data AS table2 ON aggregated_table.max_date=table2.lastModified GROUP BY table2.lastModified ORDER BY table2.ID";                                                        
      
      #$sql = "SELECT ID, Label, PM2_5Value, Region, AVG(PM2_5Value), MAX(PM2_5Value), lastModified FROM monitor_data GROUP BY ID HAVING Region = 'Sunshine Coast'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0)
      {
        $monitor_array = array();

        while($row = $result->fetch_assoc())
        {
            $id = $row["ID"];
            $label = $row["Label"];
            $value = $row["PM2_5Value"];
            $last = $row["lastModified"];
            $latlng = 'lat: ' . $row["Lat"] . ', lng: ' . $row["Lon"];

            $monitor_array[] = array($id, $label, $value, $last, $latlng);
        }
        print_r($monitor_array);

        $location1 = $monitor_array[0][4];
      }
      else
      {
        echo "0 results";
      }
      $conn->close();
    ?>
<body>
      <p>Location = {<?php echo $location1 ?>}
