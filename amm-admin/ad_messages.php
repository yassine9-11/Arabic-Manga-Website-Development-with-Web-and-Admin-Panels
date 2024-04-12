<?php
ob_start();
session_start();
$page_title="Amura Cpanel | messages  ";



if (isset($_SESSION['adminID'])){
    include "init.php";

    $do=isset($_GET['do'])? $_GET['do']:'manage';

    if($do=='manage'){

        $sql="SELECT * FROM `messages`";
        $search=$con->prepare($sql);
        $search->execute();
        $rows=$search->fetchAll();

        $msgid=isset($_GET['msg'])? $_GET['msg']:'0';

        if($msgid==0){
            $msg='';
        } elseif($msgid==3){
            $msg="<div class='alert alert-danger'>
            لم يتم العثور على اي شيء .
            </div>";
        }
        elseif($msgid==4){
            $msg="<div class='alert alert-danger'>
            حدث خطأ  !
            </div>";
        }
        elseif($msgid==5){
            $msg="<div class='alert alert-warning'>
            تم حذف الرسالة  بنجاح .
            </div>";
        }
        ?>
       
        <div class="container messages ad_home d-flex">
        
            <div class="latest row m-auto">
                <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                <div class="bloc-content">
                   <div class="blochead">
                       <h4>
                           جميع الرسائل التي تم إرسالها .
                       </h4>
                       
                   </div>
    
                   <div class="msg">
                       <?php 
                       echo $msg;
                       if(!$rows){
                           ?>
                               <div class="alert alert-danger">
                                   لا توجد اي رسالة ! 
                               </div>
                           <?php
                       }
                       ?>
                   </div>
    
    
                   <div class="row">
    
                       <div class="message latestmanga col-12," style="margin:10px 0">
    
                           <table class="table-responsive" style="width: 100%;">
                               <thead>
                                   <tr>
                                       <td>
                                           الصورة
                                       </td>
                                       <td>
                                           الاسم
                                       </td>
                                       <td>
                                           البريد الاليكتروني
                                       </td>
                                       <td>
                                           نوع المرسل
                                       </td>
                                       <td>
                                           الرسالة
                                       </td>
                                       <td>
                                           الوقت
                                       </td>
                                       <td>
                                           الإ عدادات
                                       </td>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php
                                   foreach($rows as $message){
                                       $mangainfo="SELECT * FROM user WHERE Email = ?";
                                       $search1=$con->prepare($mangainfo);
                                       $search1->execute(array($message['MessageEmail']));
                                       $MessageUser=$search1->fetch();
                                       ?>
                                       <tr>
                                           <td>
                                               <img src="
                                                         <?php
                                                         if($MessageUser){
                                                           $user_photo=isset($MessageUser['image'])?
                                                                       $MessageUser['image']:
                                                                       'user_default.jpg';
                                                         }else{
                                                           $user_photo='user_default.jpg';
                                                         }
                                                         echo $img.$user_photo;
                                                         ?>" 
                                                    alt="">
                                           </td>
                                           <td>
                                               <div class="username">
                                                   <?php echo $message['Messagename']  ?>
                                               </div>
                                           </td>
                                           <td>
                                               <div class="username">
                                                   <?php echo $message['MessageEmail']  ?>
                                               </div>
                                           </td>
                                           <td>
                                               <div class=" <?php 
                                                    echo !$MessageUser ?'text-warning':'text-success' ?> ">
                                                   مستخدم 
                                                   <?php if(!$MessageUser){
                                                       echo "غير مسجل";
                                                   }else{
                                                       echo "مسجل" ;
                                                   }
                                                     ?>
                                               </div>
                                           </td>
                                           <td>
                                                <?php echo $message['MessageContent']  ?>
                                           </td>
       
                                           <td>
                                               <?php echo $message['MessageDate']?> 
                                             
                                           </td>
                                           <td>
                                               <div class="controls">
                                                   
                                                   <a class="delete btn btn-danger" 
                                                      data-bs-toggle="modal" 
                                                      data-bs-target="#<?php echo "modal".$message['MesssageID'];?>">
                                                        حذف
                                                       <i class="fa fa-trash"></i>
                                                   </a>
    
                                                   
       
                                               </div>
                                               <!-- delete modal  -->
                                               <div class="modal" id="<?php echo "modal".$message['MesssageID'];?>">
    
                                                <div class="modal-dialog">
                                                   <div class="modal-content">
                                               
                                                       <!-- Modal Header -->
                                                       <div class="modal-header d-flex">
                                                           <h4 class="modal-title">
                                                               تأكيد الحذف
                                                           </h4>
                                                       </div>
                                               
                                                       <!-- Modal body -->
                                                       <div class="modal-body">
                                                           هل انت متأكد من حذف 
                                                           <b>
                                                            هذه الرسالة .
                                                           </b>
                                                           ؟
                                                       </div>
                                               
                                                       <!-- Modal footer -->
                                                       <div class="modal-footer">
                                                           <a href="ad_messages.php?do=delete&id=<?php echo $message['MesssageID'] ?>"
                                                              class="btn btn-danger">
                                                               حذف 
                                                           </a>
                                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                             تراجع 
                                                           </button>
                                                       </div>
                                               
                                                   </div>
                                                </div>
                                               </div>
                                           </td>
                                       </tr>
                                       <?php
                                   }
                                   ?>
                               </tbody>
    
                           </table>
                       </div>
    
                   </div>
               </div>
                </div>
    
            </div>
        </div>
        
        
        <?php
    }elseif($do=='delete'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=="not"){
            header("location:ad_messages.php?msg=3");
            exit();
        }
        



        $sql="  DELETE FROM messages WHERE `messages`.`MesssageID` = ? ";
        $search=$con->prepare($sql);
        $search->execute(array($id));

        if($search->rowCount()>0){
            header("location:ad_messages.php?msg=5");
        }
        else{
            header("location:ad_messages.php?msg=4");
        }
    }
        ?>


        <?php include $tpl."footer.php";
}
else{
header('location:  index.php');
exit();
}
ob_end_flush(); ?>