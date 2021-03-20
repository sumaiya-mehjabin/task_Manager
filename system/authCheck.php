<?php
session_start();
include './globals/variables.php';

if(!isset($_SESSION['is_logged_in']) && empty($_SESSION['is_logged_in'])) {
    header('Location: '.$APP_URL.'/login.php');
}
