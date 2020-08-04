<!DOCTYPE html>
<html class='a'>
    <head>
        <title>Home</title>
        <style>
            @import url('global.css');
            #map 
            {
                height: 100%;
                width: 100%;
                position: absolute;
            }
            #map_container
            {
                position: 'relative';
                height: 100%;
                width: 100%;
            }
            #heading
            {
                position: absolute;
                margin: 0;
                text-align: center;
                left: 50%;
                transform: translate(-50%)
            }
            #settings
            {
                display: block;
                position: absolute;
                text-align: center;
                bottom: 50px;
                width: 200px;
            }
            #menu
            {
                position: fixed;
                height: 25px;
                width: 150px;
                font-size: 14px;
                bottom: 5px;
                left: 25px;
            }
           
        </style>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body style = 'overflow: hidden;'>
        <div id = 'map_container'>
            <div id = 'map'></div>
            <div id = 'heading'>
                <h1 class = 'a'>Sunshine Coast Air Quality</h1>
                <input type = 'button' class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
                <input type = 'button' class = 'option2' value = 'Current Values' onclick = "window.location.href = '/ajax_current.php'">
                <input type = 'button' class = 'option3' value = 'Search Engine' onclick = "window.location.href = '/search.php'">
            </div>
            <div id = 'settings'>
            </div>  
            <input type = 'button' id = 'menu' class = 'option' value = 'Map Options' onclick = 'openPopup();'>
        </div>
        <div id = 'container' style = 'width:400px; height:200px;'></div>
        <script>
            var map;
            var is_open = false;
            var master;
            var markers = [];
            var gibsons = {lat: 49.401154, lng: -123.5075};
            var rounded = new Array();
            var contentstring = new Array();
            var current_zoom;

            function openPopup()
            {
                var settingstring = "<input type = 'button' class = 'option' onclick = 'zoomChange();' value = 'Change Location Zoom'>";
                if (is_open == true)
                {
                    $('#settings').html(null);
                    is_open = false;
                    console.log('2: ' + is_open);
                }
                else if (is_open == false)
                {
                    $('#settings').html(settingstring);
                    is_open = true;
                    console.log('3: ' + is_open);
                }
            }

            function zoomChange()
            {
                var current = getCookie('location_zoom');
                if (current == 1)
                {
                    setCookie('location_zoom', 0);
                }
                else
                {
                    setCookie('location_zoom', 1);
                }

                $('#settings').html(null);
                is_open = false;
            }

            function ajaxRetrieve()
            {
                $(document).ready(function() {
                    // Variable to hold request
                    var request;

                    // Abort any pending request
                    if (request) {
                        request.abort();
                    }

                    request = $.ajax({
                        url: "/cur_database_conn_json.php",
                        type: "get",
                        dataType: "json"
                    });

                    request.done(function (response, textStatus, jqXHR){
                        setMarkers(response);
                        //console.log(response);
                        console.log("Hooray, it worked!");
                    });

                    request.fail(function (jqXHR, textStatus, errorThrown){
                        console.error(
                            "The following error occurred: " +
                            textStatus, errorThrown
                        );
                    });
                });
            }

            function deleteMarkers()
            {
                for (let i = 0; i < markers.length; i++)
                {
                    markers[i].setMap(null);
                }
                markers = [];
            }

            function setMarkers(values)
            {
                var infowindow = new google.maps.InfoWindow();

                deleteMarkers();

                master = values;

                var icon_10 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_10.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_20 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_20.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_30 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_30.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_40 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_40.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_50 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_50.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_60 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_60.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_70 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_70.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_80 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_80.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_90 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_90.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_100 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_100.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_100plus = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_100+.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                var icon_NA = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_NA.png",
                scaledSize: new google.maps.Size(50, 50),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(25,25)
                };

                for (let i = 0; i < master.length; i++)
                {
                    //Sets the Lat Lng and Air quality Value for each sensor
                    var location = new google.maps.LatLng(master[i][4], master[i][5]);

                    rounded[i] = String(Math.round(master[i][2] * 10) / 10);

                    var icon_type;
                    if ((rounded[i] > 100) && (rounded[i] < 1000))
                    {
                        icon_type = icon_100plus;
                    }
                    else if ((rounded[i] < 100) && (rounded[i] >= 90))
                    {
                        icon_type = icon_100;
                    }
                    else if ((rounded[i] < 90) && (rounded[i] >= 80))
                    {
                        icon_type = icon_90;
                    }
                    else if ((rounded[i] < 80) && (rounded[i] >= 70))
                    {
                        icon_type = icon_80;
                    }
                    else if ((rounded[i] < 70) && (rounded[i] >= 60))
                    {
                        icon_type = icon_70;
                    }
                    else if ((rounded[i] < 60) && (rounded[i] >= 50))
                    {
                        icon_type = icon_60;
                    }
                    else if ((rounded[i] < 50) && (rounded[i] >= 40))
                    {
                        icon_type = icon_50;
                    }
                    else if ((rounded[i] < 40) && (rounded[i] >= 30))
                    {
                        icon_type = icon_40;
                    }
                    else if ((rounded[i] < 30) && (rounded[i] >= 20))
                    {
                        icon_type = icon_30;
                    }
                    else if ((rounded[i] < 20) && (rounded[i] >= 10))
                    {
                        icon_type = icon_20;
                    }
                    else if ((rounded[i] < 10) && (rounded[i] >= 0))
                    {
                        icon_type = icon_10;
                    }
                    else
                    {
                        icon_type = icon_NA
                    }

                    contentstring[i] = "Name: " + master[i][1] + " Value: " + rounded[i] + " ID: " + master[i][0] + "<br>" + "Past Hr: " + master[i][6] + " Past 24 Hrs: " + master[i][7] + " Past Week: " + master[i][8];
                
                    //creates new markers
                    var marker = new google.maps.Marker({position: location, map: map, label: rounded[i], icon: icon_type});
                    markers.push(marker);
                    
                    //creates pop-ups
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                            infowindow.setContent(contentstring[i]);
                            infowindow.open(map, marker);
                        }
                    })(marker, i)); 
                }

            }
            //// From w3schools ////
            function setCookie(cname, cvalue) {
                document.cookie = cname + '=' + cvalue + ';';
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == '') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
            ///////////////////////

            function initMap()
            {
                
                map = new google.maps.Map(document.getElementById('map'), {
                    center: gibsons,
                    zoom: 11,
                    mapTypeId: 'terrain',
                    options: {
                        gestureHandling: 'greedy'
                    }
                });

                if (current_zoom == 1) {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                            map.setCenter(initialLocation);
                            map.setZoom(10);
                        });
                    }
                }

                ajaxRetrieve();
                setInterval(ajaxRetrieve, 120*1000);
            }
        </script>
        <script async defer
            src = ''>
        </script>
    </body>
</html>
