<?php
include 'globals/core.php';
$projects = [];

$project_title = '';
$description = '';


$error = array(
    "title" => '',
    "description" => '',
);
$error_count = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_title = $_POST['project_title'];
    $description = $_POST['description'];


    if($project_title == ''){
        $error['title'] = "Title field is required";
        $error_count++;
    }
    if($description == ''){
        $error['description'] = "Description field is required";
        $error_count++;
    }

    $date = date("Y/m/d");

    $sql = "INSERT INTO projects (title, description, created_at) VALUES ('$project_title', '$description', '$date')";

    if ($conn->query($sql) === TRUE) {
        header('Location: '.$APP_URL.'/index.php');
    }
    else {
        $error['name'] = "something went wrong";
        $error_count++;
    }
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM projects";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }
    $conn->close();
}

