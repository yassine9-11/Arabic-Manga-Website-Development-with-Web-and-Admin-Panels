<?php
ob_start();
session_start();
$page_title="Amura Cpanel | manga  ";


if (isset($_SESSION['adminID'])){
    include "init.php";

    $sql="SELECT * FROM manga_series ORDER BY MangaID DESC";
    $search=$con->prepare($sql);
    $search->execute();
    $rows=$search->fetchAll();

    $msgid=isset($_GET['msg'])? $_GET['msg']:'0';

    if($msgid==0){
        $msg='';
    }elseif($msgid==1){
        $msg="<div class='alert alert-warning'>
                 تم حذف المانجا بنجاح .
                  </div>";
    }
    elseif($msgid==2){
        $msg="<div class='alert alert-secondary'>
        مانجا غير موجودة بالفعل .
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
        $msg="<div class='alert alert-success'>
        تم إضافة المانجا بنجاح
        </div>";
    }
    elseif($msgid==6){
        $msg="<div class='alert alert-success'>
        تم تعديل المانجا بنجاح
        </div>";
    }
   



  

    
    ?>

    <div class="container ad_home d-flex">

        <div class="latest row m-auto">
            <div class="bloc manga_blc col-12" style="margin: 10px 0;">
                <div class="bloc-content">
                    <div class="blochead">
                        <h4>
                            جميع المانجات التي تم اضافتها
                        </h4>
                        <a class="add btn-bloc" href="ad_addmanga.php">
                         إضافة مانجا جديدية
                        <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="message">
                        <?php
                            echo $msg;
                            ?>
                    </div>

                    <div class="row">

                        <div class="message latestmanga col-12," style="margin:10px 0">



                           <div class="scrollme" style="overflow-x: auto;">
                            <table class="table-responsive" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>
                                            الصورة
                                        </td>
                                        <td>
                                            اسم المانجا
                                        </td>
                                        <td>
                                            المؤلف
                                        </td>
                                        <td>
                                            الكاتب
                                        </td>
                                        <td>
                                            الوصف
                                        </td>
                                        <td>
                                            التصنيف
                                        </td>
                                        <td>
                                            سنة الانتاج
                                        </td>
                                        <td>
                                            keywords
                                        </td>
                                        <td>
                                            الحالة
                                        </td>
                                        <td>
                                            التقييم
                                        </td>
                                        <td>
                                            المشاهدات
                                        </td>
                                        <td>
                                            عدد الفصول 
                                        </td>
                                        <td>
                                            الإ عدادات
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($rows){
                                        foreach($rows as $manga){
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo $img.$manga['CoverImageURL'] ?>" alt="">
                                            </td>
                                            <td>
                                                <div class="username">
                                                    <?php echo $manga['Title'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['Author'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['writer'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="" style="font-weight: 400; font-size: 11px;font-family: cursive;word-spacing: 3px;">
                                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                          <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo $manga['MangaID']?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                                                <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                                                <?php echo $manga['Description'] ?>
                                                                </span>
                                                            </button>
                                                          </h2>
                                                          <div id="flush-collapseOne<?php echo $manga['MangaID']?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <?php echo $manga['Description'] ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['Genre'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['year'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['keywords'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['PublicationStatus'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['rating'] ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <?php echo $manga['vues'] ?>
                                                </div>
                                            </td>
                                            <td>
                                            <?php
                                                     $sql1="SELECT * FROM `manga_chapter` WHERE MangaID=?";
                                                     $search1=$con->prepare($sql1);
                                                     $search1->execute(array($manga['MangaID']));
                                                     $chapters=$search1->fetchAll();
                                                    echo sizeof($chapters);?>
                                            </td>
                                            <td>
                                                <div class="controls" style="margin-right: auto;">
                                                   <a class="edit btn btn-secondary" href="ad_chapters.php?MangaID=<?php echo $manga['MangaID'];?>">
                                                        الفصول
                                                        <i class="fa fa-th-list"></i>
                                                    </a>
                                                    <a class="edit btn btn-success" href="ad_updatemanga.php?id=<?php echo $manga['MangaID'];?>">
                                                        تعديل
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="delete btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo "modal".$manga['MangaID'];?>">
                                                         حذف
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    

                                                </div>
                                                <!-- delete modal  -->
                                                <div class="modal" id="<?php echo "modal".$manga['MangaID'];?>">
                                                
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
                                                            هل انت متأكد من حذف هذه المانجا ؟
                                                        </div>
                                                
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <a href="ad_deletemanga.php?id=<?php echo $manga['MangaID'];?>" 
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
                                    }
                                    else{
                                        ?>
                                            <tr>
                                                <div class="alert alert-danger">
                                                    لا توجد اي مانجا أضف مانجا جديدة
                                                </div>
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
    </div>

    </div>
    <?php include $tpl."footer.php";
}
else{
    header('location:  ad_home.php');
    exit();
}
ob_end_flush(); ?>