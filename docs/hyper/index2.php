<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../styles/style.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
  $("#togglePassword").click(function(){
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password"){
      input.attr("type", "text");
    }else{
      input.attr("type", "password");
    }
    });
  </script>
<script src="../scripts/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script>
     $(function () {
                var login_window = $("#login-dialog").dialog({autoOpen: false,
                    height: 520,
                    width: 1024,
                    modal: true,
                    closeText: '',
                    close: function(){
                      register_window.dialog("close");
                    }
                });
 $("#btn-login").button().on("click", function () {
                login_window.dialog("open");
                });
               var register_window = $("#register-dialog").dialog({autoOpen: false,
                    height: 530,
                    width: 520,
                    modal: true,
                    closeText: '',
                    close: function () {
                        register_window.dialog("close");
                    }
                });
                $("#btn-register").button().on("click", function () {
                     register_window.dialog("open");
                });
                });
        </script>
</head>
<body>
 <script src="../scripts/login-registration.js"></script>
    <div class="demo-container">
        <h2>XXX CarDealers Login Registration</h2>
        <div class="login-registration-menu">
            <input type="button" value="Login" id="btn-login"> <input
                type="button" value="Register" id="btn-register">
        </div>
        <div class="thank-you-registration">
        </div>
<?php
            require_once "login-form.php";
            require_once "registration-form.php";
?>
    </div>
   <script>
       function validateEmailId(input) {
	var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (emailFormat.test(input)) {
		return true;
	} else {
		return false;
	}
}
</script>
</body>
</html>
