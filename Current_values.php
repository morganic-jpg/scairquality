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
      h1.a
      {
        background-color: #4ABF22;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 8px 10px;
        text-align: center;
        display: block;
        font-size: 40px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
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

      body
			{
				text-align: center;
			}

      form
      {
        margin-top: 0px;
      }

      p
			{
				background-color: #4ABF22;
				border-radius: 5px;
				color: white;
				text-align: center;
				font-size: 16px;
				margin-left: auto;
        margin-right: auto;
        margin-bottom: 1em;
        width: 300px;
				padding: 5px 17px;
			}

      .option
      {
        background-color: #4ABF22;
        border: none;
        border-radius: 7px;
        color: white;
        padding: 8px 8px;
        text-align: center;
        display: inline;
        font-size: 12px;
        cursor: pointer;
        margin: auto;
      }

      .option2
      {
        background-color: #4ABF22;
        border: none;
        border-radius: 7px;
        color: white;
        padding: 8px 8px;
        text-align: center;
        display: inline;
        font-size: 12px;
        cursor: pointer;
        margin: auto;
      }

      .option3
      {
        background-color: #4ABF22;
        border: none;
        border-radius: 7px;
        color: white;
        padding: 8px 8px;
        text-align: center;
        display: inline;
        font-size: 12px;
        cursor: pointer;
        margin: auto;
      }

      .button
      {
        background-color: #4ABF22;
        border: none;
        border-radius: 7px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        display: block;
        font-size: 16px;
        cursor: pointer;
        margin-top: 2em;
        margin-left: auto;
        margin-right: auto;
        width: 200;
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

      $sql = "SELECT * FROM (SELECT *, max(lastModified) AS max_date FROM monitor_data GROUP BY ID HAVING Region = 'Sunshine Coast') AS aggregated_table INNER JOIN monitor_data AS table2 ON aggregated_table.max_date=table2.lastModified WHERE table2.Region = 'Sunshine Coast' GROUP BY table2.lastModified ORDER BY table2.ID";                                                        
      
      #$sql = "SELECT ID, Label, PM2_5Value, Region, AVG(PM2_5Value), MAX(PM2_5Value), lastModified FROM monitor_data GROUP BY ID HAVING Region = 'Sunshine Coast'";
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
    <form action = 'current_values_region.php' name = 'select' method = 'post'/>
        <p>Select Region:</p>
        <?php
            $monitor_list = file_get_contents('/home/legal-server/python_code/monitor_list.json');
            $region_array = json_decode($monitor_list, true);
            $array = $region_array["Regions"];

            $x = count($array);

            echo("<select name = 'region'>");
            for ($i = 0; $i < $x; $i++)
            {
              $region_val = $array[$i]["Name"];
              echo("<option value = '$region_val'>$region_val</option>");
            }
            echo('</select>');
        ?>
        <input class = 'button' type = 'submit' value = 'Change Region'/><br><br>
    </form>
  </body>
</html>
