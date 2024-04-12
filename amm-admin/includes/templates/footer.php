<div class="container login">

        <!--foote_bottom_ul_amrc ends here-->
        <p class="text-center">Copyright @2023 | Designed  by <a href="ad_home.html" class="companyname">AMURA MANGA</a></p>


        <!--social_footer_ul ends here-->
    </div>
        <!-- jquery file-->
        <script src="<?php echo $js.'jquery-3.6.0.min.js.js' ?>"></script>
        <!-- bootstrap file -->
        <script src="<?php echo $js.'bootstrap.bundle.js' ?>"></script>
        <!-- fontawesome file -->
        <script src="<?php echo $js.'fontawesome.min.js' ?>"></script>
        <!-- main js file -->
        <script src="<?php echo $js.'script.js' ?>">
        $(document).ready(function(){
    $('#upload-frm').submit(function(e){
        e.preventDefault();

        $('.progress').css('visibility','visible');
        

        var formData = new FormData(this);

        $.ajax({
            url:'ad_chapters.php?do=insertmultilepage',
            type:'POST',
            data:formData,
            processData:false,
            contentType:false,
            xhr:function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress',function(e){
                    if(e.lengthComputable){
                        var per= Math.round((e.loaded/e.total)*100);
                        $('#progress-bar').text(per +"%");
                        $('.progress-bar').css('width',per+'%');
                    }
                })
                return xhr;
            },
            success:function (res){
                let id = formData.get('id');
               window.location.href='ad_chapters.php?do=pages&id='+id+'&msg=1';
            }
        })
    })
})
        </script>
</body>
</html>