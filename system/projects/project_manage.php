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
    $error = array();
    $error_count = 0;
    if(!isset($_POST['assigned_member']) && $_POST['assigned_member'] == ''){
        $error['assigned_member'] = "Assigned member field is required";
        $error_count++;
    }

    if(!isset($_POST['task_description']) && $_POST['task_description'] == ''){
        $error['task_description'] = "Task Description field is required";
        $error_count++;
    }

    if(!isset($_POST['task_due']) && $_POST['task_due'] == ''){
        $error['task_due'] = "Due date field is required";
        $error_count++;
    }

    if(!isset($_POST['task_title']) && $_POST['task_title'] == ''){
        $error['task_title'] = "Title field is required";
        $error_count++;
    }
    if($error_count > 0){
        echo json_encode(array('status' => 5000, 'error' => $error));
        exit();
    }

    $project_id = $_POST['project_id'];
    $task_title = $_POST['task_title'];
    $task_description = $_POST['task_description'];
    $task_due = $_POST['task_due'];
    $assigned_member = $_POST['assigned_member'];

    $sql = "INSERT INTO projects_tasks (title, project_id, description, due_date, assigned_member) VALUES ('$task_title', '$project_id', '$task_description', '$task_due', '$assigned_member')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 2000, 'message' => 'Successfully Created'));
        $conn->close();
        exit();
    }
    else {
        $error['name'] = "something went wrong";
        echo json_encode(array('status' => 5000, 'error' => $conn -> error));
        $conn->close();
        exit();
    }

}

if(isset($headers['route']) && $headers['route'] == 'GET_ALL_TASK'){
    $project_id = $_POST['project_id'];
    session_start();
    $user_id = $_SESSION['id'];

    if(isset($_POST['selected_member']) && $_POST['selected_member'] != ''){
        $selected_member = $_POST['selected_member'];
        $keyword = '';
        if(isset($_POST['keyword']) && $_POST['keyword'] != ''){
            $keyword = $_POST['keyword'];
        }
        $tasks_todo = [];
        $tasks_on_progress = [];
        $tasks_done = [];

        $todo_sql = "SELECT projects_tasks.*, users.name as member_name FROM projects_tasks LEFT JOIN users ON users.id = projects_tasks.assigned_member WHERE projects_tasks.title like '%".$keyword."%' AND projects_tasks.project_id=".$project_id." AND projects_tasks.assigned_member=".$selected_member." AND projects_tasks.status = 1";
        $todo_result = $conn->query($todo_sql);
        if ($todo_result->num_rows > 0) {
            // output data of each row
            while($row = $todo_result->fetch_assoc()) {
                $row['has_access'] = 0;
                if($user_id == $row['assigned_member']){
                    $row['has_access'] = 1;
                }
                $tasks_todo[] = $row;
            }
        }

        $on_progress_sql = "SELECT projects_tasks.*, users.name as member_name FROM projects_tasks LEFT JOIN users ON users.id = projects_tasks.assigned_member WHERE projects_tasks.title like '%".$keyword."%' AND projects_tasks.project_id=".$project_id." AND projects_tasks.assigned_member=".$selected_member." AND projects_tasks.status = 2";
        $on_progress_result = $conn->query($on_progress_sql);
        if ($on_progress_result->num_rows > 0) {
            // output data of each row
            while($row = $on_progress_result->fetch_assoc()) {
                $row['has_access'] = 0;
                if($user_id == $row['assigned_member']){
                    $row['has_access'] = 1;
                }
                $tasks_on_progress[] = $row;
            }
        }

        $done_sql = "SELECT projects_tasks.*, users.name as member_name FROM projects_tasks LEFT JOIN users ON users.id = projects_tasks.assigned_member WHERE projects_tasks.title like '%".$keyword."%' AND projects_tasks.project_id=".$project_id." AND projects_tasks.assigned_member=".$selected_member." AND projects_tasks.status = 3";
        $done_result = $conn->query($done_sql);
        if ($done_result->num_rows > 0) {
            // output data of each row
            while($row = $done_result->fetch_assoc()) {
                $row['has_access'] = 0;
                if($user_id == $row['assigned_member']){
                    $row['has_access'] = 1;
                }
                $tasks_done[] = $row;
            }
        }

        $rowcount = 0;
        $sql_count = "Select * from projects_tasks where project_id =".$project_id;
        if ($res_count=mysqli_query($conn,$sql_count)) {
            $rowcount=mysqli_num_rows($res_count);
        }

        $rv = array(
            'todo' => $tasks_todo,
            'on_progress' => $tasks_on_progress,
            'done' => $tasks_done
        );
        echo json_encode(array('status' => 2000, 'data' => $rv, 'total' => $rowcount));
    }
    else{
        $keyword = '';
        if(isset($_POST['keyword']) && $_POST['keyword'] != ''){
            $keyword = $_POST['keyword'];
        }
        $tasks_todo = [];
        $tasks_on_progress = [];
        $tasks_done = [];

        $todo_sql = "SELECT projects_tasks.*, users.name as member_name FROM projects_tasks LEFT JOIN users ON users.id = projects_tasks.assigned_member WHERE projects_tasks.title like '%".$keyword."%' AND projects_tasks.project_id=".$project_id." AND projects_tasks.status = 1";
        $todo_result = $conn->query($todo_sql);
        if ($todo_result->num_rows > 0) {
            // output data of each row
            while($row = $todo_result->fetch_assoc()) {
                $row['has_access'] = 0;
                if($user_id == $row['assigned_member']){
                    $row['has_access'] = 1;
                }
                $tasks_todo[] = $row;
            }
        }

        $on_progress_sql = "SELECT projects_tasks.*, users.name as member_name FROM projects_tasks LEFT JOIN users ON users.id = projects_tasks.assigned_member WHERE projects_tasks.title like '%".$keyword."%' AND projects_tasks.project_id=".$project_id." AND projects_tasks.status = 2";
        $on_progress_result = $conn->query($on_progress_sql);
        if ($on_progress_result->num_rows > 0) {
            // output data of each row
            while($row = $on_progress_result->fetch_assoc()) {
                $row['has_access'] = 0;
                if($user_id == $row['assigned_member']){
                    $row['has_access'] = 1;
                }
                $tasks_on_progress[] = $row;
            }
        }

        $done_sql = "SELECT projects_tasks.*, users.name as member_name FROM projects_tasks LEFT JOIN users ON users.id = projects_tasks.assigned_member WHERE projects_tasks.title like '%".$keyword."%' AND projects_tasks.project_id=".$project_id." AND projects_tasks.status = 3";
        $done_result = $conn->query($done_sql);
        if ($done_result->num_rows > 0) {
            // output data of each row
            while($row = $done_result->fetch_assoc()) {
                $row['has_access'] = 0;
                if($user_id == $row['assigned_member']){
                    $row['has_access'] = 1;
                }
                $tasks_done[] = $row;
            }
        }

        $rowcount = 0;
        $sql_count = "Select * from projects_tasks where project_id =".$project_id;
        if ($res_count=mysqli_query($conn,$sql_count)) {
            $rowcount=mysqli_num_rows($res_count);
        }

        $rv = array(
            'todo' => $tasks_todo,
            'on_progress' => $tasks_on_progress,
            'done' => $tasks_done
        );
        echo json_encode(array('status' => 2000, 'data' => $rv, 'total' => $rowcount));
    }

}

if(isset($headers['route']) && $headers['route'] == 'DELETE'){
    $project_id = $_POST['project_id'];
    $task_id = $_POST['task_id'];
    $sql = "DELETE FROM projects_tasks WHERE id=".$task_id." AND project_id=".$project_id;
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 2000, 'message' => 'Project removed successfully'));
        exit();
    } else {
        echo json_encode(array('status' => 5000, 'message' => 'Something went wrong'));
        exit();
    }
}

if(isset($headers['route']) && $headers['route'] == 'CHANGE_STATUS'){
    $project_id = $_POST['project_id'];
    $task_id = $_POST['task_id'];
    $task_status = $_POST['task_status'];
    $sql = "UPDATE projects_tasks SET status='".$task_status."' WHERE id=".$task_id." AND project_id=".$project_id;

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 2000, 'message' => 'Project removed successfully'));
        exit();
    } else {
        echo json_encode(array('status' => 5000, 'message' => $conn->error));
        exit();
    }
}



$conn->close();
?>
