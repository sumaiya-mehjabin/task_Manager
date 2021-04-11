<?php
include './globals/variables.php';
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "n1R4YDCHlAyx7OqJn1R4YDCHlAyx7OqJ";
$DB_name = "task_manager";

// Create connection
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
