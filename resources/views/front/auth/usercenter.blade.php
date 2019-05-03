@extends('front.partial.base')

@section('css')
<style type="text/css">
    .radio-inline input[type="radio"] {
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        margin-left: -45px;
        margin-top:0;
    }
    label input[type="radio"]:after {
        display: block;
        content: "";
        width: 25px;
        height: 25px;
        background: url("{{asset('images/no-check.png')}}") no-repeat;
        border-radius: 50%;
        margin-top:17.5px;
    }
    label input[type="radio"]:checked:after {
        background: url("{{asset('images/check.png')}}") no-repeat;
    }
    label.radio-inline{
        padding-left: 45px;
    }
    .alter-name .an-ipt input[type=text]:focus {
        border: 1px solid #ececec;
    }
    @media (max-width:768px){
        label input[type="radio"]:after{
            margin-top: 0;
        }
        .radio-inline{
            margin-right: 40px;
        }
    }

</style>
@endsection

@section('seo')
    <title>{!! getSettingValueByKey('name') !!}|个人中心</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
    <section class="container news-main main usercenter">
        @include('front.auth.usercenter_nav')
        <form class="form-horizontal">
            <div class="form-group user-head">
                <label class="col-md-2 col-xs-3" style="padding-right: 0;">用户头像：</label>
                <div class="col-md-10 col-xs-9">
                    <span class="value attach">
                        <img src="{!! $user->head_image !!}" style="width:80px;height:80px;border-radius: 50%;" onerror="javascript:this.src='{{ asset('images/user-head.png') }}';" alt="">
                        <span class="amend type_files">修改</span>
                        <input type="hidden" name="head_image" value="{!! $user->head_image !!}" />
                    </span>
                </div>
            </div>
            <div class="form-group nickname" style="margin-bottom: 15px;">
                <label for="nickname" class="col-md-2">
                    <span>*</span>昵称：
                </label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="nickname" placeholder="" name="nickname" maxlength="12" value="{!! $user->nickname !!}" @if($user->update_nickname_time) readonly="readonly" @endif>
                    <p class="amend-time">昵称仅可以修改<span>1</span>次</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 col-xs-3" style="margin-bottom:0;margin-top: 7px;">性别：</label>
                <div class="col-md-10 col-xs-9">
                    <label class="radio-inline">
                        <input type="radio" class="user_sex"  value="男" @if($user->sex=='男') checked @endif> 男
                    </label>
                    <input type="hidden" name="sex" value="{!! $user->sex !!}">
                    <label class="radio-inline">
                        <input type="radio" class="user_sex"  value="女" @if($user->sex=='女') checked @endif> 女
                    </label>
                </div>
            </div>
            <div class="form-group intro">
                <label for="intro" class="col-md-2">简介:</label>
                <div class="col-md-10">
                    <input type="text" name="des" class="form-control" id="intro" placeholder="" value="{!! $user->des !!}">
                </div>
            </div>
            <div class="form-group intro gongzhonghao">
                <label for="gongzhonghao" class="col-md-2">公众号名称:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="gongzhonghao" placeholder="" value="" name="official_accounts_name">
                </div>
            </div>
            <div class="form-group erweima">
                <label for="erweima" style="margin-top: 20px;" class="col-md-2">公众号二维码:</label>
                <div class="col-md-10 attach">
                    <img src="{!! $user->official_accounts_erweima !!}" width="206" height="206" onerror="javascript:this.src='{{ asset('images/add-image.png') }}';" alt="" class="img-rounded type_files" />
                    <input type="hidden" name="official_accounts_erweima" value="{!! $user->official_accounts_erweima !!}" />
                    <p style="margin-top: 14px;">公众号二维码上传成功后将显示在专栏页和文章底部</p>
                    <button type="button" class="btn btn-default saveUserInfo">保存</button>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('js')
  @include('front.auth.usercenter_js')
  <script type="text/javascript">
      //保存信息
      $('.saveUserInfo').click(function(){
            $.zcjyRequest('/ajax/update_user',function(res){
                    if(res){
                        $.alert(res);
                        location.reload();
                    }
            },$('form').serialize(),'POST');
      });
      //用户性别切换
      $('.user_sex').click(function(){
            $('.user_sex').prop('checked',false);
            $(this).prop('checked',true);
            $(this).parent().parent().find('input').val($(this).val());
      });
      $('.form-control').each(function(index, el) {
          if($(this).val()){
            $(this).css({'border':'none','background-color':'#eee'});
          }else{
            $(this).css({'border':'1px solid #ccc','background-color':'none'});
          }
      });
  </script>
@endsection