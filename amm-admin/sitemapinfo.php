<?php
ob_start();
session_start();
$page_title="Amura Cpanel | site map  ";

if (isset($_SESSION['adminID'])){
    include "init.php";
    ?>
    <div class="sitmaptxt container">
        <h1>مفهوم فهرسة المواقع</h1>
        <p> 
            هي عبارة عن عمليةٍ برمجيةٍ تقوم على تنزيل البيانات 
            من صفحات الويب، وتخزينها في قواعد البيانات التابعة لمحركات البحث 
            بهدف معالجة جميع البيانات المُجمعة لإظهار أهم نتائج البحث المرتبطة
             بالكلمات المفتاحية التي يدخلها المستخدم، لكن كيف يتم الأمر!؟
        </p>
        <p>
            في حالتنا لقد قمت ببرمجة سكريبت يقوم بانشاء ملف (sitemap.xml)  
            بشكل اتوماتيكي  يكفيك الضغط على الرابط اسفله ايها الناشر 
        </p>
        
        <a href="sitemap.php" >فهرسة موقعك الان </a>
    </div>






    <?php

   
}
else{
header('location:  ad_login.php');
exit();
}
ob_end_flush(); ?>

