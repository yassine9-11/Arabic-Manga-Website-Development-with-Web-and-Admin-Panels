<?php

include "init.php";
 

$ChapterID=(isset($_GET['id'])?$_GET['id']:'no');

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

echo " act Id :".$chapter['ChapterNumber'];
$nextId=getNextchapterID($ChapterID,$manga['MangaID']);
?>
<div>hy</div>
<?php if($nextId>0){  ?>
<a href="test.php?id=<?php echo $chapters[$nextId-1]['ChapterID']  ?>">
    nextID
</a>
<?php }
if($nextId<sizeof($chapters)-1){  ?>
    <a href="test.php?id=<?php echo $chapters[$nextId+1]['ChapterID']  ?>">
        prevID
    </a>
<?php }
/*
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

        foreach($chapters as $chapter){
            echo $chapter['ChapterID'].'<br>';
        }*/?>