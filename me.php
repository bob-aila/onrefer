<?

<?php
/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
  require('database.php');
  $token = bin2hex(random_bytes(50));
if (isset($_POST['reset'])) {
  $initial =$_POST['initial'];
  // ensure that the user exists on our system
  if (empty($initial)) {
      echo "<script type='text/javascript'>alert('Your username is required');</script>";
      	header('Location: me.php');
      	exit();
  }
  // generate a unique random token of length 100
  $query = "SELECT email FROM registered WHERE username='$initial'";
  $result = mysqli_query($con, $query) or die ( mysqli_error());
  $row = mysqli_fetch_assoc($result);
   if(mysqli_num_rows($result) <= 0) {
                   echo "<script type='text/javascript'>alert('Sorry, please register your details first');</script>";
       	header('Location: me.php');
       	exit();
  }
  else{
    $email=$row['email'];
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO passreset(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($con, $sql);
    // Send email to user with the token in a link they can click on
    $to = $email;
    $subject = "Reset your password on onrefer.herokuapp.com";
    $msg = "Hi there, click on this <a href=\"me.php?token=" . $token . "\">link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    $headers = "From: onrefer53@gmail.com";
    mail($to, $subject, $msg, $headers);
    echo "<script type='text/javascript'>alert(' Please check your email for a reset link');</script>";
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new-password'])) {
  $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($con, $_POST['new_pass_c']);
  $token = $_SESSION['token'];
  // Grab to token that came from the email link
  if (empty($new_pass) || empty($new_pass_c))      echo "<script type='text/javascript'>alert('Password is required');</script>";
  if ($new_pass !== $new_pass_c) echo "<script type='text/javascript'>alert('Password do not match');</script>";
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM passreset WHERE token='$token' LIMIT 1";
    $results = mysqli_query($con, $sql);
    $email = mysqli_fetch_assoc($results)['email'];
    if ($email) {
      $new_pass = md5($new_pass);
      $sql = "UPDATE users SET password='$new_pass' WHERE username='$user'";
      $results = mysqli_query($con, $sql);
      header('location: index.php');
    } echo "<script type='text/javascript'>alert('Sorry, You have not applied for password reset');</script>";
}
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>onRefer</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" class="politics_version">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
			<img class="img-fluid" src="images/logo.png" alt="" />
		</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="users.php">Home</a>
            </li>
			<li class="nav-item">
                <a class="nav-link js-scroll-trigger" 
             href="logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

		<div id="pricing" class="section lb">
		<div class="container">
                  <div class="logsize">                 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Password</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body oncontextmenu="return false" onselectstart="return false" on ondragstart="return false">
<h2><center>Password Reset</center></h2>
<center><form method="post" action="reset.php">
 <div class="container">
    <label for="username"><b>Current Password</b></label>
    <input type="text" name="initial" placeholder=" confirm username">
         <button type="submit" name="reset">Change</button>
  </div>
</form></center>
</body>
</html>
   
        </div>
    </div>
    </div>
	
    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
				<a href="#"><img src="images/logo.png" alt="" /></a>
                <div class="footer-center">
                    <p class="footer-links">
                        <a href="index.php">Home</a>
                
                    </p>
                    <p class="footer-company-name">All Rights Reserved. &copy; 2020 <a href="#">onRefer</a> Design By : 
					<a href="https://html.design/">schweitzer</a></p>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
	<!-- Camera Slider -->
	<script src="js/jquery.mobile.customized.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script> 
	<script src="js/parallaxie.js"></script>
	<script src="js/headline.js"></script>
	<!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
    <script src="js/jquery.vide.js"></script>

</body>
</html>
