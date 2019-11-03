<!DOCTYPE html>
<html class = 'a'>
  <head>
    <h1 class = 'a'>Sunshine Coast Air Quality</h1>
    <style>
      h1.a
      {
        background-color: #4ABF22;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 10px 10px;
        text-align: center;
        display: block;
        font-size: 40px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 80px;
        width: 500px;
      }

      html.a
      {
        background-color: #302F2F;
        color: black;
        font-size: 20px;
      }

      tr
      {
        background-color: #368C19;
				border-radius: 7px;
        border: none;
				color: white;
				text-align: center;
				font-size: 16px;
				margin-left: auto;
        margin-right: auto;
        margin-bottom: 1em;
        width: 300px;
				padding: 5px 17px;

        -webkit-box-shadow: 0 8px 6px -6px black;
           -moz-box-shadow: 0 8px 6px -6px black;
                box-shadow: 0 8px 6px -6px black;
      }

      th
      {
        background-color: #368C19;
				border-radius: 7px;
        border: none;
				color: white;
				text-align: center;
				font-size: 16px;
				margin-left: auto;
        margin-right: auto;
        margin-bottom: 1em;
        width: 300px;
				padding: 5px 17px;

        -webkit-box-shadow: 0 8px 6px -6px black;
           -moz-box-shadow: 0 8px 6px -6px black;
                box-shadow: 0 8px 6px -6px black;
      }

      td
      {
        background-color: #368C19;
				border-radius: 7px;
        border: none;
				color: white;
				text-align: center;
				font-size: 16px;
				margin-left: auto;
        margin-right: auto;
        margin-bottom: 1em;
        width: 300px;
				padding: 5px 17px;

        -webkit-box-shadow: 0 8px 6px -6px black;
           -moz-box-shadow: 0 8px 6px -6px black;
                box-shadow: 0 8px 6px -6px black;
      }

      table
      {
        background-color: #4ABF22;
				border-radius: 7px;
        border: none;
				color: white;
				text-align: center;
				font-size: 16px;
				margin-left: auto;
        margin-right: auto;
        margin-bottom: 1em;
        width: 1000px;
				padding: 17px 25px;
      }
    </style>
  </head>
  <body>
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

      $sql = "SELECT * FROM monitor_data GROUP BY ID HAVING Region = 'Sunshine Coast'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0)
      {
        echo
        "<table border ='1'>
         <tr>
           <th>ID</th>
           <th>Location</th>
           <th>Air Quality Value</th>
           <th>Average</th>
           <th>Highest Recorded</th>
           <th>Last Modified</th>

         </tr>";

        while($row = $result->fetch_assoc())
        {
            $id = $row["ID"];
            $label = $row["Label"];
            $value = $row["PM2_5Value"];
            $avg = $row["AVG(PM2_5Value)"];
            $max = $row["MAX(PM2_5Value)"];
            $last = $row["lastModified"];


            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$label</td>";
            echo "<td>$value</td>";
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