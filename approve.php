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
<?php
require('database.php');
$id=$_REQUEST['id'];
$query = "SELECT * from withdraw where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update User Details</title>
<link rel="stylesheet" href="responsive/responsive.css">
    <!-- Custom CSS -->
</head>
<body class="loggedin" oncontextmenu="return false;">
     <!--Step 1:Adding HTML-->
    <p></p><button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Aprove</button> 
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$username =$_REQUEST['username'];
$phone =$_REQUEST['phone'];
$amount =$_REQUEST['amount'];
$status =$_REQUEST['status'];
$update="update withdraw set username='".$username."', phone='".$phone."', amount='".$amount."',status='Approved' where id='$id'";
mysqli_query($con, $update) or die(mysqli_error($con));

require('database.php');
$sel_query="SELECT * FROM main WHERE username='$username'";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$tot=$row["total"];
$with=$row["withdrawn"];
$withdrawn=$with+$amount;
$balance=$tot-$withdrawn;
$update="UPDATE main set withdrawn='$withdrawn',balance='$balance' WHERE username='$username'";
    mysqli_query($con, $update) or die(mysqli_error($con));
    header ('location: withdrawals.php');
}
}else {
?>
			<div id="id01" class="modal"> 
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span> 
        <form class="modal-content animate" method="post" action="" enctype="multipart/form-data".<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>> 
            <div class="container"> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

 <p><input type="hidden" name="username" placeholder="username" value="<?php echo $row['username'];?>" /></p>
               
 <p><input type="hidden" name="phone" placeholder="phone"  value="<?php echo $row['phone'];?>" /></p>
               
 <p><input type="hidden" name="amount"  required value="<?php echo $row['amount'];?>" /></p>
                <label><b>Status</b></label>
 <p><input type="text" name="status"  value="<?php echo $row['status'];?>" /></p>
     <div id="anr_captcha_field_1" class="anr_captcha_field_div"></div>
         <script src="https://www.google.com/recaptcha/api.js?onload=anr_onloadCallback&#038;render=explicit"
				async defer></script>
                <div class="clearfix"> 
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Wait</button> 
                    <button type="submit" class="signupbtn">Verify</button> 
                </div> 
            </div>
</form>
    <?php } ?>
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