
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