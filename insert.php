<?php
require('database.php');
if("$_POST[username]"=="$_POST[inviter]"){
    die("Offence reported, You can not invite yourself!");
}
$check="SELECT * FROM registered WHERE username = '$_POST[username]'";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] < 1) {
$check="SELECT * FROM users WHERE username = '$_POST[username]'";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 0) {
    $check="SELECT * FROM users WHERE username = '$_POST[inviter]'";
    $rs = mysqli_query($con,$check);
    $data = mysqli_fetch_array($rs, MYSQLI_NUM);
  if($data[0] > 0) {
    $sql="INSERT INTO registered (Firstname, Lastname, email, contact, username,inviter) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[email]','$_POST[contact]','$_POST[username]', '$_POST[inviter]')";
    if(!mysqli_query($con, $sql)){
    die('Error: ' . mysqli_error($con));
    }
   header('Location: users.php');
   mysqli_close($con);

}else{
      die("Check the inviters username!");
      }}else{
      die("Your username has not been registered!");}
    else{
         die("Reported!.Dont Change your username!");
    }
?>
