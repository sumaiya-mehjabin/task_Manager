<?php
$APP_URL = 'https://demo1.redishketch.com';
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
    $start_date = $_POST['project_start_date'];
    $end_date = $_POST['project_end_date'];
    $users = $_POST['users'];

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
    $sql = "INSERT INTO projects (title, description, start_date, end_date, created_at) VALUES ('$project_title', '$description', '$start_date', '$end_date', '$date')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        session_start();
        $user_id = $_SESSION['id'];
        $sql2 = "INSERT INTO projects_members (project_id, member_id, member_type, member_status) VALUES ('$last_id', '$user_id', 1, 1)";
        if ($conn->query($sql2) === TRUE) {
            foreach ($users as $user){
                $mem_id = $user;
                $sql2 = "INSERT INTO projects_members (project_id, member_id, member_type, member_status) VALUES ('$last_id', '$mem_id', 2, 1)";
                $conn->query($sql2);
            }
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
    $sql = "Select projects_members.id, projects.id as projects_id, projects.title, projects.description, projects.start_date, projects.end_date,  projects.created_at from projects_members JOIN projects on projects.id = projects_members.project_id 
            where projects_members.member_id =".$user_id." AND projects_members.member_type = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $pro_id = $row['projects_id'];
            $rowcount = 0;
            $sql_count = "Select * from projects_tasks where project_id =".$pro_id;
            if ($res_count=mysqli_query($conn,$sql_count)) {
                $rowcount=mysqli_num_rows($res_count);
            }
            $row['tasks'] = $rowcount;


            $rowcount_progress = 0;
            $sql_count_progress = "Select * from projects_tasks where project_id =".$pro_id." AND status = 2";
            if ($res_count_progress=mysqli_query($conn,$sql_count_progress)) {
                $rowcount_progress=mysqli_num_rows($res_count_progress);
            }
            $row['tasks_progress'] = $rowcount_progress;

            $rowcount_done = 0;
            $sql_count_done = "Select * from projects_tasks where project_id =".$pro_id." AND status = 3";
            if ($res_count_done=mysqli_query($conn,$sql_count_done)) {
                $rowcount_done=mysqli_num_rows($res_count_done);
            }
            $row['tasks_done'] = $rowcount_done;


            $row['start_date_formatted'] = date("d M,Y h:iA", strtotime($row['start_date']));
            $row['end_date_formatted'] = date("d M,Y h:iA", strtotime($row['end_date']));
            $projects[] = $row;
        }
    }
    echo json_encode(array('status' => 2000, 'data' => $projects));
}

if(isset($headers['route']) && $headers['route'] == 'GET_ALL_OTHER'){
    $projects = [];

    session_start();
    $user_id = $_SESSION['id'];
    $sql = "Select projects_members.id, projects.id as projects_id, projects.title, projects.description, projects.start_date, projects.end_date,  projects.created_at from projects_members JOIN projects on projects.id = projects_members.project_id 
            where projects_members.member_id =".$user_id." AND projects_members.member_type = 2";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $pro_id = $row['projects_id'];
            $rowcount = 0;
            $sql_count = "Select * from projects_tasks where project_id =".$pro_id;
            if ($res_count=mysqli_query($conn,$sql_count)) {
                $rowcount=mysqli_num_rows($res_count);
            }
            $row['tasks'] = $rowcount;

            $rowcount_progress = 0;
            $sql_count_progress = "Select * from projects_tasks where project_id =".$pro_id." AND status = 2";
            if ($res_count_progress=mysqli_query($conn,$sql_count_progress)) {
                $rowcount_progress=mysqli_num_rows($res_count_progress);
            }
            $row['tasks_progress'] = $rowcount_progress;

            $rowcount_done = 0;
            $sql_count_done = "Select * from projects_tasks where project_id =".$pro_id." AND status = 3";
            if ($res_count_done=mysqli_query($conn,$sql_count_done)) {
                $rowcount_done=mysqli_num_rows($res_count_done);
            }
            $row['tasks_done'] = $rowcount_done;


            $row['start_date_formatted'] = date("d M,Y h:iA", strtotime($row['start_date']));
            $row['end_date_formatted'] = date("d M,Y h:iA", strtotime($row['end_date']));
            $projects[] = $row;
        }
    }
    echo json_encode(array('status' => 2000, 'data' => $projects));
}

if(isset($headers['route']) && $headers['route'] == 'GET_ALL_USERS'){
    $users = [];

    session_start();
    $user_id = $_SESSION['id'];
    $sql = "Select * from users where users.id !=".$user_id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    echo json_encode(array('status' => 2000, 'data' => $users));
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
    $start_date = $_POST['project_start_date'];
    $end_date = $_POST['project_end_date'];
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
    $sql = "UPDATE projects SET title='".$project_title."', description='".$description."', start_date='".$start_date."', end_date='".$end_date."' WHERE id=".$project_id;
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








