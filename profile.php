<?php
ob_start();
session_start();
$page_title="Amura Manga | home  ";
include "init.php";

    $UserID=(isset($_GET['id'])?$_GET['id']:'no');
    if($UserID=='no'){
    ?>
    <div class="alert alert-danger" style="padding: 50px;margin:60px 10px;">
        هذه الصفحة غير موجودة .
    </div>
    <?php
    }else{ 
        // get user info :
        $sql="SELECT * FROM `user` WHERE userID = ? ";
        $search=$con->prepare($sql);
        $search->execute(array($UserID));
        $row=$search->fetch();


        if($_SERVER['REQUEST_METHOD']=='GET'){
            $do=(isset($_GET['d']))?$_GET['d']:'mr';
        }
        ?>
          <!-- user profil:-->
        <div class="profil_page container">
        <div class="profil heading_part d-flex">
            <div class="profil___img">
                <img src="<?php echo $img.$row['image'] ?>" alt="">
                <?php if($UserID==$_SESSION['userID']){  ?>
                <a href="" class="edit"> 
                    تغيير الصورة  <i class="fa fa-edit" style="margin: 0 5px ;"></i>
                </a>
                <?php } ?>
            </div>
            <div class="info__stats">
                <table>
                    <tr>
                        <td class="key">
                            الاسم
                        </td>
                        <td class="value">: <?php echo $row['Username'] ?>
                        </td>
                        <td>
                            <?php if($UserID == $_SESSION['userID']){  ?>
                            <a href="" class="edit"> 
                                تعديل <i class="fa fa-edit" style="margin: 0 5px ;"></i>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="key"> البريد الاليكتروني
                        </td>
                        <td class="value">: <?php echo $row['Email'] ?>
                        </td>
                        <td>
                            <?php if($UserID == $_SESSION['userID']){  ?>
                            <a href="" class="edit"> 
                                تعديل <i class="fa fa-edit" style="margin: 0 5px ;"></i>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="key">
                            تاريخ الانضمام
                        </td>
                        <td class="value">
                            : <?php echo getTimeAgo(strtotime($row['RegistrationDate'])) ?></td>
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
                    
                </table>
            </div>
        </div>

        
        <div class="bodying_part">
            <div class="body__titls">
                <ul>
                    <?php if($UserID == $_SESSION['userID']){ ?>
                    <li class="profil_link">
                        <a href="?d=mr&id=<?php echo $UserID ?>" 
                           class="<?php echo ($do=="mr")?'active':""; ?>">
                        المانجات التي بدأت قرائتها 
                        </a>
                    </li>
                    <!-- <li class="profil_link">
                        <a href="?d=mf&id=<?php echo $UserID ?>"
                           class="<?php echo ($do=="mf")?'active':""; ?>">
                        المانجات المفضلة لديك
                        </a>
                    </li> -->
                    <li class="profil_link">
                        <a href="?d=n&id=<?php echo $UserID ?>"
                           class="<?php echo ($do=="n")?'active':""; ?>">
                       الاشعارات 
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li class="profil_link">
                        <a href="?d=ms&id=<?php echo $UserID ?>" 
                           class="<?php echo ($do=="mr")?'active':""; ?>">
                        المانجات التي يتابعها 
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <hr class="profil__hr" />
            <div class="body__content">
                <?php if($do=="mr"){  ?>
                    <div class="body___list row">
                        <div class="body__item favmanga d-flex">
                            <img src="./2.jpeg" alt="">
                            <div class="mangatit">naruto</div>
                            <a href="singleManga.php?id=64&prec=p&u=<?php echo $row['Username']?>">
                                اتمم القراءة
                                <i class="fa-regular fa-circle-play text-light"style="margin-right:10px"></i>
                            </a>
                        </div>
                    </div> 
                    <div class="body___list row">
                        <div class="body__item favmanga d-flex">
                            <img src="./2.jpeg" alt="">
                            <div class="mangatit">naruto</div>
                            <a href="singleManga.php?id=64&prec=p&u=<?php echo $row['Username']?>">
                                اتمم القراءة
                                <i class="fa-regular fa-circle-play text-light"style="margin-right:10px"></i>
                            </a>
                        </div>
                    </div>
                <?php }elseif($do=="ms"){?>
                    <div class="body___list row">
                        <div class="body__item favmanga d-flex">
                            <img src="./2.jpeg" alt="">
                            <div class="mangatit">naruto</div>
                            <a href="singleManga.php?id=64&prec=p&u=<?php echo $row['Username']?>">
                                اقرأ الان 
                                <i class="fa-regular fa-circle-play text-light"style="margin-right:10px"></i>
                            </a>
                        </div>
                    </div> 
                    <div class="body___list row">
                        <div class="body__item favmanga d-flex">
                            <img src="./2.jpeg" alt="">
                            <div class="mangatit">naruto</div>
                            <a href="singleManga.php?id=64&prec=p&u=<?php echo $row['Username']?>">
                                اقرأ الان 
                                <i class="fa-regular fa-circle-play text-light"style="margin-right:10px"></i>
                            </a>
                        </div>
                    </div>
                <? }elseif($do=="n"){ ?>
                <div class="body___list row">
                    <div class="body__item not d-flex" style="position: relative;">
                        <i class="fa fa-user"></i>
                        <a href="">
                            تم قبول ملفك الجنائي
                        </a>
                        <div class="time__noti">
                            قبل 5 دقائق
                        </div>
                    </div>
                    <div class="body__item not d-flex">
                        <i class="fa fa-comments"></i>
                        <a href="">
                            تم قبول ملفك الجنائي
                        </a>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>






        <?php 
    }
    include $tpl."footer.php";

ob_end_flush(); ?>