<?php


$APP_URL = 'http://localhost/task_Manager';
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_name = "task_manager";

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = md5($_POST['password']);

if($name == ''){
    echo 'Name is required';
    exit();
}
if($phone == ''){
    echo 'Name is required';
    exit();
}
if($email == ''){
    echo 'Email is required';
    exit();
}
if($password == ''){
    echo 'Password is required';
    exit();
}
// Create connection
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    header('Location: '.$APP_URL.'/index.php');
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
