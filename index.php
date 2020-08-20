<!DOCTYPE html>
<html class='a'>
    <!--<meta name='viewport' content='width=device-width, initial-scale=1.00, maximum-scale=1.00, minimum-scale=1.00, user-scalable=no'>-->
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
                height: 100%;
                width: 100%;
            }
            #heading
            {
                position: absolute;
                margin: 0;
                text-align: center;
                left: 50%;
                transform: translate(-50%);
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
            #correction_factor
            {
                margin: 2px;
            }
           
        </style>
        <script src ="https://scairquality.ca/map_page_functions.js"></script>
        <script src ="https://scairquality.ca/chart_plugin.js"></script>
        <!--<script src="https://code.highcharts.com/highcharts.js"></script>-->
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    </head>
    <body style = 'overflow: hidden;'>
        <div id = 'map_container'>
            <div id = 'map'></div>
            <div id = 'heading'>
                <h1 class = 'a'>Sunshine Coast Air Quality</h1>
                <input type = 'button' class = 'option' value = 'Home' onclick = "window.location.href = '/index.php'">
                <input type = 'button' class = 'option' value = 'Current Values' onclick = "window.location.href = '/ajax_current.php'">
                <input type = 'button' class = 'option' value = 'Search Engine' onclick = "window.location.href = '/Individual_Search.php'">
            </div>
            <div id = 'settings'>
            </div>  
            <input type = 'button' id = 'menu' class = 'button' value = 'Map Options' onclick = 'checkWindow();'>
        </div>
        <div id = 'container' style = 'width:400px; height:200px;'></div>
        <script>
            var map;
            var is_open = false;
            var open_0 = false;
            var open_1 = false;
            var open_2 = false;
            var master;
            var markers = [];
            var gibsons = {lat: 49.401154, lng: -123.5075};
            var rounded = new Array();
            var data_pass = new Array();
            var contentstring = new Array();
            var current_zoom;

            function initMap()
            {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: gibsons,
                    zoom: 10,
                    mapTypeId: 'terrain',
                    streetViewControl: false,
                    fullscreenControl: false,
                    options: {
                        gestureHandling: 'greedy'
                    }
                });

                //Cookies.set('correction_factor', 0);
                //Cookies.set('average', 0);
                setMapzoom();
                ajaxRetrieve();
                setInterval(ajaxRetrieve, 120*1000);
            }
            $(document).ready(function() {
 
            //Triggers when a change occurs in the specified element
            $("#settings").on('change','#correction_factor', function() {

                var correction_type = $("#correction_factor").val();
                Cookies.set('correction_factor', correction_type);
                ajaxRetrieve();
                });
            
            //Triggers when a change occurs in the specified element
            $("#settings").on('change','#avg_options', function() {

                var averages = $("#avg_options").val();
                Cookies.set('average', averages);
                ajaxRetrieve();
                });

            //Triggers when a change occurs in the specified element
            $("#settings").on('change','#zoom_options', function() {

                var correction_type = $("#zoom_options").val();
                Cookies.set('location_zoom', correction_type);
                setMapzoom();
                });
            });
        </script>
        <script async defer
            src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA_nOosJgGoJYrYGQkXRgRbr7nKYzbgg34&callback=initMap'>
        </script>
    </body>
</html>
