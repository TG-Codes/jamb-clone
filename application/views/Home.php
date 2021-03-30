<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <div class="container">
      <form id="form" method="post" action="Home/register" class="form">
        <h2>WELCOME! PLEASE REGISTER</h2>
        <div class="form-control">
          <label for="username">First Name</label>
          <input type="text" id="fname" name="fname" placeholder="Enter First Name" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="username">Middle Name</label>
          <input type="text" id="mname" name="mname" placeholder="Enter Middle Name" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="username">Last Name</label>
          <input type="text" id="lname" name="lname" placeholder="Enter Last Name" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter email" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="email">Address</label>
          <input type="text" id="address" name="address" placeholder="Enter Address" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="email">State</label>
          <input type="text" id="state" name="state" placeholder="Enter State" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="email">Phone Number</label>
          <input type="text" id="phone" name="phone" placeholder="Enter Phone" />
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password" />
          <small>Error message</small>
        </div>
        <div id="StatusPassword"></div>
        <div class="form-control">
          <label for="password2">Confirm password</label>
          <input
            type="password"
            id="password2" name="password2"
            placeholder="Renter your password"
          />
          <small>Error message</small>
        </div>
        <div id="error"></div>
        <button id="submit" type="submit">Submit</button>
      </form>
    </div>

  </body>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/modernizr-2.6.2.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/app.js"></script>

  <script type="text/javascript">
<<<<<<< Updated upstream
       
=======
        $(document).ready(function(){
            $("#form").on("submit", function(event){
          event.preventDefault();

          var fname = $("#fname").val();
          var mname = $("#mname").val();
          var lname = $("#lname").val();
          var email = $("#email").val();
          var address = $("#address").val();
          var state = $("#state").val();
          var phone = $("#phone").val();
          var password = $("#password").val();

          if (fname !== "" && mname !== "" && lname !== "" && email !== "" && address !== "" && state !== "" && phone !=="" && password !== "") {

            $.ajax({
              type: 'POST', 
              url: 'Home/register',
              data: $("#form").serialize(),
              dataType: 'json',
              async : true,
            beforeSend: function()
              {  
                 $("#error").fadeOut( "slow" );
                 $("#submit").html('Process.......');
             },
             success: function(response)
                   {
                    if (response.error == false) {
                        $("#error").fadeIn(1000, function(){            
                          $("#error").html('<div class="alert alert-success" role="alert"> '+response.message+'!</div>');
                           $("#submit").html('Submit');
                           document.getElementById("form").reset();
                        });   
                    }
                    else {
                        $("#error").fadeIn(1000, function(){            
                          $("#error").html('<div class="alert alert-danger"> '+response.message+'!</div>');
                           $("#submit").html('Submit');
                        });
                    }
                   }

            });

          }
            else {
                $("#error").fadeIn(1000, function(){            
                      $("#error").html('<div class="alert alert-danger"> All Fields are required!</div>');
                       $("#submit").html('Submit');
                    });
                }         
            });
        });
>>>>>>> Stashed changes
    </script>
</html>
