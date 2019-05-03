@extends('front.partial.base')

@section('css')

@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
	<section class="container news-main main usercenter">
        @include('front.auth.usercenter_nav')
        <form class="form-horizontal account">
        	<div class="form-group login-wx">
                <label for="login-wx">登录微信:</label>
                <input type="text" class="form-control"  id="login-wx" placeholder="" value="{!! $user->nickname !!}"  readonly="readonly">
                @if(!empty($user->openid)) <span class="amend unbindWeixin">解绑</span>  @endif
            </div>
            <div class="form-group login-phone">
                <label for="login-phone">登录手机号:</label>
                <input type="text" class="form-control"  name="mobile" id="login-phone" placeholder="" value="{!! $user->mobile !!}" readonly="readonly">
                @if(!empty($user->mobile)) 
                <span class="amend" id="amend-phone">修改</span> 
                @else
                <span class="amend"  id="amend-phone">绑定</span>
                @endif
            </div>
            <div class="form-group login-password">
                <label for="login-password">登录密码:</label>
                <input type="password" class="form-control" id="login-password" placeholder="" value="" >
                <span class="amend updatePwd">修改</span> 
            </div>
            <!-- <button type="button" class="btn btn-default" style="margin-left: 156px;margin-top: 0;">保存</button> -->
       	</form>
       	<div class="popup login-popup" style="display: none;">
       		<div class="zhezhao"></div>
       		<div class="amend-login_info">
       			<div class="title">
       				修改登录信息
       				<span>为确保账号安全,需要验证当前手机有效性</span>
       			</div>
       			<div class="amend-main">
       				<form id="amend-login_info" class="form-horizontal">
                @if(!empty($user->mobile))
       					 <div class="form-group">
			                <label>当前绑定手机号:</label>
			                <div class="value">
			                	<span style="color:#ff0000;font-size:18px;">{!! $user->mobile !!}</span> 
			                </div>
			            </div>
						      <div class="form-group">
			                <label for="verification-code">验证码:</label>
			                <div class="value">
			                	<input type="text" name="code" id="verification-code" placeholder="请输入6位短信验证码" value="">
			                	<button type="button" onclick="get_code(this)">获取验证码</button>
			                </div>
			            </div>
                    <input type="hidden" name="type" value="edit" />
                  @else
                    <input type="hidden" name="type" value="bind" />
                  @endif
			            <div class="form-group">
			                <label for="new-phone">输入新手机号:</label>
			                <div class="value">
			                	<input type="text" name="newmobile" id="new-phone" placeholder="请输入您新的登录手机号" value="">
			                </div>
			            </div>
			            <div class="form-group">
			                <label for="repeat-phone">确认新手机号:</label>
			                <div class="value">
			                	<input type="text" name="entermobile" id="repeat-phone" placeholder="请确保两次手机号输入一致" value="">
			                </div>
			            </div>
			            <button type="button" class="btn btn-default saveEditMForm" style="margin-left: 156px;margin-top: 0;">保存</button>
       				</form>
       			</div>
       		</div>
       	</div>
    </section>
@endsection

@section('js')
	<script>
		$(function(){
			$('#amend-phone').click(function() {
				$('.login-popup').show();
			});
			$('.zhezhao').on('click', function() {
				$(this).parent().hide();
			});
			//解绑微信
			$('.unbindWeixin').click(function(){
				$.zcjyRequest('/ajax/unbind_weixin',function(res){
					if(res){
						$.alert(res);
					}
				},{},'POST');
			});
		
			
			//修改登录密码
			$('.updatePwd').click(function(){
				var password = $('#login-password').val();
				if($.empty(password)){
					$.alert('请输入修改密码','error');
					return;
				}
				$.zcjyRequest('/ajax/update_user',function(res){
					if(res){
						$.alert(res);
					}
				},{password:password},'POST');
			});
		});

		 //获取验证码
        function get_code(dom){
                var that = dom;
                $.zcjyRequest('/ajax/send_mobile_code',
                    function(res){
                    if(res){
                        sendCode(that);
                    }
                },{mobile:$('input[name=mobile]').val(),type:'edit_mobile'},'POST');
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
        
        //修改手机号保存
        $(document).on('click','.saveEditMForm',function(){
        		$.zcjyRequest('/ajax/edit_mobile_bind',function(res){
        				if(res){
        					$.alert(res);
        					location.reload();
        				}
        		},$('#amend-login_info').serialize(),'POST');
        });
	</script>
@endsection