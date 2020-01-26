<!DOCTYPE html>
<html class = 'a'>
  <head>
    <title>SC Air Quality</title>
    <div>
      <h1 class = 'a'>Sunshine Coast Air Quality</h1>
      <input class = 'option' value = 'Home' onclick = "window.location.href = '/home.php'">
      <input class = 'option2' value = 'Current Values' onclick = "window.location.href = '/current_values.php'">
      <input class = 'option3' value = 'Search Engine' onclick = "window.location.href = '/search.php'">
    </div>

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
        margin-bottom: 0;
        width: 500px;
      }
      html.a
      {
        background-color: #302F2F;
        color: black;
        font-size: 20px;
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
        width: 200px;
      }

      body
			{
				text-align: center;
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

      input
      {
        margin-bottom: 1em;
      }

      form
      {
        margin-top: 0px;
      }

      img.logo
      {
        position: fixed;
        border-radius: 10px;
      }

      img.logo2
      {
        position: fixed;
        border-radius: 10px;
        height: auto;
        width: 200px;
      }

      div.logo
      {
        margin-right: 75%;
        display: inline-block;
      }

      div.logo2
      {
        margin-left: 50%;
        display: inline-block;
      }

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
    <form action = 'conn-table.php' name = 'select' method = 'post'/><br><br>
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
      <input type = 'text' name = 'limit'/>

      <input class = 'button' type = 'submit' value = 'Next Page'/>
    </form>
  </body>
</html>
