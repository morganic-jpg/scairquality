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

   var_dump($_POST);

  #$sql = "SELECT * FROM (SELECT *, max(lastModified) AS max_date FROM monitor_data GROUP BY ID HAVING Region = 'Sunshine Coast') AS aggregated_table INNER JOIN monitor_data AS table2 ON aggregated_table.max_date=table2.lastModified WHERE table2.Region = 'Sunshine Coast' GROUP BY table2.lastModified ORDER BY table2.ID";                                                        
  $sql = "SELECT ID, Label, PM2_5Value, Lat, Lon, lastModified FROM current_data WHERE Region = $region";
  $result = $conn->query($sql);

  if ($result->num_rows > 0)
   {
     echo
     "<div>
         <table border ='1'>
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
    echo "</table></div>";
  }
  else
  {
    echo "0 results";
  }
  $conn->close();
?>

