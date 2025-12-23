<?php
session_start();
include 'conn.php';


if(!isset($_POST["btn_2"])) die("invalid");

$password = $_POST["password"];
$email = $_POST["email"];

if (empty($password))
    header("Location: account.php?isvalid=Enter password");

if (!$conn)
    die("Sorry, you can't connect to the database.");

$sql = "SELECT * FROM `user_details` WHERE `username` ='$email' AND `user_password` = '$password'";
printf($sql);
if($result = mysqli_query($conn, $sql))
    if(mysqli_num_rows($result) > 0)
        header("Location: index.html");
    else
        header("Location: account.php?isvalid=Invalid password or email");
?>