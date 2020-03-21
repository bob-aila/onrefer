
<?php
require('database.php');
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$id=$_REQUEST['id'];
$query = "SELECT * from registered where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$firstname =$_REQUEST['firstname'];
$lastname =$_REQUEST['lastname'];
$email =$_REQUEST['email'];
$contact =$_REQUEST['contact'];
$username =$_REQUEST['username'];
$inviter =$_REQUEST['inviter'];
$update="update registered set Firstname='".$firstname."', Lastname='".$lastname."', email='".$email."',contact='".$contact."', username='".$username."', inviter='".$inviter."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error($con));
header ('Location: summary.php');
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div class="content">
			<h2>Record Update</h2>
			<div class="login-page">
             <div class="form">
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
 <p><input type="text" name="firstname" placeholder="firstname" required pattern="[A-Za-z]*$" value="<?php echo $row['Firstname'];?>" /></p>
 <p><input type="text" name="lastname" placeholder="lastname" required pattern="[A-Za-z]*$" value="<?php echo $row['Lastname'];?>" /></p>
 <p><input type="text" name="email" placeholder="@gmail." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required value="<?php echo $row['email'];?>" /></p>
 <p><input type="number" patern="0([0-9]){9}" name="contact" placeholder="07---------" required  value="<?php echo $row['contact'];?>" /></p>
 <p><input type="text" name="username" required value="<?php echo $row['username'];?>" /></p>
 <p><input type="text" name="inviter" required value="<?php echo $row['inviter'];?>" /></p>
</form>
    <?php } ?>
                </div>
    </div>
            </div>