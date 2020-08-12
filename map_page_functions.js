            var settingstring_1 = "<input style = 'margin: 2px;' type = 'button' class = 'button' onclick = 'zoomdropDown();' value = 'Change Location Zoom'><br>";
            var settingstring_2 = "<input style = 'margin: 2px;' type = 'button' class = 'button' onclick = 'dropDown();' value = 'Change Correction Factor'><br>";
            var settingstring_3 = "<input style = 'margin: 2px;' type = 'button' class = 'button' onclick = 'avgdropDown();' value = 'View Historical Averages'><br>";
            var settingstring = settingstring_1 + settingstring_2;
            var avgdropdown = "<select id = 'avg_options' class = 'option'>" +
                "<option hidden disabled selected value>-- Select Option --</option>" +
                    "<option value = '0'>Current Reading</option>" +
                    "<option value = '1'>1 hr Average</option>" +
                    "<option value = '2'>3 hr Average</option>" +
                    "<option value = '3'>6 hr Average</option>" +
                    "<option value = '4'>24 hr Average</option>" +
                "<select>";
            var zoomdropdown = "<select id = 'zoom_options' class = 'option'>" +
                "<option hidden disabled selected value>-- Select Option --</option>" +
                    "<option value = '1'>Center on Location</option>" +
                    "<option value = '0'>Center on Gibsons</option>" +
                "<select>";
            var correctdropdown = "<select id = 'correction_factor' class = 'option'>" +
                "<option hidden disabled selected value>-- Select Option --</option>" +
                    "<option value = '0'>No Correction Factor</option>" +
                    "<option value = '1'>AQ-SPEC</option>" +
                    "<option value = '2'>LRAPA</option>" +
                    "<option value = '3'>U of Utah</option>" +
                    "<option value = '4'>UNBC</option>" +
                "<select>";
                var hist_data;
            
            function dropDown()
            {   
                if (open_0 == true && open_1 == true && open_2 == true)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + settingstring_3 + avgdropdown);
                    open_0 = false;
                }
                else if (open_0 == false && open_1 == false && open_2 == true)
                {
                    $('#settings').html(settingstring + correctdropdown + settingstring_3 + avgdropdown);
                    open_0 = true;
                }
                else if (open_0 == false && open_1 == true && open_2 == true)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + correctdropdown + settingstring_3 + avgdropdown);
                    open_0 = true;
                }
                else if (open_0 == true && open_1 == false && open_2 == true)
                {
                    $('#settings').html(settingstring + settingstring_3 + avgdropdown);
                    open_0 = false;
                }
                else if (open_0 == true && open_1 == true && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + settingstring_3);
                    open_0 = false;
                }
                else if (open_0 == false && open_1 == false && open_2 == false)
                {
                    $('#settings').html(settingstring + correctdropdown + settingstring_3);
                    open_0 = true;
                }
                else if (open_0 == false && open_1 == true && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + correctdropdown + settingstring_3);
                    open_0 = true;
                }
                else if (open_0 == true && open_1 == false && open_2 == false)
                {
                    $('#settings').html(settingstring + settingstring_3);
                    open_0 = false;
                }
                
            }

            function zoomdropDown()
            {   
                if (open_1 == true && open_0 == true && open_2 == true)
                {
                    $('#settings').html(settingstring + correctdropdown + settingstring_3 + avgdropdown);
                    open_1 = false;
                }
                else if (open_1 == false && open_0 == false && open_2 == true)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + settingstring_3 + avgdropdown);
                    open_1 = true;
                }
                else if (open_1 == false && open_0 == true && open_2 == true)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + correctdropdown + settingstring_3 + avgdropdown);
                    open_1 = true;
                }
                else if (open_1 == true && open_0 == false && open_2 == true)
                {
                    $('#settings').html(settingstring + settingstring_3 + avgdropdown);
                    open_1 = false;
                }
                else if (open_1 == true && open_0 == true && open_2 == false)
                {
                    $('#settings').html(settingstring + correctdropdown + settingstring_3);
                    open_1 = false;
                }
                else if (open_1 == false && open_0 == false && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + settingstring_3);
                    open_1 = true;
                }
                else if (open_1 == false && open_0 == true && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + correctdropdown + settingstring_3);
                    open_1 = true;
                }
                else if (open_1 == true && open_0 == false && open_2 == false)
                {
                    $('#settings').html(settingstring + settingstring_3);
                    open_1 = false;
                }
            }

            function avgdropDown()
            {   
                if (open_1 == true && open_0 == true && open_2 == true)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + correctdropdown + settingstring_3);
                    open_2 = false;
                }
                else if (open_1 == false && open_0 == false && open_2 == true)
                {
                    $('#settings').html(settingstring + settingstring_3);
                    open_2 = false;
                }
                else if (open_1 == false && open_0 == true && open_2 == true)
                {
                    $('#settings').html(settingstring + correctdropdown + settingstring_3);
                    open_2 = false;
                }
                else if (open_1 == true && open_0 == false && open_2 == true)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + settingstring_3);
                    open_2 = false;
                }
                else if (open_1 == true && open_0 == true && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + correctdropdown + settingstring_3 + avgdropdown);
                    open_2 = true;
                }
                else if (open_1 == false && open_0 == false && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + settingstring_2 + settingstring_3 + avgdropdown);
                    open_2 = true;
                }
                else if (open_1 == false && open_0 == true && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + settingstring_2 + correctdropdown + settingstring_3 + avgdropdown);
                    open_2 = true;
                }
                else if (open_1 == true && open_0 == false && open_2 == false)
                {
                    $('#settings').html(settingstring_1 + zoomdropdown + settingstring_2 + settingstring_3 + avgdropdown);
                    open_2 = true;
                }
            }
            
            function openPopup()
            {
                if (is_open == true)
                {
                    $('#settings').html(null);
                    is_open = false;
                    open_0 = false;
                    open_1 = false;
                    open_2 = false;
                }
                else if (is_open == false)
                {
                    $('#settings').html(settingstring + settingstring_3);
                    is_open = true;
                }
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
                        var correction = Cookies.get('correction_factor');
                        var averages = Cookies.get('average');
                        setMarkers(response, correction, averages);
                        //console.log(response);
                        //console.log("Hooray, it worked!");
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

            function setMarkers(values, correctiontype, average)
            {
                var infowindow = new google.maps.InfoWindow();

                deleteMarkers();

                master = values;

                var icon_10 = {
                url: "https://scairquality.ca/Map_Icons/Map_Icon_10.png",
                scaledSize: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(20,20)
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

                    if (average == 0)
                    {
                        rounded[i] = String(Math.round(master[i][2] * 10) / 10);
                    }
                    else if (average == 1)
                    {
                        rounded[i] = String(Math.round(master[i][6] * 10) / 10);
                    }
                    else if (average == 2)
                    {
                        rounded[i] = String(Math.round(master[i][7] * 10) / 10);
                    }
                    else if (average == 3)
                    {
                        rounded[i] = String(Math.round(master[i][8] * 10) / 10);
                    }
                    else if (average == 4)
                    {
                        rounded[i] = String(Math.round(master[i][9] * 10) / 10);
                    }
                    else
                    {
                        rounded[i] = String(Math.round(master[i][2] * 10) / 10);
                    }
                    

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

                    //contentstring[i] = "Name: " + master[i][1] + " Value: " + rounded[i] + " ID: " + master[i][0];
                    // "<br>" + "Past Hr: " + master[i][6] + " Past 24 Hrs: " + master[i][7] + " Past Week: " + master[i][8];
                    var contentstring = "<div id = 'container" + master[i][0] + "'></div>";
                
                    //creates new markers
                    var label_value = String(correctionFactor(rounded[i], correctiontype));
                    var marker = new google.maps.Marker({position: location, map: map, label: label_value, icon: icon_type});
                    markers.push(marker);
                    
                    //creates pop-ups
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                            infowindow.open(map, marker);
                            infowindow.setContent("<div id = 'container" + master[i][0] + "'></div>");
                            console.log(contentstring);

                            google.maps.event.addListener(infowindow, 'domready', function(){
                                ajaxhistoricalRetrieve(master[i][0]);
                            });
                        }
                    })(marker, i)); 
                }

            }

            function setMapzoom()
            {
                var current_zoom = Cookies.get("location_zoom");
                var gibsons = {lat: 49.401154, lng: -123.5075};

                if (current_zoom == 1) {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                            map.setCenter(initialLocation);
                            map.setZoom(10);
                        });
                    }
                }
                else
                {
                    map.setCenter(gibsons);
                    map.setZoom(10);
                }
            }

            function correctionFactor(value, type)
            {
                var corrected;

                if (type == 0)
                {
                    corrected = value;
                }
                else if (type == 1)
                {
                    //AQ-SPEC: y = 0.624x + 2.728 (0-100 ug/m3)
                    if (value < 100)
                    {
                        corrected = Math.round(((0.624 * value) + 2.728) * 10) / 10;
                    }
                    else
                    {
                        corrected = value;
                        console.log("Value did not meet requirements for correction factor")
                    }
                }
                else if (type == 2)
                {
                    //U of Utah: y = 0.778x + 2.65 (0-60 ug/m3)
                    if (value < 60)
                    {
                        corrected = Math.round(((0.778 * value) + 2.65) * 10) / 10;
                    }
                    else
                    {
                        corrected = value;
                        console.log("Value did not meet requirements for correction factor")
                    }

                }
                else if (type == 3)
                {
                    //LRAPA y = 0.5x - 0.66 (0-60 ug/m3)
                    if (value < 60)
                    {
                        corrected = Math.round(((0.5 * value) - 0.66) * 10) /10;
                    }
                    else
                    {
                        corrected = value;
                        console.log("Value did not meet requirements for correction factor")
                    }

                }
                else if (type == 4)
                {
                    //UNBC y = 0.68x + 1.91 (0-20 ug/m3)
                    //UNBC y = 0.87x - 6.62 (>20 ug/m3)
                    if (value < 20)
                    {
                        corrected = Math.round(((0.68 * value) + 1.91) * 10) / 10;
                    }
                    else if (value > 20)
                    {
                        corrected = Math.round(((0.87 * value) - 6.62) * 10) / 10;
                    }
                    else
                    {
                        corrected = value;
                        console.log("Value did not meet requirements for correction factor")
                    }
                }
                else
                {
                    corrected = value;
                }

                return corrected;
            }
            function ajaxhistoricalRetrieve(sensor)
            {
                console.log("Post: " + sensor);
                postarray = 'val=' + sensor;
		        element = "container" + sensor;
		        console.log(element);
                $(document).ready(function(){
                    var request;

                    request = $.ajax({
                        url: "/hist_database_conn.php",
                        type: "post",
                        dataType: "text",
                        data: postarray
                    });

                    request.done(function (response){
                        drawChart(sensor, element, response);
                        console.log(response);
                    });

                    request.fail(function(jqXHR, textStatus, errorThrown){
                        console.error("The following error occurred: " +
                        textStatus, errorThrown
                        );
                    });
                });
            }
            function drawChart(sensor, element, data)
            {
                    console.log('Placing chart at: ' + element);
                    var mychart = Highcharts.chart(element, {
                        chart: {
                            zoomType: 'x'
                        },
                        yAxis: {
                            title: {
                                    text: 'Air Qualiy (ug/m3)'
                                }
                        },
                        xAxis: {
                                type: 'datetime'
                        },
                        title: {
                                text: 'Air Quality For Sensor: ' + sensor
                            },
                        plotOptions: {
                                series: {
                                    turboThreshold: 0
                                }
                            },
                        series: [{
                            name: 'A Channel',
                            data: data
                        }]
                        });
    }
