<?php
ob_start();
session_start();
$nohead="yes";
include "init.php";
    
    $MangaID=(isset($_GET['id'])?$_GET['id']:'no');
    if($MangaID=='no'){
    ?>

    <div class="alert alert-danger" style="padding: 50px;margin:60px 10px;">
        هذه الصفحة غير موجودة .
    </div>
    <?php
    }
    else{
        $sql="SELECT * FROM manga_series where MangaID = ?";
        $search=$con->prepare($sql);
        $search->execute(array($MangaID));
        $manga=$search->fetch();


        

        if(!$manga){
            ?>
            <div class="alert alert-danger" style="padding: 50px;margin:60px 10px;">
                هذه الصفحة غير موجودة .
            </div>
            <?php
        }
        else{
            $sql1="SELECT * FROM `manga_chapter` WHERE MangaID=? ORDER BY ChapterNumber DESC";
            $search1=$con->prepare($sql1);
            $search1->execute(array(
                $manga['MangaID']
            )); 
        $chapters=$search1->fetchAll();


        //les infos de meta et title:
        $page_title=" Amura Manga | ".$manga['Title'];
        $descMeta=$manga["Description"];
        $descMeta.=" Amura manga";
        $keyMeta=$manga['keywords'];
        $titleMeta=$manga['Title'];

        include $tpl."header.php";
        include $tpl.'navbar.php';

    
    ?>
        <!-- search bar -->
        <div class="filter-bar">
            <?php 
            $precpage='h';
            $type="اشهر المانجات ";
            ?>
            <div class="breadcrumb">
                    <a href="./">
                       AmuraManga
                    </a>
                <?php 
                $precpage=(isset($_GET['prec']))?$_GET['prec']:"no";
                if($precpage=='h'){
                    $type=(isset($_GET['type']))?$_GET['type']:"no";
                    $typeName="";

                    if($type=="pm"){ $typeName="أشهر المانجات ";}
                    elseif($type=="lm"){ $typeName="أحدث المانجات ";}

                    ?>
                    <span>/</span><a href="index.php"> الرئيسية      </a>

                    <?php if($type!="no"){?>
                    <span>/</span> 
                    <a href="index.php#<?php echo $type ?>"><?php echo $typeName; ?></a>
                    <?php } ?>


                    <span>/</span> 
                     <span class="current text-dark"><?php echo $manga['Title']; ?></span>
                    <?php
                }
                elseif($precpage=='m'){
                    ?>
                    <span>/</span>
                    <a href="manga.php">
                       قائمة المانجا 
                    </a>
                    <span>/</span>
                     <span class="current text-dark">
                     <?php echo $manga['Title']; ?>
                     </span>
                    <?php
                }
                elseif($precpage=='p'){
                    $user=(isset($_GET['u']))?$_GET['u']:"user";
                    ?>
                    <span>/</span>
                    <a href="manga.php">
                       <?php echo $user ?>
                    </a>
                    <span>/</span>
                     <span class="current text-dark">
                     <?php echo $manga['Title']; ?>
                     </span>
                    <?php
                }
                ?>
                
            </div>
        </div>


        <!-- manga details -->
        <div class="row container">
            <div class="singlemanga m-auto ">
                <div class="manga-info container">
                    <h1 class="manga-title"><?php echo  $manga['Title']; ?> </h1>
                    <hr class="manga-hr">
    
                    <div class="manga-info-wrap">
                        <div class="manga-cover">
                            <div style="position:relative">
                                <img src="<?php echo $img.$manga['CoverImageURL'] ?>"
                                          alt="Manga Cover - <?php echo  $manga['Title']; ?> ">
                                <div class="nbr">
                                <?php 
                                $mangainfo="SELECT * FROM `manga_chapter` WHERE MangaID=?";
                                $search1=$con->prepare($mangainfo);
                                $search1->execute(array($manga['MangaID']));
                                $rs=$search1->fetchAll();
                                $chapter_nbr=sizeof($rs);
                                echo $chapter_nbr ?> فصول </div>
                            </div>
    
                        </div>
                        <div class="manga-details">
    
                            <div class="d-flex">
                                <div class="part1">
                                    <div class="rating-star">

                                        <?php if($manga['rating']<=10&&$manga['rating']>=0){
                                            $RAT=$manga['rating'];
                                            }else{
                                                $RAT=0;
                                            }
                                        ?>
                                        <i class="<?php echo Rating($RAT)[0] ?> comp"></i>
                                        <i class="<?php echo Rating($RAT)[1] ?>  comp"></i>
                                        <i class="<?php echo Rating($RAT)[2] ?>  comp"></i>
                                        <i class="<?php echo Rating($RAT)[3] ?>  comp "></i>
                                        <i class="<?php echo Rating($RAT)[4] ?> comp"></i>

                                        <span class="value">(<?php echo $RAT ?>)</span>
                                    </div>
                                    <div class="manga-rating">
                                        <span class="key">التقييم  : </span><?php echo $RAT ?>
                                    </div>
                                    <div class="manga-authors">
                                        <span class="key">
                                            المؤلف 
                                            :
                                        </span>
                                        <span class="value">
                                           <?php echo $manga['Author'] ?>
                                        </span>
                                    </div>
                                    <div class="manga-authors">
                                        <span class="key">
                                            الكاتب  
                                            :
                                        </span>
                                        <span class="value"> 
                                            <?php echo $manga['writer'] ?>     
                                        </span>
                                    </div>
                                    <div class="manga-genres">
                                        <span class="key">النوع :</span>
                                        <span class="value">
                                            مانجا 
                                        </span>
                                    </div>
                                    <div class="manga-genres">
                                        <span class="key">
                                            التصنيف 
                                             :
                                            </span>
                                        <span class="value">
                                            <?php
                                                $GenreArray=explode(",",$manga['Genre']);
                                                foreach($GenreArray as $gen) {
                                                    if(!$gen==""){ 
                                                ?>
                                                <span class="gen" style="">
                                                    <?php echo $gen ?>
                                                </span>
                                                <?php }}?>
                                        </span>
                                    </div>
    
                                    <div class="manga-genres">
                                        <span class="key">
                                            
                                            الكلمات المفتاحية (
                                                tags
                                            )
                                             
                                            :
                                        </span>
                                        <span class="value">
                                            <?php
                                            $keywordsArray=explode(",",$manga['keywords']);
                                            foreach($keywordsArray as $tag) {
                                            ?>
                                            <span class="tag" style="">

                                                         <?php echo $tag ?>
                                            </span>
                                            <?php }?>
                                        </span>
                                    </div>
    
    
                                </div>
                                <div class="part2">
                                    <div class="manga-genres">
                                        <span class="key">
                                            سنة الانتاج  
                                             :
                                            </span>
                                        <span class="value">
                                            <?php echo $manga['year'] ?>
                                        </span>
                                    </div>
                                    <div class="manga-status">
                                        <span class="key">    الحالة  :</span>
                                        <span class="value">
                                            <?php echo $manga['PublicationStatus'] ?>
                                        </span>
                                    </div>
    
                                    <div class="sats d-flex">
                                        <div class="views">
                                            <i class="fa fa-comments"></i><br> 12 تعليق
                                        </div>
                                        <div class="comments">
                                            <i class="fa-solid fa-eye"></i> <br> 127 مشاهدة
    
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                            
                                <?php if(sizeof($chapters)>0){ ?>
                                <div class="startRead">
                                <a href="readManga.php?id=<?php
                                          echo $chapters[sizeof($chapters)-1]["ChapterID"] ?>" 
                                    class="start-read">
                                    ابدأ قراءة الفصل الاول

                                </a>
                                </div>
                                <?php }else{?>
                                <div class="alert alert-warning">
                                     لم يتم اضافة اي فصل الى حد الان .
                                </div>
                                <?php }?>
                        </div>
                    </div>
                    <hr class="manga-hr">
    
                    <div class="manga-description">
                        <div class="d-flex">
                            <h2 class="manga-sing-title">
                                <i class="fa-solid fa-bookmark" style="margin-left:10px"></i> القصة : </h2>
                        </div>
    
                        <p> <?php echo $manga["Description"] ?> </p>
                    </div>
                    <hr class="manga-hr">
    
                    <div class="chapter-list">
                        
                        <h2 class="manga-sing-title"><i class="fa-solid fa-list" style="margin-left:10px"></i>قائمة الفصول المضافة :</h2>
                        <ul>
                            <table class="table table-striped">
                                <tbody>
                                    <?php
                                    $i=sizeof($chapters);
                                    foreach($chapters as $chapter){ 
                                        $i--;
                                    ?>
                                    <tr>
                                        <td>
                                            <li>
                                                <a href="readManga.php?i=<?php echo $i?>&id=<?php echo $chapter['ChapterID']?>">
                                                    الفصل 
                                                    <?php  echo $chapter['ChapterNumber'] ?>
                                                    [<?php echo $chapter['Title']?>]
                                                    <i class="fa-regular fa-circle-play"style="margin-right:10px"></i>
                                                </a>
                                                <span class="since_chapter">
                                                     <?php echo getTimeAgo(strtotime($chapter['ReleaseDate'])); ?>
                                                     <i class="fa-regular fa-clock"style="margin-right:5px"></i>
                                                </span>
                                            </li>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                
                                </tbody>
                            </table>
                    </ul>
                    </div>
                    </ul>
    
                </div>
            </div>
        </div>
        </div>


    <?php 
    }}
    include $tpl."footer.php";

ob_end_flush(); ?>