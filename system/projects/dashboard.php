<?php
$APP_URL = 'http://localhost/task_Manager';
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_name = "task_manager";

// Create connection
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$headers = apache_request_headers();
if(isset($headers['route']) && $headers['route'] == 'CREATE'){
    $error = array(
        "title" => '',
        "description" => '',
    );
    $project_title = '';
    $description = '';
    $error_count = 0;
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
    if($error_count > 0){
        echo json_encode(array('status' => 5000, 'error' => $error));
        exit();
    }

    $date = date("Y/m/d");
    $sql = "INSERT INTO projects (title, description, created_at) VALUES ('$project_title', '$description', '$date')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        session_start();
        $user_id = $_SESSION['id'];
        $sql2 = "INSERT INTO projects_members (project_id, member_id, member_type, member_status) VALUES ('$last_id', '$user_id', 1, 1)";
        if ($conn->query($sql2) === TRUE) {
            echo json_encode(array('status' => 2000, 'message' => 'Successfully Created'));
            $conn->close();
            exit();
        }else{
            $error['name'] = "something went wrong";
            echo json_encode(array('status' => 5000, 'error' => $error));
            $conn->close();
            exit();
        }
    }
    else {
        $error['name'] = "something went wrong";
        echo json_encode(array('status' => 5000, 'error' => $error));
        $conn->close();
        exit();
    }

}

if(isset($headers['route']) && $headers['route'] == 'GET_ALL'){
    $projects = [];

    session_start();
    $user_id = $_SESSION['id'];
    $sql = "Select projects_members.id, projects.id as projects_id, projects.title, projects.description,  projects.created_at from projects_members JOIN projects on projects.id = projects_members.project_id 
            where projects_members.member_id =".$user_id." AND projects_members.member_type = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }
    echo json_encode(array('status' => 2000, 'data' => $projects));
}

if(isset($headers['route']) && $headers['route'] == 'GET_ALL_OTHER'){
    $projects = [];

    session_start();
    $user_id = $_SESSION['id'];
    $sql = "Select projects_members.id, projects.id as projects_id, projects.title, projects.description,  projects.created_at from projects_members JOIN projects on projects.id = projects_members.project_id 
            where projects_members.member_id =".$user_id." AND projects_members.member_type = 2";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }
    echo json_encode(array('status' => 2000, 'data' => $projects));
}

if(isset($headers['route']) && $headers['route'] == 'GET_SINGLE'){
    $project_id = $_POST['project_id'];
    $sql = "SELECT * FROM projects WHERE id=".$project_id;
    $result = $conn->query($sql);
    $Project = $result->fetch_assoc();
    echo json_encode(array('status' => 2000, 'data' => $Project));
    exit();
}

if(isset($headers['route']) && $headers['route'] == 'UPDATE'){
    $error = array(
        "title" => '',
        "description" => '',
    );
    $project_title = '';
    $description = '';
    $error_count = 0;
    $project_title = $_POST['project_title'];
    $description = $_POST['description'];
    $project_id = $_POST['project_id'];
    if($project_title == ''){
        $error['title'] = "Title field is required";
        $error_count++;
    }
    if($description == ''){
        $error['description'] = "Description field is required";
        $error_count++;
    }
    if($error_count > 0){
        echo json_encode(array('status' => 5000, 'error' => $error));
        exit();
    }
    $sql = "UPDATE projects SET title='".$project_title."', description='".$description."' WHERE id=".$project_id;
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 2000, 'message' => 'Successfully Updated'));
        $conn->close();
        exit();
    }
    else {
        $error['name'] = "something went wrong";
        echo json_encode(array('status' => 5000, 'error' => $error));
        $conn->close();
        exit();
    }

}

if(isset($headers['route']) && $headers['route'] == 'ADD_MEMBER'){
    $error = array(
        "project_id" => '',
        "email" => '',
    );
    $error_count = 0;
    $project_id = '';
    $email = '';

    $project_id = $_POST['project_id'];
    $email = $_POST['email'];

    if($project_id == ''){
        $error['project_id'] = "Project id field is required";
        $error_count++;
    }
    if($email == ''){
        $error['email'] = "Email address field is required";
        $error_count++;
    }
    if($error_count > 0){
        echo json_encode(array('status' => 5000, 'error' => $error));
        exit();
    }
    $email_check_sql = "SELECT *  FROM `users` WHERE `email` = '".$email."'";
    $result = $conn->query($email_check_sql);
    if($result->num_rows == 0) {
        $error['email'] = "Email address is invalid";
        echo json_encode(array('status' => 5000, 'error' => $error));
        exit();
    }
    $user = $result->fetch_assoc();
    $user_id = $user['id'];

    $member_check_sql = "SELECT *  FROM `projects_members` WHERE `project_id` = ".$project_id." AND `member_id` = ".$user_id;
    $mem_result = $conn->query($member_check_sql);
    if($mem_result->num_rows == 0) {
        $sql = "INSERT INTO projects_members (project_id, member_id, member_type, member_status) VALUES ('$project_id', $user_id, 2, 0)";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('status' => 2000, 'message' => 'Successfully Member added'));
            $conn->close();
            exit();
        }
        else {
            $error['name'] = "something went wrong";
            echo json_encode(array('status' => 5000, 'error' => $error));
            $conn->close();
            exit();
        }
    } else {
        $error['email'] = "User Already a member";
        echo json_encode(array('status' => 5000, 'error' => $error));
        exit();
    }
}

if(isset($headers['route']) && $headers['route'] == 'GET_MEMBER'){
    $members = [];
    $project_id = $_POST['project_id'];
    $members_sql = "Select projects_members.id, projects_members.member_status, projects_members.member_type, users.id as user_id, users.name, projects_members.project_id  from projects_members JOIN users on users.id = projects_members.member_id where projects_members.project_id =".$project_id;
    $result = $conn->query($members_sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    }
    echo json_encode(array('status' => 2000, 'data' => $members));
    exit();
}

if(isset($headers['route']) && $headers['route'] == 'DELETE_MEMBER'){
    $project_id = $_POST['project_id'];
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM projects_members WHERE project_id=".$project_id." AND member_id=".$user_id;
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 2000, 'message' => 'Member removed successfully'));
        exit();
    } else {
        echo json_encode(array('status' => 5000, 'message' => 'Something went wrong'));
        exit();
    }
}

if(isset($headers['route']) && $headers['route'] == 'DELETE'){
    $project_id = $_POST['project_id'];
    $sql = "DELETE FROM projects WHERE id=".$project_id;
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 2000, 'message' => 'Project removed successfully'));
        exit();
    } else {
        echo json_encode(array('status' => 5000, 'message' => 'Something went wrong'));
        exit();
    }
}








