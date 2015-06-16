$(document).ready(function(){
    
    //panel overlay
    
    $(".panel-arrow").click(function() {
        if($(this).hasClass("fa-chevron-left")){
            $(this).addClass("fa-chevron-right");
            $(this).removeClass("fa-chevron-left");
            $("#overlay-admin").animate({
                left: -200
            },500);
            
        } else {
            $(this).addClass("fa-chevron-left");
            $(this).removeClass("fa-chevron-right");
            $("#overlay-admin").animate({
                left: 0
            },500);
        }
        
    });
    
    // Compteur longueur résumé actualité / info trafic
    if ($('#resume').length)
    {
        updateCount();
        
        function updateCount(){
            var length = 255 - $('#resume').val().length;
            $('#resumeLength').text("Caractères restants : " + length);
            if(length < 0){
                $('#resumeLength').css('color', 'red');
            }else{
                $('#resumeLength').css('color', 'black');
            }
        }
        
        $('#resume').keydown(function(){ updateCount(); });
        $('#resume').change(function(){ updateCount(); });
    }
    
    // Confirmation lors de la suppresion actualité / info trafic
    if ($('.delete').length)
    {
        $('.delete').click(function(event){
           event.preventDefault();
           if(confirm("Voulez vous vraiment supprimer cet élément ?"))
           {
               window.location.href = $(this).attr('href');
           }
        });
    }
    
    $("#closeFlash").click(function(event) {
        event.preventDefault();
        $(".flash").fadeOut();
    });
    
    
});