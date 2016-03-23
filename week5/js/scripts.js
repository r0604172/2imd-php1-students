$(document).ready(function() {
    $.get('ajax/getCurrentUser.php', function(itsMe) {
        user = itsMe.name;
    });
    
    $("#verzenden").on('click', function(e) {
        var message = $("#iMessage").val();
        $("#iMessage").val([]);
        $.post('ajax/saveMessage.php', {
            message : message, 
            user: user
        }).done(function (response) {
            $('.messages').append('<article class="me">' + response.user + ": " + response.text + '</article>');
        });
        e.preventDefault();
    });
    setInterval(function() {
        $.get('ajax/getAllMessages.php', function(response) {
            $('.messages').empty();
            $.each(response, function(index) {
                var theMessage = response[index].text;
                if(theMessage.substr(theMessage.length -4) === ".jpg" || 
                    theMessage.substr(theMessage.length -4) === ".png" ||
                    theMessage.substr(theMessage.length -4) === ".gif") {
                    theMessage = "<img src='" + response[index].text + "' width='250'>";
                }
                if (response[index].user === user) {

                    $('.messages').append('<article class="me">' + response[index].user + ": " + theMessage + '</article>');
                } else {
                    $('.messages').append("<article class='them'>" + response[index].user + ": " + theMessage + "</article>");
                }
            });
            $("html, body").animate({ scrollTop: $(document).height() - $(window).height() });
        });
    },2000);
});