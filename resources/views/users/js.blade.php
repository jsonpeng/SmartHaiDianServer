@section('scripts')
<script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
<script type="text/javascript">
	var click_dom = $('.type_files');
	//图片文件上传
  	var myDropzone = $(document.body).dropzone({
        url:'/ajax/uploads',
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
			click_dom.find('a').text(progress+"%");

        },
        queuecomplete:function(progress){
        	console.log(progress);
        	click_dom.find('a').text('上传完毕√,点击更换');
        },
        success:function(file,data){
        	if(data.code == 0){
            	console.log('上传成功:'+data.message.src);
            	if(data.message.type == 'image'){
            		click_dom.find('img').attr('src',data.message.src);
            	}
            	else if(data.message.type == 'sound'){
            		click_dom.find('audio').show().attr('src',data.message.src);
            	}
                else if(data.message.type == 'excel'){
                    console.log($('#import_form').find('input[name=excel_path]'));
                    $('#import_form').find('input[name=excel_path]').val(data.message.current_src);
                    $('.import_class').find('button').show();
                    return;
                }
                if(click_dom.data('type') == 'question'){
                    $('input[name=attach_sound_url]').val(data.message.src);
                }
                else if(click_dom.data('type') == 'selection'){
                    $('input[name=selection_sound_url]').val(data.message.src);
                }
                else{
                    $('input[name=attach_url]').val(data.message.src);
                }
                $('input[name=welcome_sound_url]').val(data.message.src);
          
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
</script>
@endsection