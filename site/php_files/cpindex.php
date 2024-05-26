<?php
session_start();
include('dbconnection.php');
if(isset($_POST['login']))
{
$ret=mysqli_query($con,"SELECT * FROM userinfo WHERE email='".$_POST['username']."' and password='".$_POST['pwd']."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$extra="changepassword.php";
echo "<script>window.location.href='".$extra."'</script>";
exit();
}
else
{
$_SESSION['action1']="Invalid username or password";
$extra="index.php";
echo "<script>window.location.href='".$extra."'</script>";
exit();
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
    <title>Login for Change Password</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Back to Tutorial</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="http://www.phpgurukul.com/all-demos/">All Demos</a>
                    </li>
                    <li>
                        <a href="http://www.phpgurukul.com/category/php-projects/">Free Projects</a>
                    </li>
                    <li>
                        <a href="http://www.phpgurukul.com/contact-us/">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
  
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Login Here for change Password</h1>
                <p style="color:red;"><?php echo $_SESSION['action1'];?><?php echo $_SESSION['action1']="";?></p>
             <form name="login" action="" method="post" >
              <table align="center">
			  <tr height="50">
			  <td>User Name :</td>
			  <td><input type="text" name="username" id="opwd"></td>
			  </tr>
		  <tr height="50">
			  <td>Passowrd :</td>
			  <td><input type="password" name="pwd" id="pwd"></td>
			  </tr>
		  <tr height="50">
              <td></td>
              <td><input type="submit" name="login" Value="login"></td>
              </tr>
			  </table>
			  </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
