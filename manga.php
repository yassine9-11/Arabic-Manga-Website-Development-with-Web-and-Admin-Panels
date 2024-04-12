<?php
ob_start();
session_start();
$page_title="Amura Manga | home  ";
$nosearch="no"; // no search label in navbar
include "init.php";

    $q="";
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $q= isset($_GET['q'])? $_GET['q'] : '';
    }

    if($q==""){
        $sql="SELECT * FROM manga_series";
        $search=$con->prepare($sql);
        $search->execute();
        $mangas=$search->fetchAll();
        $rs="";
    }
    else{
        $sql="SELECT * FROM manga_series WHERE Title LIKE '%$q%' 
              OR Description LIKE '%$q%' OR year  LIKE '%$q%'
              OR Author  LIKE '%$q%' OR writer  LIKE '%$q%' 
              OR Genre  LIKE '%$q%' ";
        $search=$con->prepare($sql);
        $search->execute();
        $mangas=$search->fetchAll();
        $rs="
        <p>تم ايجاد <span class='count'>".sizeof($mangas)."</span> نتيجة</p>
        ";
    }

    ?>
    <!-- search bar -->
    <div class="filter-bar">
        <div class="breadcrumb">
            <a href="./">
                AmuraManga
            </a>
            <span>/</span>
            <a href="manga.php" class="current text-dark">
                قائمة المانجا 
            </a>

        </div>

        <form action="manga.php?" method="GET">
            <input type="text" 
                   name="q" 
                   placeholder="إبحث عن المانجا المفضلة  لديك ..." 
                   class="search-input"
                   value="<?php echo $q ?>">
            <!--<select name="sort" class="sort-select">
             <option value=""> ترتيب حسب </option>
            <option value="rating">
                التقييم
            </option>
            <option value="date">
                وقت النشر 
            </option>
            <option value="title">
                العنوان
            </option>
            <option value="author">
                الكاتب
            </option>
          </select>
            <select name="genre" class="genre-select">
            <option value=""> عرض حسب النوع </option>
            <option value="action">أكشن</option>
          </select> -->
            <!-- <div class="filter-checkboxes">
                <input type="checkbox" name="completed" value="1" id="completed">
                <label for="completed">
                    إكتملت
                </label>
                <input type="checkbox" name="ongoing" value="1" id="ongoing">
                <label for="ongoing">
                    قيد الانشاء
                </label>
                <input type="checkbox" name="free" value="1" id="free">
                <label for="free">
                    مجانيا
                </label>
            </div> -->
            <button type="submit" class="search-button">بحث
                <i class="fa fa-search"></i>

            </button>
        </form>
    </div>
    
    <div class="result-count">
        <?php echo $rs ?>
    </div>

    <div class="all manga">
        <div class="latestmangawrap">

            <div class="container latest-manga2">
                <div class="row">
                    <?php
                    foreach($mangas as $manga){ 
                    ?>
                    <div class="col-md-3 col-6">
                        <div class="mangacard mangalatest">
                            <div class="mangaimg">
                                <img src="<?php echo $img.$manga['CoverImageURL'] ?>" 
                                     alt="<?php echo $img.$manga['Title'] ?>">
                                <div class="nbr__chapter"> <span class="nbr">
                                    <?php 
                                    $mangainfo="SELECT * FROM `manga_chapter` WHERE MangaID=?";
                                    $search1=$con->prepare($mangainfo);
                                    $search1->execute(array($manga['MangaID']));
                                    $rs=$search1->fetchAll();
                                    $chapter_nbr=sizeof($rs);
                                    echo $chapter_nbr ?>
                                    </span> فصل 
                                </div>
                                <a href="singleManga.php?id=<?php 
                                         echo $manga['MangaID'] ?>&prec=m" 
                                   class="btn btn-read">

                                    إقرأ الان
                                </a>
                            </div>
                            <div class=" allmangatitle" style="margin: 5px">
                                <?php echo $manga['Title'] ?>

                                <table style="margin:auto;">
                                    <tr >
                                        <td><span class="mangadate">
                                            <?php
                                            echo $manga["vues"];
                                            ?>
                                        </span></td>
                                        <td><i class="far fa-eye"></i></td>

                                        

                                        <td><span class="mangadate">(<?php echo $manga['rating'] ?>)</span></td>
                                        <td> <i class="fa fa-star rating"></i></td>

                                    </tr>
                                    <tr >
                                        <td><span class="mangadate">
                                            <?php echo $manga['Author'] ?>
                                            </span>
                                        </td>
                                        <td><i class="fa fa-pencil"></i></td>

                                        

                                        <td> 
                                            <span class="mangadate <?php
                                                echo ($manga['PublicationStatus']=="Completed")?
                                                "text-success":"text-primary"; 
                                                 ?>"> 
                                                <?php echo $manga['PublicationStatus'] ?>
                                            </span>
                                        </td>

                                        <td>
                                            
                                               <?php
                                                echo ($manga['PublicationStatus']=="Completed")?
                                                "<i class='fa fa-check-circle text-success'></i>":
                                                "<i class='fa fa-check text-primary'></i>"; 
                                                 ?>     
                                        </td>

                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>




    <?php 
    
    include $tpl."footer.php";

ob_end_flush(); ?>