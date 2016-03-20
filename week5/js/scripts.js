$(document).ready(function(){
   // klikken op knop
    $("#btnSubmit").on("click", function(e){
        "use strict";
        // message ophalen uit tekstveld
        var message = $("#activitymessage").val();

        // Ajax call: verzenden naar php bestand om query uit te voeren
        $.post("ajax/saveMessage.php", { message : message })
            .done(function( response ){
                if(response.status === 'succes') {
                    // update tonen
                    var li = "<li style='display: none'><h2>Christophe </h2>" + message + "</li>";
                    $('#listupdates').prepend(li);
                    $("#listupdates li:first-child").slideDown();
                    // invoerveld opnieuw leeg maken
                    $("#activitymessage").val('');
                }
        });
        e.preventDefault();
    })
});