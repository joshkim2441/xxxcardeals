<?php
error_reporting(0);
session_start();
include("dbconnection.php");
if(isset($_POST['Submit']))
{
 $oldpass=md5($_POST['opwd']);
 $useremail=$_SESSION['email_id'];
 $newpassword=md5($_POST['npwd']);
$sql=mysqli_query($conn,"SELECT password FROM register WHERE password='$oldpass' && email_id='$useremail'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $conn=mysqli_query($conn,"UPDATE register SET password='$newpassword' WHERE email_id='$useremail'");
$_SESSION['msg1']="Password Changed Successfully !!";
}
else
{
$_SESSION['msg1']="Old Password does not match !!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Change xXx Password</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>
	<script>
function closeForm(){
  document.getElementById("myForm").style.display = "none";
  var viewportwidth = document.documentElement.clientWidth;
  var viewportwidth = document.documentElement.clientheight;
  window.resizeBy(-300,0);

  window.close("indexcp.php",
  "mywindow",
  "width=300,left="+(viewportwidth-300)+",top=0")
}
	</script>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.opwd.value=="")
{
alert("Old Password Field is Empty !!");
document.chngpwd.opwd.focus();
return false;
}
else if(document.chngpwd.npwd.value=="")
{
alert("New Password Field is Empty !!");
document.chngpwd.npwd.focus();
return false;
}
else if(document.chngpwd.cpwd.value=="")
{
alert("Confirm Password Field is Empty !!");
document.chngpwd.cpwd.focus();
return false;
}
else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
{
alert("Password and Confirm Password Fields do not match  !!");
document.chngpwd.cpwd.focus();
return false;
}
return true;
}
</script>
<script>
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
</script>
<style>
input + .show-hide {
    display: inline-block;
    margin-left: -30px;
    width: 22px;
    height: 12px;
    background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAMCAYAAABm+U3GAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyVpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDYuMC1jMDAyIDc5LjE2NDM2MCwgMjAyMC8wMi8xMy0wMTowNzoyMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIxLjEgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RTU2MjEzMDc3QzNBMTFFQzk2QkZDMkFDOTI3NEUzMTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RTU2MjEzMDg3QzNBMTFFQzk2QkZDMkFDOTI3NEUzMTYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFNTYyMTMwNTdDM0ExMUVDOTZCRkMyQUM5Mjc0RTMxNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFNTYyMTMwNjdDM0ExMUVDOTZCRkMyQUM5Mjc0RTMxNiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ppk5kv4AAALrSURBVHjabFNPKORhGH5mjJkQOexhonVZY4w1GIakRZbLTKZtOShuymRqSvaiKZGLg0QrcdgDRfnT1rQXB2ouxBKWDGplTEM07UaRhmG8+37fNr/m4K2v3zfvn2fe93mfT7W2toazszMsLCzg+voa0WhUfjMyMrRPT0+fYrHYx5OTEzN/3+C//SkrKzuYnZ0N5Ofnm2pqauzhcDh1e3t7OD09fZjjEZGkQYKlpKTg5eVFd3Nz8yUQCLjY9TYeKy4uBoPj9PTUqNfrPxwdHcFms+H+/h6Xl5c/NRqNNw4qgYkI7ERaWhouLi5se3t7X9lvaG9vR15eHvg3JicnkZmZKQt4CmxubsLhcKCwsBAejwdNTU36urq6d11dXf5gMCiaA/b397G0tASr1drPdVRaWkobGxuUaByn5uZm4j+h4+Nj4o6pvLxcxm5vb8lgMJCoraqq6l9cXISgFzs7O2hoaBgTgc7OTgUsFAop98HBQeru7qaBgQEJMDQ0JP0dHR3E9Mi70+mUsfr6+rHd3V0gKyvrm3BMTEwoQD6fjywWCz08PNDU1BRdXV3R+Pi4LOzp6SGmTOYVFBTQysqKUicwRI7AVOMVE0viEaHT6VBZWYnW1la43W5MT09Dq9Wir69P5om7SqXCq7a1tQWWjKRCjCPs+fmZent7iZcgxxWxkZERZdz19XU6Pz+n7OxspVtBo4gJWgW98Pv9WF5ehiBeBFgJxFqWyTk5OWQymYh1TZxDjY2NymJra2uJ1SKXWVFRIUGFAIQQhCCkfIQ8xPijo6Of29ragvPz82Q0Gik3N5cODw/p7u5O6Yx1S3a7nZgmcrlcEpDP75KSEltLSwvm5uawurrKXtZxwrGw2H+xrqWcvF4vVVdXSxDWLPEjiQPFT4hfqIf3oGM1gCfCzMyMlFviy0vlzhxms9kguuZFfWf+g7zE94+Pj0VMmXzSSUlJf1m3B8nJyT61Wv2Da6K8E0QiEfly4/ZPgAEAdnYDAqEPWZcAAAAASUVORK5CYII=);
    background-size: contain;
    cursor: pointer;
    -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
  }
  input.shown + .show-hide {
    background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAMCAYAAABm+U3GAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyVpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDYuMC1jMDAyIDc5LjE2NDM2MCwgMjAyMC8wMi8xMy0wMTowNzoyMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIxLjEgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RTU2MjEzMDM3QzNBMTFFQzk2QkZDMkFDOTI3NEUzMTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RTU2MjEzMDQ3QzNBMTFFQzk2QkZDMkFDOTI3NEUzMTYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFNTYyMTMwMTdDM0ExMUVDOTZCRkMyQUM5Mjc0RTMxNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFNTYyMTMwMjdDM0ExMUVDOTZCRkMyQUM5Mjc0RTMxNiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PnYNdPsAAAIqSURBVHjalFM7i1pREJ71iQgWIhaKhaAEhID4agIWi4022whaW2m72MdqY5MtLLTIDxDLNKIgNgqKICoLKisoGMv4QFHxsU5mLvFyEyJkBw7ncGa+794z3zd39XodJpMJFAoFWCwWcDwehV2n06lOp9PD29vb/Wg0+ki7ASjkcvlPu93+olQqqzKZ7Ptmsznq9XpQqVTAeyQSAavVCgqQhEajgcvlol4ul4/j8ThBV5Zrzul0Cnu32/0wHA4/0TFO6wf9QM5oND4T9iDlkiEiKBQK0Gq1MJ/Pg81m84WIn2KxmCWdTkM0GoXVagWdTkdYu90OQqEQqNVqSCQSlvV6/cQYxjIHczEn9Ho9KBaL4PF4PtOH0OVyYaPRQGmUSiUMh8NIH8FWqyXc+f1+zOVyOBgM0OfzIWOZg7mYE9rtNgQCgQwn4vG4SDadTsVzJpMRgNdFQJzNZmg2m8UaxnKOuZgTTCbTN77IZrNiUbVaRa/Xi+fzGVOpFCaTSbTZbCJxMBgU6txuN1YqFRHHHJxnzj/EuwY5AEhtdgCUy2Wg1sC741Yr+Jn8XH62tA3/3Yq/xWMhWBAWhgXiYMFYuHeJV6vVIJ/PC8Ymrwap4JWLyEpIlkKyFpLFxD/jM99xjmt+v+KVsczBXMx5J528/X4P2+1W3e/3H8mftwZE2klhQBwOxzN5+MAD9s/JY2JywsFgMHyh5Feawgcaa2GkifDmSBNGwDLxNX4JMACTUN1nilJXvgAAAABJRU5ErkJggg==);
  }
  @-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}
  </style>
</head>
<body>

 <!---   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Back to Services</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.html" onclick="closeForm()">Home Page</a>
                    </li>
                    <li>
                        <a href="coverletter.php" onclick="closeForm()">introduction</a>
                    </li>
                    <li>
                        <a href="logout.php" onclick="closeForm()">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>--->

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Change your xXx Password</h2>
                   <p style="color:red;"><?php echo $_SESSION['msg1'];?><?php echo $_SESSION['msg1']="";?></p>
             <form name="chngpwd" action="" method="post" ID="myForm" onSubmit="return valid();">
              <table text-align="center">
			  <tr height="50">
			  <td>Old Password :</td>
			  <td><input type="password" name="opwd" id="opwd"></td>
			  </tr>
		  <tr height="50">
			  <td>New Password :</td>
			  <td><input type="password" name="npwd" id="npwd"></td>
			  </tr>
		  <tr height="50">
			  <td>Confirm Password :</td>
			  <td><input type="password" name="cpwd" id="cpwd"></td>
			  </tr>
			  <tr>
			  <td><a href="index.php" onclick="closeForm()">Back to login Page</a></td>
			  <td><input type="submit" name="Submit" value="Change Password" /></td>
			  <td><button type ="button" class="btn cancel" onclick="closeForm()">Close</button><td>
			  </tr>
                <tr>
              <td></td>
              <td></td>
              </tr>
			  </table>
			  </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="funcs/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="funcs/bootstrap.min.js"></script>
</body>

</html>
