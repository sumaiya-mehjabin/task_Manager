<?php include './system/authCheck.php' ?>
<?php include './system/projects/project_details.php' ?>
<?php include 'globals/header.php' ?>
<?php
$APP_URL = 'http://localhost/task_Manager';
?>
<body>
<div class="main-body-wrapper">
    <header>
        <?php include 'globals/navbar.php' ?>
    </header>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <td><strong>Project Name:</strong></td>
                <td><?php echo $Project['title'] ?></td>
            </tr>
            <tr>
                <td><strong>Project Description:</strong></td>
                <td><?php echo $Project['description'] ?></td>
            </tr>
            <tr>
                <td><strong>Project Start Date:</strong></td>
                <td><?php echo date("d M,Y h:iA", strtotime($Project['start_date']))?></td>
            </tr>
            <tr>
                <td><strong>Project End Date:</strong></td>
                <td><?php echo date("d M,Y h:iA", strtotime($Project['end_date']))?></td>
            </tr>
            <tr>
                <td><strong>Member Type:</strong></td>
                <td> <?php echo $Member['member_type'] == 1 ? 'Creator' : 'Collaborator'; ?></td>
            </tr>
        </table>
        <form action="">
            <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
            <div class="row">
                <div class="col-md-4">
                    <select name="member_id" class="form-control">
                        <option value="">All Members</option>
                        <?php
                        foreach ($members_list as $member) {
                            if($member['user_id'] == $selected_member){
                                echo '<option selected value="' . $member['user_id'] . '">' . $member['name'] . '</option>';
                            }else{
                                echo '<option value="' . $member['user_id'] . '">' . $member['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="keyword" placeholder="Search here" class="form-control" value="<?php echo $keyword ?>">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="section-wrapper">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="section-title">TODO</div>
                        </div>
                        <?php
                        if ($Member['member_type'] == 1) {
                            echo '<div class="col-md-3 text-right">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#CreateProjects" data-placement="top" title="Create Tasks"><i class="fa fa-plus"></i></button>
                                    </div>';
                        }
                        ?>
                    </div>
                    <div id="task-list-wrapper-todo"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="section-wrapper">
                    <div class="section-title">ON PROGRESS</div>
                    <div id="task-list-wrapper-on-progress"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="section-wrapper">
                    <div class="section-title">DONE</div>
                    <div id="task-list-wrapper-done"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="CreateProjects" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="CreateTask(event)" id="CreateForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Task</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
                        <div class="form-group">
                            <label>Task Title</label>
                            <input type="text" class="form-control" placeholder="Project Title" name="task_title"
                                   required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Task Description</label>
                            <textarea class="form-control" name="task_description" rows="5" required
                                      placeholder="Task Description.."></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Due Date</label>
                            <input type="text" id="create_due_date" class="form-control" placeholder="Due Date"
                                   name="task_due" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Assigned Member</label>
                            <select name="assigned_member" class="form-control" required>
                                <option value="">Select Member</option>
                                <?php
                                foreach ($members_list as $member) {
                                    echo '<option value="' . $member['user_id'] . '">' . $member['name'] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Task</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="RemoveTask" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="RemoveTask(event)" id="RemoveForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Remove Task</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
                        <input type="hidden" value="" id="remove-task-item" name="task_id">
                        <div class="alert alert-danger" role="alert">
                            Are you sure. Task will be removed!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">REMOVE TASK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ChangeStatusTask" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form onsubmit="ChangeStatusTask(event)" id="ChangeStatusForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Task Status</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
                        <input type="hidden" value="" id="change-task-item" name="task_id">
                        <div class="form-group">
                            <select name="task_status" class="form-control" id="change-task-status">
                                <option value="1">TODO</option>
                                <option value="2">ON PROGRESS</option>
                                <option value="3">DONE</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">CHANGE</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let Selected_task = 0;
    $(function () {
        setTimeout(function () {
            GetTasks()
            $('#ChangeStatusTask').on('hidden.bs.modal', function () {
                $('#ChangeStatusForm')[0].reset();
                $('#change-task-status').val('')
            })
            $('[data-toggle="tooltip"]').tooltip()
            $('#create_due_date').flatpickr({
                enableTime: true,
                altInput: true,
                altFormat: "d M, Y h:i K",
                dateFormat: "Y-m-d H:i:s",
                defaultDate: new Date(),
            });
        }, 500)

    })

    function CreateTask(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/project_manage.php",
            cache: false,
            type: "POST",
            headers: {route: 'CREATE'},
            data: $('#CreateForm').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    $('#CreateProjects').modal('hide');
                    $('#CreateForm')[0].reset();
                    GetTasks();
                    setTimeout(function (){
                        $('#create_due_date').flatpickr({
                            enableTime: true,
                            altInput: true,
                            altFormat: "d M, Y h:i K",
                            dateFormat: "Y-m-d H:i:s",
                            defaultDate: new Date(),
                        });
                    },300)
                }
            }
        });
    }

    function GetTasks() {
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/project_manage.php",
            cache: false,
            type: "POST",
            headers: {route: 'GET_ALL_TASK'},
            data: {
                project_id: '<?php echo $project_id ?>',
                selected_member: '<?php echo $selected_member ?>',
                keyword: '<?php echo $keyword ?>',
            },
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status = 2000) {
                    renderList(response.data)
                }
            }
        });
    }

    function renderList(data) {
        let html = '';
        if(data.todo.length > 0){
            $.each(data.todo, function (i, v) {
                let row = ''
                if(v.has_access == 1){
                    row = `<div class="each-task">
                            <div class="task-title">` + v.title + `</div>
                            <div class="task-due">` + v.due_date + `</div>
                            <div class="task-assigned">` + v.member_name + `</div>
                            <div class="button-group mt-5">
                                <button onclick="ChangeStatusModal(event, ` + v.id + `, ` + v.status + `)" type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
                                <?php
                                    if($Member['member_type'] == 1){
                                        echo '<button onclick="RemoveTaskModal(event, ` + v.id + `)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                                    }
                                ?>
                            </div>
                        </div>`
                }else{
                    row = `<div class="each-task">
                            <div class="task-title">` + v.title + `</div>
                            <div class="task-due">` + v.due_date + `</div>
                            <div class="task-assigned">` + v.member_name + `</div>
                            <div class="button-group mt-5">
                                <?php
                                    if($Member['member_type'] == 1){
                                        echo '<button onclick="RemoveTaskModal(event, ` + v.id + `)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                                    }
                                ?>
                            </div>
                        </div>`
                }
                html = html + row;
            })
            $('#task-list-wrapper-todo').html(html);
        }else{
            let alert = `<div class="alert alert-info" role="alert">
                          Task list is empty
                        </div>`;
            $('#task-list-wrapper-todo').html(alert);
        }

        if(data.on_progress.length > 0) {
            html = '';
            $.each(data.on_progress, function (i, v) {
                let row = `<div class="each-task">
                                <div class="task-title">` + v.title + `</div>
                                <div class="task-due">` + v.due_date + `</div>
                                <div class="task-assigned">` + v.member_name + `</div>
                                <div class="button-group mt-5">
                                    <button onclick="ChangeStatusModal(event, ` + v.id + `, ` + v.status + `)" type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
                                    <?php
                                        if($Member['member_type'] == 1){
                                            echo '<button onclick="RemoveTaskModal(event, ` + v.id + `)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                                        }
                                    ?>
                                </div>
                            </div>`
                html = html + row;
            })
            $('#task-list-wrapper-on-progress').html(html);
        }else{
            let alert = `<div class="alert alert-info" role="alert">
                          Task list is empty
                        </div>`;
            $('#task-list-wrapper-on-progress').html(alert);
        }

        if(data.done.length > 0) {
            html = '';
            $.each(data.done, function (i, v) {
                let row = `<div class="each-task">
                                <div class="task-title">` + v.title + `</div>
                                <div class="task-due">` + v.due_date + `</div>
                                <div class="task-assigned">` + v.member_name + `</div>
                                <div class="button-group mt-5">
                                    <button onclick="ChangeStatusModal(event, ` + v.id + `, ` + v.status + `)" type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
                                    <?php
                                        if($Member['member_type'] == 1){
                                            echo '<button onclick="RemoveTaskModal(event, ` + v.id + `)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
                                        }
                                    ?>
                                </div>
                            </div>`
                html = html + row;
            })
            $('#task-list-wrapper-done').html(html);
        }else{
            let alert = `<div class="alert alert-info" role="alert">
                          Task list is empty
                        </div>`;
            $('#task-list-wrapper-done').html(alert);
        }
    }

    function ChangeStatusModal(event, task_id, status) {
        Selected_task = task_id;
        $('#change-task-item').val(task_id)
        $('#change-task-status').val(status)
        $('#ChangeStatusTask').modal('show');
    }

    function RemoveTaskModal(event, task_id) {
        Selected_task = task_id;
        $('#RemoveTask').find('#remove-task-item').val(task_id)
        $('#RemoveTask').modal('show');

    }

    function RemoveTask(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/project_manage.php",
            cache: false,
            type: "POST",
            headers: {route: 'DELETE'},
            data: $('#RemoveForm').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    $('#RemoveTask').modal('hide');
                    GetTasks();
                }
            }
        });
    }

    function ChangeStatusTask(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/project_manage.php",
            cache: false,
            type: "POST",
            headers: {route: 'CHANGE_STATUS'},
            data: $('#ChangeStatusForm').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    $('#ChangeStatusTask').modal('hide');
                    GetTasks();
                }
            }
        });
    }
</script>
</body>
</html>
