<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{!! getSettingValueByKeyCache("name") !!}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/iCheck/1.0.2/skins/all.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminLTE/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminLTE/css/skins/skin-blue.min.css') }}">

    
    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdn.bootcss.com/element-ui/1.4.3/theme-default/index.css" rel="stylesheet">
    

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style type="text/css">
    .skin-blue .main-header .logo,.skin-blue .main-header .navbar , .btn-primary , .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover , .skin-blue .main-header .logo , .skin-blue .main-header .navbar .sidebar-toggle:hover{
        background-color: #019875 !important;
        border-color: white;
    }

    .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
        background-color: #fff;
    }

    .skin-blue .sidebar-menu>li.header {
        color: #4b646f;
        background: #fff;
    }

    .skin-blue .sidebar a {
        color: black;
    }

    .skin-blue .sidebar-menu>li>.treeview-menu {
        margin: 0 1px;
        background: black;
    }

    .box.box-info,.nav-tabs-custom>.nav-tabs>li.active{
        border-top-color: green;
    }
    .required{
        color: orange;
    }
    .layui-layer-shade{
        background-color: transparent !important;
    }
    </style>
    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
    <style type="text/css">
        .content-header{overflow: hidden;}
        .box.box-primary{border-top: none;}
        thead {
            border-bottom: 1px solid #d0d0d0;
        }
        .mce-i-browse:before {
            content: "\e014";
        }
    </style>


    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>{!! getSettingValueByKeyCache("name") !!}后台管理系统</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation" style="position: relative;">
                
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('logo/logo.png') }}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! optional(auth('admin')->user())->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                   {{--  <div class="pull-left">
                                        <a href="{!! route('settings.edit_pwd') !!}" class="btn btn-default btn-flat">
                                            修改密码
                                        </a>

                                    </div> --}}
                                    <div class="pull-right">
                                        <a href="{!! url('/zcjy/logout') !!}" class="btn btn-default btn-flat">
                                            退出
                                        </a>
                                   {{--      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form> --}}
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright 2019 <a href="/" target="_blank">{!! getSettingValueByKeyCache("name") !!}</a>.</strong> All rights reserved.
        </footer>

    </div>

   


    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.bootcss.com/iCheck/1.0.2/icheck.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/adminLTE/js/app.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/tinymce/jquery.tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/vue/vue.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('vendor/jquery.nestable.js') }}"></script> -->
    <script src="https://cdn.bootcss.com/element-ui/1.4.3/index.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/zcjy.js') }}"></script>
    <script type="text/javascript">
        $.extend({
    //汉化查询
    chParamFind:function(name){
        var words = $.chParam();
        var word = '参数不完整';
        for (var i in words) {
            if(typeof words[i][name] !== 'undefined'){
                word = '请输入'+words[i][name];
            }
        }
        return word;
    },
    //汉化参数
    chParam:function(){
        return [
            {'name':'名称'},
            {'endtime':'结束时间'},
            {'content':'内容'},
            {'address':'地址'},
            {'gear':'档位金额'},
            {'target':'目标金额'},
            {'zuqi':'租期'},
            {'area':'面积'},
            {'price':'价格'},
        ];
    },
    //表单检测
    varifyInput:function(attr){
        var status = 0;
        if(!$.is_array(attr)){
            attr = attr.split(',');
        }
        for (var i = 0; i < attr.length; i++) {
            if($.empty($.inputAttr(attr[i]).val())){
                status = $.chParamFind(attr[i]);
                $.alert(status,'error');
                break;
            }
        }
        return status;
    },
    //弹出
    alert:function(word,type="success"){
        type = type == "success" ? 1 : 5;
        layer.msg(word, {icon: type});
    },
    //检测数据是否为空
    empty:function(data) {
        return data == '' || data == null  || data == false || data == 'false' || data == 'null' || data == {} || data == '{}' || data == [] ||  JSON.stringify(data) == '{}';
    },
    /**
     * [判断是否是数组]
     * @param  {[type]}  object [description]
     * @return {Boolean}        [description]
     */
    is_array:function (object){
        return object && typeof object==='object' &&
            Array == object.constructor;
    },    
    /**
     * [设置指定输入的最大长度]
     * @param {[string]} attribute      [属性]
     * @param {[array]} keyword_arr     [属性关键字数组]
     * @param {[int]} length            [description]
     */
    setInputLengthByName:function(attribute,keyword_arr,length){  
        for(var i=keyword_arr.length-1;i>=0;i--){
            $('input['+attribute+'='+keyword_arr[i]+']').attr('maxlength',length);
        }
    },
    /**
     * [后台/前端 ajax请求通用接口]
     * @param  {[string]}   request_url         [请求地址]
     * @param  {Function}   callback            [成功回调]
     * @param  {Object}     request_parameters  [请求参数]
     * @param  {String}     method              [HTTP请求方法]
     * @return {[type]}                         [description]
     */
    zcjyRequest:function(request_url,callback,request_parameters = {},method = "GET"){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:request_url,
            type:method,
            data:request_parameters,
            success: function(data) {
                // console.log(data.code);
                if(data.code == 0){
                    if(typeof(callback) == 'function'){
                        callback(data.message);
                        //layer.msg(data.message, {icon: 5});
                    }
                }
                else{
                    callback(false);
                    layer.msg(data.message, {icon: 5});
                }
            }
        });
    },
    /**
     * [给必填/必选字段加上提示]
     * @param  {string}  name_array [description]
     * @param  {Boolean} select     [description]
     * @return {[type]}             [description]
     */
    zcjyRequiredParam:function(name_array,select=false){
           name_array = name_array.split(',');
           select = select ? '选' : '填';
           for(var i=name_array.length-1;i>=0;i--){
                $('label[for='+name_array[i]+']').after('<span class=required>(必'+select+')</span>');
           }
    },
    /**
     * [打开弹出层]
     * @param  {[type]}   url      [description]
     * @param  {[type]}   title    [description]
     * @param  {Array}    area     [description]
     * @param  {[type]}   '680px'] [description]
     * @param  {Function} callback [description]
     * @return {[type]}            [description]
     */
    zcjyFrameOpen:function(url,title='智慧海淀',area=['60%', '680px'],callback=null){
        var type =2;
        // if(url.length > 50){
        //     type = 1;
        // }
        // area = ['100%', '1080px'];
        
         layer.open({
            type: type,
            title:title,
            shadeClose: true,
            shade: 1.0,
            area: area,
            content: url, 
        });
        if(callback != null && typeof (callback) == 'function'){
            callback(url);
        }
    },
    /**
     * [自动根据input的name字段生成基于jq的选择器]
     * @param  {[type]} name_attr [description]
     * @return {[type]}           [description]
     */
    inputAttr:function(name_attr){
        if(!$.is_array(name_attr)){
            name_attr = name_attr.split(',');
        }
        var fuhao =',';
        var new_attr = '';
        for (var i = name_attr.length - 1; i >= 0; i--) {
            if(i == 0){
                fuhao = '';
            }
            new_attr += 'input[name='+name_attr[i]+']'+fuhao;
        }
        return $(new_attr);
    }
});

$.fn.extend({    
    /**
     * [限制number类型的输入 后期可继续扩展]
     * @param 传入参数  [int/string] {整形/字符串} _lengths  [长度/类型]
     * @return 
     */
   numberInputLimit:function(_lengths){    
       $(this).bind("keyup paste",function(){
            if(_lengths <= 11){
            //替换字母特殊字符 用于整形浮点等     
            this.value=this.value.replace(/[^\d.]/g,"");
            }
           //截取最大长度 
           //针对数据库常用字符串 推荐使用191
           //针对数据库常用数量    推荐使用8 11
            if(this.value.length > _lengths){
                this.value=this.value.slice(0,_lengths);
            }
            //针对100以内 百分比
            if(_lengths == 3){
                if(this.value > 100){
                    this.value = 100;
                }
            }
            //针对商城分类
            if(_lengths == 1 || _lengths== 'category'){
                 if(this.value > 3){
                    this.value = 3;
                }
            } 
        });    
    },
    /**
     * [限制图片的长度 超过规范长度给出错误提示]
     * @param  {[int]}  _imgmaxlength [图片url最大长度]
     * @return {[type]}               [description]
     */
    imgInputLimit:function(_imgmaxlength){
        //图片长度限制
        $(this).bind('change',function(){
            //长度超出数据库规范限制
            if($(this).val().length>=_imgmaxlength){
                //置空输入框
                $(this).val("");
                //去除图片
                $(this).parent().find('img').remove();
                //给出错误提示弹框
                layer.msg("图片 不能大于 "+_imgmaxlength+" 个字符,请修改图片名称后重试", {
                            icon: 5
                });
              
            }
        });
    },
    zcjyFrameOpenObj:function(url,title,area=['60%', '680px'],func='click',callback=null){
        var type =2;
        if(url.length > 50){
            type = 1;
        }
        if($(window).width()<479){
            area = ['100%', '100%'];
        }
        $(this).bind(func,function(){
                 layer.open({
                    type: type,
                    title:title,
                    shadeClose: true,
                    shade: 0.8,
                    area: area,
                    content: url, 
                });
               if(callback != null && typeof (callback) == 'function'){
                    callback(url);
                }
        });
    },  
});
$('input[name=price]').numberInputLimit(6);
    </script>
    <script src="{{ asset('vendor/layer/layer.js') }}"></script>

    <script type="text/javascript">
    $('#add_post').click(function(){
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      $.ajax({
                url: '/zcjy/getCustomType',
                type: 'POST',
                success: function(data) {

                 var status=data.status;
                 var alltype=data.msg;
                 var html='';

                 if(status){
                for(var i=0;i<alltype.length;i++){
                    html +='<a class="btn btn-success" style="margin-left:10px;" href="/zcjy/posts/create?post_type='+alltype[i].slug+'">'+alltype[i].name+'</a>';
                }
                console.log(html);

               layer.open({
                      type: 1,
                      area: ['680px', '450px'], 
                      content: '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h4 class="modal-title">请选择一种类型进行添加</h4></div><div class="modal-body"><a href="/zcjy/posts/create" class="btn btn-default">文章</a>'+html+'</div>'
                    });

            }else{
                alert('未知错误');
            }

            }
        });

    });

    var i=0;
    var slug_arr=[];
    $('.select_cat').click(function(){
        var slug=$(this).data('slug');
        var val=$(this).val();
        console.log("val:"+val);
        var that=this;
        if($(this).is(':checked')){
              i++;
              $.ajax({
                    url:'/getRootSlug/'+val,
                    type:'GET',
                    success:function(data){
                        if(data.status){
                            slug=data.msg;
                             $('#'+slug).show(500);
                          slug_arr.push(slug);
                            console.log(i);
                            if(i>1){
                            $('#post').val(slug_arr);
                          }else{
                              $('#post').val(slug_arr[0]);
                          }
                        }else{
                            return false;
                        }
                    }
              });       
        }else{
              i--;
                $.ajax({
                    url:'/getRootSlug/'+val,
                    type:'GET',
                    success:function(data){
                        if(data.status){
                            slug=data.msg;
                            console.log("还选中的分类别名"+$('.select_cat:checked').data('slug'));
                            if($('.select_cat').is(':checked') && $('.select_cat:checked').data('slug')==slug){
                                return false;
                            }
                            $('#'+slug).hide(500);
                          removeByValue(slug_arr,slug)
                          if(i>1){
                            $('#post').val(slug_arr);
                          }else{
                              $('#post').val(slug_arr[0]);
                          }
                           if(!$('.select_cat').is(':checked')){
                                $('#post').val("post");
                           }
                        }else{
                            return false;
                        }
                    }
              });            
        }
    });

    $('#custom_checkbox').click(function(){

    });

    function removeByValue(arr, val) {
      for(var i=0; i<arr.length; i++) {
        if(arr[i] == val) {
          arr.splice(i, 1);
          break;
        }
      }
    }

    $('#items_select').change(function(){
            var val=$(this).val();
            console.log(val);
            if(val=="select" || val=="checkbox"){
                $('#items_value').show();
            }else{
                $('#items_value').hide();
            }
    });

    //表格隐藏与显示
    $('.fa').click(function(){
       var type=$(this).data('type');
        var status= $(this).parent().parent().parent().children('.box-body').data('status');
        var functions =$(this).data('function');
        if(functions =='switch-table'){
            console.log($(this).parent().parent().parent().children('.box-body'));
       if(status=="show"){
            $(this).parent().parent().parent().children('.box-body').hide();
            $(this).parent().parent().parent().children('.box-body').data('status','hide');
       }else{
        $(this).parent().parent().parent().children('.box-body').show();
        $(this).parent().parent().parent().children('.box-body').data('status','show');
       }
   }else{
    return false;
   }
    });

    $('#refresh').click(function(){
            $.ajax({
                url:'/clearCache',
                type:'post',
                success:function(data){
                    if(data.status){
                layer.msg('清空缓存成功', {icon: 1});
                    }else{
                layer.open({
                    content: '未知错误!'
                    ,skin: 'msg'
                    ,time: 2 
                  });
                        return false;
                    }
                }
            })
    });
    
    $('input[type=text]').numberInputLimit(191);
    </script>
    @include('layouts.model_required')
    @yield('scripts')
</body>
</html>


