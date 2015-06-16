$(document).ready(function(){
    
    
    /**
     * MENU MOBILE
    */
    $("#menu_dropdown").click(function(event) {
        event.preventDefault();
        $(".menu_dropdown").slideToggle();
    })
    
    // $(window).resize(function() { 
    //   if(($(window).width() <= 600) && ($(".drop").css("display") == "none" )) {
    //       $(".drop").click(function(event) {
    //           event.preventDefault();
    //           $(this).parent("li").children("ul").slideDown();
    //       });
    //   }
    //   if(($(window).width() <= 600) && ($(".drop").css("display") == "block" )) {
    //       $(".drop").click(function(event) {
    //           event.preventDefault();
    //           $(this).parent("li").children("ul").slideUp();
    //       });
    //   }
    // });
    

    
    /**
     * NAVIGATION RAPIDE 
    */
    
    $(".block-cat").hover(function() {
        $(".actif").removeClass("active");
    }, function() {
        $(".actif").addClass("active");
    });
    
    $(".block-cat").click(function() {
        // switch onglet
        $(".actif").removeClass("active");
        $(".actif").removeClass("actif");
        $(this).addClass("active");
        $(this).addClass("actif");
        
        // switch block
        $(".block-navigation-inset").removeClass("active");
        $("."+$(this).attr('id')).addClass("active"); //<- technique PGM
        
        if($(this).attr('id') == "home"){
            $(".dot").css('visibility', 'visible');
        }
        else{
            $(".dot").css('visibility', 'hidden');
        }
    });
    
    
    
    $(".drop-list").hover(function() {
        $(this).parent("li").children("a").addClass("active");
    }, function() {
        $(this).parent("li").children("a").removeClass("active");
    });
    
    if($(window).width() >= 671) {
        dropDownNav();
    } else {
        createElements();
         $(".drop-title").click(function(event) {
            event.preventDefault();
            $(this).parent("li").children("ul").slideToggle();
        });
    }
    
    $(window).resize(function() {
        if($(window).width() >= 671){
            dropDownNav();
            if(!$(".menu_dropdown").is(':visible')) {
                $(".menu_dropdown").show()
            }
            
        } else {
            if($(".menu_dropdown").is(':visible')) {
                $(".menu_dropdown").hide()
            }
        }
        createElements();
    });
    
    function dropDownNav() {
        $(".drop").hover(function() {
            $(this).parent("li").children("ul").show();
        }, function() {
            $(this).parent("li").children("ul").hide();
        });
        
    }
    
    /**
     * MESSAGE FLASH 
    */
    
    $("#closeFlash").click(function(event) {
        event.preventDefault();
        $(".flash").fadeOut();
    });
    
    
    /**
     * Boutons mobile
     */
     function createElements() {

		if (($(window).width() > 671) && ($("#mob_content").length)){
			$("#mob_content").remove();
		}
		if(($(window).width() <= 671) && (!$("#mob_content").length)) {
			$("#page_accueil").prepend(
				$("<div></div>")
				.attr('id', 'mob_content')
				.prepend($("<a></a>")
					.addClass("mob_button")
					.attr({id: "button_path", href: "/back-office/public/recherchetrajet"})
					.prepend($("<span></span>")
					    .text("Rechercher un trajet"))
					.prepend($('<img>')
						.attr('src', '/back-office/public/img/button_path.png')
						))
				.prepend($("<a></a>")
					.addClass("mob_button")
					.attr({id: "button_time", href: "/back-office/public/recherchehoraire"})
					.prepend($("<span></span>")
					    .text("Rechercher un horaire"))
					.prepend($('<img>')
						.attr('src', '/back-office/public/img/button_time.png')
						))
				.prepend($("<div></div>")
					.attr('id', 'download_buttons')
					.prepend($("<span></span>")
					    .text("Téléchargez l'application"))
					.prepend($("<a></a>")
						.attr('href', '#')
						.append($('<img>')
							.attr('src', '/back-office/public/img/dowload_apple.png'))
						)
					.prepend($("<a></a>")
						.attr('href', '#')
						.append($('<img>')
							.attr('src', '/back-office/public/img/dowload_googleplay.png'))
						))
				);
		}
	}
    
    /**
    *   Content Type
    */

    $("#title-search-itiniraire").click(function() {
        $("#block-search-itiniraire").slideDown()
        $("#block-search-horaire").slideUp()
    })
    
    $("#title-search-horaire").click(function() {
        $("#block-search-itiniraire").slideUp()
        $("#block-search-horaire").slideDown()
    })
    
    $(".infos-trafic").click(function() {
        $(".infos-trafic").addClass("active");
        $(".infos-actu").removeClass("active");
    });
    
    $(".infos-actu").click(function() {
        $(".infos-actu").addClass("active");
        $(".infos-trafic").removeClass("active");
    });
    
    /**
     * EDITEURS WYSIWYG
    */
    
    if($('#contenuQuestion').length)
    {
        CKEDITOR.replace('contenuQuestion', {
            toolbar: 
                        [
                    		[ 'Cut', 'Copy', 'Undo', 'Redo' ],			// Defines toolbar group without name.
                    		'/',																					// Line break - next group will be placed in new line.
                    		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	                    ]
        });
    }
    
    /**
     * SLIDER 
    */
    if($('.home').length)
    {
        $('.home').unslider({
            speed : 600,
            delay : 4000,
            dots : true
        });
        // $('.bxslider').bxSlider();
    
        $('.home').width("100%");
    }
    
    
    /**
     * QUESTIONS FAQ & CATEGORIES LIEUX
     */
     
    if($('.block-question').length)
    {
        $('.block-question').click(function(){
           $(this).find('.answer').slideToggle();
           $(this).find('.question-icon').toggleClass('fa-plus');
           $(this).find('.question-icon').toggleClass('fa-minus');
        });
    }
    
    /**
     * MAP DYNAMIQUE LIEUX
     */
     
    if($('.block-lieu h2').length)
    {
        $('.block-lieu h2').click(function(){
          $(this).parent().find('.answer, .nomLieu').slideToggle();
          $(this).parent().find('.question-icon').toggleClass('fa-plus');
          $(this).parent().find('.question-icon').toggleClass('fa-minus');
        });
    }
    
    
    var map, marker;
    var pathname = window.location.pathname.substring(window.location.pathname.lastIndexOf("/")+1, window.location.pathname.length);
    if(pathname == "lieux"){
        $(function() {
            var mapOptions = {
              center: { lat: 44.5667, lng: 6.0833},
              zoom: 18,
             };
             map = new google.maps.Map(document.getElementById('map-lieu'), mapOptions);
             
        });
        
        function resizeMap(){
            google.maps.event.trigger(map,'resize');
            map.setZoom( map.getZoom() );
        }
        
    }
    
    $(".nomLieu").click(function(e) {
        //MARQUEUR DE LA MAP
        e.stopPropagation();
        var latitude = parseFloat($(this).data("lat"));
        var longitude = parseFloat($(this).data("long"));
        
        if(marker != undefined)
            marker.setMap(null);
        
        marker = new google.maps.Marker({
          position: { lat: latitude, lng: longitude},
          map: map,
         });
        marker.setMap(map);


        $("#nomLieu").html($(this).text());
        $("#popup").show(); 
        resizeMap();
        map.setCenter(new google.maps.LatLng(latitude, longitude));
    });
    
    $(".close-popup").click(function() {
       $("#popup").hide(); 
       
    });
    
    $("#popup").click(function(e){
        e.stopPropagation();
    });
    
    $("body").click(function(){
        $("#popup").hide();
    });

    /**
     * DATEPICKER
     */
     
  $('#dateA, #dateL').glDatePicker({
      cssName : 'flatwhite',
      calendarOffset: { x: 0, y: 1 },
        onClick: function(target, cell, date, data) {
            
            var dd = date.getDate();
            var mm = date.getMonth()+1;
            var yyyy = date.getFullYear();
            
            if(dd < 10) dd = '0'+dd;
            if(mm < 10) mm = '0'+mm;
            
            target.val(dd+'-'+mm+'-'+yyyy);
    
            if(data != null) {
                alert(data.message + '\n' + date);
            }
        }
  });

    /**
     * AUTOCOMPLETE ARRETS ET LIGNES
     */
    var arrets = ["Academie","Albert borel","Alp'arena","Aristide briand","Av. d'embrun","Bd d'orient","Beauchateau","Bel air","Bel aure","Bellevue","Bonne","Bonneval","Bosquet","Camargue","Carrefour de st jean","Carrefour du senateur","Chabanas","Chabrieres","Chabrieres  1","Chabrieres  2","Champ de trente","Champ forain","Champsaur","Chapelle de charance","Chateau laty","Chaudefeuille","Chemin des vignes","Cimetiere st roch","Claree","Clinique","College de fontreyne","Commerce","Desmichels","Drac","Du lac","Ecole beauregard","Ecole bellevue","Ecole des eyssagnieres","Ecole puymaure","Ecole tourronde","Ecole villarobert","Eglise st roch","Emile zola","Europe","Faure du serre 1","Faure du serre 2","Ferme blanche","Ferme de l'hopital","Flodanche","Florian","Foyer de fontreyne","Gare s.n.c.f.","Gare sncf","Graffinel","Guillaume farel","Guisane","Gymnase lafaille","Hameau de puymaure","Hauteville","Hopital","Hopital l'adret","Impasse sixtine","Jaures","Jean mace","Kapados","La chenaie","La commanderie","La descente","La durance","La glaciere","La justice","La luye","La romettine","La selle","La source","La tourronde","La tourronde 1","La tourronde 2","Lachaup","Ladoucette","Lareton","Le bas collet","Le bois st jean","Le buzon","Le chaffal","Le chateau d'eau","Le clos de charance","Le collet","Le pavillon","Le rigodon","Le rio","Le riotord","Le rochasson","Le st pascal","Le torrent de la selle","Le turrelet","Le vieux chemin","Le villard","Les 4 vents","Les abadous","Les bruyeres","Les buissonnets","Les castors","Les cedres","Les cheminots","Les chenes","Les ecrins","Les emeyeres","Les fangerots","Les farelles","Les fauvins","Les genets","Les gontiers","Les gourlanche","Les gourlanches","Les grandes terres","Les lacets","Les lauriers","Les lilas","Les marronniers","Les metiers","Les pins","Les pinsons","Les poncets","Les pres","Les silos","Les terrasses","Les thermes","Les tilleuls","Les tourterelles","Les vergers","Les vigneaux","Lesdiguieres","Lycee agricole","Madeleine","Mairie de romette","Maison de la sante au travail","Mediatheque-theatre","Mermoz","Micropolis","Molines","Montclair","Moulin du pre","Nestle","Parassac","Parc du ch?teau","Parc st joseph","Patac","Pervenches","Pignerol","Pole universitaire","Pompidou","Pont blanc","Pont sarrazin","Porte colombe","Roland garros","Romette pre mongil","Rousine","Route du colombis","Rte des pres","Rte du col de manse","Sabbat","Saint-jean","Sainte-marthe","Services techniques","Serviolan","Sevigne","Soleil levant","St exupery","Stade","Stade nautique","Ste marguerite","Tavanet","Tokoro","Tournefave","Treschatel","Val du plan","Verdun","Viaduc","Villeneuve"];
    var lignes = ["1 - Serviolan <> Bonneval", "2 - Molines <> Lesdiguieres", "3 - Les près <> Romette", "4 - Tokoro <> Saint Jean", "5 - Les Emeyeres <> Pôle Universitaire", "6 - La Luye <> Tournefave", "7 - Faure du Serre <> Parassac", "8 - La Justice <> Les Grandes Terres", "9 - Centre Ville <> Romette"];
    var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};
    
$('#arret').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'arrets',
  displayKey: 'value',
  source: substringMatcher(arrets)
});

$('#ligne').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'lignes',
  displayKey: 'value',
  source: substringMatcher(lignes)
});

    
    /**
     * ICI C'EST LE BORDEL
    */
    
    $("#cat").dblclick(function() {
        $("*").addClass("fa-spin");
    })
    
    $("#lapin").dblclick(function() {
        $("body").addClass("fa-rotate-180");
    });
    
    $("#doge").dblclick(function() {
        $("body").css({'background' : 'url("/back-office/public/img/doges.jpg") center center repeat-x fixed'});
        console.log("Such easter, very egg, wow.")
    });
    
    
    
    
    $("#princess").dblclick(function() {var dx = new Array(), xp = new Array(), yp = new Array();
        var am = new Array(), stx = new Array(), sty = new Array();
        var i;
        var larg_fenetre = (document.body.offsetWidth<window.innerWidth)? window.innerWidth:document.body.offsetWidth;
        var haut_fenetre = (document.body.offsetHeight<window.innerHeight)? window.innerHeight:document.body.offsetHeight;
        
        for (i = 0; i < 40; i++) { 
            dx[i] = 0;
            xp[i] = Math.random()*(larg_fenetre-40);
            yp[i] = Math.random()*haut_fenetre;
            am[i] = Math.random()*20;
            stx[i] = 0.02 + Math.random()/10;
            sty[i] = 0.7 + Math.random();
            
            var obj = document.getElementsByTagName('body')[0];
            var para = document.createElement("img");
            para.setAttribute("src","img/etoile.gif");
            para.setAttribute("id","dot" + i);
            para.style.position = "absolute";
            para.style.zIndex = "2";
            obj.appendChild(para);
        }
        
        function neige() {
            for (i = 0; i < 40; i++) {
                dx[i] += stx[i];
                yp[i] += sty[i];
                if (yp[i] > haut_fenetre-50) {
                    xp[i] = Math.random()*(larg_fenetre-am[i]-40);
                    yp[i] = 0;
                }
                document.getElementById("dot"+i).style.top = yp[i] + "px";
                document.getElementById("dot"+i).style.left = xp[i] + am[i]*Math.sin(dx[i]) + "px";
            }
            setTimeout(neige, 10);
        }
        neige();
    });

});