$(document).ready(function(){
    // Formulaire d'ajout d'images au slider
    if ($('#slider-form').length)
    {
        // Objet : l'id de la slide => sa position dans le slider
        var order = {};
        
        $('#slider-add').click(function(event){
            event.preventDefault();
           $('#slider-form').toggleClass('hidden');
           $(this).toggleClass('hidden');
        });
        
        $('#slider-close').click(function(event){
           event.preventDefault();
           $('#slider-form').toggleClass('hidden');
           $('#slider-add').toggleClass('hidden');
        });
        
        $('.slide .editOverlay').click(function(){
            $(this).parent().find('.form').toggleClass('hidden');
        });
        
        $('.slider-update-attr').click(function(event){
           event.preventDefault();
           var nom = $(this).parent().parent().find('input[name="nom"]').val();
           var alt = $(this).parent().parent().find('input[name="alt"]').val();
           var id = $(this).parent().parent().parent().data("id");
           
            $.ajax({
                url : "slider/updateValues",
                method : "POST",
                dataType: "json",
                async : false,
                data : {
                    id : id,
                    nom : nom,
                    alt : alt
                },
                complete : function(res){
                    $('.flash-temp').empty().show();
                    $('.flash-temp').append('<div class="flash success">Image modifée !<a href="#" id="closeFlash"><i class="fa fa-times"></i></a></div>');
                    setTimeout(function(){
                        $('.flash-temp').fadeOut();
                    }, 3500);
                }
            });
           
        });
        
        $('.slider-delete').click(function(event){
           event.preventDefault();

           if(confirm("Voulez vous vraiment supprimer cette image ?"))
           {
               var slideDiv = $(this).parent().parent().parent();
               var id = $(this).parent().parent().parent().data("id");
               
               console.log(id);
               
                $.ajax({
                    url : "slider/deleteSlide",
                    method : "POST",
                    dataType: "json",
                    async : false,
                    data : {
                        id : id
                    },
                    complete : function(res){
                        $('.flash-temp').empty().show();
                        $('.flash-temp').append('<div class="flash warning">Image supprimée !<a href="#" id="closeFlash"><i class="fa fa-times"></i></a></div>');
                        setTimeout(function(){
                            $('.flash-temp').fadeOut();
                        }, 3500);
                        
                        $(slideDiv).fadeOut(1000, function(){
                           $(this).remove(); 
                        });
                    }
                });
           }
           
        });
        
        $('.slides').sortable().bind('sortupdate', function() {
            $('.slide').each(function(){
               order[$(this).data("id")] = ($('.slide').index(this)+1);
            });

            $.ajax({
                url : "slider/updatePos",
                method : "POST",
                dataType: "json",
                async : false,
                data : {
                    order : order
                },
                complete : function(res){
                    $('.flash-temp').empty().show();
                    $('.flash-temp').append('<div class="flash success">Ordre modifié !<a href="#" id="closeFlash"><i class="fa fa-times"></i></a></div>');
                    setTimeout(function(){
                        $('.flash-temp').fadeOut();
                    }, 3500);
                }
            });
            
        });;
        
    } 
});