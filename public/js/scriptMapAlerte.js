$(document).ready(function(){
    
    if($('#map').length)
    {
        var map = new google.maps.Map(document.getElementById('map'));
        
        // Récupération des précédentes valeurs dans le champ si définies pour replacer le marqueur
        // Sinon valeurs par défaut au centre de Gap
        var prevLat = ($('#latitude').val() != "") ? $('#latitude').val() : "44.5589007";
        var prevLon = ($('#longitude').val() != "") ? $('#longitude').val() : "6.077607";
    
        var pickerMap = $('input[name="adresse"]' ).addresspicker({
              appendAddressString: ", 05000, Gap, France",
              draggableMarker: true,
              regionBias: null,
              updateCallback: updateCallback,
              reverseGeocode: false,
              autocomplete: 'default',
              mapOptions: {
                  zoom: 15,
                  center: new google.maps.LatLng(prevLat, prevLon),
                  scrollwheel: true,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
              },
              elements: {
                  map: "#map",
                  lat: '44.55994036128737',
                  lng: '6.086962650848363',
                  country: "France",
                  postal_code: "05000",
                  type: false
              }
            });
            
            // Création du marqueur déplacable
            var gmarker = pickerMap.addresspicker( "marker");
            gmarker.setVisible(true);
            pickerMap.addresspicker( "updatePosition");
            
            // Evenement lors du déplacement du marqueur
            google.maps.event.addListener(gmarker, 'dragend', function(event) { 
                updateFields(event.latLng.lat(), event.latLng.lng());
            });
    
            // Met à jour les champs
            function updateFields(lat, lon){
                $('#latitude').val(lat);
                $('#longitude').val(lon);
            }
    
            // Evenement lorsqu'on entre une adresse directement
            function updateCallback(geocodeResult, parsedGeocodeResult){
                updateFields(parsedGeocodeResult.lat, parsedGeocodeResult.lng);
            }
    }
    
});
