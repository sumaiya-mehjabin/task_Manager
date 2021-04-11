<?php
$APP_URL = 'https://demo1.redishketch.com';
session_start();
session_destroy();

header('Location: ' . $APP_URL . '/login.php');


