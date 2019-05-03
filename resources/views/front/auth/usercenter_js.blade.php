
<script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
<script type="text/javascript">
    //上传头像
    $('.usercenter_headimg_edit').click(function(){
        layer.open({
            type: 1,
            closeBtn: false,
            shift: 7,
            shadeClose: true,
            title:'修改个人信息',
            content: $('#import_user_image_box').html()
        });
        $(document).on('click','.type_files',function(){
            click_dom = $(this);
            $('input[type=file]').trigger('click');
        });
    });

    var head_image;
    var myDropzone = $(document.body).dropzone({
        url:'/ajax/upload_file',
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        addRemoveLinks:false,
        maxFiles:100,
        autoQueue: true, 
        previewsContainer: ".attach", 
        clickable: ".type_files",
        headers: {
         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        addedfile:function(file){
            console.log(file);
        },
        totaluploadprogress:function(progress){
            progress=Math.round(progress);
            // click_dom.find('a').text(progress+"%");

        },
        queuecomplete:function(progress){
            //console.log(progress);
            // if($.empty(click_dom)){
            //     click_dom = $('.type_files');
            // }
            click_dom.find('a').text('上传完毕√');
        },
        success:function(file,data){
            if(data.code == 0){
                console.log('上传成功:'+data.message.src);
                if($.empty(click_dom)){
                    click_dom = $('.type_files');
                }
                console.log(click_dom);
                if(data.message.type == 'image'){
                 
                    click_dom.find('img').attr('src',data.message.src);
                    head_image = data.message.src;
                }
                else if(data.message.type == 'word'){
                   
                }
                else if(data.message.type == 'excel'){
                 
                  
                }
                click_dom.find('input').val(data.message.src);
            }
            else{
                click_dom.find('a').text('上传失败╳ ');
                alert('文件格式不支持!');
            }
      },
      error:function(){
        console.log('失败');
      }
    });

    var click_dom=null;
    $(document).on('click','.type_files',function(){
            click_dom = $(this).parent();
            //$('input[type=file]').trigger('click');
    });
    var brief;
    $(document).on('keyup change','.brief',function(){
        brief = $('.brief:eq(1)').text();
        console.log(brief);
    });

    function enterImport(obj){
        $.zcjyRequest('/ajax/update_user',function(res){
            if(res){
                $.alert('上传更新成功');
                layer.closeAll();
                location.reload();
            }
        },$($(obj).parent()).serialize(),'POST');
    }
</script>
