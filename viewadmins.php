<?php
session_start();
require('database.php');
if (!isset($_SESSION['loggedin'])) {
header('Location: index.php');
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
              <a class="nav-link js-scroll-trigger" href="#edit">Edit</a>
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
			 <h2><B>Admins</B></h2>
<table><tr><th><strong>No</strong></th><th><strong>Admin</strong></th><th><strong>Password</strong></th></tr>
<?php
require('database.php');
$count=1;
$sel_query="Select * from admin ORDER BY id desc";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { 
?>
<tr><td align="center"><?php echo $count; ?></td><td align="center"><?php echo $row["username"]; ?></td><td align="center"><?php echo $row["password"]; ?></td><td align="center"><a href="#edit?id=<?php echo $row["id"]; ?>">Edit</a></td><td align="center"><a href="deletea.php?id=<?php echo $row["id"]; ?>">Delete</a></td></tr>
<?php $count++; } ?>
        </table>
        </div>
			
		</div>
	 <div id="eedit" class="section db">
        <div class="container">
            <div class="section-title text-center">
                <h3>Edit</h3>
                <p>for faster response to your questions fill all the apaces</p>
            </div><!-- end title -->

<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    header('Location: index.html');
	exit();
}

$id=$_REQUEST['id'];
require('database.php');
$query = "SELECT * from admin where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<body class="loggedin">
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$username =$_REQUEST['username'];
$password =$_REQUEST['password'];
$update="update admin set username='".$username."', password='".$password."'";
mysqli_query($con, $update) or die(mysqli_error($con));
echo "record Updated Successfully". "</br></br><a href='viewdetails.php'>View Updated</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
             <div class="form">
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
 <p><input type="text" name="username" placeholder="username" required value="<?php echo $row['username'];?>" /></p>
 <p><input type="text" name="password" placeholder="password" required value="<?php echo $row['password'];?>" /></p>

  <p><input name="submit" type="submit" value="Update" /></p>
</form>
    <?php } ?>
</div>

</body>
            
            
        </div><!-- end container -->
    </div><!-- end section -->

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
