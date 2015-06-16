$(document).ready(function(){
    
                    /******************************
                     *      INITIALISATION        *
                     *  Var globales et appels    *
                     * ****************************/
var arrets, infowindow, markerUser = null;
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
    zoom: 16,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    streetViewControl: false,
    styles : mapStyles
};
var map = new google.maps.Map(document.getElementById('map'),mapOptions);

var iconeArret = {
    url : 'img/iconeArret.png',
    size: new google.maps.Size(16, 17)
}

var iconeBus = {
    url : 'img/iconeBus.png',
    size: new google.maps.Size(24, 26)
}

var iconeAlerte = {
    url : 'img/iconeAlerte.png',
    size: new google.maps.Size(24, 26)
}

var iconeUser = {
    url : 'img/iconeUser.png',
    size : new google.maps.Size(24, 26)
}

createArrets();
createAlertes();
createLignes();
createBus();
createUser();

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

function createArrets(){
  // Requête AJAX récupérations des 300 arrêts
  $.ajax({
      url: "plan/arrets",
      async: false,
      success: function(res) {
          // Création des marqueurs
          var arrets = res;
          for (var i in arrets) {
              var pos = new google.maps.LatLng(arrets[i].latArret, arrets[i].longArret);
              markersArrets[i] = new google.maps.Marker({
                  position: pos,
                  map: map,
                  icon: iconeArret,
                  title: arrets[i].nomArret,
                  opacity: 0.75
              });
              // Ajout des marqueurs sur la map
              markersArrets[i].setMap(map);
              
                google.maps.event.addListener(markersArrets[i], 'click', function(event) {
    
                clearInfoWindow();
    
                // Création de la nouvelle fenêtre
                infowindow = new google.maps.InfoWindow({
                    position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                    content: "<div class='info-map-container'><span class='info-map-id'>" + this.title + "</span><a href='http://bus-gap-exilz.c9.io/back-office/public/find?findA=true&arret=" + this.title + "' target='_blank' class='info-map-name center'>Voir les horaires</a></span></div>",
                    maxWidth: 200
                });
    
                // Ouverture de la nouvelle fenêtre
                infowindow.open(map);
          });
        }
    }
  });
}

// Mise à jour de la position de l'utilisateur sur mobile
function createUser(){
    setInterval(function (){
        if(markerUser == null){
            console.log("null");
            var mobilecheck = 
            function() {
                var check = false;
                (function(a,b){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
                return check;
            }
            
            // Si on est sur mobile
            if(mobilecheck()){
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showUserPosition);
                    }
                    function showUserPosition(position) {
                        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        console.log(pos);
                        markerUser = new google.maps.Marker({
                                                position: pos,
                                                map: map,
                                                icon: iconeUser,
                                                opacity: 1
                                            });
                        markerUser.setMap(map);
                    }
            }
        }else{
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(updateUserPosition);
                    }
                    function updateUserPosition(position) {
                        console.log("updateUser");
                        var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                        markerUser.setPosition(pos);
                    }
        }
        
        
    }, updateDelay);
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

// Ajoute un marqueur bus sur la map
function createMarkerBus(service, pos){
    markersBus[service] = new google.maps.Marker({
                        position: pos,
                        map: map,
                        icon: iconeBus,
                        opacity: 1,
                        service : service
                    });
    markersBus[service].setMap(map);
    
    // Création infowindow clic sur bus
    google.maps.event.addListener(markersBus[service], 'click', function(event) {
        
        var prochainArret, direction;
        
        $.ajax({
            url : "plan/busInfos",
            method : "GET",
            async : false,
            data : {
                service : service
            },
            success : function(res){
                direction = res[0];
                prochainArret = res[1];
                
                if(!prochainArret)
                    prochainArret = "Terminus";
            }
        });

        // Fermeture et suppresion en mémoire de la précédente pop-up
        clearInfoWindow();

        // Création de la nouvelle fenêtre
        infowindow = new google.maps.InfoWindow({
            position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
            content: "<div class='info-map-container'><span class='info-map-id'>Prochain arrêt :<br/>" + prochainArret + "</span><span class='info-map-direction'>Direction :<br/>" + direction + "</span></div>",
            maxWidth: 330,
            service : service
        });
        
        // Ouverture de la nouvelle fenêtre
        infowindow.open(map);
    });
    
    console.log("Bus " + service + " ajouté !");
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

// Crée les bus la première fois puis lance la routine de mise à jour
function createBus(){
    $.ajax({
        url : "plan/bus",
        async : false,
        success : function(res){
            var bus = res;
            for(var i in bus){
                if(i != "_indexOf"){
                    var pos = new google.maps.LatLng(bus[i].latitude, bus[i].longitude);
                    createMarkerBus(i, pos);
                }
            }
        }
    });
    
    // Routine de mise à jour des positions des bus
    setInterval(
        function updateBus(){
            console.log("màj");
            $.ajax({
                url : "plan/bus",
                async : false,
                success : function(res){
                    var bus = res;
                    // On vérifie que chaque marqueur est présent dans le retour JSON
                    // Si il n'y est pas, on supprime le marqueur
                    for(var i in markersBus){
                        // On ignore l'extension du prototype par l'autre bibliotheque
                        if(i != "_indexOf"){
                            if(bus[i] !== undefined)
                                console.log("Bus " + i + "ok !");
                            else
                                deleteMarkerBus(i);
                        }
                        
                    }
                    
                    for(var i in bus){
                        var pos = new google.maps.LatLng(bus[i].latitude, bus[i].longitude);
                        
                        // On vérifie si le bus trouvé en JSON est dans les marqueurs crées
                        // Si il n'y est pas, on ajoute un marqueur
                        // Sinon, on met à jour sa position
                        if(markersBus[i] === undefined){
                            createMarkerBus(i, pos);
                        }else if(i != "_indexOf"){
                            markersBus[i].setPosition(pos);
                            // Déplacement de l'infowindow en mm tps si celle ouverte correspond au bus parcouru
                            if(infowindow != null){
                                if(infowindow.service != undefined){
                                    if(infowindow.service == i)
                                        infowindow.setPosition(pos);
                                }
                            }
                            
                        }
                    }
                    
                    
                }
            });
        
    }, updateDelay);
    
}

// Routine de mise à jour des pop-ups (direction et prochains arrets)
setInterval(
    function updatePopUpBus(){
        // Si une pop-up est ouverte et que celle-ci est celle d'un bus (= a un service)
        if(infowindow != null){
            if(infowindow.service != undefined){
                var prochainArret, direction;
                
                // Requête AJAX et modification du contenu
                $.ajax({
                    url : "plan/busInfos",
                    method : "GET",
                    async : false,
                    data : {
                        service : infowindow.service
                    },
                    success : function(res){
                        direction = res[0];
                        prochainArret = res[1];
                        
                        if(!prochainArret)
                            prochainArret = "Terminus";
            
                    }
                });
                
                infowindow.setContent("<div class='info-map-container'><span class='info-map-id'>Prochain arrêt :<br/>" + prochainArret + "</span><span class='info-map-direction'>Direction :<br/>" + direction + "</span></div>");
                
            }
        }
    }, updateDelay);


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
FullScreenControl(map, "Passer en plein écran",
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
    var originalOverflow = bodyStyle.overflow;
    controlDiv.goFullScreen = function () {
        
        $('.map-fullscreen-overlay').show();
        var center = map.getCenter();
        mapDiv.style.position = "fixed";
        mapDiv.style.width = "100%";
        mapDiv.style.height = "100%";
        mapDiv.style.top = "0";
        mapDiv.style.left = "0";
        mapDiv.style.zIndex = "100";
        document.body.style.overflow = "hidden";
        controlText.innerHTML = "<strong>" + exitFull + "</strong>";
        fullScreen = true;
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    };
    controlDiv.exitFullScreen = function () {
        var center = map.getCenter();
        $('.map-fullscreen-overlay').hide();
        if (originalPos === "") {
            mapDiv.style.position = "relative";
        }
        else {
            mapDiv.style.position = originalPos;
        }
        mapDiv.style.width = originalWidth;
        mapDiv.style.height = originalHeight;
        mapDiv.style.top = originalTop;
        mapDiv.style.left = originalLeft;
        mapDiv.style.zIndex = originalZIndex;
        document.body.style.overflow = originalOverflow;
        controlText.innerHTML = "<strong>" + enterFull + "</strong>";
        fullScreen = false;
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    };
    // Clic sur le bouton passage en plein écran de la map
    google.maps.event.addDomListener(controlUI, "click", function () {
        if (!fullScreen) {
            controlDiv.goFullScreen();
        }
        else {
            controlDiv.exitFullScreen();
        }
    });
    return controlDiv;
}


});