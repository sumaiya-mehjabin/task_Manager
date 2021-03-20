<?php
include 'globals/core.php';
$error = array(
    "email" => '',
    "password" => '',
);
$error_count = 0;
$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email == ''){
        $error['email'] = "Email field is required";
        $error_count++;
    }
    if($password == ''){
        $error['password'] = "Password field is required";
        $error_count++;
    }
    if($error_count > 0){return;}
    $bash_password = md5($password);
    $sql = "SELECT * FROM `users` WHERE email='$email'and password='".$bash_password."'";
    $result = mysqli_query($conn,$sql) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $user_sql = "SELECT * FROM users WHERE email=".$email;
        $result = $conn->query($sql);
        $User = $result->fetch_assoc();
        session_start();
        $_SESSION["id"] = $User['id'];
        $_SESSION["name"] = $User['name'];
        $_SESSION["email"] = $User['email'];
        $_SESSION["avatar"] = $User['avatar'];
        $_SESSION["phone"] = $User['phone'];
        $_SESSION["password"] = $User['password'];
        $_SESSION["is_logged_in"] = true;
        header('Location: '.$APP_URL.'/index.php');
    } else {
        $error['email'] = "invalid credential";
        $error_count++;
    }
    $conn->close();
}


