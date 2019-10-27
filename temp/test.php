<!DOCTYPE html>
<html>
  <body>
    <?php
      $monitor_list = file_get_contents('/home/legal-server/python_code/monitor_list.json');
      $region_array = json_decode($monitor_list, true);
      $array = $region_array["Regions"];

      $x = count($array);

      echo("<select name = 'region'>");
      for ($i = 0; $i < $x; $i++)
      {
        $region[$i] = $array[$i]["Name"];
        echo("<option value = '$region[$i]'>$region[$i]</option>");
      }
      echo('</select>');

      $var_region = "'" + $region[0] + "'"
      echo($varf)
     ?>
  </body>
</html>
