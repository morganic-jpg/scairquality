<!DOCTYPE html>
<html class='a'>
    <head>
        <title>Home</title>
        <div>
            <h1 class = 'a'>Sunshine Coast Air Quality</h1>
            <input class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
            <input class = 'option2' value = 'Current Values' onclick = "window.location.href = '/Current_values.php'">
            <input class = 'option3' value = 'Search Engine' onclick = "window.location.href = '/search.php'">
        </div>
        <style>
            @import url('global.css');
            #map 
            {
                height: 800px;  
                width: 800px;
                border-radius: 7px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 40px;
                  
            }
        </style>
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

            #$sql = "SELECT * FROM (SELECT *, max(lastModified) AS max_date FROM monitor_data GROUP BY ID) AS aggregated_table INNER JOIN monitor_data AS table2 ON aggregated_table.max_date=table2.lastModified GROUP BY table2.lastModified ORDER BY table2.ID";                                                        
            $sql = "SELECT ID, Label, PM2_5Value, Lat, Lon, lastModified FROM Current_Data";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                $monitor_array = array();

                while($row = $result->fetch_assoc())
                {
                    $id = $row["ID"];
                    $label = $row["Label"];
                    $value = $row["PM2_5Value"];
                    $last = $row["lastModified"];
                    $latlng = 'lat: ' . $row["Lat"] . ', lng: ' . $row["Lon"];

                    $monitor_array[] = array($id, $label, $value, $last, $latlng);
                }

                //Extracts Lat Lng Pairs from the array and combines into a string with | as a delimiter
                foreach ($monitor_array as $array_element) 
                {
                    $latlng_array = $latlng_array . '|' . $array_element[4];
                }

                //Extracts Air Quality from the array and combines into a string with | as a delimiter
                foreach ($monitor_array as $array_element)
                {
                    $airqual_array = $airqual_array . '|' . $array_element[2];
                }

                $javascriptarray = json_encode($monitor_array);
            }
            else
            {
                echo "0 results";
            }
            $conn->close();
        ?>
    </head>
    <body>
        <div id='map'></div>
        <script>
            var map;
            var marker;
            var locations;
            var vancouver = {lat: 49.2827, lng: -123.1207};

            var master = <?php echo $javascriptarray ?>;
            console.log(master);

            function setMarkers()
            {
                var image_med = {
                url: "https://scairquality.ca/Orange.png",
                size: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(25,25)
                };

                var image_small = {
                url: "https://scairquality.ca/small.png",
                size: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(20,20)
                };

                var image_large = {
                url: "https://scairquality.ca/Red.png",
                size: new google.maps.Size(64, 64),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(32,32)
                };

                var image_err = {
                url: "https://scairquality.ca/err.png",
                size: new google.maps.Size(64, 64),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(32,32)
                };

                //Converts the string of PHP data back into a javascript array by splitting on the | used as a delimiter
                var Location = "<?php echo $latlng_array; ?>";
                var latlngs = Location.split("|");
                latlngs.shift();
                var airqual = "<?php echo $airqual_array; ?>";
                var airqualvals = airqual.split("|");
                airqualvals.shift();

                var infowindow = new google.maps.InfoWindow();


                for (i = 0; i < latlngs.length; i++)
                {
                    //Converts the array of lat lngs into javascript objects by splitting on the , and on the : and recombining
                    var string1 = latlngs[i];
                    var properties = string1.split(', ');
                    var obj = {};
                    properties.forEach(function(property) {
                        var tup = property.split(':');
                        obj[tup[0]] = Number(tup[1]);
                    });

                    //Takes the air quality value corresponding to the loop # and rounds it to one  
                    //decimal place before converting it to a string for the google marker property
                    var airstring = airqualvals[i];
                    var rounded = String(Math.round(airstring * 10) / 10);

                    var sized_icon;
                    if (rounded >= 100)
                    {
                        sized_icon = image_large;
                    }
                    else if ((rounded < 100) && (rounded >= 10))
                    {
                        sized_icon = image_med;
                    }
                    else if (rounded > 1000)
                    {
                        sized_icon = image_err;
                        rounded = "E";
                    }
                    else
                    {
                        sized_icon = image_small;
                    }
                
                    //creates new markers
                    var marker = new google.maps.Marker({position: obj, map: map, label: rounded, icon: sized_icon});
                    
                    //creates pop-ups (this wont work until i fix the issue with the PHP and Javascript Array)
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                            infowindow.setContent(rounded);
                            infowindow.open(map, marker);
                        }
                    })(marker, i)); 
                }

            }

            function initMap()
            {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: vancouver,
                    zoom: 7,
                    mapTypeId: 'hybrid'
                });

                setMarkers();
            }
        </script>
        <script async defer
            src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAMGwGj7ub63upwbV5RAgGcnF7-qevf414&callback=initMap'>
        </script>
    </body>
</html>
