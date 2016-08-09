//
//DOCUMENT READY
//

// SHOW/HIDE CONTENT ACCORDING TO SELECTED JOB
$(document).ready(function(){ 
  $("#all").hide()
                
    $("#jb").change(function(){
      var sele = $("#jb option:selected").text();

        if((sele=="Polymécanicien-ne CFC")||(sele=="Informaticien-ne CFC")||(sele=="Logisticien-ne CFC")||(sele=="Planificateur-trice éléctricien-ne CFC")||(sele=="Employé-e de commerce CFC")||(sele=="Gardien-ne d'animaux CFC")){
            $("#all").show(1000)
            $("#infoOnly").hide(0)
            $("#polyOnly").hide(0)
                   
        if(sele=="Informaticien-ne CFC"){
            $("#infoOnly").show(1000)
            }
        if(sele=="Polymécanicien-ne CFC"){
            $("#polyOnly").show(1000)
            }
        }else if((sele=="Laborantin-e CFC; option biologie")||(sele=="Laborantin-e CFC; option chimie")||(sele=="Laborantin-e en physique CFC")){
                    $("#all").hide(1000)

                    if(confirm("Pour les métiers de laborantins, l'inscription se fait au près de ASSOCIATION, cliquer sur ok pour être rediriger...")){
                        window.location.replace("http://apprentis.epfl.ch");
                    }else{}
            }
    });

// CHECK FILE FORMATS
    $("#photo").change(function(){
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        var input = $("#photo");
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
              alert("Format non pris en charge, Formats autorisés : "+fileExtension.join(', '));
            }
    });
                        
    $("#cv").change(function(){
        var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
              alert("Format non pris en charge, Formats autorisés : "+fileExtension.join(', '));
            }
    });

    $("#lettre").change(function(){
        var fileExtension = ['pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Format non pris en charge, Formats autorisés : "+fileExtension.join(', '));
        }
    });                              
});

//
//CHANGE EVENTS
//
$(document).ready(function(){ 
// SHOW/HIDE ACCORDING TO RADIOBUTTON
    $("#maj1").change(function(){
        $("#representants").show(1000);
    });
    $("#maj2").change(function(){
        $("#representants").hide(1000);
    });

// CHECK DATE INPUT
    $("#birthApp").change(function(){
            userDate = new Date(document.getElementById("birthApp").value);
            now = new Date();
            birthDate = userDate.getTime();
            currentDate = now.getTime();
            currentDays = currentDate/24/60/60/1000;
            userDays = birthDate/24/60/60/1000;
            currentDays = Math.floor(currentDays);
            userDays = Math.floor(userDays);
            douzeAns = Math.floor(currentDays - 4383);

            if(currentDays <= userDays){
                document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide';

            }else if(userDays>douzeAns){
                document.getElementById('errorMsg').innerHTML = '<p class ="errorMsgs">Date invalide, trop jeune';
            }
            else{
                document.getElementById('errorMsg').innerHTML = '';
            }
        });

// CLICK TO ADD LINE
    $('#addSch').click(function(){
        var div = $('<input type="text"/>');
        div.appendTo('#test');
    });
});