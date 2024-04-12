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