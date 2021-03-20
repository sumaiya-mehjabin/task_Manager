<?php
$APP_URL = 'http://localhost/task_Manager';
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_name = "task_manager";
$project_id = $_GET['id'];

// Create connection
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM projects WHERE id=".$project_id;
$result = $conn->query($sql);
$Project = $result->fetch_assoc();

$conn->close();
?>
