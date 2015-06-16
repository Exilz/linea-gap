$(document).ready(function(){
   var nbCol = 2;
   var nbLigne = 1;
   var updating = false;
   var idLigne = $('#ligne').data('idligne');
   var idTypeSemaine = $('#typeSemaine').data('typesemaine');

   $(".addLine").click(function() {
        var upper = $(this).parents("tr");
        upper.after(newLigne(upper.data("num-ligne") + 1))
        nbLigne++;
    });
    
    function changeHoraire(selectedHoraire){
        if(updating){
            if(confirm("Êtes vous sûr ?")){
                course = $('#updateField').parent().index();
                nomArret = $('#updateField').parents("tr").find('.arret').attr('title');
                sens = $('.changeDirection').attr('data-direction');
                
                $.ajax({
                    url: "update",
                    async: false,
                    type : "POST",
                    data : {
                        idLigne : idLigne,
                        idTypeSemaine : idTypeSemaine,
                        course : course,
                        nomArret : nomArret,
                        sens : sens
                    },
                    success: function(res) {
                        console.log(res);
                    }
                });
                
                
                $('#updateField').parent().html($('#updateField').val());
                updating = false;
            }else{
                $('#updateField').parent().html(selectedHoraire);
                updating = false;
            }
        }
    }
    
    function newLigne(num) {
        var ligne;
        ligne = "<tr id='ligne_"+ num +"' data-num-ligne='" + num + "'>";
        ligne += "<td class='arret'>";
        ligne += "<i class='fa fa-times addLine'></i>";
        ligne += "<input type='text' name='arret_" + num + "' id='arret_" + num + "' placeholder='Arret'/></td>";
        for(var i = 0; i < nbCol; i++) {
            ligne += "<td><i class='fa fa-times addCol'></i>";
            ligne += "<input type='text' name='heure_" + num +"_" + i + "' id='heure_" + num +"_" + i + "' placeholder='00:00'/></td>";
        }
        ligne += '</td>';
        return ligne;
    }
    
    $(".horaire").click(function() {
        console.log($(this).text());
        if(!updating){
            var selectedHoraire = $(this).text().trim();
            $(this).html('<input type="text" id="updateField" placeholder="00:00" value="' + selectedHoraire + '"/>');
            updating = true;
            
            $("#updateField").keypress(function(e) {
              if (e.keyCode == 13) changeHoraire(selectedHoraire);
            });
            
            $('#updateField').blur(function() {
                
               changeHoraire(selectedHoraire);
                
            });
            
        }
    });
    
    
});