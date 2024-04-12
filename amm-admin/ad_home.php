<?php
ob_start();
session_start();
$page_title="Amura Cpanel | home ";


if (isset($_SESSION['adminID'])){
    include "init.php";


    //data bases :
    // mangas :
        $searchmanga=$con->prepare("SELECT * FROM `manga_series`");
        $searchmanga->execute();
        $mangas=$searchmanga->fetchAll();
        $nbrmanga=sizeof($mangas);

    //chapters :
        $searchchapter=$con->prepare("SELECT * FROM `manga_chapter`");
        $searchchapter->execute();
        $chapters=$searchchapter->fetchAll();
        $nbrchapter=sizeof($chapters);

    //users :
        $searchuser=$con->prepare("SELECT * FROM `user`");
        $searchuser->execute();
        $users=$searchuser->fetchAll();
        $nbruser=sizeof($users);
    //categoriesS :
        $searchcat=$con->prepare("SELECT * FROM `categories`");
        $searchcat->execute();
        $cats=$searchcat->fetchAll();
        $nbrcat=sizeof($cats);
    
    // messages  :
        $searchmsg=$con->prepare("SELECT * FROM `messages`");
        $searchmsg->execute();
        $messages=$searchmsg->fetchAll();
        $nbrmsg=sizeof($messages);



    ?>

    <body>

        <!-- header  -->

        <div class="container home ad_home d-flex">

            <!-- statics -->
            <div class="stats row">
                <div class="col-md-2 col-6">
                    <div class="stat d-flex">
                        <i class="fa fa-code"></i>
                        <span class="stathead">
                   ###
                </span>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <a href="ad_manga.php" style="text-decoration:none">
                        <div class="stat manganbr d-flex">
                            <i class="fa fa-book"></i>
                            <span class="stathead">
                        <?php echo $nbrmanga; ?>
                        مانجا 
                    </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-6">
                    <a href="ad_chapters.php" style="text-decoration:none">
                        <div class="stat chapternbr d-flex">
                            <i class="fa fa-th-list"></i>
                            <span class="stathead">
                    <?php echo $nbrchapter; ?>
                    فصل
                </span>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-md-2 col-6">
        <a href="ad_users.php" style="text-decoration:none">
            <div class="stat usernbr d-flex">
                <i class="fa fa-users"></i>
                <span class="stathead">
                    <?php echo $nbruser; ?>
                    مستخدم 
                </span>
            </div>
        </a>
        </div> -->
                <div class="col-md-2 col-6">
                    <a href="ad_cat.php" style="text-decoration:none">
                        <div class="stat usernbr d-flex">
                            <i class="fa fa-list-alt"></i>
                            <span class="stathead">
                        <?php echo $nbrcat; ?>
                        تصنيف
                    </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-6">
                    <a href="ad_messages.php" style="text-decoration:none">
                        <div class="stat msgnbr d-flex">
                            <i class="fa fa-envelope"></i>
                            <span class="stathead">
                    <?php echo $nbrmsg; ?>
                    رسالة 
                </span>
                        </div>
                    </a>
                </div>

                <div class="col-md-2 col-6">
                    <div class="stat d-flex">
                        <i class="fa fa-code"></i>
                        <span class="stathead">
                ###
                </span>
                    </div>
                </div>
            </div>
            <div class="d-grid options">
                <a href="sitemapinfo.php" class="sitmap">الفهرسة  </a>
            </div>
            <div class="latest row m-auto">
                <div class="latestbloc col-12">
                    <div class="blocheader msg">
                        <?php 
                 $searchmsg=$con->prepare("SELECT * FROM `messages` ORDER BY MessageDate DESC LIMIT 5;");
                 $searchmsg->execute();
                 $messages=$searchmsg->fetchAll();
                 
                 ?>
                        <h3 class="">
                            أخر خمس رسائل
                        </h3>
                        <div class="row">
                            <?php
                   if(!$messages){
                           ?>
                                <div class="alert alert-danger">
                                    لا توجد اي رسالة !
                                </div>
                                <?php
                       }
                    
                    foreach($messages as $message){
                    $mangainfo="SELECT * FROM user WHERE Email = ?";
                    $search1=$con->prepare($mangainfo);
                    $search1->execute(array($message['MessageEmail']));
                    $MessageUser=$search1->fetch();
                    ?>

                                    <div class="comment d-flex col-12 d-flex" style="margin:2px 0">
                                        <div class="d-flex">


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
                             ?>" alt="user_message">
                                            <div>
                                                <div class="username d-flex align-items-center">
                                                    <?php  echo $message['MessageEmail'] ?>
                                                    <div class="time__of_comment mr-10">
                                                        <?php  echo $message['MessageDate'] ?>
                                                    </div>
                                                </div>

                                                <p class="comment-text">
                                                    <?php  echo $message['MessageContent'] ?>

                                                </p>
                                            </div>
                                        </div>
                                        <!-- <div class="controls msg">
                            <a class="edit text-success">
                                    تعديل
                                    <i class="fa fa-edit"></i>
                                </a>
                            <a class="delete text-danger">
                                    حذف
                                    <i class="fa fa-trash"></i>
                                </a>
                        </div> -->

                                    </div>
                                    <?php
                    }
                    ?>
                        </div>
                    </div>
                </div>
                <div class="latestbloc col-12 col-md-6">
                    <div class="blocheader manga">
                        <h3>
                            أخر 5 مانجات تم نشرها
                        </h3>
                        <?php
                $searchmanga=$con->prepare("SELECT * FROM `manga_series` ORDER BY MangaID DESC LIMIT 5;");
                $searchmanga->execute();
                $mangas=$searchmanga->fetchAll();
                ?>
                            <div class="row">
                                <?php     
                    if(!$mangas){
                        ?>
                                <div class="alert alert-danger">
                                    لا توجد اي مانجا
                                </div>
                                <?php
                    }
                    foreach($mangas as $manga){
                    ?>
                                    <div class="Col-12">
                                        <div class="latestmanga d-flex" style="justify-content: space-between;">
                                            <div class="d-flex"><img src="<?php echo $img.$manga['CoverImageURL'] ?>" alt="">
                                                <div>
                                                    <h4>
                                                        <?php echo $manga['Title'] ?>
                                                    </h4>
                                                    <div class="time">
                                                        <?php echo $manga['PublicationStatus'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="controls">
                                                <a class="edit  text-primary" href="ad_chapters.php?MangaID=<?php echo $manga['MangaID'];?>">
                                   عرض الفصول
                                    <i class="fa fa-th-list"></i>
                                </a>
                                                <a class="edit  text-success" href="ad_updatemanga.php?id=<?php echo $manga['MangaID'];?>">
                                    تعديل
                                    <i class="fa fa-edit"></i>
                                </a>


                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <?php } ?>
                            </div>
                    </div>

                </div>

                <div class="latestbloc col-12 col-md-6">
                    <div class="blocheader chapter">
                        <h3>
                            أخر 5 فصول تم نشرها
                        </h3>
                        <?php
                $searchmanga=$con->prepare("SELECT * FROM `manga_chapter` ORDER BY ReleaseDate DESC LIMIT 5;");
                $searchmanga->execute();
                $chapters=$searchmanga->fetchAll();
                ?>
                            <div class="row">
                                <?php
                        if(!$chapters){
                            ?>
                                    <div class="alert alert-danger">
                                        لا يوجد اي فصل
                                    </div>
                                    <?php
                        }
                        foreach($chapters as $chapter){
                                        $mangainfo="SELECT * FROM manga_series WHERE MangaID=?";
                                        $search1=$con->prepare($mangainfo);
                                        $search1->execute(array($chapter['MangaID']));
                                        $manga=$search1->fetch();
                        ?>
                                        <div class="latestmanga col-12 d-flex latestchapter" style="justify-content: space-between;">>
                                            <img src="
                          <?php  
                          $manga_photo=isset($manga['CoverImageURL'])?$manga['CoverImageURL']:'user_default.jpg';
                          echo $img.$manga_photo;
                          ?>" alt="">
                                            <div>
                                                <H5 class="chapternumb d-flex align-items-center">
                                                    <div class="chap">
                                                        <?php echo $chapter['Title']  ?>

                                                    </div>
                                                    <div class="time">now</div>
                                                </H5>
                                                <h4 class="manganame">
                                                    <?php echo $manga['Title']  ?> [ الفصل
                                                    <?php echo $chapter['ChapterNumber']  ?>]
                                                </h4>
                                            </div>
                                            <div class="controls">

                                                <a href="ad_chapters.php?do=pages&id=<?php echo $chapter['ChapterID'] ?>" class="text-success">
                                عرض 
                                <i class="fa fa-eye"></i>
                            </a>
                                                <a href="ad_chapters.php?do=edit&id=<?php echo $chapter['ChapterID'] ?>" class=" text-primary">
                                تعديل
                                <i class="fa fa-edit"></i>
                            </a>

                                            </div>
                                        </div>
                                        <hr>
                                        <?php }?>

                            </div>
                    </div>
                </div>

                <!-- <div class="latestbloc col-12 col-md-6">
            <div class="blocheader user">
                <h3>
                    أخر 5 مستخدمين جدد
                </h3>
                <?php
                $searchmanga=$con->prepare("SELECT * FROM `user` ORDER BY RegistrationDate DESC LIMIT 5;");
                $searchmanga->execute();
                $users=$searchmanga->fetchAll();
                ?>
                <div class="row">
                    <?php
                    if(!$users){
                        ?>
                            <div class="alert alert-danger">
                                لا يوجد اي مستخدم 
                            </div>
                        <?php
                    }
                    foreach($users as $user){
                        ?>
                    <div class="mosta5 d-flex col-md-12"
                         style="align-items: center;justify-content: space-between;"> 
                        <div class="d-flex" style="align-items: center;">
                          <img src="
                             <?php  
                             $user_photo=isset($user['image'])?$user['image']:'user_default.jpg';
                             echo $img.$user_photo;
                             ?>" 
                            alt="">
                          <div>
                            <div class="username"><?php echo $user['Username']  ?></div>
                            <div class="email"><?php echo $user['Email']  ?></div>


                        </div>
                        <div class="time__of_comment">
                            <?php echo $user['RegistrationDate']  ?>
                        </div>
                        </div>
                         <div class="controls">
                        <a href="ad_users.php?do=profil&id=<?php echo $user['UserID'] ?>"
                               class=" text-secondary">
                                عرض المزيد
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="ad_users.php?do=edit&id=<?php echo $user['UserID'] ?>"
                               class=" text-primary">
                                تعديل
                                <i class="fa fa-edit"></i>
                            </a>
                        </div> 


                    </div>
                    <hr>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="latestbloc col-12 col-md-6">
            <div class="blocheader">
                <h3>
                    أخر 5 تعليقات
                </h3>
                <div class="row">
                    <div class="alert alert-danger">
                        غير متوفر حاليا 
                    </div>
                </div>
            </div>
        </div> -->


            </div>
        </div>

        </div>


        <?php include $tpl."footer.php";
}
else{
    header('location:index.php');
    exit();
}
ob_end_flush(); ?>