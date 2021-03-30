/**
 * Password Validation
 */
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


/**
 * Registration 
 */

$(document).ready(function() {
    $("#form").on("submit", function(event) {
        event.preventDefault();

        var fname = $("#fname").val();
        var mname = $("#mname").val();
        var lname = $("#lname").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var state = $("#state").val();
        var phone = $("#phone").val();
        var password = $("#password").val();

        if (fname !== "" && mname !== "" && lname !== "" && email !== "" && address !== "" && state !== "" && phone !== "" && password !== "") {

            $.ajax({
                type: 'POST',
                url: 'Home/register',
                data: $("#form").serialize(),
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    $("#error").fadeOut("slow");
                    $("#submit").html('Processing....');
                },
                success: function(response) {
                    if (response.error = false) {
                        $("#error").fadeIn(1000, function() {
                            $("#error").html('<div class="alert alert-success" role="alert"> ' + response.message + '!</div>');
                            $("#submit").html('Submit');
                            document.getElementById("form").reset();
                        });
                    } else {
                        $("#error").fadeIn(1000, function() {
                            $("#error").html('<div class="alert alert-danger"> ' + response.message + '!</div>');
                            $("#submit").html('Submit');
                        });
                    }
                }

            });

        } else {
            $("#error").fadeIn(1000, function() {
                $("#error").html('<div class="alert alert-danger"> All Fields are required!</div>');
                $("#submit").html('Submit');
            });
        }
    });
});