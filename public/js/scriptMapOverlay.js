$(document).ready(function(){

	$(window).resize(function() { 

		if($(window).width() > 671) {
    	    $(".ligne-overlay").hide();
    	    $(".map-fullscreen-overlay").css('left', '0px');
    	}
    	else {
    		$(".ligne-overlay").show();
    	}
	});	

	if($(window).width() > 671) {
    	    $(".ligne-overlay").hide();
    	    $(".map-fullscreen-overlay").css('left', '0px');
    	}
   	else {
   		$(".ligne-overlay").show();	
    }

    $(".ligne-overlay").click(function(event) {
		if($(".map-fullscreen-overlay").css('left') == "0px" ) {
				$(".map-fullscreen-overlay").animate({left: '-290px'});
				$(".ligne-overlay").html("<i class=\"fa fa-chevron-right\"></i>");
		}
		else if($(".map-fullscreen-overlay").css('left') != "0px" ){
				$(".map-fullscreen-overlay").animate({left: '0px'});
				$(".ligne-overlay").html("<i class=\"fa fa-chevron-left\"></i>");
		}
    });


});