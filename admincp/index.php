<?php
require_once '../ultils.php';
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
    exit();
}else{
    require_once 'dashboard.php';
}