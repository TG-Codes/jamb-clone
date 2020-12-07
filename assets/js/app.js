$(document).ready(function() {
    $("#password2").keyup(function() {
        if ($("#password").val() != $("#password2").val()) {
            $("#StatusPassword").html("Password do not match").css("color", "red");
            $("#submit").prop('disabled', true);
        } else {
            $("#StatusPassword").html("Password matched").css("color", "green");
            $("#submit").prop('disabled', false);
        }
    });
});