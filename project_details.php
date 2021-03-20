<?php include './system/authCheck.php' ?>
<?php include './system/projects/project_details.php' ?>
<?php include 'globals/header.php' ?>
<body>
<div class="main-body-wrapper">
    <header>
        <?php include 'globals/navbar.php' ?>
    </header>
    <div class="container">

        <h1>Project name: <?php echo $Project['title']?></h1>
    </div>
</div>
</body>
</html>
