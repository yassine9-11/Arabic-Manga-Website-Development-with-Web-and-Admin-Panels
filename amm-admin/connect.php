<?php
$dsn ='mysql:host=localhost;dbname=amuramanga';
$user = 'root';
$pass = '';
$option =array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try{
    $con = new PDO($dsn,$user,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
}
catch(PDOException $e){
    echo "<h1 style='color:red; font-weight:bold ;text-align:center;margin-top:100px'> data base not connected ! </h1>";
    exit();
}