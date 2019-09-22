<!DOCTYPE html>
<html>
  <head>
      <title>POST</title>
  </head>
  <body>
    <h3>PHP - Post</h3>
    <p> If you thought this was going to have a happy ending you weren't really paying attention</p>

    <?
      $weather = $_POST['txtWeather'];
      echo "The weather for today is: $weather<br>";

      echo "<hr>";
      print_r($_POST);
      echo "<hr>";

      if($weather == 'sunny')
      {
        echo "Don't forget to bring skin cancer<br>";
      }
      else if($weather == 'rainy')
      {
        echo "Don't forget your umbrella<br>";
      }
      else
      {
        echo "Have a good day<br>";
      }

    ?>
  </body>
</html>
