<!DOCTYPE html>
<html class='a'>
    <head>
        <title>Home</title>
        <div>
            <h1 class = 'a'>Sunshine Coast Air Quality</h1>
            <input class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
            <input class = 'option2' value = 'Current Values' onclick = "window.location.href = '/ajax_current.php'">
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
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <?php
            $servername = "localhost";
            $username = "airdata";
            $password = "AESl0uis!";
            $dbname = "airdata";
            $region_include = '("Sunshine Coast", "Northern Interior", "Southern Interior", "Lower Mainland", "Vancouver Island & Other Islands")';

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);
            }

            $sort_region = $_POST['region'];
	    $region = ("'" . $sort_region . "'");

            $sql = "SELECT ID, Label, PM2_5Value, Lat, Lon, lastModified, v3, v5, v6 FROM current_data WHERE Region in $region_include";
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
                    $lat = $row["Lat"];
                    $lng = $row["Lon"]; 
                    $v3 = $row["v3"];
                    $v5 = $row["v5"];
                    $v6 = $row["v6"];
                    #$max = $row["MAX"];
                    #$min = $row["MIN"];
                    #$avg = $row["AVG"];

                    #$monitor_array[] = array($id, $label, $value, $last, $lat, $lng, $max, $min, $avg);
                    $monitor_array[] = array($id, $label, $value, $last, $lat, $lng, $v3, $v5, $v6);
                }

                //converts PHP array into a format javascript can interpret
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
        <div id = 'container' style = 'width:400px; height:200px;'></div>
        <script>
            var map;
            var marker;
            var locations;
            var vancouver = {lat: 49.2827, lng: -123.1207};
            var rounded = new Array();
            var labels = new Array();
            var contentstring = new Array();
            var avg_rounded = new Array();

            function setMarkers()
            {
                var infowindow = new google.maps.InfoWindow();
                var master = <?php echo $javascriptarray ?>;
                console.log(master);

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
                size: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(20,20)
                };

                console.log(master.length);

                for (i = 0; i < master.length; i++)
                {
                    //Sets the Lat Lng and Air quality Value for each sensor
                    var location = new google.maps.LatLng(master[i][4], master[i][5]);

                    rounded[i] = String(Math.round(master[i][2] * 10) / 10);
                    //avg_rounded[i] = String(Math.round(master[i][8] * 10) / 10);
                
                    //Decides what size and color icon to use based on air quality value
                    var sized_icon;
                    if ((rounded[i] >= 100) && (rounded[i] < 1000))
                    {
                        sized_icon = image_large;
                    }
                    else if ((rounded[i] < 100) && (rounded[i] >= 10))
                    {
                        sized_icon = image_med;
                    }
                    else if (rounded[i] >= 1000)
                    {
                        sized_icon = image_err;
                        rounded[i] = "E";
                    }
                    else
                    {
                        sized_icon = image_small;
                    }

                    contentstring[i] = "Name: " + master[i][1] + " Value: " + rounded[i] + " ID: " + master[i][0] + "<br>" + "Past Hr: " + master[i][6] + " Past 24 Hrs: " + master[i][7] + " Past Week: " + master[i][8];
                
                    //creates new markers
                    var marker = new google.maps.Marker({position: location, map: map, label: rounded[i], icon: sized_icon});
                    
                    //creates pop-ups
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                            infowindow.setContent(contentstring[i]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i)); 
                }

            }

           /* document.addEventListener('DOMContentLoaded', function () {
                var myChart = Highcharts.chart('container', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Air Quality Values'
                    },
                    xAxis: {
                        title: {
                            text: 'Day'
                        }, 
                        tickInterval: 7
                    },
                    yAxis: {
                        title: {
                            text: 'ug m<sup>3</sup>'
                        }
                    },
                    series: [{
                        name: 'Sensor x',
                        data: [1, 0, 4]
                    }]
                });
            });*/

            function initMap()
            {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: vancouver,
                    zoom: 7,
                    mapTypeId: 'terrain'
                });

                setMarkers();
            }
        </script>
        <script async defer
            src = ''>
        </script>
    </body>
</html>
