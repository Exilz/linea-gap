$(function() {

    // Variables globales
    var map = new window.google.maps.Map(document.getElementById("map"));
    var directionsDisplay = new window.google.maps.DirectionsRenderer();
    var directionsService = new window.google.maps.DirectionsService();
    var stops;

    $.ajax({
        url: "getCoords",
        async: false,
        data: {
            idLigne: 9,
            sens: 2,
            date: '13-02-2015'
        },
        success: function(res) {
            stops = res;
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });


    Tour_startUp(stops);

    window.tour.loadMap(map, directionsDisplay);
    window.tour.fitBounds(map);

    if (stops.length > 1)
        window.tour.calcRoute(directionsService, directionsDisplay);
});

function Tour_startUp(stops) {
    if (!window.tour) window.tour = {
        updateStops: function(newStops) {
            stops = newStops;
        },
        loadMap: function(map, directionsDisplay) {
            var myOptions = {
                zoom: 13,
                center: new window.google.maps.LatLng(51.507937, -0.076188),
                mapTypeId: window.google.maps.MapTypeId.ROADMAP
            };
            map.setOptions(myOptions);
            directionsDisplay.setMap(map);
        },
        fitBounds: function(map) {
            var bounds = new window.google.maps.LatLngBounds();

            jQuery.each(stops, function(key, val) {
                var myLatlng = new window.google.maps.LatLng(val.Geometry.Latitude, val.Geometry.Longitude);
                bounds.extend(myLatlng);
            });
            map.fitBounds(bounds);
        },
        calcRoute: function(directionsService, directionsDisplay) {
            var batches = [];
            var itemsPerBatch = 10; // Max 10 waypoints : start = -1, stop = 1, 8 waypointss
            var itemsCounter = 0;
            var wayptsExist = stops.length > 0;

            while (wayptsExist) {
                var subBatch = [];
                var subitemsCounter = 0;

                for (var j = itemsCounter; j < stops.length; j++) {
                    subitemsCounter++;
                    subBatch.push({
                        location: new window.google.maps.LatLng(stops[j].Geometry.Latitude, stops[j].Geometry.Longitude),
                        stopover: true
                    });
                    if (subitemsCounter == itemsPerBatch)
                        break;
                }

                itemsCounter += subitemsCounter;
                batches.push(subBatch);
                wayptsExist = itemsCounter < stops.length;
                // Boucle continue si il y a encore des points à traiter, -1 pour refaire un tour
                // Qui démarre avec le dernier point (origine de la destination)
                itemsCounter--;
            }

            // Tableau avec la liste des waypoints traités
            var combinedResults;
            var unsortedResults = [{}];
            var directionsResultsReturned = 0;

            for (var k = 0; k < batches.length; k++) {
                var lastIndex = batches[k].length - 1;
                var start = batches[k][0].location;
                var end = batches[k][lastIndex].location;

                // On retire le premier et le dernier waypoint (origin et destination de la méthode direction)
                var waypts = [];
                waypts = batches[k];
                waypts.splice(0, 1);
                waypts.splice(waypts.length - 1, 1);

                var request = {
                    origin: start,
                    destination: end,
                    waypoints: waypts,
                    travelMode: window.google.maps.TravelMode.DRIVING
                };

                (function(kk) {
                    directionsService.route(request, function(result, status) {
                        if (status == window.google.maps.DirectionsStatus.OK) {

                            var unsortedResult = {
                                order: kk,
                                result: result
                            };
                            unsortedResults.push(unsortedResult);

                            directionsResultsReturned++;

                            if (directionsResultsReturned == batches.length) // Si les directions ont toutes été traitées on les ajoute sur la map
                            {
                                // On trie le tableau de résultat précédent
                                unsortedResults.sort(function(a, b) {
                                    return parseFloat(a.order) - parseFloat(b.order);
                                });
                                var count = 0;
                                for (var key in unsortedResults) {
                                    if (unsortedResults[key].result != null) {
                                        if (unsortedResults.hasOwnProperty(key)) {
                                            if (count == 0) 
                                                combinedResults = unsortedResults[key].result;
                                            else {
                                                combinedResults.routes[0].legs = combinedResults.routes[0].legs.concat(unsortedResults[key].result.routes[0].legs);
                                                combinedResults.routes[0].overview_path = combinedResults.routes[0].overview_path.concat(unsortedResults[key].result.routes[0].overview_path);

                                                combinedResults.routes[0].bounds = combinedResults.routes[0].bounds.extend(unsortedResults[key].result.routes[0].bounds.getNorthEast());
                                                combinedResults.routes[0].bounds = combinedResults.routes[0].bounds.extend(unsortedResults[key].result.routes[0].bounds.getSouthWest());
                                            }
                                            count++;
                                        }
                                    }
                                }

                                console.log(combinedResults.routes[0].legs);
                                var legs = combinedResults.routes[0].legs;
                                var bounds = new google.maps.LatLngBounds();

                                var polyline = new google.maps.Polyline({
                                    path: [],
                                    strokeColor: '#FF0000',
                                    strokeWeight: 3
                                });

                                for (i = 0; i < legs.length; i++) {
                                    var steps = legs[i].steps;
                                    for (j = 0; j < steps.length; j++) {
                                        var nextSegment = steps[j].path;
                                        for (k = 0; k < nextSegment.length; k++) {
                                            polyline.getPath().push(nextSegment[k]);
                                            bounds.extend(nextSegment[k]);
                                        }
                                    }
                                }

                                console.log(google.maps.geometry.encoding.encodePath(polyline.getPath()));



                                directionsDisplay.setDirections(combinedResults);
                            }
                        }
                    });
                })(k);
            }
        }
    };
}