$(document).ready(function() {

    if($('#map').length)
    {
            arrayPoly = [];
            var center = new google.maps.LatLng(44.559044, 6.078822);
            var coords;
            var waypts = [];
            var i = 0;
            var waypointsPoped = false;
        
            $.ajax({
                url: "getCoords",
                async: false,
                data: {
                    idLigne: 1,
                    sens: 1,
                    date: '14-02-2015'
                },
                success: function(res) {
                    coords = res;
                    console.log(coords);
                    length = coords.length - 1;
                    createLine();
                },
                error: function(errorThrown) {
                    console.log(errorThrown);
                }
            });
    
            var map = new google.maps.Map(document.getElementById('map'), {
                center: center,
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
    
            var polyline = new google.maps.Polyline({
                path: [],
                strokeColor: '#0000FF',
                strokeWeight: 5
            });
    
    
            function createLine() {
    
                var iterations = Math.round(length/10);
                for (var j = 0; j < iterations; j++) {
                    
                    if(i+11 < length)
                    {
                        for(var k = i+1; k < i+9; k++)
                            waypts.push({
                                location: new google.maps.LatLng(coords[j].latArret, coords[j].longArret),
                                stopover: true
                            });
                        
                        var bounds = new google.maps.LatLngBounds();
                        var directionsService = new google.maps.DirectionsService();
    
                        var request = {
                            origin: new google.maps.LatLng(coords[i].latArret, coords[i].longArret),
                            destination: new google.maps.LatLng(coords[i+10].latArret, coords[i+10].longArret),
                            travelMode: google.maps.DirectionsTravelMode.DRIVING,
                            waypoints: waypts
                        };
                        
                        directionsService.route(request, function(result, status) {
                            
                            if (status == google.maps.DirectionsStatus.OK) {
                                path = result.routes[0].overview_path;
        
                                $(path).each(function(index, item) {
                                    polyline.getPath().push(item);
                                    bounds.extend(item);
                                })
        
                                arrayPoly = polyline.getPath();
                                polyline.setMap(map);
                                map.fitBounds(bounds);
        
                            }
                        });
                        
                        i+=11;
                        waypts = [];
                        
                    }
                    else
                    {
                        waypts=[];
                        for(var k = i; k < length; k++)
                            waypts.push({
                                location: new google.maps.LatLng(coords[j].latArret, coords[j].longArret),
                                stopover: true
                        });
                        
                        var bounds = new google.maps.LatLngBounds();
                        var directionsService = new google.maps.DirectionsService();
    
                        var request = {
                            origin: new google.maps.LatLng(coords[i-1].latArret, coords[i-1].longArret),
                            destination: new google.maps.LatLng(coords[length].latArret, coords[length].longArret),
                            travelMode: google.maps.DirectionsTravelMode.DRIVING,
                            waypoints: waypts
                        };
                        
                        directionsService.route(request, function(result, status) {
                            
                            if (status == google.maps.DirectionsStatus.OK) {
                                path = result.routes[0].overview_path;
        
                                $(path).each(function(index, item) {
                                    polyline.getPath().push(item);
                                    bounds.extend(item);
                                })
        
                                arrayPoly = polyline.getPath();
                                polyline.setMap(map);
                                map.fitBounds(bounds);
        
                            }
                        });
                    }
                    
                        
                }


            }

        }
});