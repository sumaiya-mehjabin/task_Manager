<?php


$APP_URL = 'http://localhost/task_Manager';
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_name = "task_manager";

$project = $_POST['project_title'];
$description = $_POST['description'];

if($project == ''){
    echo 'Project Name is required';
    exit();
}
if($description == ''){
    echo 'Project description is required';
    exit();
}
// Create connection
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = date("Y/m/d");
$sql = "INSERT INTO projects (title, description, created_at) VALUES ('$project', '$description', '$date')";

if ($conn->query($sql) === TRUE) {
    header('Location: '.$APP_URL.'/dashboard.php');
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
