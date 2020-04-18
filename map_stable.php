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
    </head>
    <body>
        <div id='map'></div>
        <script>
            var map;
            var marker;
            var infowindow;
            var red_icon;
            var green_icon;
            var locations;
            var vancouver = {lat: 49.2827, lng: -123.1207};

            function setmarkers()
            {
                var image = {
                url: "https://scairquality.ca/test.png",
                size: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(25,25)
                };

                marker = new google.maps.Marker({position: vancouver, map: map, icon: image, label: "470.9"});
            }

            function initMap()
            {
                infowindow = new google.maps.InfoWindow();
                map = new google.maps.Map(document.getElementById('map'), {
                    center: vancouver,
                    zoom: 7,
                    mapTypeId: 'hybrid'
                });
                setmarkers();
            }
        </script>
        <script async defer
            src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAMGwGj7ub63upwbV5RAgGcnF7-qevf414&callback=initMap'>
        </script>
    </body>
</html>
