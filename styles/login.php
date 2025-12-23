<?php

include 'conn.php';


$user_username = $user_password ='';
$error = '';


if(isset($_POST['submit_button'])){
    
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];
    
    
    
 
    if($user_password !== $conf_user_password){
        $error = "Passwords do not match.";
    }else { 
        $insert_query = "INSERT INTO `user_details` (username, email, user_password) VALUES ('$user_username', '$user_email', '$user_password')";

        $sql_execute = mysqli_query($conn, $insert_query);

        if($sql_execute){
            echo "<script>alert('Registration Successful');</script>";
            
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="Registration.css">
</head>
<body>
    <div class="login-container">
        <form action="" method="post">
            <h2>Login</h2>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" name="submit_button">Login</button>
        </form>
    </div>
    
</body>
</html>