<!DOCTYPE html>
<html class = 'a'>
  <head>
  <title>Current Values</title>
  <div>
    <h1 class = 'a'>Sunshine Coast Air Quality</h1>
    <input class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
    <input class = 'option2' value = 'Current Values' onclick = "window.location.href = '/Current_values.php'">
    <input class = 'option3' value = 'Search Engine' onclick = "window.location.href = '/search.php'">
   </div>
    <style>
      @import url('current_vals.css');
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
  <form id = 'foo' name = 'foo' method = 'post'>
    <p>Select Region:</p>
    <select id = 'region' name = 'region'>
    <?php
        $monitor_list = file_get_contents('/home/legal-server/python_code/monitor_list.json');
        $region_array = json_decode($monitor_list, true);
        $array = $region_array["Regions"];
        $x = count($array);

        //echo("<select id = 'region' name = 'region'>");
        for ($i = 0; $i < $x; $i++)
        {
          $region_val = $array[$i]["Name"];
          echo("<option value = '$region_val'>$region_val</option>");
        }
       // echo('</select>');
    ?>
    </select>
    <input class = 'button' type = 'submit' value = 'Change Region'/><br><br>
  </form>
    <div id = 'table'></div>
  </body>
  <script>
    $(document).ready(function() {
    // Variable to hold request
    var request;

    // Bind to the submit event of our form
    $("#foo").submit(function(event){

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("select");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "/cur_database_conn.php",
        type: "post",
        dataType: "json",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log("Hooray, it worked!");
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error("Data:" + serializedData +
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

    });
  });
  </script>
</html>
