<?php
require('database.php');
$pass=hash("sha256", $_POST['password']);
$check = "SELECT * FROM users WHERE username='$_POST[username]' AND password='$pass' LIMIT 1";
$results = mysqli_query($con, $check);
if (mysqli_num_rows($results) == 1) {
$check = "SELECT * FROM registered WHERE username='$_POST[username]' AND contact='$_POST[phone]' LIMIT 1";
$results = mysqli_query($con, $check);
if (mysqli_num_rows($results) == 1) {
    $check = "SELECT * FROM main WHERE username='$_POST[username]' AND balance >='$_POST[amount]' LIMIT 1";
    $results = mysqli_query($con,$check);
   if (mysqli_num_rows($results) == 1) {
    $sql="INSERT INTO withdraw (username, phone, amount, status) VALUES ('$_POST[username]','$_POST[phone]','$_POST[amount]','PENDING')"; 
    if(!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
    }
   header('Location: users.php');
   mysqli_close($con);

}else{
      die("Reported,You cant withdraw more than you have earned!");
      }
}else{
    
      die("Register first or Use the right phone number you registered!");
}
}
die ('Wrong password!');
?>
