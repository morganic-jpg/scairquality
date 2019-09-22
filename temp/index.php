<?php
$servername = "localhost";
$username = "airdata";
$password = "AESl0uis!";
$dbname = "airdata";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

return $conn;
?>

<!DOCTYPE html>
<html>
  <style>
      h3.a
      {
        background-color: #4FCC25;
				border-radius: 10px;
				color: white;
				text-align: center;
				margin: 4px 2px;
				margin-left: 30%;
				margin-right: 30%;
				padding: 5px 17px;
        font-size: 40px;
      }
      img
      {
        border-radius: 10px;
      }
      div.a
      {
        position: fixed;
        margin-right: 90%;
      }
      .button
      {
        margin-top: 10px;
        background-color: #4FCC25;
        border: none;
        border-radius: 10px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        display: block;
        font-size: 16px;
        cursor: pointer;
        margin-left: auto;
        margin-right: auto;
      }
      h3
      {
        text-align: center;
      }
  </style>
  <head>
    <?php
	if(isset($_POST['data'])){
	    $sth = $conn->prepare("SELECT * FROM airdate");
	    $sth->execute();
	}
    ?>
    <title>Air Quality</title>
  </head>
  <body>
    <h3 class = a>Sechelt Air Quality</h3>
    <div class = 'a'>
      <img src = 'logo.gif'>
      </img>
    </div>
    <h3>Select Monitor By Location:</h3>
    <input type = 'button' class = 'button' value = 'East Porpoise Bay'/>
    <form method = "POST" action="">
	<input type = "submit" name = "data" value = "1"/>
    </form>
  </body>
</html>
