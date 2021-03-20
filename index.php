<?php include './system/authCheck.php' ?>
<?php include 'globals/header.php' ?>
<?php include './system/projects/dashboard.php' ?>
<body>
<div class="main-body-wrapper">
    <header>
        <?php include 'globals/navbar.php' ?>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-container margin-100">
                        <div class="form-title text-left">CREATE PROJECT</div>
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Project Title</label>
                                <input type="name" class="form-control" placeholder="Project Title" name="project_title"
                                       required>
                                <div class="invalid-feedback"><?php if ($error['email'] != '') echo $error['email']; ?></div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="5" name="description"
                                          required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Create Project</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="table-wrapper margin-100">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Description</th>
                                <th>Created_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($projects as $key => $value) { ?>
                                <tr>
                                    <td>
                                        <a href="project_details.php?id=<?php echo $value['id'] ?>">
                                            <?php echo $value['title'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $value['description'] ?></td>
                                    <td><?php echo $value['created_at'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</div>
</body>
</html>
