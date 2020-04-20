<!DOCTYPE html>
<html class = 'a'>
  <head>
    <title>Search Engine</title>
    <div>
      <h1 class = 'a'>Sunshine Coast Air Quality</h1>
      <input class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
      <input class = 'option2' value = 'Current Values' onclick = "window.location.href = '/Current_values.php'">
      <input class = 'option3' value = 'Search Engine' onclick = "window.location.href = '/search.php'">
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
    <form action = 'conn-table-ind.php' name = 'select' method = 'post'/><br><br>
      <p>Enter ID of Sensor:</p>
      <input type = 'text' name = 'id_box' value = '1086'/>

      <p>Time Frame</P>
      <select name = 'time_drop' id = 'time_drop'>
        <option value = 'hour'>Hourly Data</option>
        <option value = 'day'>Daily Data</option>
      </select>

      <p>Select one option:</p>
      <input type = 'radio' name ='radDir' value = 'DESC'/>Descending Order<br>
      <input type = 'radio' name ='radDir' value = 'ASC'/>Ascending Order

      <p>How many rows would you like to view?</p>
      <input type = 'text' name = 'limit'/>

      <input class = 'button' type = 'submit' value = 'Next Page'/>
    </form>
  </body>
</html>
