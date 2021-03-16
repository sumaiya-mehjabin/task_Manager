<?php



$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_name = "task_manager";

$email = $_POST['email'];
$password = md5($_POST['password']);

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


$sql = "SELECT * FROM `users` WHERE username='$email'and password='".md5($password)."'";
$result = mysqli_query($conn,$sql) or die(mysql_error());
$rows = mysqli_num_rows($result);

if ($rows == 1) {
    echo "login successful";
} else {
    echo "Invalid";
}
$conn->close();

