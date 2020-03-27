
<?php
require('database.php');
$adm = ($_POST['adm']);
    $password = hash("sha256", $_POST['pass']);
     $sql = "INSERT INTO admin (username, password) VALUES ('$adm', '$pass')";
    if(mysqli_query($con,$sql)){
        echo "Records added successfully.";
        echo '<br>'.'You are succssesfully registered';
    }else{
        echo "ERROR: Could not able to execute";
    }
?>
