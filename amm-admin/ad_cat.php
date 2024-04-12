<?php
ob_start();
session_start();
$page_title="Amura Cpanel | categories  ";



if (isset($_SESSION['adminID'])){
    include "init.php";

    $do=isset($_GET['do'])? $_GET['do']:'manage';

    if($do=='manage'){

        $sql="SELECT * FROM `categories`";
        $search=$con->prepare($sql);
        $search->execute();
        $rows=$search->fetchAll();

        $msgid=isset($_GET['msg'])? $_GET['msg']:'0';

        if($msgid==0){
            $msg='';
        }
        elseif($msgid==1){
            $msg="<div class='alert alert-success'>
                     تم إضافة التصنيف بنجاح .
                      </div>";
        }
        elseif($msgid==2){
            $msg="<div class='alert alert-success'>
            تم تعديل معلومات التصنيف بنجاح .
             </div>";
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
            تم حذف التصنيف  بنجاح .
            </div>";
        }
        ?>
       
        <div class="container messages ad_home d-flex">
        
            <div class="latest row m-auto">
                <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                <div class="bloc-content">
                   <div class="blochead">
                       <h4>
                           جميع التصنيفات  .
                       </h4>
                       <a href="ad_cat.php?do=add"class="add btn-bloc">
                            إضافة تصنيف جديد
                            <i class="fa fa-plus"></i>
                        </a>
                       
                   </div>
    
                   <div class="msg">
                       <?php 
                       echo $msg;
                       if(!$rows){
                           ?>
                               <div class="alert alert-danger">
                                   لا يوجد اي تصنيف ! 
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
                                           الاسم
                                       </td>
                                       <td>
                                           عدد المانجات التي تنتمي للتصنيف 
                                       </td>
                                       <td>
                                           الإ عدادات
                                       </td>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php
                                   foreach($rows as $cat){
                                       ?>
                                       <tr>
                                           
                                           <td>
                                               <div class="username">
                                                   <?php echo $cat['CatName']  ?>
                                               </div>
                                           </td>
                                           <td>
                                               <div class="username">
                                                   <?php echo "not finished yet !"  ?>
                                               </div>
                                           </td>
                                           <td>
                                               <div class="controls">
                                                    <a href="ad_cat.php?do=edit&id=<?php echo $cat['CatID'] ?>"
                                                       class=" btn btn-primary">
                                                        تعديل
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                   <a class="delete btn btn-danger" 
                                                      data-bs-toggle="modal" 
                                                      data-bs-target="#<?php echo "modal".$cat['CatID'];?>">
                                                        حذف
                                                       <i class="fa fa-trash"></i>
                                                   </a>
    
                                                   
       
                                               </div>
                                               <!-- delete modal  -->
                                               <div class="modal" id="<?php echo "modal".$cat['CatID'];?>">
    
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
                                                           <a href="ad_cat.php?do=delete&id=<?php echo $cat['CatID'] ?>"
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
    }elseif($do=='add'){
        ?>
       <div class="container messages ad_home d-flex">
   
            <div class="latest row m-auto">
                <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                    <div class="bloc-content">
                        <div class="blochead">
                            <h4>
                                إضافة تصنيف  جديد
                            </h4>

                            <a href="ad_cat.php" class="btn btn-secondary">
                            <i class="fa fa-arrow-right"></i>
                               عودة
                            </a>
                        </div>


                        <div class="row">
                            <form action="ad_cat.php?do=insert" method="POST" class="addmanag"enctype="multipart/form-data">
                                <table class=" table table-responsive">
                                 
                                    <tr>
                                        <td class="ky">
                                            اسم التصنيف <span style="font-size: 9px;">
                                            (مثال  : أكشن مغامرة قتال .... )   
                                            </span> :
                                        </td>
                                        <td class="val">
                                            <input type="text" name="name"  class="form-control" placeholder="أكتب اسم المستخدم هنا ">
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td class="" colspan="2">
                                            <input type="submit" value="اضافة الان  " class="form-control bg-success text-white">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
       </div>
        <?php
    }elseif($do=='insert'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
        
            $sql="INSERT INTO `categories` 
                 ( `catName`)
                 VALUES (?)";
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['name']
                             ));
            if($search->rowCount()>0){
               header("location:ad_cat.php?do=manage&msg=1");
            }
        }
        else{
            header("location:ad_cat.php?do=manage&msg=4");
        }

    }elseif($do=='edit'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_cat.php?do=manage&msg=3");
            exit();
        }

        $sql="SELECT * FROM categories WHERE CatID=?";
        $search=$con->prepare($sql);
        $search->execute(array($id));
        $cat=$search->fetch();
        ?>
        <div class="container messages ad_home d-flex">
    
             <div class="latest row m-auto">
                 <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                     <div class="bloc-content">
                         <div class="blochead">
                            <h4>
                                 تعديل معلومات 
                                 <b><?php 
                                  echo $cat['CatName']
                                 ?></b>
                            </h4>
                            <a href="ad_cat.php" class="btn btn-secondary">
                                 <i class="fa fa-arrow-right"></i>
                                    عودة
                            </a>

                         </div>


                         <div class="row">
                             <form action="ad_cat.php?do=update" method="POST" class="addmanag"enctype="multipart/form-data">
                                 <table class=" table table-responsive">
                                  
                                    <tr>
                                        <td class="ky">
                                            اسم التصنيف <span style="font-size: 9px;">
                                            (مثال  : أكشن مغامرة قتال .... )   
                                            </span> :
                                        </td>
                                        <td class="val">
                                            <input type="text" 
                                                   name="name"  
                                                   class="form-control" 
                                                   placeholder="أكتب اسم المستخدم هنا "
                                                   value="<?php echo $cat['CatName'] ?>">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="" colspan="2">
                                            <input type="hidden" name="id" value="<?php echo $cat['CatID'] ?>">
                                            <input type="submit" value="تعديل الان " class="form-control bg-success text-white">
                                        </td>
                                    </tr>

                                 </table>
                             </form>
                         </div>
                     </div>
                 </div>

             </div>
        </div>
         <?php

    }elseif($do=='update'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
          

            $sql="UPDATE `categories` 
                  SET  `CatName`=?
                  WHERE `categories`.`catID` = ? "; 
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['name'],
                             $_POST['id']
                             ));
            if($search->rowCount()>0){
              
                header("location:ad_cat.php?msg=2");
            }else{
                header("location:ad_cat.php?msg=4");
            }
        }
        else{
            header("location:ad_cat.php?msg=4");
        }
    }elseif($do=='delete'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=="not"){
            header("location:ad_cat.php?msg=3");
            exit();
        }
        



        $sql="  DELETE FROM categories WHERE `categories`.`CatID` = ? ";
        $search=$con->prepare($sql);
        $search->execute(array($id));

        if($search->rowCount()>0){
            header("location:ad_cat.php?msg=5");
        }
        else{
            header("location:ad_cat.php?msg=4");
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