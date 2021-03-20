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

$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

$projects = [];

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}


$conn->close();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha512-k78e1fbYs09TQTqG79SpJdV4yXq8dX6ocfP0bzQHReQSbEghnS6AQHE2BbZKns962YaqgQL16l7PkiiAHZYvXQ=="
          crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha512-ANkGm5vSmtDaoFA/NB1nVJzOKOiI4a/9GipFtkpMG8Rg2Bz8R1GFf5kfL0+z0lcv2X/KZRugwrAlVTAgmxgvIg=="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./resources/style/style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="form-container">
                <form action="./system/projects/dashboard.php" method="post">
                <div class="form-group">
                    <label>Project Title</label>
                    <input type="name" class="form-control" placeholder="Project Title" name="project_title" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="5" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Create Project</button>
                </div>
                </form>
            </div>
        </div>
        <div class="offset-2 col-md-6">
            <div class="table-wrapper">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Description</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($projects as $key=>$value){ ?>
                        <tr>
                            <td>
                                <a href="project_details.php?id=<?php echo $value['id']?>">
                                    <?php echo $value['title']?>
                                </a>
                            </td>
                            <td><?php echo $value['description']?></td>
                            <td><?php echo $value['created_at']?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
