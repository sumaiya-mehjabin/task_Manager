<?php include './system/authCheck.php' ?>
<?php include 'globals/header.php' ?>
<?php
$APP_URL = 'http://localhost/task_Manager';
?>
<body>
<div class="main-body-wrapper">
    <header>
        <?php include 'globals/navbar.php' ?>
    </header>
    <main>
        <div class="container">
            <div class="table-wrapper margin-100">
                <ul class="nav nav-tabs">
                    <li class="active"><a  data-toggle="tab" href="#my_projects">My Projects</a></li>
                    <li><a data-toggle="tab" href="#other_projects">Other Projects</a></li>
                </ul>
                <div class="tab-content mt-5">
                    <div id="my_projects" class="tab-pane fade in active in">
                        <div class="col-md-12 text-right mb-4">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#CreateProjects">Create Projects</button>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Description</th>
                                    <th>Created_at</th>
                                    <th class="text-center">Options</th>
                                </tr>
                                </thead>
                                <tbody id="list-table">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="other_projects" class="tab-pane fade">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Project Title</th>
                                    <th>Description</th>
                                    <th>Created_at</th>
                                    <th class="text-center">Options</th>
                                </tr>
                                </thead>
                                <tbody id="list-table-other">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <div class="modal fade" id="CreateProjects" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="CreateProject(event)" id="CreateForm">
                    <div class="modal-header">
                        <h4 class="modal-title">CREATE PROJECT</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Project Title</label>
                            <input type="name" class="form-control" placeholder="Project Title" name="project_title"
                                   required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="5" name="description"
                                      required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Project</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="RemoveProject" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="RemoveProject(event)" id="RemoveForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Remove Project</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="remove-modal-item" name="project_id">
                        <div class="alert alert-danger" role="alert">
                            Are you sure. Project will be removed
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">REMOVE PROJECT</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditProject" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="UpdateProject(event)" id="EditForm">
                    <div class="modal-header">
                        <h4 class="modal-title">EDIT PROJECT</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" class="remove-modal-item" name="project_id">
                        <div class="form-group">
                            <label>Project Title</label>
                            <input type="name" class="form-control project-title" placeholder="Project Title"
                                   name="project_title"
                                   required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control  project-desc" name="description" rows="5" name="description"
                                      required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Project</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ProjectMembers" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Project Members</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mt-5 mb-5">
                        <label>Add Project Member</label>
                        <form class="form-inline" onsubmit="AddMemberToProject(event)">
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="_add_member_email_" type="email" class="form-control" placeholder="Email address">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Member</button>
                        </form>
                        <div class="form-group">
                            <input type="hidden" name="email">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Member name</th>
                            <th>role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="member-list-table">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="RemoveMember" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="RemoveMember(event)" id="RemoveMemberForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Remove Member</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="remove-member-item" name="user_id">
                        <div class="alert alert-danger" role="alert">
                            Are you sure. Member will be removed
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">REMOVE Member</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let Selected_project = 0;
    $(function () {
        GetProjects()
        GetProjectsOther()
        $('#ProjectMembers').on('hidden.bs.modal', function () {
            $('.invalid-feedback').html('');
            $('#_add_member_email_').val('')
        })
        $('#EditProject').on('hidden.bs.modal', function () {
            $('#EditProject')[0].reset();
        })

    });

    function CreateProject(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "POST",
            headers: {route: 'CREATE'},
            data: $('#CreateForm').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    $('#CreateProjects').modal('hide');
                    $('#CreateForm')[0].reset();
                    GetProjects();
                }
            }
        });
    }

    function GetProjects() {
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "GET",
            headers: {route: 'GET_ALL'},
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status = 2000) {
                    renderTable(response.data)
                }
            }
        });
    }

    function GetProjectsOther() {
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "GET",
            headers: {route: 'GET_ALL_OTHER'},
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status = 2000) {
                    renderTableOthers(response.data)
                }
            }
        });
    }

    function RemoveProject(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "POST",
            headers: {route: 'DELETE'},
            data: $('#RemoveForm').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    window.location.href = '';
                }
            }
        });
    }

    function renderTable(projects) {
        let table = '';
        $.each(projects, function (i, v) {
            let row = `<tr>
                                <td>
                                    <a href="#">` + v.title + `</a>
                                </td>
                                <td>
                                    <div class="cut-text">` + v.description + `</div>
                                </td>
                                <td>` + v.created_at + `</td>
                                <td class="text-center">
                                    <a href="project_details.php?project_id=`+v.projects_id+`" type="button" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Project Tasks"><i class="fa fa-tasks"></i></a>
                                    <button onclick="ShowMemberModal(` + v.projects_id + `)" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Project Members"><i class="fa fa-users"></i></button>
                                    <button onclick="EditItemModal(` + v.projects_id + `)" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit Project"><i class="fa fa-pencil"></i></button>
                                    <button onclick="RemoveItemModal(` + v.projects_id + `)" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove Project"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`
            table = table + row;
        })
        $('#list-table').html(table);
        setTimeout(function (){
            $('[data-toggle="tooltip"]').tooltip()
        },100)
    }

    function renderTableOthers(projects) {
        let table = '';
        $.each(projects, function (i, v) {
            let row = `<tr>
                                <td>
                                    <a href="#">` + v.title + `</a>
                                </td>
                                <td>
                                    <div class="cut-text">` + v.description + `</div>
                                </td>
                                <td>` + v.created_at + `</td>
                                <td class="text-center">
                                    <a href="project_details.php?project_id=`+v.projects_id+`" type="button" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Project Tasks"><i class="fa fa-tasks"></i></a>
                                </td>
                            </tr>`
            table = table + row;
        })
        $('#list-table-other').html(table);
        setTimeout(function (){
            $('[data-toggle="tooltip"]').tooltip()
        })
    }

    function RemoveItemModal(project_id) {
        $('#RemoveProject').find('#remove-modal-item').val(project_id)
        $('#RemoveProject').modal('show');
    }

    function EditItemModal(project_id) {
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "POST",
            headers: {route: 'GET_SINGLE'},
            data: {
                project_id: project_id
            },
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    $('#EditProject').find('.remove-modal-item').val(response.data.id)
                    $('#EditProject').find('.project-title').val(response.data.title)
                    $('#EditProject').find('.project-desc').val(response.data.description)
                    $('#EditProject').modal('show');
                }
            }
        });
    }

    function UpdateProject(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "POST",
            headers: {route: 'UPDATE'},
            data: $('#EditForm').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    GetProjects();
                    $('#EditProject').modal('hide');
                    $('#EditProject')[0].reset();
                }
            }
        });
    }

    function ShowMemberModal (project_id){
        Selected_project = project_id;
        renderMembers(project_id);
        $('#ProjectMembers').modal('show');
    }

    function renderMembers(project_id){
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "POST",
            headers: {route: 'GET_MEMBER'},
            data: {
                project_id: project_id,
            },
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    let table = '';
                    let members  = response.data;
                    $.each(members, function (i, v) {
                        let role = v.member_type == 1 ? 'Creator' : 'Collaborator';
                        let remove_btn = '';
                        if(v.member_type == 2){
                            remove_btn = '<button onclick="RemoveMemberModal(' + v.user_id + ')" type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove Project"><i class="fa fa-trash"></i></button>';
                        }
                        let row = `<tr>
                                <td>
                                    <a href="#">` + v.name + `</a>
                                </td>
                                <td>
                                    <div class="cut-text">` + role + `</div>
                                </td>
                                <td class="text-center">
                                    `+remove_btn+`
                                </td>
                            </tr>`
                        table = table + row;
                    })
                    $('#member-list-table').html(table);
                }
            }
        });
    }

    function AddMemberToProject (event){
        event.preventDefault();
        $('.invalid-feedback').html('');
        let email = $('#_add_member_email_').val()
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "POST",
            headers: {route: 'ADD_MEMBER'},
            data: {
                project_id: Selected_project,
                email: email,
            },
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    $('#_add_member_email_').val('')
                    renderMembers(Selected_project)
                }else{
                    ErrorHandaler(response.error)
                }
            }
        });
    }

    function ErrorHandaler(errors) {
        $.each(errors, function (i, v) {
            $('[name=' + i + ']').closest('.form-group').find('.form-control').addClass('is-invalid');
            $('[name=' + i + ']').closest('.form-group').find('.invalid-feedback').html(v);
        });
    }

    function RemoveMemberModal(user_id) {
        $('#RemoveMemberForm').find('#remove-member-item').val(user_id)
        $('#RemoveMember').modal('show');
    }

    function RemoveMember(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo $APP_URL?>/system/projects/dashboard.php",
            cache: false,
            type: "POST",
            headers: {route: 'DELETE_MEMBER'},
            data:{
                user_id: $('#remove-member-item').val(),
                project_id: Selected_project
            },
            success: function (data) {
                let response = JSON.parse(data);
                if (response.status == 2000) {
                    $('#RemoveMember').modal('hide');
                    renderMembers(Selected_project)
                }
            }
        });
    }
</script>
</body>
</html>
