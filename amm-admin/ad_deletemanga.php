<?php
ob_start();
session_start();
$page_title="Amura Cpanel | delete managa  ";


if (isset($_SESSION['adminID'])){
    include "init.php";
    $id=isset($_GET['id'])? $_GET['id']:'not';
    if($id=="not"){
        header("location:ad_manga.php?msg=3");
    }
    else{
        //get urlimg to delete also :
        $sql1=" SELECT * FROM manga_series WHERE `manga_series`.`MangaID` = ?";
        $search1=$con->prepare($sql1);
        $search1->execute(array($id));
        $row=$search1->fetch();



        $sql=" DELETE FROM manga_series WHERE `manga_series`.`MangaID` = ?";
        $search=$con->prepare($sql);
        $search->execute(array($id));

        if($search->rowCount()>0){
            if($row['CoverImageURL']=='manga_default.jpg'){
                header("location:ad_manga.php?msg=1");

            }
            else{
                $imageURL= "../media/images/".$row['CoverImageURL'];
                unlink($imageURL);
                header("location:ad_manga.php?msg=1");

            }
        }
        else{
            header("location:ad_manga.php?msg=2");
        }
    }
    include $tpl."footer.php";
}
else{
    header('location:index.php');
    exit();
}
ob_end_flush(); ?>