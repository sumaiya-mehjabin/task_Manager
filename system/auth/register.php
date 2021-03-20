<?php
include 'globals/core.php';
$error = array(
    "name" => '',
    "phone" => '',
    "email" => '',
    "password" => '',
);
$error_count = 0;

$name = '';
$phone = '';
$email = '';
$password = '';
$confirm_password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($name == ''){
        $error['name'] = "Name field is required";
        $error_count++;
    }
    if($phone == ''){
        $error['phone'] = "Phone field is required";
        $error_count++;
    }

    if (!(preg_match('/^[0-9]+$/', $phone))) {
        $error['phone'] = "Phone field must be number";
        $error_count++;
    }

    if($email == ''){
        $error['email'] = "Email field is required";
        $error_count++;
    }
    if($password == ''){
        $error['password'] = "Password field is required";
        $error_count++;
    }
    if($confirm_password == ''){
        $error['confirm_password'] = "Confirm password field is required";
        $error_count++;
    }
    if($confirm_password != $password){
        $error['confirm_password'] = "Confirm password didn't match password field";
        $error_count++;
    }


    if($error_count > 0){
     return;
    }
    $bash_password = md5($password);

    $sql = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$bash_password')";
    if ($conn->query($sql) === TRUE) {
        header('Location: '.$APP_URL.'/pages/auth/login.php');
    }
    else {
        $error['name'] = "something went wrong";
        $error_count++;
    }
    $conn->close();
}









