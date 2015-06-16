$(document).ready(function(){
   
    var direction = 1;
    var scrollDistance = 400;
    var animDelay = 250;
   
    var navigation = $('.navigation');
    
    if(navigation.length)
        var navTop = navigation.offset().top - parseFloat(navigation.css('margin-top').replace(/auto/, 0));
    
    $(window).scroll(function (event) {
      var y = $(this).scrollTop()
      if (y >= navTop) {
        navigation.addClass('fixedTopNav');
      } else {
        navigation.removeClass('fixedTopNav');
      }
    });
   
   function change_nav() {
       if ($(window).width() <= 671){
    		$(".changeLigne").html("<i class=\"fa fa-search\"></i> Chercher");
    		$(".changeDirection").html("<i class=\"fa fa-arrows-v\"></i> Sens");
    	}
    	else {
    	    $(".changeLigne").html("<i class=\"fa fa-search\"></i> Nouvelle recherche");
    		$(".changeDirection").html("<i class=\"fa fa-arrows-v\"></i> Changer la direction");
    	}
   }
   
   change_nav();
   
   $(window).resize(function() {
        change_nav();
   });
   
   $('.changeDirection').click(function(){
        if(direction == 1){
            $('.nomAller').hide();
            $('.nomRetour').show();
            $('.changeDirection').attr('data-direction', "2");
            direction = 2;
        }else{
            $('.nomAller').show();
            $('.nomRetour').hide();
            $('.changeDirection').attr('data-direction', "1");
            direction = 1;
        } 
        
      $('.aller').toggleClass('hidden');
      $('.retour').toggleClass('hidden');
   });
   
   $('.changeLigne').click(function(){
      $('.block-search').toggleClass('hidden'); 
   });
    
    $('.scrollRight').click(function(){
        var leftPos = $('.aller, .retour').scrollLeft();
        $(".aller, .retour").animate({scrollLeft: leftPos + scrollDistance}, animDelay);
    });  
    
    $('.scrollLeft').click(function(){
        var leftPos = $('.aller, .retour').scrollLeft();
        $(".aller, .retour").animate({scrollLeft: leftPos - scrollDistance}, animDelay);
    });  

});