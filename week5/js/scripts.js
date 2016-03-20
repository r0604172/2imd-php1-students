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
                    var li = "<li style='display: none' id='" + response.id + "'>" +
                        "<h2>Christophe </h2>" + message +
                        "<form method='post' action=''>" +
                            "<input type='hidden' name='action' value='likeActivity'>" +
                            "<input type='hidden' id='id' name='id' value='" + response.id + "' />" +
                            "<input type='submit' value='like' id='btnLike" + response.id + "' class='btnLike' />" +
                        "</form> " +
                        "<span class='likes' id='likeSpan" + response.id + "'>0</span>" +
                        "<form method='post' action=''>" +
                            "<input type='hidden' name='action' value='removeActivity' />" +
                            "<input type='hidden' name='id' value='" + response.id +"' />" +
                            "<input type='image' src='img/soft_grey_action_delete.png' class='btnRemove' id='btnRemove" + response.id +"' />" +
                        "</form></li>";
                    $('#listupdates').prepend(li);
                    $("#listupdates").find("li:first-child").slideDown();
                    // invoerveld opnieuw leeg maken
                    $("#activitymessage").val('');
                }
        });
        e.preventDefault();
    });

    $('#listupdates').on("click", 'input[type=image]', function(e){
        "use strict";
        var id = $(this).prev('input[name=id]').val();

        // Ajax Call
        $.post("ajax/deleteMessage.php", {id : id}).
            done(function( response ){
                if(response.status === 'verwijderd') {
                    // post verwijderen
                    $('#'+id).remove();
                }
            });
        e.preventDefault();
    });

    $('#listupdates').on("click", 'input[type=submit]', function(e){
        "use strict";
        var id = $(this).prev('input[name=id]').val();

        // Ajax Call
        $.post("ajax/likeMessage.php", {id : id}).
        done(function( response ){
            if(response.status === 'geliked') {
                // post likes weergeven
                $('#likeSpan'+ response.id).text(response.message);
            }
        });
        e.preventDefault();
    });
});