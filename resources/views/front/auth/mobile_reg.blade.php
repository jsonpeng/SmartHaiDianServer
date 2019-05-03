@extends('front.partial.base')

@section('css')
<style type="text/css">
    .reg_get_code{
        display: inline-block;
        border: none;
        background: none;
    }
    .erweima {
        position: fixed;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%,-50%);
        -moz-transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        -o-transform: translate(-50%,-50%);
        z-index: 10000;
    }
    .zhezhao {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, .65);
        z-index: 9999;
    }
</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}|用户登录</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')

    @include('front.partial.nav')
    
    <section class="bg-content">
        <div class="login-box">
            <div class="top">
                <ul class="pull-left">
                    <li class="active">
                        <a href="/user/reg/mobile">注册</a>
                    </li>
                    <li>
                        <a href="/user/login">登录</a>
                    </li>
                </ul>
                <p class="pull-right">市场有风险 , 投资需谨慎</p>
                <div class="clearfix"></div>
            </div>
            <div class="login-main amend-main">
                <!-- pc -->
                <form class="loginForm hidden-xs">
                    <div class="form-group">
                        <label>手机号:</label>
                        <div class="value">
                            <input type="text" name="mobile" placeholder="请输入手机号码" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>验证码:</label>
                        <div class="value">
                            <input type="text" name="code" placeholder="请输入短信验证码" value="">
                            <button type="button" class="reg_get_code">获取验证码</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>输入密码:</label>
                        <div class="value">
                            <input type="password" name="password" placeholder="请输入您的账号密码" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>确认密码:</label>
                        <div class="value">
                            <input type="password" name="re_password" placeholder="请确保两次密码输入一致" value="">
                        </div>
                    </div>
                    <div class="operate">
                        <div class="checkbox">
                            <label style="width:auto;">
                                <input type="checkbox" class="reg_protol">同意<a href="">《注册服务协议》</a>
                            </label>
                        </div>
                        <button class="btn btn-default reg_enter" type="button">同意协议并注册</button>
                        <div class="other-way">
                            已有账号？<a href="/user/login">立即登录</a>
                            <span class="wx-login">合作账号登录：</span>
                        </div>
                    </div>
                </form>
                <!-- mobile -->

                <form class="loginForm visible-xs" style="padding:30px 0">
                    <div class="form-group">
                        <label>手机号:</label>
                        <input type="text" class="form-control" name="mobile" placeholder="请输入手机号码">
                    </div>
                    <div class="form-group" style="position:relative;">
                        <label>验证码:</label>
                        <input type="text" class="form-control mobile-code" name="code" placeholder="请输入6位短信验证码">
                        <button type="button" class="reg_get_code">获取验证码</button>
                    </div>
                    <div class="form-group">
                        <label>输入密码:</label>
                        <input type="password" class="form-control" name="password" placeholder="请输入您新的账号密码">
                    </div>
                    <div class="form-group">
                        <label>确认密码:</label>
                        <input type="password" class="form-control" name="re_password" placeholder="请确保两次密码输入一致">
                    </div>
                    <div class="operate">
                        <div class="checkbox">
                            <label style="width:auto;">
                                <input type="checkbox" class="reg_protol">同意<a href="">《注册服务协议》</a>
                            </label>
                        </div>
                        <button class="btn btn-default reg_enter" type="button">同意协议并注册</button>
                        <div class="other-way">
                            已有账号？<a href="/user/login">立即登录</a>
                            <span>合作账号登录：</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <div class="saoma" style="display: none;">
        <div class="erweima" style="padding: 10px 30px 20px 30px; background-color: rgb(255, 255, 255); text-align: center;">
            <h3 style="padding:15px 0;font-size: 18px;">微信登录</h3>
            <img src="{{asset('images/erweima.png')}}" alt="">
        </div>
        <div class="zhezhao" style=""></div>
    </div>

    </section>
@endsection


@section('js')
    <script type="text/javascript">
        if($(window).width()>768){
            get_code('.loginForm.hidden-xs');
            register('.loginForm.hidden-xs');
        }else{
            get_code('.loginForm.visible-xs');
            register('.loginForm.visible-xs');
        }
        //发送验证码
        function get_code(box){
            $(box+' .reg_get_code').click(function(){
                if($.empty($(box+' input[name=mobile]').val())){
                    $.alert('请先输入手机号','error');
                    return;
                }
                var that = this;
                $.zcjyRequest('/ajax/send_mobile_code',
                    function(res){
                    if(res){
                        sendCode(that);
                    }
                },{mobile:$(box+' input[name=mobile]').val()},'POST');
            });
        }
        

        var leaveTime=60;
        function sendCode(obj){
            if(leaveTime==0){
                $(obj).attr('disabled',false);
                $(obj).text('发送验证码')
                leaveTime=60;
                return false;
            }
            else{
                leaveTime--;
                $(obj).attr('disabled',true);
                $(obj).text('重新发送('+leaveTime+')');
            }
            setTimeout(function() {
                sendCode(obj);
            },1000);
        }

        //确定注册
        function register(box){
            $(box+' .reg_enter').click(function(){
                if(!$(box+' .reg_protol').prop('checked')){
                    $.alert('请先同意协议','error');
                    return;
                }

                $.zcjyRequest('/ajax/reg_user',function(res){
                    if(res){
                        $.alert(res);
                        location.href="/user/center/index";
                    }
                },$(box).serialize(),'POST');

            });
        }

        $('.wx-login').click(function(){
            $.zcjyRequest('/ajax/start_weixin_scan',function(res){
                 $('.saoma').find('img').attr('src',res);
                 $('.saoma').show();
                 startScanLoop();
            });
        });

        $('.zhezhao').on('click', function() {
            $(this).parent().hide();
        });

        function startScanLoop(){
          var interval =  setInterval(function(){
                $.zcjyRequest('/ajax/ask_scan_result',function(res){
                    if(res == 'login success'){
                        $.alert('微信登录成功');
                        
                        setTimeout(function(){
                              location.reload();
                        },1500);
                      
                    }
                });
            },3000);
        }
    </script>
@endsection