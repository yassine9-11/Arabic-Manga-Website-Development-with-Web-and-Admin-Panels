<?php
ob_start();
session_start();
$page_title="Amura Cpanel | users  ";



if (isset($_SESSION['adminID'])){ 
    include "init.php";

    $do=isset($_GET['do'])? $_GET['do']:'manage';
    


    if($do=='manage'){

        $MangaID=isset($_GET['MangaID'])? $_GET['MangaID']:'not';
        if($MangaID=='not'){
            $sql="SELECT * FROM `manga_chapter` ";
            $search=$con->prepare($sql);
            $search->execute();
        }
        else{
            $sql="SELECT * FROM `manga_chapter` WHERE MangaID=? ";
            $search=$con->prepare($sql);
            $search->execute(array(
                $MangaID
            )); 
        }
        
        $rows=$search->fetchAll();


        

        $msgid=isset($_GET['msg'])? $_GET['msg']:'0';
        

        if($msgid==0){
            $msg='';
        }elseif($msgid==1){
            $msg="<div class='alert alert-success'>
                     تم إضافة الفصل بنجاح .
                      </div>";
        }
        elseif($msgid==2){
            $msg="<div class='alert alert-success'>
            تم تعديل معلومات الفصل بنجاح.
             </div>";
        } elseif($msgid==3){
            $msg="<div class='alert alert-danger'>
            لم يتم العثور على اي شيء .
            </div>";
        }
        elseif($msgid==4){
            $msg="<div class='alert alert-danger'>
            حدث خطأ  !
            </div>";
        }
        elseif($msgid==5){
            $msg="<div class='alert alert-warning'>
            تم حذف الفصل بنجاح .
            </div>";

        }
        elseif($msgid==6){
            $msg="<div class='alert alert-success'>
            قبل إضافة الفصول يجب عليك إضافة المانجا .
            إضافة مانجا 
            <a href='ad_addmanga.php'>من هنا </a>
            </div>";
        }
       
    
        ?>
        <div class="container messages ad_home d-flex">
          <div class="latest row m-auto">
            <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                <div class="bloc-content">
                    <div class="blochead">
                        <h4>
                            جميع الفصول المضافة 
                        </h4>
                        <a href="ad_chapters.php?do=add&id=<?php echo $MangaID ?>"class="add btn-bloc">
                            إضافة فصل جديد
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>

                    <div class="msg">
                        <?php 
                        echo $msg;
                        if(!$rows){
                            ?>
                                <div class="alert alert-danger">
                                    لا يوجد اي فصل ؟ يمكنك البدأ في اضافة الفصول .
                                </div>
                            <?php
                        }
                        ?>
                    </div>


                    <div class="row">

                        <div class="message latestmanga col-12," style="margin:10px 0">

                            <table class="table-responsive" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td colspan="2">
                                            المانجا 
                                        </td>
            
                                        <td>
                                            رقم الفصل 
                                        </td>

                                        <td>
                                         عنوان الفصل 
                                        </td>
                                        <td>
                                            تاريخ النشر 
                                        </td>
                                        <td >
                                            عدد الصور 
                                        </td>
                                        <td>
                                            الإ عدادات
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($rows as $chapter){
                                        $mangainfo="SELECT * FROM manga_series WHERE MangaID=?";
                                        $search1=$con->prepare($mangainfo);
                                        $search1->execute(array($chapter['MangaID']));
                                        $manga=$search1->fetch();
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="
                                                          <?php  
                                                          $manga_photo=isset($manga['CoverImageURL'])?$manga['CoverImageURL']:'user_default.jpg';
                                                          echo $img.$manga_photo;
                                                          ?>" 
                                                     alt="">
                                            </td>
                                            <td>
                                                <div class="username">
                                                    <?php echo $manga['Title']  ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="username">
                                                    <?php echo $chapter['ChapterNumber']  ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="email">
                                                    <?php echo $chapter['Title']  ?>
                                                </div>
                                            </td>
                                            <td>
                                                 <?php echo $chapter['ReleaseDate']  ?>
                                            </td>
        
                                            <td>
                                                <div class="username">
                                                    <?php
                                                     $sql1="SELECT * FROM `manga_page` WHERE ChapterID=?";
                                                     $search1=$con->prepare($sql1);
                                                     $search1->execute(array($chapter['ChapterID']));
                                                     $pages=$search1->fetchAll();
                                                    echo sizeof($pages);?>
                                                   
                                                </div>
                                            </td>
                                            <td>
                                                <div class="controls">
                                                    <a href="ad_chapters.php?do=insertoption&id=<?php echo $chapter['ChapterID'] ?>"
                                                       class="btn btn-secondary">
                                                        إضافة 
                                                        <i class="fa fa-add"></i>
                                                    </a>
                                                    <a href="ad_chapters.php?do=pages&id=<?php echo $chapter['ChapterID'] ?>"
                                                       class="btn btn-success">
                                                        عرض 
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="ad_chapters.php?do=edit&id=<?php echo $chapter['ChapterID'] ?>"
                                                       class=" btn btn-primary">
                                                        تعديل
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo "modal".$chapter['ChapterID'];?>">
                                                         حذف
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    
        
                                                </div>
                                                <!-- delete modal  -->
                                                <div class="modal" id="<?php echo "modal".$chapter['ChapterID'];?>">

                                                 <div class="modal-dialog">
                                                    <div class="modal-content">
                                                
                                                        <!-- Modal Header -->
                                                        <div class="modal-header d-flex">
                                                            <h4 class="modal-title">
                                                                تأكيد الحذف
                                                            </h4>
                                                        </div>
                                                
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            هل انت متأكد من حذف 
                                                            <b>
                                                            الفصل 
                                                            <?php echo $chapter['ChapterNumber'];?>
                                                            [<?php echo $chapter['Title'];?> ]
                                                            </b>
                                                            ؟
                                                        </div>
                                                
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <a href="ad_chapters.php?do=deletechap&id=<?php echo $chapter['ChapterID'] ?>"
                                                               class="btn btn-danger">
                                                                حذف 
                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                              تراجع 
                                                            </button>
                                                        </div>
                                                
                                                    </div>
                                                 </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

          </div>
        </div>

      
        <?php
    }elseif($do=='add'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        

         ?>
        <div class="container messages ad_home d-flex">
    
             <div class="latest row m-auto">
                 <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                     <div class="bloc-content">
                         <div class="blochead">
                             <h4>
                                 تحميل فصل جديد
                             </h4>

                             <a href="ad_chapters.php" class="btn btn-secondary">
                             <i class="fa fa-arrow-right"></i>
                                عودة
                             </a>
                         </div>


                         <div class="row">
                             <form action="ad_chapters.php?do=insertchap" method="POST" class="addmanag"enctype="multipart/form-data">
                                 <table class=" table table-responsive">
                                  
                                     <tr>
                                         <td class="ky">
                                             المانجا 
                                             <span style="font-size: 9px;">
                                             (المانجا التي ستضيف فيها الفصل )   
                                             </span> :
                                         </td>
                                         <td class="val">
                                            <?php 
                                            $sql="SELECT Title,MangaID FROM `manga_series` ";
                                            $search=$con->prepare($sql);
                                            $search->execute();
                                            $rows=$search->fetchAll();
                                            if(sizeof($rows)==0){
                                                header("location:ad_chapters.php?msg=6");

                                            }
                                             ?>
                                            <select name="manga" class="form-control">
                                                <?php 
                                                foreach($rows as $manga){ 
                                                    ?>
                                                     <option value="<?php echo $manga['MangaID'] ?>"
                                                            <?php 
                                                             echo ($manga['MangaID']==$id)?
                                                            "selected":""; ?> 
                                                            > 
                                                        
                                                        <?php echo $manga['Title'] ?>
                                                    </option>
                                                    <?php
                                                }?>
                                            </select>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                             رقم الفصل :
                                         </td>
                                         <td class="val">
                                             <input type="number" name="chapter_number" class="form-control" placeholder="الرقم الترتيبي للفصل ">
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="ky">
                                          عنوان الفصل  :
                                         </td>
                                         <td class="val">
                                             <input type="text" name="chapter_title" class="form-control" placeholder="عنوان الفصل ">
                                         </td>
                                     </tr>
                                     
                                 
                                     <tr>
                                         <td class="" colspan="2">
                                             <input type="submit" value="إضافة الفصل" class="form-control bg-primary text-white">
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
    }elseif($do=='insertchap'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
            $sql="INSERT INTO `manga_chapter` 
                 ( `MangaID`, `ChapterNumber`, `Title`, `ReleaseDate`)
                 VALUES (?, ?, ?, now())";
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['manga'],
                             $_POST['chapter_number'],
                             $_POST['chapter_title']
                             ));
            if($search->rowCount()>0){
                // get max id :
                $sql2="SELECT * FROM `manga_chapter`  WHERE ChapterID= (SELECT MAX(ChapterID) FROM manga_chapter); ";
                $search1=$con->prepare($sql2);
                $search1->execute();
                $row=$search1->fetch();
                $id=$row['ChapterID'];
               header("location:ad_chapters.php?do=pages&msg=1&id=".$id);
            }
        }
        else{

            header("location:ad_chapters.php?do=manage&msg=4");
        }
    
    }elseif($do=='addpage'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }


        $sql1="SELECT MAX(PageNumber) FROM manga_page WHERE ChapterID=?; ";
        $search1=$con->prepare($sql1);
        $search1->execute(array($id));
        $row1=$search1->fetch();
        
        $i=$row1['MAX(PageNumber)']+1;

        ?>
        <div class="container messages ad_home d-flex">
   
            <div class="latest row m-auto">
                <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                    <div class="bloc-content">
                        <div class="blochead">
                            <h4>
                              تحميل صورة جديدة
                            </h4>

                            <a href="ad_chapters.php" class="btn btn-secondary">
                            <i class="fa fa-arrow-right"></i>
                               عودة
                            </a>
                        </div>


                        <div class="row">
                            <form action="ad_chapters.php?do=insertpage" method="POST" class="addmanag"enctype="multipart/form-data">
                                <table class=" table table-responsive">
                                 
                                    <tr>
                                        <td class="ky">
                                            الرقم الترتيبي للصورة :
                                            <span style="font-size: 9px;">
                                            
                                            </span>
                                        </td>
                                        <td class="val">
                                           <input type="number" class="form-control" value="<?php echo $i ?>"  name="number">
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="ky" style="display: flex;align-items: center; justify-content: center;">
                                            الصورة :
                                            <span style="font-size: 9px;display: inline-block;width: 150px;">
                                            (الصور يجب ان تكون مركبة في صورة واحدة على شكل عمودي و مرتب )
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
                                        <td class="" colspan="2">
                                            <input type="hidden" value="<?php echo $id ?>" name="id">
                                            <input type="submit" value="حفظ " class="form-control bg-primary text-white">
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
    }elseif($do=='insertpage'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //upload manga file :
            $pathIMG = "../media/images/";
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
            $imagname="page_".$imgnumber;
            move_uploaded_file($_FILES['img']['tmp_name'][0], $pathIMG.$imagname.".jpg");

            if(!($_FILES['img']['tmp_name'][0]=='')){
                $img=$imagname.".jpg";
            }else{
                $img='page_default.jpg';
            }
            
            $sql="INSERT INTO `manga_page` 
                  ( `ChapterID`, `PageNumber`, `ImageURL`)
                 VALUES (?, ?, ?)";
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['id'],
                             $_POST['number'],
                             $img
                             ));
            if($search->rowCount()>0){
                $id=$_POST['id'];
               header("location:ad_chapters.php?do=pages&id=".$id."&msg=1");           
            }
        }
        else{
           header("location:ad_chapters.php?msg=3");           
        }
    
    }elseif($do=='insertoption'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }
        ?>
       <div class="option container m-5">
        <p>
            اختر طريقة رفع الصور .
        </p>
        <div style="display: flex; flex-direction: column;">
            <a href="ad_chapters.php?do=addpage&id=<?php echo $id; ?>" class="inserta">
                رفع صورة بصورة 
            </a>
            <a href="ad_chapters.php?do=addmultiplepage&id=<?php echo $id; ?>" class="inserta">
                رفع جميع الصور دفعة واحدة 
            </a>
        </div>
       </div>
      <?php     
    }elseif($do=='insertmultilepage'){
        if($_SERVER['REQUEST_METHOD']=='POST'){

            //upload manga file :
            $pathIMG = "../media/images/";
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

            $sql1="SELECT MAX(PageNumber) FROM manga_page WHERE ChapterID=?; ";
            $search1=$con->prepare($sql1);
            $search1->execute(array($_POST['id']));
            $row1=$search1->fetch();

            $i=$row1['MAX(PageNumber)']+1;
           


            foreach($_FILES['img']['tmp_name'] as $page){
               
                //store img in media :
                $imagname="page_".$imgnumber;
                move_uploaded_file($page, $pathIMG.$imagname.".jpg");

                //store pagr url in db :
                if(!($page=='')){
                    $img=$imagname.".jpg";
                }else{
                    $img='page_default.jpg';
                }

                $sql="INSERT INTO `manga_page` 
                  ( `ChapterID`, `PageNumber`, `ImageURL`)
                 VALUES (?, ?, ?)";
                $search=$con->prepare($sql);
                $search->execute(array(
                                 $_POST['id'],
                                 $i,
                                 $img
                                 ));

                                 
                if($search->rowCount()>0){
                    $err=false;    
                }else{
                    $err=true;  
                    $errmsg="there is error"; 
                }
    
                $imgnumber++;
                $i++;
            }

            //error handling
            if($err){
                echo $errmsg;
            }
            else{
                $id=$_POST['id'];
                header("location:ad_chapters.php?do=pages&id=".$id."&msg=1"); 
            }

        }
        else{
           header("location:ad_chapters.php?msg=3");           
        }
    
    }elseif($do=='addmultiplepage'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }
        ?>
        <div class="container messages ad_home d-flex">
   
            <div class="latest row m-auto">
                <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                    <div class="bloc-content">
                        <div class="blochead">
                            <h4>
                                حمل الصور دفعة واحدة 
                            </h4>

                            <a href="ad_chapters.php" class="btn btn-secondary">
                            <i class="fa fa-arrow-right"></i>
                               عودة
                            </a>
                        </div>


                        <div class="row">
                            <form action="ad_chapters.php?do=insertmultilepage" id="upload-frm" method="POST" class="addmanag"enctype="multipart/form-data">
                                <table class=" table table-responsive">
                                 
                                    <tr >
                                        <td class="ky" style="display: flex;align-items: center; justify-content: center;">
                                            الصورة :
                                            <span style="font-size: 9px;display: inline-block;width: 150px;">
                                            (الصور يجب يتم اختيارها بشكل مرتب )
                                            </span>
                                        </td>
                                        <td class="val">
                                        <input type="file"
                                                    required='required' 
                                                    class="form-control" 
                                                    name="img[]" 
                                                    multiple
                                                    >
                                        </td>
                                    </tr>
                                   
                                    
                                
                                    <tr>
                                        <td class="" colspan="2">
                                            <input type="hidden" value="<?php echo $id ?>" name="id">
                                            <input type="submit" value="حفظ " class="form-control bg-primary text-white">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                        <div class="progr">
                                        <div class="progress" dir='ltr'>
                                          <div class="progress-bar bg-warning" id="prog-bar" style="width:70%" ></div>
                                        </div> 
    
                                            <div id='progress-bar'>
                                            
                                            </div>
                                        </div>
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
    }elseif($do=='pages'){ 

        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }
        $sql="SELECT * FROM `manga_page` WHERE ChapterID=?";
        $search=$con->prepare($sql);
        $search->execute(array($id));
        $row=$search->fetchAll();

        $msgid=isset($_GET['msg'])? $_GET['msg']:'0';
        $msg='';
        if($msgid==0){
            $msg='';
        }elseif($msgid==1){
            $msg="<div class='alert alert-success'>
                     تم إضافة الفصل بنجاح . الان قم باضافة الصور .
                </div>";
        }
        elseif($msgid==2){
            $msg="<div class='alert alert-success'>
                    تم إصافة الصورة بنجاح .
                </div>";
        }
        elseif($msgid==2){
            $msg="<div class='alert alert-success'>
                    تم تعديل الصورة بنجاح .
                </div>";
        }
        elseif($msgid==3){
            $msg="<div class='alert alert-danger'>
                    حدث خطأ 
                </div>";
        }
        elseif($msgid==4){
            $msg="<div class='alert alert-danger'>
                    حدث خطأ 
                </div>";
        }elseif($msgid==5){
            $msg="<div class='alert alert-warning'>
                    تم حذف الصورة بنجاح .
                </div>";
        }

        ?>
        <div class="manga_photos">
            <div class="row container m-auto">
                <div class="blochead">
                        
                        <a href="ad_chapters.php?do=insertoption&id=<?php echo $id ?>"
                           class="add btn-bloc"
                           style="width: 200px; text-align: center;">
                            إضافة صورة جديد
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="ad_chapters.php" class="btn btn-secondary" >
                        <i class="fa fa-arrow-right"></i>
                           عودة
                        </a>
                </div>
                
                
                <div class="msge" style="margin: 2px 0;">
                    <?php
                    echo $msg;
                    ?>
                </div>
                <?php 
                foreach($row as $photo){
                ?>
                <div class="col-12">
                    <div class="manga_photo">
                       <a href="<?php echo $img.$photo['ImageURL'] ?>"class="img_title">
                           الصورة رقم 
                           <?php echo $photo['PageNumber'] ?>
                       </a>
                       <div class="">
                            <a href="ad_page.php?img=<?php echo $img.$photo['ImageURL'] ?>"
                               class=" btn btn-secondary">
                                عرض الصورة
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="ad_chapters.php?do=editpage&id=<?php echo $photo['PageID'] ?>&idchap=<?php echo $id ?>"
                               class=" btn btn-primary">
                                تغيير الصورة
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo "modalpage".$photo['PageID'];?>">
                                 حذف
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <!-- delete modal  -->
                        <div class="modal" id="<?php echo "modalpage".$photo['PageID'];?>">
                            
                            <div class="modal-dialog">
                               <div class="modal-content">
                            
                                   <!-- Modal Header -->
                                   <div class="modal-header d-flex">
                                       <h4 class="modal-title">
                                           تأكيد الحذف
                                       </h4>
                                   </div>
                            
                                   <!-- Modal body -->
                                   <div class="modal-body">
                                       هل انت متأكد من حذف 
                                       <b>
                                       الصورة رقم 
                                       <?php echo $photo['PageNumber'];?>
                                       </b>
                                       ؟
                                   </div>
                            
                                   <!-- Modal footer -->
                                   <div class="modal-footer">
                                       <a href="ad_chapters.php?do=deletepage&id=<?php echo $photo['PageID'] ?>&idchap=<?php echo $id ?>"
                                          class="btn btn-danger">
                                           حذف 
                                       </a>
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                         تراجع 
                                       </button>
                                   </div>
                            
                               </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php  } ?>
            </div>
        </div>
        <?php
    }elseif($do=='editpage'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        $idchap=isset($_GET['idchap'])? $_GET['idchap']:'not';
        if($id=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }
        if($idchap=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }
        $sql="SELECT * FROM `manga_page`  WHERE PageID=?";
        $search=$con->prepare($sql);
        $search->execute(array($id));
        $page=$search->fetch();
        ?>
        <div class="container messages ad_home d-flex">
   
            <div class="latest row m-auto">
                <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                    <div class="bloc-content">
                        <div class="blochead">
                            <h4>
                                تعديل الصورة 
                            </h4>

                            <a href="ad_chapters.php?do=pages" class="btn btn-secondary">
                            <i class="fa fa-arrow-right"></i>
                               عودة
                            </a>
                        </div>


                        <div class="row">
                            <form action="ad_chapters.php?do=updatepage" method="POST" class="addmanag"enctype="multipart/form-data">
                                <table class=" table table-responsive">
                                 
                                    <tr>
                                        <td class="ky">
                                            الرقم الترتيبي للصورة :
                                            <span style="font-size: 9px;">
                                            
                                            </span>
                                        </td>
                                        <td class="val">
                                           <input type="number" 
                                                  class="form-control"  
                                                  name="number"
                                                  value="<?php echo $page['PageNumber'] ?>"
                                                  >
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="ky" style="display: flex;align-items: center; justify-content: center;">
                                            تغيير الصورة :
                                            <span style="font-size: 9px;display: inline-block;width: 150px;">
                                            ( في حالة اردت تغيير الصورة قم بتحميل الصورة الجديدة و سيتم  استبدالها بالقديمة )
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
                                        <td class="" colspan="2">
                                            <input type="hidden" value="<?php echo $idchap ?>" name="idchap">
                                            <input type="hidden" value="<?php echo $id ?>" name="id">
                                            <input type="submit" value="حفظ " class="form-control bg-primary text-white">
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
    }elseif($do=='updatepage'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //update photo ;
            $changedimg="0";
            if(!($_FILES['img']['tmp_name'][0]=='')){
                //get url for img :
                $sql1="SELECT `PageID`,`ImageURL` FROM  `manga_page` 
                       WHERE  `manga_page`.`PageID` = ?"; 
                $search1=$con->prepare($sql1);
                $search1->execute(array(
                                 $_POST['id']
                                 ));
                $mangaIMG=$search1->fetch();

                $pathIMG = "../media/images/";
                $pathIMGold = "../media/images/user_".$mangaIMG['ImageURL'];

                if (file_exists($pathIMGold)&&(!$mangaIMG['ImageURL']=='page_default.jpg')) {
                    unlink($pathIMGold);
                }
                $imagname="page_".$_POST['id'];
                move_uploaded_file($_FILES['img']['tmp_name'][0], $pathIMG.$imagname.".jpg");
                //move_uploaded_file($_FILES['img']['tmp_name'][0], $pathIMG."\\page_".$_POST['id'].".jpg");
                $img="page_".$_POST['id'].".jpg";
    
                $sql = "UPDATE `manga_page` SET `ImageURL` = ? WHERE `PageID` = ?";
                $stmt= $con->prepare($sql);
                $stmt->execute(array($img,$_POST['id']));
                $changedimg="1";
            }

            $sql="UPDATE `manga_page` SET `PageNumber` = ? 
                  WHERE `PageID` = ? ";
            $search=$con->prepare($sql);
            $search->execute(array(
                             $_POST['number'],
                             $_POST['id']
                             ));
            if($search->rowCount()>0||$changedimg=="1"){
              
                header("location:ad_chapters.php?do=pages&msg=3&id=".$_POST['idchap']);
            }else{
                header("location:ad_chapters.php?do=pages&msg=4&id=".$_POST['idchap']);
            }
        }
        else{
            header("location:ad_chapters.php?msg=4");
        }
    }elseif($do=='edit'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=='not'){
            header("location:ad_chapters.php?msg=3");
            exit();
        }
        $sql="SELECT * FROM `manga_chapter`  WHERE ChapterID=?";
        $search=$con->prepare($sql);
        $search->execute(array($id));
        $chapter=$search->fetch();
        ?>
        <div class="container messages ad_home d-flex">
    
       <div class="latest row m-auto">
           <div class="bloc manga_blc col-12" style="margin: 10px 0;">
               <div class="bloc-content">
                    <div class="blochead">
                        <h4>
                            تعديل معلومات الفصل 
                            <?php echo $chapter['ChapterNumber']; ?>
                            [ <?php echo $chapter['Title'];?>]
                        </h4>
    
                        <a href="ad_chapters.php" class="btn btn-secondary">
                        <i class="fa fa-arrow-right"></i>
                           عودة
                        </a>
                    </div>
    
    
                    <div class="row">
                        <form action="ad_chapters.php?do=updatechap" method="POST" class="addmanag"enctype="multipart/form-data">
                            <table class=" table table-responsive">
                             
                                <tr>
                                    <td class="ky">
                                        المانجا 
                                        <span style="font-size: 9px;">
                                 
                                        </span> :
                                    </td>
                                    <td class="val">
                                       <?php 
                                       $sql="SELECT Title,MangaID FROM `manga_series` ";
                                       $search=$con->prepare($sql);
                                       $search->execute();
                                       $rows=$search->fetchAll();
                                        ?>
                                       <select name="manga">
                                           <?php 
                                           foreach($rows as $manga){ 
                                               ?>
                                               <option value="<?php echo $manga['MangaID'] ?>"
                                                       <?php echo ($manga['MangaID']==$chapter['MangaID'])?
                                                       "selected":""; ?> >
                                                   <?php echo $manga['Title'] ?>
                                               </option>
                                               <?php
                                           }?>
                                       </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ky">
                                        رقم الفصل :
                                    </td>
                                    <td class="val">
                                        <input type="number" 
                                               name="chapter_number" 
                                               class="form-control" 
                                               placeholder="الرقم الترتيبي للفصل "
                                               value="<?php echo $chapter['ChapterNumber'] ?>"
                                               >
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ky">
                                     عنوان الفصل  :
                                    </td>
                                    <td class="val">
                                        <input type="text" 
                                               name="chapter_title" 
                                               class="form-control" 
                                               placeholder="عنوان الفصل "
                                               value="<?php echo $chapter['Title'] ?>"
                                               >
                                    </td>
                                </tr>
                                
                            
                                <tr>
                                    <td class="" colspan="2">
                                        <input type="hidden" name="id" value="<?php echo $chapter['ChapterID'] ?>">
                                        <input type="submit" value="إضافة الفصل" class="form-control bg-primary text-white">
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

    }elseif($do=='updatechap'){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
            $sql="UPDATE `manga_chapter` SET 
                 `MangaID` = ?, `ChapterNumber` = ?, `Title` = ? 
                WHERE `manga_chapter`.`ChapterID` = ?"; 
            $search=$con->prepare($sql);
            $search->execute(array(
                            $_POST['manga'],
                            $_POST['chapter_number'],
                            $_POST['chapter_title'],
                            $_POST['id']
                            ));
            if($search->rowCount()>0){
              
                header("location:ad_chapters.php?do=manage&msg=2");
            }else{
                header("location:ad_chapters.php?do=manage&msg=4");
            }
        }
        else{
            header("location:ad_chapters.php?do=manage&msg=4");
        }
    }elseif($do=='deletechap'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        if($id=="not"){
            header("location:ad_chapters.php?msg=3");
            exit();
        }
        
        $sql=" DELETE FROM manga_chapter WHERE `manga_chapter`.`ChapterID` = ?";
        $search=$con->prepare($sql);
        $search->execute(array($id));

        if($search->rowCount()>0){
            header("location:ad_chapters.php?msg=5"); 
        }
        else{
            header("location:ad_chapters.php?msg=4");
        }
    }elseif($do=='deletepage'){
        $id=isset($_GET['id'])? $_GET['id']:'not';
        $idchap=isset($_GET['idchap'])? $_GET['idchap']:'not';
        if($id=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }
        if($idchap=='not'){
            header("location:ad_chapters.php?do=manage&msg=3");
            exit();
        }

        //get urlimg to delete also :
        $sql1=" SELECT * FROM manga_page WHERE `manga_page`.`PageID` = ? ";
        $search1=$con->prepare($sql1);
        $search1->execute(array($id));
        $row=$search1->fetch();
        
        $sql=" DELETE FROM manga_page WHERE `manga_page`.`PageID` = ? ";
        $search=$con->prepare($sql);
        $search->execute(array($id));

        if($search->rowCount()>0){
             
            if($row['ImageURL']=='page_default.jpg'){
                header("location:ad_chapters.php?do=pages&msg=5&id=".$idchap);
            }
            else{
                $imageURL= "..\media\images\\".$row['ImageURL'];
                unlink($imageURL);
                header("location:ad_chapters.php?do=pages&msg=5&id=".$idchap);
            }
        }
        else{
            header("location:ad_chapters.php?do=pages&msg=4&id=".$idchap);
        }
    }

    
        ?>


        <?php include $tpl."footer.php";

}else{
header('location:  index.php');
exit();
}
ob_end_flush(); ?>

