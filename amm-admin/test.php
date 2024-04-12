<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    include "init.php";
    //upload manga file :
    $pathIMG = "../media/images/test/";
    if (!file_exists($pathIMG)) 
    {
    mkdir($pathIMG, 0777, true);  //0777 sont les droits (lecture écriture et execution)
    }

    //get max id  of existing manga chapter img :
    $sql="SELECT * FROM `manga_page`  WHERE PageID= (SELECT MAX(PageID) FROM manga_page); ";
    $search=$con->prepare($sql);
    $search->execute();
    $row=$search->fetch();



    $imgnumber=$row['PageID']+1;

    
    //img name :
    foreach($_FILES['img']['tmp_name'] as $img){
        // echo "<pre>";
        // print_r($img);
        // echo "</pre>";
        $imagname="page_".$imgnumber;
        move_uploaded_file($img, $pathIMG.$imagname.".jpg");

        $imgnumber++;
    }
    echo "done";
    // 

    // if(!($_FILES['img']['tmp_name'][0]=='')){
    //     $img=$imagname.".jpg";
    // }else{
    //     $img='page_default.jpg';
    // }
    
    // $sql="INSERT INTO `manga_page` 
    //       ( `ChapterID`, `PageNumber`, `ImageURL`)
    //      VALUES (?, ?, ?)";
    // $search=$con->prepare($sql);
    // $search->execute(array(
    //                  $_POST['id'],
    //                  $_POST['number'],
    //                  $img
    //                  ));
    // if($search->rowCount()>0){
    //     $id=$_POST['id'];
    //    header("location:ad_chapters.php?do=pages&id=".$id."&msg=1");           
   // }
}
else{
           
} ?>
<form action="test.php" method="POST" enctype="multipart/form-data">

    <input type="file" 
    class="form-control" 
    name="img[]" 
    multiple
    >
    <input type="submit" value="حفظ " class="form-control bg-primary text-white">

</form>

