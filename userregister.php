<?php
session_start();
require('database.php');
if (!isset($_SESSION['loggedin'])) {
header('Location: index.html');
exit();
}
$check = "SELECT * FROM admin WHERE username='$_SESSION[name]' LIMIT 1";
    $results = mysqli_query($con,$check);
    if (mysqli_num_rows($results) <>1) {
    header('Location: index.html');
    exit();
    }
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

    <!-- LOADER -->
    <div id="preloader">
        <div id="main-ld">
			<div id="loader"></div>  
		</div>
    </div><!-- end loader -->
    <!-- END LOADER -->
	
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
              <a class="nav-link js-scroll-trigger active" href="admin.php">Home</a>
            </li>
                          <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="#pricing">Users</a>
            </li>
              <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="#portfolio">Admins</a>
            </li>
               <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

	<div id="pricing" class="section lb">
		<div class="container">
			<div class="section-title text-center">
			<p><h3>Users Logins Registration</h3>
			
	<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
			
             <div class="form">
				<form class="register-form" action="demoinsert.php" method="post">
                    Username:<p></p><input type="text" name="username" placeholder="username" id="username" required><p></p>Password:<p> </p>
                    <input type="text" name="password" placeholder="password" id="password" required><p></p>   
                    <center><input type="submit" value="Submit"></center>

          </form>
                </div>
        </body>
		</div>
                    
            </div><!-- end title -->

		<div id="portfolio" class="section lb">
		<div class="container">
			<div class="section-title text-center">
                <h3>Admins Registration</h3>
            </div><!-- end title -->
            <body class="loggedin">
             <div class="form">
				<form class="register-form" action="demoinserta.php" method="post">
                    Username:<p></p><input type="text" name="adm" placeholder="username" id="adm" required><p></p>Password:<p></p>  
                    <input type="text" name="pass" placeholder="password" id="pass" required><p></p>   
                    <center><input type="submit" value="Submit"></center>
               
          </form>
			</div>
            </body>
		</div>
        </div>
    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
				<a href="#"><img src="images/logo.png" alt="" /></a>
                <div class="footer-center">
                    <p class="footer-links">
                        <a href="index.html">Home</a>
                
                    </p>
                    <p class="footer-company-name">All Rights Reserved. &copy; 2020 <a href="#">onRefer</a> Design By : 
					<a href="https://www.linkedin.com/in/bob-philip-54102a162">schweitzer</a></p>
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
