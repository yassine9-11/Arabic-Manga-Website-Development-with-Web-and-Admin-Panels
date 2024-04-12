<?php
ob_start();
session_start();
$page_title="Amura Cpanel | users  ";



if (isset($_SESSION['adminID'])){
    include "init.php";

    $do=isset($_GET['do'])? $_GET['do']:'manage';
    


    if($do=='manage'){

        $sql="SELECT * FROM user";
        $search=$con->prepare($sql);
        $search->execute();
        $rows=$search->fetchAll();



        $msgid=isset($_GET['msg'])? $_GET['msg']:'0';

        if($msgid==0){
            $msg='';
        }elseif($msgid==1){
            $msg="<div class='alert alert-success'>
                     تم إضافة المستخدم بنجاح .
                      </div>";
        }
        elseif($msgid==2){
            $msg="<div class='alert alert-success'>
            تم تعديل معلومات المستخدم بنجاح .
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
            تم حذف المستخدم بنجاح .
            </div>";
        }
       
    
        ?>
        <div class="container messages ad_home d-flex">
          <div class="latest row m-auto">
            <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                <div class="bloc-content">
                    <div class="blochead">
                        <h4>
                            جميع الحسابات المسجلة لدينا
                        </h4>
                        <a href="ad_users.php?do=add"class="add btn-bloc">
                            إضافة حساب جديد
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="msg">
                        <?php 
                        echo $msg;
                        if(!$rows){
                            ?>
                                <div class="alert alert-danger">
                                    لا يوجد اي مستخدم مسجل لديكم . يمكنكم إضافة مستخدمين جدد .
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
                                            كلمة المرور
                                        </td>
                                        <td>
                                            تاريخ الانضمام
                                        </td>
                                        <td>
                                            الإ عدادات
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($rows as $user){
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="
                                                          <?php  
                                                          $user_photo=isset($user['image'])?$user['image']:'user_default.jpg';
                                                          echo $img.$user_photo;
                                                          ?>" 
                                                     alt="">
                                            </td>
                                            <td>
                                                <div class="username">
                                                    <?php echo $user['Username']  ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="email">
                                                    <?php echo $user['Email']  ?>
                                                </div>
                                            </td>
                                            <td>
                                                 <?php echo $user['PasswordHash']  ?>
                                            </td>
        
                                            <td>
                                                <div class="">
                                                    <?php echo $user['RegistrationDate']  ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="controls">
                                                    <a href="ad_users.php?do=profil&id=<?php echo $user['UserID'] ?>"
                                                       class=" btn btn-secondary">
                                                        عرض المزيد

                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="ad_users.php?do=edit&id=<?php echo $user['UserID'] ?>"
                                                       class=" btn btn-primary">
                                                        تعديل
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo "modal".$user['UserID'];?>">
                                                         حذف
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    
                                                   
        
                                                </div>
                                                <!-- delete modal  -->
                                                <div class="modal" id="<?php echo "modal".$user['UserID'];?>">
                                                    
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
                                                                هل انت متأكد من حذف هذا المستخدم 
                                                                <b>[<?php echo $user['Username'];?> ]</b>
                                                                ؟
                                                            </div>
                                                    
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <a href="ad_users.php?do=delete&id=<?php echo $user['UserID'] ?>"
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
                                 إضافة مستخدم جديد
                             </h4>

                             <a href="ad_users.php" class="btn btn-secondary">
                             <i class="fa fa-arrow-right"></i>
                                عودة
                             </a>
                         </div>


                         <div class="row">
                             <form action="ad_users.php?do=insert" method="POST" class="addmanag"enctype="multipart/form-data">
                                 <table class=" table table-responsive">
                                  
                                     <tr>
                                         <td class="ky">
                                             اسم المستخدم <span style="font-size: 9px;">
                                             (الاسم الكامل )   
                                             </span> :
                                         </td>
                                         <td class="val">
                                             <input type="text" name="name"  class="form-control" placeholder="أكتب اسم المستخدم هنا ">
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                             البريد الاليكتروني :
                                         </td>
                                         <td class="val">
                                             <input type="text" name="email" class="form-control" placeholder="البريد الاليكتروني الخاص يالمستخدم ">
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                          كلمة المرور :
                                         </td>
                                         <td class="val">
                                             <input type="text" name="password" class="form-control" placeholder="كلمة المرور ">
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                             صورة المستخدم :
                                             <span style="font-size: 9px;">
                                         (يمكنك إضافة صورة البروفايل فهي اختيارية )
                                         </span>
                                         </td>
                                         <td class="val">
                                             <input type="file" 
                                                    class="form-control" 
                                                    name="img[]" 
                                                    >
                                         </td>
                                     </tr>
                                 
                                     <tr>
                                         <td class="" colspan="2">
                                             <input type="submit" value="تسجيل " class="form-control bg-success text-white">
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
            // upload fich and photo :
            // $pathIMG = "C:\\xampp\htdocs\Amuramanga\media\images";
        
            $pathIMG = "..\media\images";
            
            if (!file_exists($pathIMG)) 
            {
            mkdir($pathIMG, 0777, true);  //0777 sont les droits (lecture écriture et execution)
            }
        
            //get max id 
            $sql="SELECT * FROM user WHERE UserID= (SELECT MAX(UserID) FROM user); ";
            $search=$con->prepare($sql);
            $search->execute();
            $row=$search->fetch();
        
            $imgnumber=$row['UserID']+1;
            $imagname="user_".$imgnumber;
            move_uploaded_file($_FILES['img']['tmp_name'][0], $pathIMG."\\".$imagname.".jpg");
        
            if(!($_FILES['img']['tmp_name'][0]=='')){
                $img=$imagname.".jpg";
            }else{
                $img='user_default.jpg';
            }
            $sql="INSERT INTO `user` 
                 ( `Username`, `Email`, `PasswordHash`, `RegistrationDate`, `image`)
                 VALUES (?, ?, ?, now(), ?)";
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['name'],
                             $_POST['email'],
                             sha1($_POST['password']),
                             $img
                             ));
            if($search->rowCount()>0){
               header("location:ad_users.php?do=manage&msg=1");
            }
        }
        else{
            header("location:ad_users.php?do=manage&msg=4");
        }
    
    }elseif($do=='update'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //update photo ;
            $changedimg="0";
            if(!($_FILES['img']['tmp_name'][0]=='')){
                //get url for img :
                $sql1="SELECT `UserID`,`image` FROM  `user` WHERE  `user`.`UserID` = ?"; 
                $search1=$con->prepare($sql1);
                $search1->execute(array(
                                 $_POST['id']
                                 ));
                $mangaIMG=$search1->fetch();

                $pathIMG = "..\media\images";
                $pathIMGold = "..\media\images\\user_".$mangaIMG['image'];

                if (file_exists($pathIMGold)&&(!$mangaIMG['image']=='user_default.jpg')) {
                    unlink($pathIMGold);
                }
                move_uploaded_file($_FILES['img']['tmp_name'][0], $pathIMG."\\user_".$_POST['id'].".jpg");
                $img="user_".$_POST['id'].".jpg";
    
                $sql = "UPDATE `user` SET  `image`=? WHERE `user`.`UserID` =?";
                $stmt= $con->prepare($sql);
                $stmt->execute(array($img,$_POST['id']));
                $changedimg="1";
            }

            $sql="UPDATE `user` 
                  SET  `Username`=?, `Email`=?, `PasswordHash`=?
                  WHERE `user`.`UserID` = ? "; 
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['name'],
                             $_POST['email'],
                             sha1($_POST['password']),
                             $_POST['id']
                             ));
            if($search->rowCount()>0||$changedimg=="1"){
              
                header("location:ad_users.php?msg=2");
            }else{
                header("location:ad_users.php?msg=4");
            }
        }
        else{
            header("location:ad_users.php?msg=4");
        }
    }elseif($do=='edit'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_users.php?do=manage&msg=3");
            exit();
        }
        $sql="SELECT * FROM user WHERE UserID=?";
        $search=$con->prepare($sql);
        $search->execute(array($id));
        $user=$search->fetch();
        ?>
        <div class="container messages ad_home d-flex">
    
             <div class="latest row m-auto">
                 <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                     <div class="bloc-content">
                         <div class="blochead">
                            <h4>
                                 تعديل معلومات 
                                 <b><?php 
                                  echo $user['Username']
                                 ?></b>
                            </h4>
                            <a href="ad_users.php" class="btn btn-secondary">
                                 <i class="fa fa-arrow-right"></i>
                                    عودة
                            </a>

                         </div>


                         <div class="row">
                             <form action="ad_users.php?do=update" method="POST" class="addmanag"enctype="multipart/form-data">
                                 <table class=" table table-responsive">
                                  
                                     <tr>
                                         <td class="ky">
                                             اسم المستخدم <span style="font-size: 9px;">
                                             (الاسم الكامل )   
                                             </span> :
                                         </td>
                                         <td class="val">
                                         
                                             <input type="text" 
                                                    name="name"  
                                                    class="form-control" 
                                                    placeholder="أكتب اسم المستخدم هنا "
                                                    value="<?php echo $user['Username'];?>"
                                                    >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                             البريد الاليكتروني :
                                         </td>
                                         <td class="val">
                                             <input type="text" 
                                                    name="email" 
                                                    class="form-control" 
                                                    placeholder="البريد الاليكتروني الخاص يالمستخدم "
                                                    value="<?php echo $user['Email'];?>"
                                                    >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                          كلمة المرور :
                                         </td>
                                         <td class="val">
                                             <input type="text" 
                                                    name="password" 
                                                    class="form-control" 
                                                    placeholder="كلمة المرور "
                                                    value="<?php echo $user['PasswordHash'];?>"
                                                    >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                             صورة المستخدم :
                                             <span style="font-size: 9px;">
                                         (يمكنك إضافة صورة البروفايل فهي اختيارية )
                                         </span>
                                         </td>
                                         <td class="val">
                                             <input type="file" 
                                                    class="form-control" 
                                                    name="img[]" 
                                                    >
                                         </td>
                                     </tr>
                                 
                                     <tr>
                                     <input type="hidden" name="id" value="<?php echo $user['UserID'];?>"
                                                    >
                                         <td class="" colspan="2">
                                             <input type="submit" value="تسجيل " class="form-control bg-success text-white">
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

    }elseif($do=='delete'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=="not"){
            header("location:ad_users.php?msg=3");
            exit();
        }
        //get url img to delete also :
        $sql1=" SELECT * FROM user WHERE `user`.`UserID` = ?";
        $search1=$con->prepare($sql1);
        $search1->execute(array($id));
        $row=$search1->fetch();



        $sql=" DELETE FROM user WHERE `user`.`UserID` = ?";
        $search=$con->prepare($sql);
        $search->execute(array($id));

        if($search->rowCount()>0){
            if($row['image']=='user_default.jpg'){
                header("location:ad_users.php?msg=5");
            }else{
                $imageURL= "..\media\images\\".$row['image'];
                unlink($imageURL);
                header("location:ad_users.php?msg=5");
            }

        }
        else{
            header("location:ad_users.php?msg=4");
        }
    }elseif($do='profil'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_users.php?do=manage&msg=3");
            exit();
        }
        $sql="SELECT * FROM user WHERE UserID=?";
        $search=$con->prepare($sql);
        $search->execute(array($id));
        $user=$search->fetch();
        ?>
        <!-- user profil:-->
        <div class="profil_page container">
        
            <div class="profil heading_part ">
                        <div class="blochead" style="margin:20px 0; width:70%;">
                             <h4>
                                 
                             </h4>

                             <a href="ad_users.php" class="btn btn-secondary text-light">
                             <i class="fa fa-arrow-right"></i>
                                عودة
                             </a>
                        </div>
                <div class="d-flex">
                   <div class="profil___img">
                    <img src="<?php echo $img.$user['image'] ?>" alt="">
                    <a href="" class="edit"> 
                        تغيير الصورة  
                        <i class="fa fa-edit" style="margin: 0 5px ;"></i>
                    </a>
                  </div>
                   <div class="info__stats">
                    <table>
                        <tr>
                            <td class="key">
                                الاسم
                            </td>
                            <td class="value">: <?php echo $user['Username'];?>
                            </td>
                            <td>
                                <a href="" class="edit"> 
                                    تعديل <i class="fa fa-edit" style="margin: 0 5px ;"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="key"> <?php echo $user['Email'];?> 
                            </td>
                            <td class="value">: youssef
                            </td>
                            <td>
                                <a href="" class="edit"> 
                                    تعديل <i class="fa fa-edit" style="margin: 0 5px ;"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="key">
                                عدد المانجات المفضلة
                            </td>
                            <td class="value">:12</td>
                        </tr>
                        <tr>
                            <td class="key"> عدد المانجات التي تقرأها </td>
                            <td class="value">:34</td>
                        </tr>
                        <tr>
                            <td class="key">
                            <?php echo $user['RegistrationDate'];?>
                            </td>
                            <td class="value">
                                : 12-06-2023</td>
                        </tr>
                    </table>
                 </div>
                </div>
             

            </div>
        </div>
    
            <?php
    }
        ?>


        <?php include $tpl."footer.php";
}
else{
header('location:  ad_login.php');
exit();
}
ob_end_flush(); ?>

