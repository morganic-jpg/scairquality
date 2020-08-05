<!DOCTYPE html>
<html class = 'a'>
  <head>
    <title>Search Engine</title>
    <div>
      <h1 class = 'a'>Sunshine Coast Air Quality</h1>
      <input class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
      <input class = 'option' value = 'Current Values' onclick = "window.location.href = '/ajax_current.php'">
      <input class = 'option' value = 'Search Engine' onclick = "window.location.href = '/search.php'">
    </div>

    <style>
      @import url('global.css');
    </style>
  </head>
  <body>
    <div class = 'logo'>
      <a href = 'https://www.cleanaironthecoast.com/'>
        <img class = 'logo' src = 'logo.gif'>
        </img>
      </a>
    </div>
    <div class = 'logo2'>
      <a href = 'https://www.2degreesinstitute.org/'>
        <img class = 'logo2' src = 'logo2.png'>
        </img>
      </a>
    </div>
    <form action = 'conn-table.php' name = 'select' method = 'post'><br><br>
      <p>View Order of Rows:</p>
      <select name = 'order' id = 'order'>
        <option value = 'lastModified'>Date Last Modified</option>
        <option value = 'ID'>ID</option>
        <option value = 'PM2_5Value'>Value</option>
      </select>

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

      <p>Select one option:</p>
      <input type = 'radio' name ='radDir' value = 'DESC'/>Descending Order<br>
      <input type = 'radio' name ='radDir' value = 'ASC'/>Ascending Order

      <p>How many rows would you like to view?</p>
      <input type = 'text' name = 'limit'/><br><br>

      <input class = 'button' type = 'submit' value = 'Next Page'/><br><br>

      <input class = 'button' value = 'Individual Search' onclick = "window.location.href = '/Individual_Search.php'">
    </form>
  </body>
</html>
