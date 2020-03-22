<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
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
<body oncontextmenu="return false;" id="page-top" class="politics_version">

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
              <a class="nav-link js-scroll-trigger active" href="#home">Home</a>
            </li>
               <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="#pricing">Credentials</a>
            </li>
              <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="#contact">Contact Us</a>
            </li>
               <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="#portfolio"></a>
            </li>
               <li class="nav-item">
              <a class="nav-link js-scroll-trigger active" href="input.php">Register Details</a>
            </li>
              <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section id="home" class="main-banner parallaxie" style="background: url('uploads/banner-01.jpg')">
		<div class="heading">
			<h1>Welcome to onRefer</h1>			
			<h3 class="cd-headline clip is-full-width">
				<span>Only current legit referral</span>
				<span class="cd-words-wrapper">
					<b class="is-visible">Join</b>
					<b>Invite</b>
					<b>Earn</b>
					<b>Withdraw</b>
				</span>
			</h3>
		</div>
	</section>


	<div id="pricing" class="section lb">
		<div class="container">
			 <h2><B>Your Details</B></h2>

<?php
require('database.php');
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT username FROM users WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>details</title>
	</head>
	<body class="loggedin">
		<div class="content">
			<h2>Credentials</h2>
			<div>
				<p>Your account details are as below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
						</table>
			</div>
		</div>
	</body>
</html>
</div><!-- end container -->
    </div><!-- end section -->

            
<div id="portfolio" class="section lb">
		<div class="container">
			<div class="section-title text-center">
<h3>Invites</h3>
            </div><!-- end title -->
    
<table><tr><th><strong>No</strong></th><th><strong>Firstname</strong></th><th><strong>Lastname</strong></th></tr>
<?php
require('database.php');
$username=$_SESSION['name'];
$count=1;
$sel_query="SELECT * FROM registered WHERE inviter ='$username'";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { 
?>
<tr><td align="center"><?php echo $count; ?></td><td align="center"><?php echo $row["Firstname"]; ?></td><td align="center"><?php echo $row["Lastname"]; ?></td></tr>
<?php $count++; }
?>
        </table>
        </div><!-- end container -->
    </div><!-- end section -->
    
    <div id="portfolio" class="section lb">
		<div class="container">
			<div class="section-title text-center">
<h3>Your Account</h3>
    </div><!-- end title -->

<?php
require('database.php');
$sel_query="SELECT * FROM main WHERE username='$_SESSION[name]'";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$count=$count-1;
$earnings=$count*100;
$in=$row["withdrawn"];
$your=$earnings-$row["withdrawn"];}
            $sql="UPDATE main set total='$earnings',withdrawn='$in',balance='$your' WHERE username='$_SESSION[name]'";
    if(!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
    }   
echo "You have invited "."$count"." people";
echo "<p>Total earned Ksh "."$earnings".".00";
echo "<p>Your balance is Ksh "."$your".".00";           
?>
<html>
    <head>
    <link rel="stylesheet" href="responsive/responsive.css">
    <!-- Custom CSS -->
    </head>
    <body>
    <!--Step 1:Adding HTML-->
    <p></p><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Withdraw funds</button> 
  
    <div id="id01" class="modal"> 
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span> 
        <form class="modal-content animate" method="post" action="withdraw.php" enctype="multipart/form-data".<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>> 
            <div class="container"> 
                <input name="username" type="hidden" value="<?php echo $_SESSION['name'];?>" />
                <label><b>Phone</b></label>
                <input type="number" placeholder="Mpesa number" name="phone" required> 
                <label><b>Amount</b></label> 
                <input type="number" placeholder="Amoount" name="amount" required> 
    
                <label><b>Password</b></label> 
                <input type="password" placeholder="Password" name="password" required> 
                <input type="checkbox" required><a href="api.whatsapp.com/send?phone=254753581874&text=Check%20'$_POST[username]'%20is%20withdrawing">Confirm Withdarawal</a>
                <p>By withdrawing, you agree to our terms and privacy <a href="#">Terms & Privacy</a>.</p> 
  
                <div class="clearfix"> 
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> 
                    <button type="submit" class="signupbtn">Apply</button> 
                </div> 
            </div> 
        </form> 
    </div> 
  
    <!--close the modal by just clicking outside of the modal-->
    <script> 
        var modal = document.getElementById('id01'); 
  
        window.onclick = function(event) { 
            if (event.target == modal) { 
                modal.style.display = "none"; 
            } 
        } 
    </script> 
  
</body> 

            </html>

        </div><!-- end container -->
    </div><!-- end section -->
    <div id="contact" class="section db">
        <div class="container">
            <div class="section-title text-center">
                <h3>Contact Us</h3>
            </div><!-- end title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="contact_form">
                        <div id="message"></div>
                         <p><a href="https://api.whatsapp.com/send?phone=254753581874">1. Clic here to WhatsApp Us</a></p>
                         <p><a href="mailto:onrefer53@gmail.com">2. Clic here to send us an email message</a></p>
                         
                        
                </div><!-- end col -->         
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
				<a href="#"><img src="images/logo.png" alt="" /></a>
                <div class="footer-center">
                    <p class="footer-links">
                        <a href="index.php">Home</a>
                
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
