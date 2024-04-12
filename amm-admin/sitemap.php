<?php
ob_start();
session_start();
$page_title="Amura Cpanel | site map  ";

if (isset($_SESSION['adminID'])){
    include "init.php";

    $xml='<?xml version="1.0" encoding="UTF-8"?>';
    $xml.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    // static urls :
    $xml.="
        <url>
	    	<loc>http://amuramanga.great-site.net/</loc>
            <changefreq>Daily</changefreq>
            <priority>1</priority>
	    </url>
         
        <url>
            <loc>http://amuramanga.great-site.net/?i=1</loc>
            <lastmod>2023-06-12T00:49:26+01:00</lastmod>
            <changefreq>Daily</changefreq>
            <priority>1.0</priority>
        </url>

        <url>
            <loc>http://amuramanga.great-site.net/?i=2</loc>
            <lastmod>2023-06-12T00:49:26+01:00</lastmod>
            <changefreq>Daily</changefreq>
            <priority>1.0</priority>
        </url>

        <url>       
            <loc>http://amuramanga.great-site.net/?i=3</loc>       
            <lastmod>2023-06-12T00:49:27+01:00</lastmod>      
            <changefreq>Daily</changefreq>
            <priority>1.0</priority>
        </url>
        <url>       
            <loc>http://localhost/Am/manga.php</loc>       
            <lastmod>2023-06-12T00:49:27+01:00</lastmod>      
            <changefreq>Daily</changefreq>
            <priority>1.0</priority>
        </url>
         ";

    //    dynamique urls :
    // mangas urls :
        $sql="SELECT * FROM manga_series";
        $search=$con->prepare($sql);
        $search->execute();
        $mangas=$search->fetchAll();

        foreach($mangas as $manga){
            $xml .= "<url>";
            $xml .= "<loc>http://amuramanga.great-site.net/singleManga.php?id=".$manga['MangaID']."</loc>";
            $xml .= "<changefreq>Daily</changefreq>";
            $xml .="<priority>0.8</priority>";
            $xml .= "</url>";
        }


    // chapters urls :
        $sql="SELECT * FROM `manga_chapter` ";
        $search=$con->prepare($sql);
        $search->execute();
        $chapters=$search->fetchAll();

        foreach($chapters as $chapter){
            $xml .= "<url>";
            $xml .= "
            <loc>http://amuramanga.great-site.net/readManga.php?id=".$chapter['ChapterID']."</loc>";
            $xml .= "<changefreq>Daily</changefreq>";
            $xml .="<priority>0.8</priority>";
            $xml .= "</url>";
        }



    $xml.='</urlset>';
	

    // generate xml file :
    $file=fopen("../sitemap.xml","w");
    fwrite($file,$xml);?>

    <div class='sitmapsucc' dir="ltr" style="width: 250px; margin: 30px auto;"> 
         <div class='progress'>
         <div class='progress-bar progress-bar-striped bg-success' 
              role='progressbar' 
              aria-valuenow='10'
              id="prog" 
              aria-valuemin='0' 
              aria-valuemax='100'></div>
         </div>

         <div id="progtxt"></div>
         <div id="status"></div>
    </div>
    
    <?php
    
    ?>
    
 
    <!-- jquery file-->
    <script src="<?php echo $js.'jquery-3.6.0.min.js.js' ?>"></script>
    <!-- bootstrap file -->
    <script src="<?php echo $js.'bootstrap.bundle.js' ?>"></script>
    <!-- fontawesome file -->
    <script src="<?php echo $js.'fontawesome.min.js' ?>"></script>
    <!-- main js file -->
    <script src="<?php echo $js.'script.js' ?>">
    </script>
    <script>
      $(document).ready(function() {
        var bar = $('#prog');
        var percent = $('#progtxt');
        var status = $('#status');

        status.empty();
        var percentVal = 0;
        bar.width(percentVal+'%')
        percent.html(percentVal+'%');

         setInterval(function(){
            percentVal += 9.76 ;
            
            bar.width(percentVal+'%')
            percent.html(percentVal+'%');
     
            if( percentVal>=100 ){
                bar.width("100%");
                percent.html("100%");
                status.html("تمت الفهرسة بنجاح ");
            }
         },500);
      });
     
    </script>
<?php
}
else{
header('location:  ad_login.php');
exit();
}
ob_end_flush(); ?>

