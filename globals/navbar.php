<?php include 'globals/core.php'?>
<nav class="navbar navbar-expand-lg navbar-light main-nav-bar">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $APP_URL?>">TASK MANAGER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <ul class="navbar-nav float-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo $APP_URL?>/system/auth/logout.php">logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
