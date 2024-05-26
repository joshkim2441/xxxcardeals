<?php
//session_start();
require_once "ShoppingCart.php";
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate user input
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill out all fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Send email using Gmail SMTP
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'joshkm2441@gmail.com';
        $mail->Password = 'samozi2441';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('joshkm2441@gmail.com', 'Joshua Mutuse');
        $mail->addAddress('joshmutuse@yahoo.com', 'Joshua Mutuse');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New message from your website';
        $mail->Body = "<p>Name: {$name}</p><p>Email: {$email}</p><p>Message: {$message}</p>";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<?php
if(isset($_SESSION["loggedIn"])){
$_SESSION["id"]=$id;}
$conn = mysqli_connect("localhost", "root", "", "resume");
if (count($_POST) > 0) {

    $sql = "SELECT * FROM register WHERE id= ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $_SESSION["id"]);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();

    if (! empty($row)) {
        $md5Password = $row["password"];
        $password = md5($_POST["newPassword"], PASSWORD_DEFAULT);
        if (password_verify($_POST["currentPassword"], $md5Password)) {
            $sql = "UPDATE register set password=? WHERE id=$id";
            $statement = $conn->prepare($sql);
            $statement->bind_param('si', $password, $_SESSION["id"]);
            $statement->execute();
            $message = "Password Changed";
        } else
            $message = "Current Password is not correct";
    }
}
?>




<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8"/>
  <title>xXx HIGH-END CAR DEALS</title>
  <meta name="web development" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/index.css">
  <ink rel="stylesheet" href="css/stylecp.css">
<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" type="text/css" href="/feedback-modal-window.css">
  <script language="JavaScript" src="js/gen_validatorv31.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"  type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script language="JavaScript" src="js/myservices.js" type="text/javascript"></script>
<script>
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
</script>
<script>
	function openForm(){
  document.getElementById("align-right").style.display = "block";
}
</script>

<style>
  #modal_wrapper.overlay::before {
    content: " ";
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 100;
    top: 0;
    left: 0;
    background: #000;
    background: rgba(0,0,0,0.7);
  }

  #modal_window {
    display: none;
    z-index: 200;
    position: fixed;
    left: 50%;
    top: 50%;
    width: 360px;
    overflow: auto;
    padding: 10px 20px;
    background: #fff;
    border: 5px solid #999;
    border-radius: 10px;
    /*box-shadow: 0 0 10px rgba(0,0,0,0.5);*/
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
  }
  /* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}
  #modal_wrapper.overlay #modal_window {
    display: block;
  }
  </style>
  <style>
        .input-icons i {
            position: absolute;
        }

        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }

        .icon {
            padding: 10px;
            min-width: 40px;
        }
        .input-field {
            width: 100%;
            padding: 10px;
        }
    </style>
</head>
   <body>
  <header id="header">
  <h1 style="text-align: center">Automobiles On Sale</h1>
  </header>
  <h2 id="s1">A Comprehensive list of cars in the showroom</h2>
  <fieldset>
  <div class="align-right">
  <input type="submit" class="open-button" value="Change Password" onclick="openForm()">
</div>

<div id="modal_wrapper">
<div id="modal_window">
<div style="text-align: right;"><a id="modal_close" href="#">close <b>X</b></a></div>
<div class = "input-icons">
<p>Complete the form below to send an email:</p>

<form id="modal_feedback" method="POST" action="send_contact_mail.php" accept-charset="UTF-8">
<p><label>Your Name<strong></strong><br><i class="material-icons prefix">account_circle</i></style>
<input type="text" style="text-align:center;" class="input-field" autofocus required title="Enter your full names" size="100" name="name" value=""></label></p>
<p><label>Email Address<strong></strong><br><i class="small material-icons prefix">email</i>
<input type="email" style="text-align:center;" class="input-field" required title="Please enter a valid email address" size="100" name="email" value=""></label></p>
<p><label>Subject<br><i class="small material-icons prefix">subject</i>
<input type="text" style="text-align:center;" size="60" name="subject" value=""></label></p>
<p><label>Enquiry<strong></strong><br><i class="material-icons prefix">mode_edit</i>
<textarea required class="input-field" name="message" cols="48" rows="8"></textarea></label></p>
<p><input type="submit" formreset="modal_feedback" onclick="document.getElementById('modal_close').addEventListener('click', closeModal) name="feedbackForm" value="Send Message"></p>
</form>
      </div>
</div> <!-- #modal_window -->
</div> <!-- #modal_wrapper -->

<div>
   <legend>Makes and Models</legend>
   <ul>
    <li id="list">Astons Ferraris Royces Lambos</li>
    <li id="list">Aston Martin</li>
      <ol>
       <li>DBS 770 Ultimate</li>
       <li>Vantage GT3</li>
       <li>4pg wb & Backend devp $9300</li>
       <li>5pg wb & Backend devp $11700</li>
       <li>6pg wb & Backend devp $13900</li>
       <li>7pg wb & Backend devp $16300</li>
       <li>8pg wb & Backend devp $18500</li>
      </ol>
       <li id="list">Lamborghini</li>
        <ol>
         <li>Revuelto</li>
         <li>Backend $1200</li>
        </ol>
       <li id="list">Ferrari</li>
      <ol>
       <li>812 GTS</li>
       <li>Purosangue</li>
       <li>SF90 Stradale</li>
       <li>SF90 XX Stradale</li>
       <li>six-pg wb debug $3700</li>
       <li>seven-pg wb debug $4300</li>
        <li>eight-pg wb debug $4900</li>
     </ol>
      <li id="list">Rolls Royce</li>
       <ol>
         <li>Cullinan Black Badge</li>
         <li>Ghost Black Badge</li>
         <li>Phantom</li>
         <li>Spectre</li>
         <li>six-pg wb debug $6700</li>
         <li>seven-pg wb debug $7800</li>
         <li>eight-pg wb debug $8900</li>
       </ol>
   </ul>
   </fieldset>
</div>
<br/>
<br/>
</fieldset>
  <legend>SHOW ROOM</legend>
   <table>
    <tr>
     <th>Vehicle</th><th>Price</th><th>Image</th>
    </tr>
    <tr>
      <td>Aston Martin DBS 770</td><td>$450,000</td><td><img src='product/Aston_Martin_DBS_770_Ultimate_$450k.jpg' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Aston Martin Vantage GT3</td><td>$726,000</td><td><img src='product/Aston_Martin_Vantage_GT302_$726k.png' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Ferrari 812 GTS</td><td>$430,000</td><td><img src='product/Ferrari_812_GTS_$430k.jpg' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Ferrari Purosangue</td><td>$400,000</td><td><img src='product/Ferrari_Purosangue_$400k.jpg' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Ferrari SF90 Stradale</td><td>$570,000</td><td><img src='product/Ferrari_SF90_Stradale_$570.jpg' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Ferrari SF90 XX Stradale</td><td>$900,000</td><td><img src='product/Ferrari_SF90_XX_Stradale_$900k.png' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Lamborghini Revuelto</td><td>$890,000</td><td><img src='product/Lamborghini_Revuelto_$890.jpg' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Rolls Royce Cullinan Black Badge</td><td>$425,000</td><td><img src='product/Rolls_Royce_Cullinan_Black_Badge_$425k.jpg' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Rolls Royce Ghost Black Badge</td><td>$443,000</td><td><img src='product/Rolls_Royce_Ghost_Black_Badge_$443k.jpg' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Rolls Royce Phantom</td><td>$458,000</td><td><img src='product/Rolls_Royce_Phantom_$458k.png' width="100" height="50"></td>
    </tr>
    <tr>
      <td>Rolls Royce Ghost Spectre</td><td>$440,000</td><td><img src='product/Rolls_Royce_Spectre_$440k.jpg' width="100" height="50"></td>
    </tr>
    <th>Transport Services</th><th>Price</th>
    <tr>
      <td>Marine Shipping</td><td>$4000</td>
    </tr>
    <tr>
      <td>Land Cargo</td><td>$4000</td>
    </tr>
    <tr>
      <td>Air Freight</td><td>$2000</td>
    </tr>
    <th>Insurance Options</th><th>Price</th>
    <tr>
     <td>Marine Insurance</td><td>0.15 of Price</td>
    </tr>
    <tr>
      <td>Land Insurance</td><td>0.20 of Price</td>
    </tr>
    <tr>
      <td>All Risk</td><td>0.30 of Price</td>
    </tr>
    <tr>
      <td>Named Perils</td><td>0.25 of Price</td>
    </tr>
   </table>
</fieldset>
<br/>
<br/>


      <fieldset>
      <legend>Calculus</legend>
   <h2>Calculate the cost in product, delivery and insurance</h2>
   <p>In a case where the vehicle has to be shipped, you can choose the type of delevery service and insurance both of which are optional.</p>

     <form>
     <h3>Vehicle Makes and Models</h3>
     <input type="radio" class="checkbox" name="radio" value="450000" id="rad"/>Aston Martin DBS 770 Ultimate<br>
     <input type="radio" class="checkbox" name="radio" value="726000" id="rad"/>Aston Martin Vantage GT302<br>
     <input type="radio" class="checkbox" name="radio" value="430000" id="rad"/>Ferrari 812 GTS<br>
     <input type="radio" class="checkbox" name="radio" value="400000" id="rad"/>Ferrari Purosangue<br>
     <input type="radio" class="checkbox" name="radio" value="570000" id="rad"/>Ferrari SF90 Stradale<br>
     <input type="radio" class="checkbox" name="radio" value="900000" id="rad"/>Ferrari SF90 XX Stradale<br>
     <input type="radio" class="checkbox" name="radio" value="890000" id="rad"/>Lamborghini Revuelto<br>
     <input type="radio" class="checkbox" name="radio" value="425000" id="rad"/>Rolls Royce Cullinan Black Badge<br>
     <input type="radio" class="checkbox" name="radio" value="443000" id="rad"/>Rolls Royce Ghost Black Badge<br>
     <input type="radio" class="checkbox" name="radio" value="458000" id="rad"/>Rolls Royce Phantom<br>
     <input type="radio" class="checkbox" name="radio" value="440000" id="rad"/>Rolls Royce Spectre<br>

     <h3><b><u>Select Combination of Services</u></b></h3>
     <input type="checkbox" class="checkbox" value="4000" name="spwbd"/>Marine Cargo<br>
     <input type="checkbox" class="checkbox" value="2000" name="2pwbd"/>Air Freight<br>
     <input type="checkbox" class="checkbox" value="4000" name="3pwbd"/>Land Cargo<br>
     <input type="checkbox" class="checkbox" value="9300" name="4pwbd"/>Shipped and Tru<br>
     <input type="checkbox" class="checkbox" value="11700" name="5pwbd"/>Air Cargo and Trucked<br>
       <br />
      </fieldset>

<label for="writingServices"><u><b>Select an Insurance Cover</u></b></label>
<p>Choose between Marine, Land, All Risk and Named Perils insurances.</p>
     <select id="dropdown">
      <option value="0" id="null">Select option</option>
      <option value="0.015" id="val">Marine Insurance</option>
      <option value="0.020" id="val">Land Cargo Insurance</option>
      <option value="0.030" id="val">All Risk</option>
      <option value="0.025" id="val">Named Perils</option>
      <br />
     </select>
     </form>
       <script type="text/javascript" src="js/myservices.js"></script>
       <script type="text/javascript">
(document.getElementById('rads'));
</script>
<span id="rads"></span>
       <script type="text/javascript">
(document.getElementById('result'));
</script>
<script type="text/javascript">
(document.getElementById('dst'));
</script>
<script type="text/javascript">
(document.getElementById('blc'));
</script>
<br />
         <button onclick="sumValues()" id="calc">Calculate</button>

           <p id="result"></p>
           <p id="dst"></p>
           <p id="blc"></p>
           </fieldset>
    <br />
          <fieldset>
        <legend>Mode of Payment</legend>
        <form method = 'POST'>
            <input type="radio" name="redirect" value="paypal.php" onchange="redirectTo(this.value)"> PayPal
            <input type="radio" name="redirect" value="credit.php" onchange="redirectTo(this.value)"> Credit Card
            <input type="radio" name="redirect" value="mpesa.php" onchange="redirectTo(this.value)"> Mpesa
        </form>
        </fieldset>
             <br />
             <form id="products" method="POST" action="ppindex.php">
        <input type="submit" value="Shop" id="submit"/>
        <br />
             <br />
 <p>For other unspecified needs that have not been listed above, please feel free to email with the specific details of your requirements and you will receive an immediate response. 📧</p>

<!-- <div class="form-container">
        <form name="frmContact" id="frmContact" method="post"
            action="" enctype="multipart/form-data"
            onsubmit="return validateContactForm()">

            <div class="input-row">
                <label style="padding-top: 20px;">Name</label> <span
                    id="userName-info" class="info"></span><br /> <input
                    type="text" class="input-field" name="userName"
                    id="userName" />
            </div>
            <div class="input-row">
                <label>Email</label> <span id="userEmail-info"
                    class="info"></span><br /> <input type="text"
                    class="input-field" name="userEmail" id="userEmail" />
            </div>
            <div class="input-row">
                <label>Subject</label> <span id="subject-info"
                    class="info"></span><br /> <input type="text"
                    class="input-field" name="subject" id="subject" />
            </div>
            <div class="input-row">
                <label>Message</label> <span id="userMessage-info"
                    class="info"></span><br />
                <textarea name="content" id="content"
                    class="input-field" cols="60" rows="6"></textarea>
            </div>
            <div>
                <input type="submit" name="send" class="btn-submit"
                    value="Send" />

                <div id="statusMessage">
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>
            </div>
        </form>
    </div>
    <form id="products" method="POST" action="contact-view.php">
        <input type="submit" value="contact Us" id="submit"/>
        </form> -->
<div class="form-popup" id="myForm" style="display:none">
	<div class="phppot-container tile-container" id="align-right" style="display:none">
		<form name="frmChange" method="post" action="/action_page.php" class="form-container" onSubmit="return validatePassword()">
			<div class="validation-message text-center"><?php if(isset($message)) { echo $message; } ?></div>
			<h2 class="text-center">Change Password</h2>

				<div class="row">
					<label class="inline-block">Current Password</label> <span
						id="currentPassword" class="validation-message"></span> <input
						type="password" name="currentPassword" class="full-width" id="myInput">
				</div>
				<div class="row">
					<label class="inline-block">New Password</label> <span
						id="newPassword" class="validation-message"></span><input
						type="password" name="newPassword" class="full-width" id="myInput">
				</div>
				<div class="row">
					<label class="inline-block">Confirm Password</label> <span
						id="confirmPassword" class="validation-message"></span><input
						type="password" name="confirmPassword" class="full-width" id="myInput">
				</div>
				<div class="row">
					<button type="submit" name="submit" value="Submit" class="btn">Change Password</button>
					<button type ="button" class="cancel" onclick="closeForm()">Close</button><br />
				</div>
			</div>
		</form>
      </div>
   </div>
   <div>
   <button id="modal_open">Open Email Form</button>
                      </div>
                      <script>
                        var form = document.getElementById('modal_feedback');
                        function submitForm(event){
                          event.preventDefault();
                          form.style.display = 'none';
                        }
                        form.addEventListener('submit', submitForm);
                        form.reset();
                        </script>
<script type="text/javascript">

  if(document.addEventListener) {
    document.getElementById("modal_feedback").addEventListener("submit", checkForm, false);
    window.addEventListener("DOMContentLoaded", modal_init, false);
  } else {
    document.getElementById("modal_feedback").attachEvent("onsubmit", checkForm);
    window.attachEvent("onload", modal_init);
  }
  </script>
           <footer>
          <nav>
         <ul id="contacts">
        <li><a href="coverletter.php">Front Desk</a></li>
        <li><a href="index.html">Home Page</a></li>
      </ul>
     <a href ="#top">Top</a>
    </nav>
  </footer>
  <script rel="application/JavaScript" src="js/myservices.js"></script>
  <script>
	function openForm(){
  document.getElementById("align-right").style.display = "block";
  var viewportwidth = document.documentElement.clientWidth;
  var viewportwidth = document.documentElement.clientheight;
  window.resizeBy(-30,0);
  window.resizeTo(300,300);
  window.moveTo(500,100);
  window.focus();

  window.open("indexcp.php",
  "mywindow",
  "width=400, height=400, top=0")
}
function closeForm(){
  document.getElementById("align-right").style.display = "none";
  var viewportwidth = document.documentElement.clientWidth;
  var viewportwidth = document.documentElement.clientheight;
  window.resizeBy(-30,0);

  window.close("indexcp.php",
  "mywindow")
}
	</script>
  <script>
      window.onload = function() {  document.querySelectorAll("INPUT[type='radio']").forEach(function(rd) {
    rd.addEventListener("mousedown", function() {
      if(this.checked) {
        this.onclick=function() {
          this.checked=false
        }
      } else {
        this.onclick=null
      }
    })
  })
}
  </script>

  <script>
    var checkForm = function (e) {
  var form = (e.target) ? e.target : e.srcElement;
  if (form.name.value == "") {
    alert("Please enter your Name");
    form.name.focus();
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    return;
  }
  if (form.email.value == "") {
    alert("Please enter a valid Email address");
    form.email.focus();
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    return;
  }
  if (form.message.value == "") {
    alert("Please enter your comment or question in the Message box");
    form.message.focus();
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    return;
  }
};

  // Original JavaScript code by Chirp Internet: chirpinternet.eu
// Please acknowledge use of this code by including this header.

document.getElementById("modal_feedback").addEventListener("submit", function(e) {
    var form = this;
    if(form.name.value == "") {
      alert("Please enter your Name");
      form.name.focus();
      e.preventDefault();
    } else if(form.email.value == "") {
      alert("Please enter a valid Email address");
      form.email.focus();
      e.preventDefault();
    } else if(form.message.value == "") {
      alert("Please enter your comment or question in the Message box");
      form.message.focus();
      e.preventDefault();
    }
  }, false);


  window.addEventListener("DOMContentLoaded", function() {
    var modalWrapper = document.getElementById("modal_wrapper");
    var modalWindow  = document.getElementById("modal_window");
    var form = document.getElementById("modal_feedback");
    var openModal = function(e)
    {
      modalWrapper.className = "overlay";
      modalWindow.style.marginTop = (-modalWindow.offsetHeight)/2 + "px";
      modalWindow.style.marginLeft = (-modalWindow.offsetWidth)/2 + "px";
      e.preventDefault();
    };

    var closeModal = function(e)
    {
      modalWrapper.className = "dialog";
      e.preventDefault();
    };

    var clickHandler = function(e) {
      if(e.target.tagName == "DIV") {
        if(e.target.id != "modal_window") closeModal(e);
      }
    };

    var keyHandler = function(e) {
      if(e.keyCode == 27) closeModal(e);
    };

    document.getElementById("modal_open").addEventListener("click", openModal, false);
    document.getElementById("modal_close").addEventListener("click", closeModal, false);
    document.addEventListener("click", clickHandler, false);
    document.addEventListener("keydown", keyHandler, false);
    document.getElementById("modal_feedback").addEventListener("submit", function(e) {
    closeModal(e);
    form.reset();
    },);
  }, false);
  if(document.addEventListener) {
    document.getElementById("modal_feedback").addEventListener("submit", checkForm, false);
    document.getElementById("modal_feedback").reset();
    window.addEventListener("DOMContentLoaded", modal_init, false);
  } else {
    document.getElementById("modal_feedback").attachEvent("onsubmit", checkForm);
    window.attachEvent("onload", modal_init);
  }
  </script>
  <script language="JavaScript" src="js/myservices.js" type="text/javascript"></script>
 </body>
</html>
<?php/* endif;*/ ?>
