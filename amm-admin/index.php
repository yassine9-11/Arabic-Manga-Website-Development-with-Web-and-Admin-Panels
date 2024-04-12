<?php 
session_start();
$page_title="Amura Cpanel | ";



if (isset($_SESSION['adminID'])){
    header('location:  ad_home.php');  // redirect to dashbord
    exit();
}else{
    header('location:  ad_login.php');  // redirect to login
    exit(); 
}