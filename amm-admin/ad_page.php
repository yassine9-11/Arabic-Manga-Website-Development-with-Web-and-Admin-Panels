<?php
ob_start();
session_start();
$page_title="Amura Cpanel | users  ";



if (isset($_SESSION['adminID'])){ 
    include "init.php";

    $img=isset($_GET['img'])? $_GET['img']:'';
    ?>
    <div class="container ad_page" style="    padding: 20px 0;margin: 10px auto;border: 1px solid tomato;">
        <img src="<?php echo $img ?>" alt="" style="width: 100%;height: auto;object-fit:contain;">
    </div>   
    <?php
    include $tpl."footer.php";

}else{
header('location:  index.php');
exit();
}
ob_end_flush(); ?>

