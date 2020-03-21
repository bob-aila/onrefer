<?php

    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */

    require('database.php');
    // Escape user inputs for security
    $username = ($_POST['username']);   
    $password = ($_POST['password']);
    // attempt insert query execution
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if(mysqli_query($con,$sql)){
        echo "Records added successfully.";
        echo '<br>'.'You are succssesfully registered';
    }
     else{
        echo "ERROR: Could not able to execute";
    }

