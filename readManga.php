<?php
ob_start();
session_start();
$nohead="yes";
include "init.php";
    
    $ChapterID=(isset($_GET['id'])?$_GET['id']:'no');
    if($ChapterID=='no'){
    ?>

    <div class="alert alert-danger" style="padding: 50px;margin:60px 10px;">
        هذه الصفحة غير موجودة .
    </div>
    <?php
    }
    else{
        $sql1="SELECT * FROM `manga_page` WHERE ChapterID = ? order by PageNumber ASC";
        $search1=$con->prepare($sql1);
        $search1->execute(array($ChapterID)); 
        $pages=$search1->fetchAll();

        if(!$pages){
              
        include $tpl."header.php";
        include $tpl.'navbar.php';
            ?>
        
            <div class="alert alert-danger" style="padding: 50px;margin:60px 10px;">
                تم حذف جميع الصور .
            </div>
            <?php
          
        }
        else{ 

        $sql="SELECT * FROM `manga_chapter` WHERE ChapterID=?";
        $search=$con->prepare($sql);
        $search->execute(array($ChapterID));
        $chapter=$search->fetch();



        $mangainfo="SELECT * FROM manga_series WHERE MangaID=?";
        $search2=$con->prepare($mangainfo);
        $search2->execute(array($chapter['MangaID']));
        $manga=$search2->fetch();
        

        $sql1="SELECT * FROM `manga_chapter` WHERE MangaID=? ORDER BY ChapterNumber DESC";
        $search1=$con->prepare($sql1);
        $search1->execute(array($manga["MangaID"])); 
        $chapters=$search1->fetchAll();

        $actualChapterID=getChapterNbr($ChapterID,$manga['MangaID']); 

        //les infos de meta et title:
        $page_title="Amura Manga | ".$manga['Title'];
        $page_title.=" - الفصل ".$chapter['ChapterNumber'];
        $page_title.=" [".$chapter['Title']."]";

        $description = $manga['Title'];
        $description .=" - الفصل ".$chapter['ChapterNumber'];
        $description .=" [".$chapter['Title']."]";
        $description .=" amura manga ";
        $descMeta=$description;

        $keyMeta=$manga['keywords'];

        $titleMeta =" الفصل ";
        $titleMeta.=$chapter['ChapterNumber'];
        $titleMeta .=" من مانجا  ";
        $titleMeta.="(".$manga['Title'].")";
        $titleMeta .= "- [".$chapter['Title']."]";

        include $tpl."header.php";
        include $tpl.'navbar.php';
    ?>
        <!-- search bar -->
        <div class="filter-bar">
        </div>
        <!-- chapter manga  -->
        

    <header class="m-auto" style="text-align: center;">
        <h1 class="manga-title">
            <?php echo $manga['Title'] ?>
        </h1>
        <h3 class="manga_chapter_nbr">
            الفصل 
            <?php  echo $chapter['ChapterNumber'] ?>
            [<?php echo $chapter['Title']?>]
        </h3>
        <div class="navigation" style="
            display: flex;
            justify-content: center;">

            <?php if($actualChapterID>0){ ?>
            <a href="readManga.php?id=<?php echo $chapters[$actualChapterID-1]['ChapterID'] ?>" 
               class="next">

                الفصل التالي 

            </a>
            <?php } if($actualChapterID<sizeof($chapters)-1) { ?>
            <a href="readManga.php?id=<?php echo  $chapters[$actualChapterID +1]['ChapterID'] ?>" 
               class="prev">
                الفصل السابق 
            </a>
            <?php  }?>
        </div>
    </header>
    <main class="manga-imgs">

        <div class="manga-images container row m-auto">
            <?php
            foreach($pages as $page){ 
            ?>

            <img src="<?php echo $img.$page['ImageURL']?>" 
                 class="col-md-9 " alt="Manga Image <?php echo $manga['Title'] ?>">

            <?php } ?>
        </div>

    </main>
          <div class="navigation" style="
            display: flex;
            justify-content: center;">

            <?php if($actualChapterID>0){ ?>
            <a href="readManga.php?id=<?php echo $chapters[$actualChapterID-1]['ChapterID'] ?>" 
               class="next">

                الفصل التالي 

            </a>
            <?php } if($actualChapterID<sizeof($chapters)-1) { ?>
            <a href="readManga.php?id=<?php echo  $chapters[$actualChapterID +1]['ChapterID'] ?>" 
               class="prev">
                الفصل السابق 
            </a>
            <?php  }?>
        </div>

    <hr class="manga-hr">
    <div class="commenting container ratingform">


        <div class="d-flex ">
            <h2 class="manga-sing-title">
                <i class="fa-regular fa-comments" style="margin-left:10px"></i> نقاشات حول المانجا : </h2>
        </div>
        <div>
            no content to show 
        </div>
        <!-- <div class="rating">
            <form action="">
                <h4>
                    تقييمك من 10 لهذه المانجا
                </h4>
                <div class=" d-flex">
                    <input type="number" step="0.5" lang="fr">
                    <input type="submit" value="إرسال ">
                </div>
            </form>

        </div> -->
        <!-- <div class="comments">
            <h4>
                تعليقات حول هذه المانجا
            </h4>
            <form class="comment-form row">
                <div class="commen col-12" style="margin:10px 0">
                    <label for="comment">
                        التعليق <span class="required">*</span>:</label>
                    <textarea id="comment" name="comment" style="width: 100%;" required></textarea>
                </div>

                <div class="col-6" style="margin:10px 0">
                    <label for="name">
                        الاسم <span class="required">*</span>:</label>
                    <input type="text" id="name" name="name" style="width: 100%;" required>

                </div>
                <div class="col-6" style="margin:10px 0"> <label for="name">
                    البريد الاليكتروني  <span class="required">*</span>:</label>
                    <input type="email" id="name" name="name" style="width: 100%;" required></div>

                <div class=" d-flex" style="margin:10px 0; align-items: end; justify-self: center;">
                    <input type="submit" value=" إرسال التعليق ">

                </div>

            </form>
            <hr class="manga-hr">

            <div class="comment-list">
                <div class="comment" style="margin:10px 0">
                    <div class="heading d-flex">
                        <img src="./1jpg.jpg" alt="">
                        <div>
                            <div class="username">John Doe</div>
                            <div class="time__of_comment">
                                منذ ساعتين
                            </div>
                            <p class="comment-text">

                                اخيرا رجعت نانو 🥰 شكرا ع الدفعه واو مو مصدقه 6 فصول من واحد من أفضل مانهواتي احس انكم دلعتونا واجد يا حبي لكم ازورا 🥰


                            </p>
                            <div class="comment__pub d-flex">
                                <i class="fa fa-heart"></i>
                                <span class="like" style="margin: 0 4px 0 20px;">23</span>
                                <a href=""> 
                                    الرد <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="comment" style="margin:10px 0">
                    <div class="heading d-flex">
                        <img src="./4jpg.jpg" alt="">
                        <div>
                            <div class="username">karim oub</div>
                            <div class="time__of_comment">
                                منذ ساعتين
                            </div>
                            <p class="comment-text">

                                6 فصول مره واحده ده دلع ده😂🥰 شكرا لكم، استمرو💪🏻

                            </p>
                            <div class="comment__pub d-flex">
                                <i class="fa fa-heart"></i>
                                <span class="like" style="margin: 0 4px 0 20px;">23</span>
                                <a href=""> 
                                    الرد <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>



                 
            </div>
        </div> -->
    </div>
    <hr class="manga-hr">


    <?php 
    }}
    include $tpl."footer.php";

ob_end_flush(); ?>