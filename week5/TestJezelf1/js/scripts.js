$(document).ready(function(){
    $("#username").on("keyup", function(e) {
        "use strict";
        // username ophalen uit tekstveld
        var username = $("#username").val();
        $(".usernameFeedback").show();

        // Ajax call: verzenden naar php bestand om query uit te voeren
        $.post("ajax/check_username.php", {username: username})
            .done(function( response ){
                $("#loadingImage").hide();
                $('.usernameFeedback span').text(response.message);

                if(response.status === 'error') {
                    $('#btnSubmit').prop('disabled', true);
                } else {
                    $('#btnSubmit').prop('disabled', false);
                }
            });
        e.preventDefault();
    })
});