@extends('front.partial.base')

@section('css')
<style type="text/css">
	.{!! getSettingValueByKeyCache("name") !!}_mobile_reg_content{
		padding-top: 150px;
		padding-bottom: 180px;
		
	}
	.{!! getSettingValueByKeyCache("name") !!}_mobile_reg_code_button{
		    display: inline-block;
		    border: 1px solid #ccc;
		    color: black;
		    font-size: 16px;
		    text-align: center;
		    width: 154px;
		    padding: 18px;
	}
	.{!! getSettingValueByKeyCache("name") !!}_mobile_reg_button{
		font-size: 16px;
		padding: 20px;
		color: white;
		background: #E51C23;
		max-width: 454px;
		margin: 0 auto;
		text-align: center;
	}

	.{!! getSettingValueByKeyCache("name") !!}_mobile_reg_input{
		margin-left: 30%;
	}

	.{!! getSettingValueByKeyCache("name") !!}_mobile_reg_form_text{
		    width: 120px;
		    position: absolute;
		    left: 18px;
		    top: 18px;
		    font-size: 20px;
	}


</style>
@endsection

@section('seo')
	  <title>{!! getSettingValueByKey('name') !!}|手机号快速注册</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
	<div class="container ">
		<div class="{!! getSettingValueByKeyCache("name") !!}_mobile_reg_content ">

			<!--找回密码-->
			<form id="find_pwd" class="text-center">
				<div class="form-inline ">
					<select name="type" class="form-control w154 h60">
						<option value="mobile">手机号找回</option>
						<option value="email">邮箱找回</option>
					<!-- 	<option>中国+0712</option> -->
					</select>
					<input name="value" class="form-control h60" value="" placeholder="请输入注册手机号码" style="min-width: 300px;" />
				</div>

				<div class="form-inline mt30">
					<input name="code" class="form-control h60" value="" placeholder="请输入验证码" style="min-width: 300px;" />
					<button type="button" class="{!! getSettingValueByKeyCache("name") !!}_mobile_reg_code_button {!! getSettingValueByKeyCache("name") !!}_mobile_reg_btn">
						获取验证码
					</button>
				</div>

				<div class="form-inline mt30">
					<input name="newpassword" type="password" class="form-control h60" value="" placeholder="请输入新密码" style="min-width: 300px;width: 460px;" />
					
				</div>

				<div class="{!! getSettingValueByKeyCache("name") !!}_mobile_reg_button mt30 next">
					修改并找回
				</div>
			</form>

		

		</div>
	</div>
@endsection


@section('js')
<script type="text/javascript">
	$('select[name=type]').change(function(){
		var type = '请输入注册邮箱号码';
		if($(this).val() == 'mobile'){
			type = '请输入注册手机号码';
		}
		$('input[name=value]').attr('placeholder',type);
	});
	//获取手机验证码
	$('.{!! getSettingValueByKeyCache("name") !!}_mobile_reg_btn').click(function(){
			if($.empty($('input[name=value]').val())){
				$.alert('请先输入号码','error');
				return;
			}
			var that = this;
			$.zcjyRequest('/ajax/forgetpwd_send_code',
				function(res){
				if(res){
					sendCode(that);
				}
			},$('#find_pwd').serialize(),'POST');
	});

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
			console.log(leaveTime);
			$(obj).attr('disabled',true);
			$(obj).text('重新发送('+leaveTime+')');
		}
		setTimeout(function() {
	        sendCode(obj);
	    },1000);
	}

	//第一个下一步
	$('.next').click(function(){
		var that =this;
		if($.empty($('input[name=value]').val())){
			$.alert('请先输入号码','error');
			return;
		}

		if($.empty($('input[name=code]').val())){
			$.alert('请先输入验证码','error');
			return;
		}

		$.zcjyRequest('/ajax/forgetpwd_action_submit',function(res){
			if(res){
				$.alert(res);
				location.href="/user/center/index";
			}
		},$('#find_pwd').serialize(),'POST');
	});
</script>
@endsection