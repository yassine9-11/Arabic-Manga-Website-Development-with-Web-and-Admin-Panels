<?php
ob_start();
session_start();
$page_title=" شاهد احدث فصول المانجا حصريا | Amura Manga - أمورا مانجا ";
$descMeta=" أفضل موقع عربي للمانغا نطمع في إرضائكم  وجعلكم مرتاحين في مشاهدة  المانغا والإستمتاع والتشويق بأحداثها
         ";
$keyMeta="أمورا مانغا ،amura manga,manga,مانغا,manhua,مانهوا،مانها،الفصل،
         ";
$titleMeta="amura manga page";

include "init.php";?>
    <!-- start slide -->

    <div  id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="./media/cover/cover1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption  d-none d-md-block">

                    <h5>
عن الموقع
                    </h5>
                    <h2>Amura Manga </h2>
                    <p>
أفضل موقع عربي للمانغا نطمع في إرضائكم وجعلكم مرتاحين في مشاهدة المانغا والإستمتاع والتشويق بأحداثها
                    </p>
                    <a href="" class="btn btn-read">
                        إقرأ  الان
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./media/cover/cover2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption  d-none d-md-block">

                    <h5>
  عن الموقع
                    </h5>
                    <h2>Amura Manga </h2>
                    <p>
  أفضل موقع عربي للمانغا نطمع في إرضائكم وجعلكم مرتاحين في مشاهدة المانغا والإستمتاع والتشويق بأحداثها
                    </p>
                    <a href="" class="btn btn-read">
                        إقرأ  الان
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./media/cover/cover3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption  d-none d-md-block">
                    <h5>عن الموقع
                    </h5>
                    <h2>Amura Manga </h2>
                    <p>أفضل موقع عربي للمانغا نطمع في إرضائكم وجعلكم مرتاحين في مشاهدة المانغا والإستمتاع والتشويق بأحداثها
                    </p>
                    <a href="" class="btn btn-read">
                        إقرأ  الان
                    </a>
                </div>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <div class="carousel-control">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </div>

          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <div class="carousel-control">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </div>
          <span class="visually-hidden">Next</span>
        </button>
    </div>








    <!-- latest chapter -->
    <?php
        $searchmanga=$con->prepare("SELECT * FROM `manga_chapter` ORDER BY ReleaseDate DESC LIMIT 6;");
        $searchmanga->execute();
        $chapters=$searchmanga->fetchAll();
    ?>
    <div class="latestmanga" id="lc">
        <div class="latestmangawrap">
            <div class="latestmangaheader">
                <span class="title latestmangatitle">
                    أخر الفصول المحدثة
                </span>
            </div>

            <div class="container latest-manga">

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
                    <div class="col-md-4 col-6">
                        <div class="mangacard">
                            <div class="mangaimg">
                            <img src="
                                 <?php
                                 $manga_photo=isset($manga['CoverImageURL'])?$manga['CoverImageURL']:'user_default.jpg';
                                 echo $img.$manga_photo;
                                 ?>"
                            alt="">
                            </div>
                            <div class="mangatitle">
                               <?php echo $manga['Title']  ?>- <span class="chapter__nbr"> الفصل <?php echo $chapter['ChapterNumber']  ?></span><br>
                                <span class="mangadate">
                                    <?php
                                     $date_post= $chapter['ReleaseDate'];
                                     $time=strtotime($date_post);
                                    echo getTimeAgo($time);

                                    ?>
                                </span>
                            </div>
                            <a href="readManga.php?id=<?php echo $chapter['ChapterID'] ?>" class="btn btn-read">
                                إقرأ  الان
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>





    <!-- popûlar manga   -->
    <?php
        $searchmanga=$con->prepare("SELECT * FROM `manga_series` ORDER BY 	year DESC LIMIT 12;");
        $searchmanga->execute();
        $popmangas=$searchmanga->fetchAll();
    ?>
    <section class="Popularmanga" id="pm" style="background:#fff;">
        <div class="latestmangaheader">
            <span class="title latestmangatitle">
                أشهر المانجات المرفوعة
            </span>
        </div>
        <div class="swiper anime-slider">
            <div class="row popular container m-auto">


                <?php
                    if(!$popmangas){
                        ?>
                            <div class="alert alert-danger">
                                لا توجد اي مانجا
                            </div>
                        <?php
                    }
                    $cmpt=0;
                    foreach($popmangas as $popmanga){
                        $cmpt++;
                        $mangainfo="SELECT * FROM `manga_chapter` WHERE MangaID=?";
                        $search1=$con->prepare($mangainfo);
                        $search1->execute(array($popmanga['MangaID']));
                        $manga=$search1->fetchAll();
                        $chapter_nbr=sizeof($manga);
                ?>

                <div class="col-md-3 col-6">
                    <div class="mangacard mangalatest">
                        <div class="order"><span><?php echo $cmpt ?></span></div>

                        <div class="mangaimg">
                            <img src="<?php echo $img.$popmanga["CoverImageURL"]?>" alt="">
                            <div class="nbr__chapter"><span class="nbr"> <?php echo $chapter_nbr ?> </span>فصل </div>
                            <a href="singleManga.php?id=<?php
                                     echo $popmanga["MangaID"] ?>&prec=h&type=pm" class="btn btn-read">
                                إقرأ الان
                            </a>
                        </div>
                        <div class="mangatitle">
                            <?php echo $popmanga['Title'] ?> <br>
                            <span style="font-size: 14px;" class=" <?php echo ($popmanga['PublicationStatus']=='Completed')?
                                                          "text-success":"text-primary" ?>">
                                <?php echo $popmanga['PublicationStatus']	?>
                            </span>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>

    </section>


    <!-- latest manga -->

    <div class="latestmanga" id="lm">
        <div class="latestmangawrap">
            <div class="latestmangaheader">
                <span class="title latestmangatitle">
                    أخر المانجات المحدثة
                </span>
            </div>

            <div class="container latest-manga2">
                <div class="row">
                <?php
                    $limitlatest=0;
                    foreach(latestMangaIDs() as $MangaID){
                        $limitlatest++;
                        $searchmanga=$con->prepare("SELECT * FROM `manga_series` WHERE MangaID = ?");
                        $searchmanga->execute(array($MangaID));
                        $latestmanga=$searchmanga->fetch();

                        if($limitlatest<=12){

                ?>

                    <div class="col-md-3 col-6">
                        <div class="mangacard mangalatest">
                            <div class="mangaimg">
                                <img src="<?php echo $img.$latestmanga['CoverImageURL'] ?>" alt="">
                                <div class="nbr__chapter"> <span class="nbr">
                                    <?php
                                    $mangainfo="SELECT * FROM `manga_chapter` WHERE MangaID=?";
                                    $search1=$con->prepare($mangainfo);
                                    $search1->execute(array($MangaID));
                                    $manga=$search1->fetchAll();
                                    $chapter_nbr=sizeof($manga);

                                    echo $chapter_nbr;
                                    ?>
                                </span> فصل</div>
                                <a href="singleManga.php?id=<?php
                                        echo $latestmanga["MangaID"] ?>&prec=h&type=lm" class="btn btn-read">
                                    إقرأ الان
                                </a>
                            </div>
                            <div class="mangatitle">
                                <?php echo $latestmanga['Title'];?> <br>
                                <span class="mangadate">
                                <?php
                                $time=strtotime(updateDate($MangaID));
                                echo getTimeAgo($time);
                                ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
            </div>

        </div>
    </div>


     <!-- categories -->
     <div class="categories"  style="background:#fff">
        <div class="latestmangaheader">
            <span class="title latestmangatitle">
                التصنيفات المتاحة
            </span>
        </div>

        <div class="row container m-auto">
            <?php

            $sql="SELECT * FROM `categories` ";
            $search=$con->prepare($sql);
            $search->execute();
            $rows=$search->fetchAll();


            foreach($rows as $cat){
            ?>
            <div class="col-md-1 col-3">
                <a href="manga.php?q=<?php echo $cat['CatName'] ?>" class="category">
                    <?php echo $cat['CatName'] ?>
            </a>
            </div>
            <?php }?>
        </div>
    </div>







    <?php include $tpl."footer.php";

ob_end_flush(); ?>
