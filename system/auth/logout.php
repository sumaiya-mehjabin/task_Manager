<?php
$APP_URL = 'http://localhost/task_Manager';
session_start();
session_destroy();

header('Location: ' . $APP_URL . '/login.php');


