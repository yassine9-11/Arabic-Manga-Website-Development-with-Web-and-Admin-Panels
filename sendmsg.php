<?php
ob_start();
session_start();
$page_title="Amura Manga | home  ";
include "init.php";
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        

        $sql="INSERT INTO `messages` 
                 (`MessageContent`,`MessageEmail`,`Messagename`,`MessageDate`)
                 VALUES (?, ?, ?, now())";
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['message'],
                             $_POST['email'],
                             $_POST['name']

                             ));
            if($search->rowCount()>0){
                ?>
                <div class="alert alert-success" style="margin:50px ;padding:50px 40px">
                    تم ارسال الرسالة بنجاح .
                </div>
                <?php
            }
    ?>


    <?php 
    }
    include $tpl."footer.php";

ob_end_flush(); ?>