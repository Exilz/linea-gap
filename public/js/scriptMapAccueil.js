$(document).ready(function(){
    
                    /******************************
                     *      INITIALISATION        *
                     *  Var globales et appels    *
                     * ****************************/
var arrets, infowindow = null;
var arretsVisibles = true, legendeVisible = true;
var markersArrets = [], markersBus = [], markersAlertes = [], encodedPolyLines = [], polylines = [];
var updateDelay = 10000; // Délai de mise à jour

// Désactivation des POI sur la map
var mapStyles =[
    {
        featureType: "poi",
        elementType: "labels",
        stylers: [
              { visibility: "off" }
        ]
    }
];
var mapOptions = {
    center: { lat: 44.559097, lng: 6.078399},
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    streetViewControl: false,
    styles : mapStyles
};
var map = new google.maps.Map(document.getElementById('map'),mapOptions);



var iconeAlerte = {
    url : 'img/iconeAlerte.png',
    size: new google.maps.Size(24, 26)
}


createAlertes();
createLignes();



                    /******************************
                     *          FONCTIONS         *
                     * ****************************/

// Rendimensionnement du navigateur
function resizeHandler(){
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center); 
}
    
// Clic nom ligne navigation
function changeLigne(idLigne){
    for(var i = 0; i < polylines.length; i++){
        (polylines[i]['idLigne'] != idLigne) ? polylines[i].setMap(null) : polylines[i].setMap(map);
    }
}

// Affiche toutes les lignes
function resetLignes(){
    for(var i = 0; i < polylines.length; i++){
        polylines[i].setMap(map);
    }
}


function createAlertes(){
   // Requête AJAX récupérations des alertes traffic
   $.ajax({
       url : "infostrafic/json",
       async: false,
       success : function(res) {
           // Création des marqueurs
           var alertes = res;
           for (var i in alertes) {
              var pos = new google.maps.LatLng(alertes[i].latitude, alertes[i].longitude);
              markersAlertes[i] = new google.maps.Marker({
                  position: pos,
                  map: map,
                  icon: iconeAlerte,
                  title: alertes[i].titreAlerte,
                  slug : alertes[i].slug,
                  opacity: 0.75
              });
              // Ajout des marqueurs sur la map
              markersAlertes[i].setMap(map);
              
            google.maps.event.addListener(markersAlertes[i], 'click', function(event) {
    
                clearInfoWindow();
    
                // Création de la nouvelle fenêtre
                infowindow = new google.maps.InfoWindow({
                    position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                    content: "<div class='info-map-container'><span class='info-map-id'>" + this.title + "</span><a href='http://bus-gap-exilz.c9.io/back-office/public/infostrafic/" + this.slug + "' target='_blank' class='info-map-name center'>Lire plus...</a></span></div>",
                    maxWidth: 200
                });
    
                // Ouverture de la nouvelle fenêtre
                infowindow.open(map);
          });
              
           }
       }
   })
}

function createLignes() {
    // Requête AJAX récupération des lignes
    $.ajax({
        url: "plan/lignes",
        async: false,
        success: function(res) {
            var lignes = res;
            console.log(lignes);
            for (var i in lignes) {
                encodedPolyLines.push({
                    'numero': lignes[i].numero,
                    'idLigne': lignes[i].idLigne,
                    'name': lignes[i].libelleLigne,
                    'polyline': lignes[i].polyline,
                    'color': lignes[i].couleurLigne
                });
            }
        }
    });
    // Création des lignes
    // note : on parcourt length-1 car le prototype est étendu par je ne sais quelle p*tain de bibliothèque (bug undefined)
    for (var i = 0; i < encodedPolyLines.length-1; i++) {
        var encodedPolyline = google.maps.geometry.encoding.decodePath(encodedPolyLines[i].polyline);
        polylines.push(new google.maps.Polyline({
            path: encodedPolyline,
            geodesic: true,
            strokeColor: encodedPolyLines[i].color,
            strokeOpacity: 0.8,
            strokeWeight: 3.5
        }));

        polylines[i]['idLigne'] = encodedPolyLines[i].idLigne;
        polylines[i]['numero'] = encodedPolyLines[i].numero;
        polylines[i]['name'] = encodedPolyLines[i].name;
        polylines[i].setMap(map);
        google.maps.event.addListener(polylines[i], 'click', function(event) {

           clearInfoWindow();

            // Création de la nouvelle fenêtre
            infowindow = new google.maps.InfoWindow({
                position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                content: "<div class='info-map-container'><span class='info-map-id'>Ligne " + this.numero + "</span><span class='info-map-name'>" + this.name + "</span><span class='info-map-horaires'><a href='findL/"+this.numero+"' target='_blank'>Consulter les horaires</a></span></div>",
                maxWidth: 300
            });

            // Ouverture de la nouvelle fenêtre
            infowindow.open(map);
        });
    }
}


// Fermeture et suppresion en mémoire de la précédente pop-up
function clearInfoWindow(){
    if (infowindow != null){
        infowindow.close();
        infowindow = null;
    }
}

// Supprime un marqueur bus de la map
function deleteMarkerBus(service){
    markersBus[service].setMap(null);
    markersBus.splice(service, 1);
    
    // Fermeture de l'infowindow si ouverte
    if(infowindow != null){
        if(infowindow.service != undefined){
            if(infowindow.service == service)
                infowindow.close();
        }
    }
    console.log("Bus " + service + " supprimé !");
}

                   /******************************
                     *          EVENEMENTS        *
                     *  jQuery et Google Maps API *
                     * ****************************/

// Appel du resizeHandler au redimmensionnement
google.maps.event.addDomListener(window, "resize", function() {
    resizeHandler();
});

// Clic changement ligne
$('.changeLigne').click(function(){
   var id = $(this).attr('data-idLigne');
   changeLigne(id);
});

// Clic "afficher toutes les lignes"
$('.resetLignes').click(function(){
   resetLignes(); 
});

// Clic "afficher/cacher les arrêts"
$('.toggleArrets').click(function(){
    if(arretsVisibles){
        for(var i in markersArrets){markersArrets[i].setMap(null);}
        arretsVisibles = false;
    }else{
        for(var i in markersArrets){markersArrets[i].setMap(map);}
        arretsVisibles = true;
    }
});

                    /******************************
                     *          FULLSCREEN        *
                     * ****************************/

// Ajout des contrôles sur la map
map.controls[google.maps.ControlPosition.TOP_RIGHT].push(
FullScreenControl(map, "Voir le plan intéractif",
"Quitter le plein écran"));

function FullScreenControl(map, enterFull, exitFull) {
    
    // Touche échap pour quitter le plein écran
    $(document).keyup(function(e) {
      if (e.keyCode == 27 && fullScreen) controlDiv.exitFullScreen();
    });
    
    // Passage en plein écran avec l'icone FA
    $('.map-fullscreen').click(function(){
        controlDiv.goFullScreen();
    });
    
    if (enterFull === void 0) { enterFull = null; }
    if (exitFull === void 0) { exitFull = null; }
    if (enterFull == null) {
        enterFull = "Full screen";
    }
    if (exitFull == null) {
        exitFull = "Exit full screen";
    }
    var controlDiv = document.createElement("div");
    controlDiv.className = "fullScreen";
    controlDiv.index = 1;
    controlDiv.style.padding = "5px";
    // Set CSS for the control border.
    var controlUI = document.createElement("div");
    controlUI.style.backgroundColor = "white";
    controlUI.style.borderStyle = "solid";
    controlUI.style.borderWidth = "1px";
    controlUI.style.borderColor = "#717b87";
    controlUI.style.cursor = "pointer";
    controlUI.style.textAlign = "center";
    controlUI.style.boxShadow = "rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px";
    controlDiv.appendChild(controlUI);
    // Set CSS for the control interior.
    var controlText = document.createElement("div");
    controlText.style.fontFamily = "Roboto,Arial,sans-serif";
    controlText.style.fontSize = "11px";
    controlText.style.fontWeight = "400";
    controlText.style.paddingTop = "1px";
    controlText.style.paddingBottom = "1px";
    controlText.style.paddingLeft = "6px";
    controlText.style.paddingRight = "6px";
    controlText.innerHTML = "<strong>" + enterFull + "</strong>";
    controlUI.appendChild(controlText);
    // set print CSS so the control is hidden
    var head = document.getElementsByTagName("head")[0];
    var newStyle = document.createElement("style");
    newStyle.setAttribute("type", "text/css");
    newStyle.setAttribute("media", "print");
    var cssText = ".fullScreen { display: none;}";
    var texNode = document.createTextNode(cssText);
    try {
        newStyle.appendChild(texNode);
    }
    catch (e) {
        newStyle.styleSheet.cssText = cssText;
    }
    head.appendChild(newStyle);
    var fullScreen = false;
    var mapDiv = map.getDiv();
    var divStyle = mapDiv.style;
    if (mapDiv.runtimeStyle) {
        divStyle = mapDiv.runtimeStyle;
    }
    var originalPos = divStyle.position;
    var originalWidth = divStyle.width;
    var originalHeight = divStyle.height;
    if (originalWidth === "") {
        originalWidth = mapDiv.style.width;
    }
    if (originalHeight === "") {
        originalHeight = mapDiv.style.height;
    }
    var originalTop = divStyle.top;
    var originalLeft = divStyle.left;
    var originalZIndex = divStyle.zIndex;
    var bodyStyle = document.body.style;
    if (document.body.runtimeStyle) {
        bodyStyle = document.body.runtimeStyle;
    }
    
    
    // Clic sur le bouton passage en plein écran de la map
    google.maps.event.addDomListener(controlUI, "click", function () {
        if (!fullScreen) {
            document.location.href="/back-office/public/plan"
        }
    });
    return controlDiv;
}


});