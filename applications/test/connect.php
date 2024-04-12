<?php
$dsn ='mysql:host=localhost;dbname=reactnative';
$user = 'root';
$pass = '';
$option =array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try{
    $con = new PDO($dsn,$user,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $res['message']="db connected successfully";
}

catch(PDOException $e){
  $res['message']="db connection error";
  $res['err']=$e;
  echo json_encode($res);
  exit();
}
