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
                    <li>
                        <a href="/user/reg/mobile">注册</a>
                    </li>
                    <li class="active">
                        <a href="/user/login">登录</a>
                    </li>
                </ul>
                <p class="pull-right">市场有风险 , 投资需谨慎</p>
                <div class="clearfix"></div>
            </div>
            <!-- 密码登录 -->
            <div class="login-main amend-main " data-type="pwd">
                <!-- pc密码登录 -->
                <form class="loginForm loginPwd hidden-xs">
                    <div class="form-group">
                        <label>手机号:</label>
                        <div class="value">
                            <input type="text"  name="name" placeholder="请输入手机号码" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>输入密码:</label>
                        <div class="value">
                            <input type="password" name="password" placeholder="请输入您的账号密码" value="">
                        </div>
                    </div>
                    <div class="operate">
                    {{--     <a href="javascript:;" class="pull-right" style="display: block;color:#1976d3;margin-top: -38px;">忘记密码</a> --}}
                        <button class="btn btn-default login_btn" type="button">立即登录</button>
                        <div class="other-way">
                            <a href="javascript:;" onclick="loginWayChange()">手机验证码登录</a>
                            <span class="wx-login">合作账号登录：</span>
                        </div>
                    </div>
                </form>
                <!-- mobile密码登录 -->
                <form class="loginForm loginPwd visible-xs" style="padding:30px 0">
                    <div class="form-group">
                        <label>手机号：</label>
                        <input type="text"  name="name" class="form-control" placeholder="请输入手机号码">
                    </div>
                    <div class="form-group">
                        <label>输入密码：</label>
                        <input type="password" name="password" class="form-control" placeholder="请输入您的帐号密码">
                    </div>
                    <div class="operate">
                        <a href="javascript:;" class="tr" style="display: block;color:#1976d3;margin-bottom: 20px;">忘记密码</a>
                        <button class="btn btn-default login_btn" type="button">立即登录</button>
                        <div class="other-way">
                            <a href="javascript:;" onclick="loginWayChange()">手机验证码登录</a>
                            <span class="wx-login">合作账号登录：</span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- 验证码登录 -->
            <div class="login-main amend-main" style="display:none;" data-type="code">
                <!-- pc验证码登录 -->
                <form class="loginForm loginCode hidden-xs">
                    <div class="form-group">
                        <label>手机号:</label>
                        <div class="value">
                            <input type="text" name="mobile" placeholder="请输入手机号码" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>验证码:</label>
                        <div class="value">
                            <input type="text" name="code" placeholder="请输入6位短信验证码" value="">
                            <button class="reg_get_code" type="button">获取验证码</button>
                        </div>
                    </div>
                    <div class="operate">
                        <button class="btn btn-default login_btn" type="button">立即登录</button>
                        <div class="other-way">
                            <a href="javascript:;" onclick="loginWayChange()">账号密码登录</a>
                            <span class="wx-login">合作账号登录：</span>
                        </div>
                    </div>
                </form>

                <!-- mobile验证码登录 -->
                <form class="loginForm loginCode visible-xs" style="padding:30px 0">
                    <div class="form-group">
                        <label>手机号：</label>
                        <input type="text"  name="mobile" class="form-control" placeholder="请输入手机号码">
                    </div>
                    <div class="form-group" style="position:relative;">
                        <label>验证码：</label>
                        <input type="text" name="code" class="mobile-code form-control" placeholder="请输入6位短信验证码">
                        <button class="reg_get_code" type="button">获取验证码</button>
                    </div>
                    <div class="operate">
                        <a href="javascript:;" class="tr" style="display: block;color:#1976d3;margin-bottom: 20px;">忘记密码</a>
                        <button class="btn btn-default login_btn" type="button">立即登录</button>
                        <div class="other-way">
                            <a href="javascript:;" onclick="loginWayChange()">手机验证码登录</a>
                            <span class="wx-login">合作账号登录：</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="saoma" style="display: none;">
        <div class="erweima" style="padding: 10px 30px 20px 30px; background-color: rgb(255, 255, 255); text-align: center;">
            <h3 style="padding:15px 0;font-size: 18px;">微信登录</h3>
            <img src="{{asset('images/erweima.png')}}" alt="">
        </div>
        <div class="zhezhao" style=""></div>
    </div>
    
@endsection


@section('js')
    <script>
        var flag = false;
        var type = 'pwd';

        //切换登陆方式
        function loginWayChange(){
             $('.login-main').toggle();
             flag = !flag;
             if(flag){
                type = 'code';
             }
             else{
                type = 'pwd';
             }
        }

        if($(window).width()>768){
            get_code('.loginCode.hidden-xs');
        }else{
            get_code('.loginCode.visible-xs');
        }
        //获取验证码
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
                },{mobile:$(box+' input[name=mobile]').val(),type:'login'},'POST');
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

        $('.login_btn').click(function(){
            var that = this;
            $.zcjyRequest('/ajax/login_user',function(res){
                if(res){
                    $.alert(res);
                    location.href="/user/center/index";
                }
            },$(that).parent().parent().serialize()+'&type='+type,'POST');
        });

        $('input[name=name],input[name=mobile],input[name=password],input[name=code]').on('keypress',function(event){
            if (event.charCode === 13) {
                $('.{!! getSettingValueByKeyCache("name") !!}_login_btn').trigger('click');
            }
        });
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