<?php
include "../connect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){




  $name=$_POST['name'];
  $password=$_POST['password'];
  $email=$_POST['email'];


  $sql="INSERT INTO `user` ( `name`, `password`, `email`)
        VALUES (?,?,?); ";
  $search=$con->prepare($sql);
  $search->execute(array($name, $password, $email ));

  if($search->rowCount()>0){ $res['res']= " inserted "; }
  else{ $res['res']="problem";  }

  echo json_encode($res);


}else{
  $res['res']="you have no permission to this page !";
  echo json_encode($res);
}
?>
