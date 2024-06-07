/* function validateEmail(input) {
	var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (emailFormat.test(input)) {
		return true;
	} else {
		return false;
	}
} */
function ajaxRegistration() {
	$(".error").text("");
	$("#first-name-info").removeClass("error");
	$("#last-name-info").removeClass("error");
	$("#register-email-info").removeClass("error");
	$("#company-info").removeClass("error");
 $("#title-info").removeClass("error");
	$("#register-password-info").removeClass("error");
	$("#confirm-password-info").removeClass("error");

	var firstName = $('#first-name').val();
	var lastName = $('#last-name').val();
	var emailId = $('#register-email-id').val();
	var company = $('#company').val();
	var title = $('#title').val();
	var password = $('#register-password').val();
	var confirmPassword = $('#confirm-password').val();
	var actionString = 'registration';

	if (firstName == "") {
		$("#first-name-info").addClass("error");
		$(".error").text("required");
	} else if (!pregMatch(firstName)) {
		$("#first-name-info").addClass("error");
		$(".error").text('Alphabets and white space allowed');
	} else if (lastName == "") {
		$("#last-name-info").addClass("error");
		$(".error").text("required");

	} else if (!pregMatch(lastName)) {
		$("#last-name-info").addClass("error");
		$(".error").text('Alphabets and white space allowed');
	} else if (emailId == "") {
		$("#register-email-info").addClass("error");
		$(".error").text("required");
	} else if (!validateEmailId(emailId)) {
		$("#register-email-info").addClass("error");
		$(".error").text('Invalid');
	} else if	(company == "") {
		$("#company-info").addClass("error");
		$(".error").text("");

	} else if (!pregMatch(company)) {
		$("#company-info").addClass("error");
		$(".error").text('Alphabets and white space allowed');

	} else if	(title == "") {
		$("#title-info").addClass("error");
		$(".error").text("");

	} else if (!pregMatch(title)) {
		$("#title-info").addClass("error");
		$(".error").text('Alphabets and white space allowed');
	} else if (password == "") {
		$("#register-password-info").addClass("error");
		$(".error").text("required");
	} else if (confirmPassword == "") {
		$("#confirm-password-info").addClass("error");
		$(".error").text("required");
	} else if (password != confirmPassword) {
		$("#confirm-password-info").addClass("error");
		$(".error").text("Your confirm password does not match.");
	} else {
		$('#loaderId').show();
		$.ajax({
		 	url : 'ajax-login-registration.php',
		 type : 'POST',
	  	data : {
				firstName : firstName,
				lastName : lastName,
				emailId : emailId,
				company : company,
				title : title,
				password : password,
				confirmPassword : confirmPassword,
				action : actionString
			},
			success : function(response) {
				if (response.trim() == 'error') {
					$('#register-success-message').hide();
					$('#ajaxloader').hide();
					$('#register-error-message').html(
							"Invalid Attempt. Try Again.");
					$('#register-error-message').show();
				} else {
					$(".thank-you-registration").show();
					$(".thank-you-registration").text(response);
					$("#register-dialog").dialog("close");
				}
			},
		});
		// this.close();
	} // endif
}
function pregMatch(input) {
	var regExp = /^[a-zA-Z ]*$/;

	if (regExp.test(input)) {
		return true;
	} else {
		return false;
	}
}
// Function for user login
function ajaxLogin() {
	$(".error").text("");
	$("#email-info").removeClass("error");
	$("#password-info").removeClass("error");

	var emailId = $('#login-email-id').val();
	var password = $('#login-password').val();
	var actionString = 'login';

	if (emailId == "") {
		$("#email-info").addClass("error");
		$(".error").text("required");
	} else if (!validateEmailId(emailId)) {
		$("#email-info").addClass("error");
		$(".error").text("Invalid");
	} else if (password == "") {
		$("#password-info").addClass("error");
		$(".error").text("required");
	} else {
		// show loader
		$('#loaderId').show();
		$.ajax({
			url : 'ajax-login-registration.php',
			type : 'POST',
			data : {
				emailId : emailId,
				password : password,
				action : actionString
			},
			success : function(response) {
				if (response.trim() == 'error') {
					$('#login-success-message').hide();
					$('#ajaxloader').hide();
					$('#login-error-message').html(
							"Invalid Attempt. Try Again.");
					$('#login-error-message').show();
				} else {
					$('.demo-container').html(response);
					$("#register_window").dialog("close");
			   $("#login-dialog").dialog("close");
				}
			},
		});
	 // this.close();
	}// endif
}
function validatePassword() {
	var currentPassword, newPassword, confirmPassword, output = true;

	currentPassword = document.frmChange.currentPassword;
	newPassword = document.frmChange.newPassword;
	confirmPassword = document.frmChange.confirmPassword;

	if (!currentPassword.value) {
		currentPassword.focus();
		document.getElementById("currentPassword").innerHTML = "required";
		output = false;
	}
	else if (!newPassword.value) {
		newPassword.focus();
		document.getElementById("newPassword").innerHTML = "required";
		output = false;
	}
	else if (!confirmPassword.value) {
		confirmPassword.focus();
		document.getElementById("confirmPassword").innerHTML = "required";
		output = false;
	}
	if (newPassword.value != confirmPassword.value) {
		newPassword.value = "";
		confirmPassword.value = "";
		newPassword.focus();
		document.getElementById("confirmPassword").innerHTML = "not same";
		output = false;
	}
	return output;
}

	window.addEventListener("DOMContentLoaded", (e) => {

		// Original JavaScript code by Chirp Internet: www.chirpinternet.eu
		// Please acknowledge use of this code by including this header.

		const showHidePassword = (e) => {
		  let input = e.target.previousElementSibling;
		  input.type = input.classList.toggle("shown") ? "text" : "password";
		};

		document.querySelectorAll("input[type=password]").forEach((current) => {
		  let showHideButton = document.createElement("div");
		  showHideButton.className = "show-hide";
		  showHideButton.addEventListener("click", showHidePassword);
		  current.after(showHideButton);
		});

	});
