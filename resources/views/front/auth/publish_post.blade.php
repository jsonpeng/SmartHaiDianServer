@extends('front.partial.base')

@section('css')
<style type="text/css">
    .publish{
        padding-top: 40px;
    }
    .topic .title{
        font-size:22px;
        padding:20px 0;
    }
    .form-control{
        font-size:18px;
        height:60px;
        padding:13px 30px;
        border-radius: 6px;
    }
    .form-group .title{
        font-size:22px;
        padding:38px 0 18px 0;
    }
    .btn-lg{
        padding:17px 60px;
    }
    .hot-topic{
        padding:15px 0;
        font-size:18px;
        color:#969696;

    }
    .hot-topic span{
        display: inline-block;
        line-height: 28px;
        border:1px solid #1976d3;
        border-radius: 14px;
        font-size:16px;
        color:#1976d3;
        width:92px;
        text-align: center;
        margin-left: 13px;
    }
    .btn-default.fabu{
        font-size:16px;
        padding:7px 67px;
        background-color:#1976d3;
        border:none;
        color:#fff;
        margin-top: 36px;
    }
    .guide-box{
        padding:18px 20px;
        border:1px solid #e6e6e6;
        border-radius: 7px;
    }
    .guide{
        margin-bottom: 20px;
    }
    .guide h4{
        font-size:18px;
        margin-bottom: 10px;
    }
    .guide p{
        color:#666;
        font-size:16px;
        line-height: 22px;
    }
</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}|发布投稿</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
    <section class="main container publish">
        <form >
            <div class="pull-left left-content">
                <div class="topic">
                    <h3 class="title">文章标题</h3>
                    <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="请输入文章标题">
                </div> 
                <div class="article-content">
                    <div class="form-group">
                        <label for="content" class="title">文章内容</label>
                        <textarea class="form-control intro" name="content" cols="50" rows="10" id="content"></textarea>
                    </div>
                    <div class="form-group attach">
                        <label class="title">文章封面</label>
                        <img src="{{asset('images/add-image.png')}}" width="206" height="206" alt="" class="img-rounded img-responsive type_files">
                        <input type="hidden" name="image" />
                    </div>
                    <div class="form-group">
                        <label class="title">请选择分类</label>
                        <div>
                            <div class="btn-group" style="margin-right: 20px;">
                                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    请选择分类 <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($cats as $key => $cat)
                                        <li class="article-cat" style="padding:5px 10px;position:relative;" data-id="{!! $key !!}">
                                            {!! $cat !!} 
                                        </li>
                                    @endforeach
                                </ul>   
                            </div>
                            <div class="btn-group cat_child" style="display: none;">
                                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     请选择子分类<span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    
                                </ul>   
                            </div>
                            <input type="hidden" class="categories" name="categories[]" value="0" />
                            <input type="hidden" class="categories" name="categories[]" value="0"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="title">添加话题</label>
                        <input type="text" name="topic" class="form-control" id="exampleInputName2" placeholder="输入话题">
                    </div>
                    <div class="hot-topic">
                        热门话题： <span>#区块链#</span><span>#技术#</span>
                    </div>
                    <button type="button" class="btn btn-default fabu">保存并发布</button>
                </div>  
            </div>
        </form>

        <div class="pull-right right-content">
            <div class="topic">
                <h3 class="title">发布指南</h3>
                <div class="guide-box">
                    <div class="guide">
                        <h4>发起文章指南</h4>
                        <p>文章标题：请用准确的语言描述您发布的文章思想</p>
                    </div>
                    <div class="guide">
                        <h4>文章正文</h4>
                        <p>详细补充您的文章内容，并提供一些相关的素材以供参与者更多的了解您文章的主题思想</p>
                    </div>
                    <div class="guide">
                        <h4>文章内容中插入图片</h4>
                        <p>使用键盘快捷键Ctrl+E快速插入图片</p>
                    </div>
                    <div class="guide">
                        <h4>选择话题</h4>
                        <p>选择一个或多个合适的话题，让您发布的文章得到更多有相同兴趣的人参与阅读</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('vendor/tinymce/jquery.tinymce.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.intro',
            height: 500,
            theme: 'modern',
            language: 'zh_CN',
            plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help responsivefilemanager'],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            external_filemanager_path: "/filemanager/",
            filemanager_title: "图片",
            external_plugins: { "filemanager": "/vendor/tinymce/plugins/responsivefilemanager/plugin.min.js" },
            templates: [{ title: 'Test template 1', content: 'Test 1' }, { title: 'Test template 2', content: 'Test 2' }],
            content_css: [
                //'//www.tinymce.com/css/codepen.min.css'
            ]
    });
    </script>
    @include('front.auth.usercenter_js')
    <script type="text/javascript">
        $('.fabu').click(function(){
              tinyMCE.triggerSave();
              $.zcjyRequest('/ajax/publish_post',function(res){
                    if(res){
                        $.alert(res);
                        location.href= '/user/center/index';
                    }
              },$('form').serialize(),'POST');

        });
        $('.article-cat').each(function(index, el) {
            $(this).click(function() {
                $(this).parent().siblings().text($(this).text());
                var that=this;
                var id=parseInt($(this).attr('data-id'));
                $('.cat_child').children('.dropdown-menu').html('');
                if(id != 0){
                            $('.categories:eq(0)').val(id);

                            $.zcjyRequest('/ajax/child_cats/'+id,function(res){
                                if(res && res.length){
                                    $('.cat_child').show();
                                    for(var i=0;i<res.length;i++){
                                        // if(i==0){
                                        //     $('.cat_child').children('.dropdown-toggle').text(res[i].name);
                                        // }
                                        $('.cat_child').children('.dropdown-menu').append('<li style="padding:5px 10px;" data-id="'+res[i].id+'">'+res[i].name+'</li>') 
                                    }
                                    $('.cat_child').find('li').each(function(index, el) {
                                        $(this).on('click', function(event) {
                                            $(this).parent().siblings().text($(this).text());
                                            $('.categories:eq(1)').val($(this).data('id'));
                                        });
                                    });
                                }
                            },{},'POST');
                    }
                });

        });
        
    </script>
@endsection