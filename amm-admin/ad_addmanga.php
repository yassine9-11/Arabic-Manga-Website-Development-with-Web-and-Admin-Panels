<?php
ob_start();
session_start();
$page_title="Amura Cpanel |add manga  ";


if (isset($_SESSION['adminID'])){
    include "init.php";
    $do=isset($_GET['do'])? $_GET['do']:'add';

    if($do=='add'){?>
    <div class="container messages ad_home d-flex">

        <div class="latest row m-auto">
            <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                <div class="bloc-content">
                    <div class="blochead">
                        <h4>
                            إضافة مانجا جديدية
                        </h4>

                    </div>


                    <div class="row">
                        <form action="ad_addmanga.php?do=insert" method="POST" class="addmanag"enctype="multipart/form-data">
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
                                        <input type="text" name="name" required="required" class="form-control" placeholder="أكتب اسم المانجا هنا ">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ky">
                                        وصف المانجا :
                                    </td>
                                    <td class="val">
                                        <textarea class="form-control" name="desc" placeholder="اضف وصف المانجا هنا "></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ky">
                                        اسم المؤلف :
                                    </td>
                                    <td class="val">
                                        <input type="text" name="autour" class="form-control" placeholder="أكتب اسم المؤلف هنا ">
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
                                                    <option value="Updating">
                                                            pas de categories !
                                                    </option>
                                                <?php
                                                }
                                                foreach($rows as $cat){ 
                                                    ?>
                                                     <option value="<?php echo $cat['CatName'] ?>"
                                                             
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
                                        <input type="text" name="year" class="form-control" placeholde="اكتب سنة الانتاج هنا ">
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
                                        <input type="number" step="0.5" lang='fr' name="rating">
                                </td>
                                <tr>
                                    <td class="ky">
                                        المشاهدات :
                                        <span style="font-size: 9px;">
                                    (ريتما يتم تكميل الموقع )
                                    </span>
                                    </td>
                                    <td class="val">
                                        <input type="number" lang="fr" name="vues">
                                </td>
                                <tr>
                                    <td class="ky">
                                        الكلمات المفتاحية :
                                        <span style="font-size: 9px;">
                                    (الكلمات المفتاحية للمانجا )
                                    </span>
                                    </td>
                                    <td class="val">
                                        <input type="text"  name="keywords">
                                </td>
                                <tr>
                                    <td class="ky">
                                        الحالة :
                                    </td>
                                    <td class="val">
                                        <input type="radio" name="status" checked value="Ongoing" id="ongo">
                                        <label for="ongo" style="color: #444; margin: 0 0 0 10px;">ongoing </label>

                                        <input type="radio" name="status" value="Ongoing" id="compl">
                                        <label for="compl" style="color: #444;">complete </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2">
                                        <input type="submit" value="التالي  " class="form-control bg-success text-white">
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
        include $tpl."footer.php";
    }elseif($do=='insert'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // upload fich and photo :
            // $pathIMG = "C:\\xampp\htdocs\Amuramanga\media\images";

            $pathIMG = "../media/images/";
            
            if (!file_exists($pathIMG)) 
            {
            mkdir($pathIMG, 0777, true);  //0777 sont les droits (lecture écriture et execution)
            }

            //get max id 
            $sql="SELECT * FROM manga_series WHERE MangaID= (SELECT MAX(MangaID) FROM manga_series); ";
            $search=$con->prepare($sql);
            $search->execute();
            $row=$search->fetch();

            $imgnumber=$row['MangaID']+1;
            $imagname="manga_".$imgnumber;
            move_uploaded_file($_FILES['img']['tmp_name'][0], $pathIMG.$imagname.".jpg");

            if(!($_FILES['img']['tmp_name'][0]=='')){
                $img=$imagname.".jpg";
            }else{
                $img='manga_default.jpg';
            }
            $sql="INSERT INTO `manga_series` 
                 (`Title`,`Author`,`writer`,`Description`,`Genre`,`year`,`keywords`, `CoverImageURL`, `PublicationStatus`,`rating`,`vues`)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ? , ?, ?,? )";
            $search=$con->prepare($sql);
            $genre="";
            foreach($_POST['genre'] as $g){
                $genre .= ",".$g;
            }
            $search->execute(array(
                             $_POST['name'],
                             $_POST['autour'],
                             $_SESSION['adminName'],
                             $_POST['desc'],
                             $genre,
                             $_POST['year'],
                             $_POST['keywords'],
                             $img,
                             $_POST['status'],
                             $_POST['rating'],
                             $_POST['vues']
                             ));
            if($search->rowCount()>0){
                header("location:ad_addmanga.php?do=addchapter");
            }
        }
        else{
            header("location:ad_manga.php?msg=4");
        }
        
    }elseif($do=='addchapter'){
        $sql="SELECT * FROM manga_series WHERE MangaID= (SELECT MAX(MangaID) FROM manga_series); ";
        $search=$con->prepare($sql);
        $search->execute();
        $row=$search->fetch();
        ?>
        <div class="container messages ad_home d-flex">

            <div class="latest row m-auto">
                <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                    <div class="bloc-content">
                        <div class="blochead">
                            <h4>
                                إضافة مانجا جديدية
                            </h4>

                        </div>
                        <div class="alert alert-success">
                            تم إضافة المانجا . الان يمكنك إضافة الفصول
                        </div>


                        <div class="row">

                            <div class="addedmanga">
                                <img src="<?php echo $img.$row['CoverImageURL'] ; ?>" alt="img ">
                                <h3 class="mangatitle"><?php echo $row['Title']?></h3>
                            </div>
                            <form action="" class="addmanag">
                                <table class="ad2 table table-responsive">

                                    <tr class="d-flex justify-content-center">
                                        <td class="">
                                            <a href="ad_chapters.php?do=add&id=<?php echo $row['MangaID'] ?>" class="btn  btn-primary text-light">
                                             إضافة فصل   جديد
                                            </a>
                                        </td>
                                        <td class="">
                                            <a href="ad_manga.php?msg=5" class="btn btn-warning text-dark">
                                                 عودة إلى القائمة  
                                             </a>
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
    
}
else{
    header('location:  index.php');
    exit();
}
ob_end_flush(); ?>