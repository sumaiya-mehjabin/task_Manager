<?php
$APP_URL = 'https://demo1.redishketch.com';
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "n1R4YDCHlAyx7OqJn1R4YDCHlAyx7OqJ";
$DB_name = "task_manager";
$project_id = $_GET['project_id'];

// Create connection
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM projects WHERE id=".$project_id;
$result = $conn->query($sql);
$Project = $result->fetch_assoc();

$user_id = $_SESSION['id'];

$mem_sql = "SELECT * FROM projects_members WHERE project_id=".$project_id." AND member_id=".$user_id;
$mem_result = $conn->query($mem_sql);
$Member = $mem_result->fetch_assoc();


$members_list = [];
$members_sql = "Select projects_members.id, projects_members.member_status, projects_members.member_type, users.id as user_id, users.name, projects_members.project_id   from projects_members JOIN users on users.id = projects_members.member_id where projects_members.project_id =".$project_id;
$result = $conn->query($members_sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $members_list[] = $row;
    }
}

$selected_member = '';

if(isset($_GET['member_id'])){
    $selected_member = $_GET['member_id'];
}
$keyword = '';

if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
}

$conn->close();

?>
