<?php
ob_start();
session_start();
$page_title="Amura Cpanel |Update manga  ";


if (isset($_SESSION['adminID'])){
    include "init.php";
    $do=isset($_GET['do'])? $_GET['do']:'edit';
    $id=isset($_GET['id'])? $_GET['id']:'not';


    

    if($do=='edit'){
        if($id=='not'){
            header("location:ad_manga.php?msg=3");
        }
        else{

            $sql="SELECT * FROM manga_series  WHERE MangaID=? ";
            $search=$con->prepare($sql);
            $search->execute(array($id));
            $row=$search->fetch();  
            ?>
            <div class="container messages ad_home d-flex">
                <div class="latest row m-auto">
                    <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                        <div class="bloc-content">
                            <div class="blochead">
                                <h4>
                                    تعديل 
                                    <?php echo $row['Title']  ?>
                                </h4>
        
                            </div>
                            <div class="row">
                                <form action="ad_updatemanga.php?do=update" method="POST" class="addmanag" enctype="multipart/form-data">
                                    <table class=" table table-responsive">
                                        <tr>
                                            <td class="ky">
                                                الصورة الرئيسية :
                                                <span style="font-size: 9px;">
                                            (هي التي ستظهر كصورة غلاف للمانجا)
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
                                            <td class="ky">
                                                اسم المانجا :
                                            </td>
                                            <td class="val">
                                                <input type="text"
                                                       name="name" 
                                                       required="required" 
                                                       class="form-control" 
                                                       placeholder="أكتب اسم المانجا هنا"
                                                       value="<?php echo $row['Title'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ky">
                                                وصف المانجا :
                                            </td>
                                            <td class="val">
                                                <textarea class="form-control" 
                                                          name="desc" 
                                                          placeholder="اضف وصف المانجا هنا "
                                                          >
                                                          <?php echo $row['Description'] ?>
                                                        </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ky">
                                                اسم المؤلف :
                                            </td>
                                            <td class="val">
                                                <input type="text" 
                                                       name="autour" 
                                                       class="form-control" 
                                                       placeholder="أكتب اسم المؤلف هنا "
                                                       value="<?php echo $row['Author'] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ky">
                                                التصنيف :
                                            </td>
                                            <td class="val">
                                               <?php 
                                            $sql="SELECT * FROM `categories` ";
                                            $search=$con->prepare($sql);
                                            $search->execute();
                                            $rows=$search->fetchAll();
                                            
                                             ?>
                                            <select name="genre[]" multiple class="form-control">
                                                <?php 
                                                if(sizeof($rows)==0){?>
                                                    <option value="Updating"
                                                    
                                                    >
                                                            pas de categories !
                                                    </option>
                                                <?php
                                                }
                                                foreach($rows as $cat){ 
                                                    ?>
                                                     <option value="<?php echo $cat['CatName'] ?>"
                                                         <?php  echo (strpos($row['Genre'], $cat['CatName']))?"selected":""; ?>
                                                    > 
                                                        
                                                        <?php echo  $cat['CatName'] ?>
                                                    </option>
                                                    <?php
                                                }?>
                                            </select>
                                    </td>
                                        </tr>
                                        <tr>
                                            <td class="ky">
                                                سنة الانتاج :
                                            </td>
                                            <td class="val">
                                                <input type="text"
                                                        name="year" 
                                                        class="form-control" 
                                                        placeholde="اكتب سنة الانتاج هنا "
                                                        value="<?php echo $row['year'] ?>"
                                                        >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ky">
                                                التقييم :
                                                <span style="font-size: 9px;">
                                            (ريتما يتم تكميل الموقع )
                                            </span>
                                            </td>
                                            <td class="val">
                                                <input type="number"
                                                       step="0.5" 
                                                       lang='fr' 
                                                       name="rating"
                                                       value="<?php echo $row['rating'] ?>"
                                                       >
                                        </td>
                                        <tr>
                                            <td class="ky">
                                                المشاهدات :
                                                <span style="font-size: 9px;">
                                            (ريتما يتم تكميل الموقع )
                                            </span>
                                            </td>
                                            <td class="val">
                                                <input type="number" 
                                                       lang="fr" 
                                                       name="vues"
                                                       value="<?php echo $row['vues'] ?>"
                                                       >
                                        </td>
                                        <tr>
                                            <td class="ky">
                                                الكلمات المفتاحية :
                                                <span style="font-size: 9px;">
                                            (الكلمات المفتاحية للمانجا )
                                            </span>
                                            </td>
                                            <td class="val">
                                                <input type="text"  
                                                       name="keywords"
                                                       value="<?php echo $row['keywords'] ?>"
                                                    />
                                            </td>
                                        <tr>
                                            <td class="ky">
                                                الحالة :
                                            </td>
                                            <td class="val">
                                                <input type="radio"
                                                       name="status" 
                                                       value="Ongoing" 
                                                       id="ongo"
                                                       <?php echo 
                                                             $row['PublicationStatus']=='Ongoing'?
                                                             'checked':''; ?>
                                                        >

                                                <label for="ongo" style="color: #444; margin: 0 0 0 10px;">ongoing </label>
        
                                                <input type="radio"
                                                       name="status" 
                                                       value="Completed" 
                                                       id="compl"
                                                       <?php echo 
                                                             $row['PublicationStatus']=='Completed'?
                                                             'checked':''; ?>
                                                       >
                                                <label for="compl" style="color: #444;">Completed </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="" colspan="2">
                                                <input type="hidden" name='id' value="<?php echo $row['MangaID'] ?>">
                                                <input type="submit" value="حفظ " class="form-control bg-success text-white">
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
        }
        include $tpl."footer.php";
    }elseif($do=='update'){
        if($_SERVER['REQUEST_METHOD']=='POST'){


            //update photo ;

           
            if(!($_FILES['img']['tmp_name'][0]=='')){
                 //get url for img :
                $sql1="SELECT MangaID,CoverImageURL FROM  `manga_series` WHERE  `manga_series`.`MangaID` = ?"; 
                $search1=$con->prepare($sql1);
                $search1->execute(array(
                                 $_POST['id']
                                 ));
                $mangaIMG=$search1->fetch();

                $pathIMG = "../media/images/";
                $pathIMGold = "../media/images/".$mangaIMG['CoverImageURL'];

                /*if (file_exists($pathIMGold)&&(!$mangaIMG['CoverImageURL']=='manga_default.jpg')) {
                    unlink($pathIMGold);
                }*/
                $imagname="manga_".$_POST['id'];
                move_uploaded_file($_FILES['img']['tmp_name'][0], $pathIMG.$imagname.".jpg");
            
                $img="manga_".$_POST['id'].".jpg";
    
                $sql = "UPDATE `manga_series` SET   `CoverImageURL`=? WHERE `manga_series`.`MangaID` =?";
                $stmt= $con->prepare($sql);
                $stmt->execute(array( $img,$_POST['id']));
            }

            $sql="UPDATE `manga_series` SET `Title` = ?,
                `Author` = ?, `Description` = ?, `Genre` = ?,
                `year` = ?,`keywords`=?, `rating` = ?, `vues` = ?,
                `PublicationStatus` = ? WHERE `manga_series`.`MangaID` = ?"; 
            $search=$con->prepare($sql);
            $genre="";
            foreach($_POST['genre'] as $g){
                $genre .= ",".$g;
            }
            $search->execute(array(
                             $_POST['name'],
                             $_POST['autour'],
                             $_POST['desc'],
                             $genre,
                             $_POST['year'],
                             $_POST['keywords'],
                             $_POST['rating'],
                             $_POST['vues'],
                             $_POST['status'],
                             $_POST['id']
                             ));
            if($search->rowCount()>0){
              
                header("location:ad_manga.php?msg=6");
            }else{
                header("location:ad_manga.php?msg=4");
            }
        }
        else{
            header("location:ad_manga.php?msg=4");
        }
        
    } 
}
else{
    header('location:  index.php');
    exit();
}
ob_end_flush(); ?>