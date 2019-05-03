@extends('front.partial.base')

@section('css')
<style type="text/css">
    .authentication .steps:before{
        border-top: 4px solid #1976d3;
    }
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
    .authentication.success .steps:before,.authentication.success .steps:after{
        border-top: 4px solid #1976d3;
    }
</style>
@endsection

@section('seo')
    <title>{!! getSettingValueByKey('name') !!}-发起认证</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')

    @if($type == '个人')
            <!-- 个人认证 -->
            <section class="container main authentication" >
                <h3 class="title">填写个人认证信息</h3>
                <ul class="steps text-center">
                    <li class="step step1 pull-left active" data-content="认证类型">
                        <span>1</span>
                    </li>
                    <li class="step step2 active" data-content="认证资料">
                        <span>2</span>
                    </li>
                    <li class="step step3 pull-right" data-content="等待审核">
                        <span>3</span>
                    </li>
                </ul>
                <form class="fill-info">
                    <input type="hidden" name="type" value="{!! $type !!}" />
                    <input type="hidden" name="id_card_time_type" value="永久" >
                    <div class="form-group zhengjian-type">
                        <label for="exampleInputName2" class="col-md-2">
                            <span class="xing">*</span>证件类型：
                        </label>
                        <div class="col-md-10">
                            <div class="btn-group">
                                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    身份证 <span class="caret"></span>
                                </button>  
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group name">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>身份证姓名：
                        </label>
                        <div class="col-md-10">
                            <input type="text" name="id_card_name" class="form-control" id="exampleInputName2" placeholder="请输入您的真实姓名">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>身份证号码：
                        </label>
                        <div class="col-md-10">
                            <input type="text" name="id_card_num" class="form-control" id="exampleInputName2" placeholder="请输入您的身份证号码">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2" style="padding-right: 5px;">
                            <span class="xing">*</span>身份证截止时间：
                        </label>
                        <div class="col-md-10">
                            <label class="radio-inline" style="margin-right: 40px;">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="永久有效" checked> 永久有效
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="截止日期"> 截止日期
                            </label>
                            <div style="display: none;" class="show-date">
                                <input type="text" class="form-control" name="id_card_end_time" id="close-date" placeholder="请输入身份证截止日期">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group uploads">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>证件上传：
                        </label>
                        <div class="col-md-10" style="padding-top: 60px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload1.png')}}" alt="" class="img-responsive type_files">
                                        <input type="hidden" name="id_card_zhengmian" />
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload2.png')}}" alt=""  class="img-responsive type_files">
                                        <input type="hidden" name="id_card_fanmian" />
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload3.png')}}" alt=""  class="img-responsive type_files">
                                        <input type="hidden" name="id_card_shouchi" />
                                    </a>
                                </div>
                            </div>
                            
                            <div class="checkbox">
                                <label style="line-height:1.4;">
                                    <input type="checkbox" class="reg_protol">我已阅读并接受<a href="">《服务协议》</a>
                                </label>
                            </div>
                            <button type="button" class="btn btn-default btn_bottom">提交</button>
                            <button type="button" class="btn btn-default return">返回上一步</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </section>

        @elseif($type == '企业')
            <!-- 企业认证 -->
            <section class="container main authentication">
                <h3 class="title">填写企业认证信息</h3>
                <ul class="steps text-center">
                    <li class="step step1 pull-left active" data-content="认证类型">
                        <span>1</span>
                    </li>
                    <li class="step step2 active" data-content="认证资料">
                        <span>2</span>
                    </li>
                    <li class="step step3 pull-right" data-content="等待审核">
                        <span>3</span>
                    </li>
                </ul>
                <form class="fill-info">
                    <input type="hidden" name="type" value="{!! $type !!}" />
                    <input type="hidden" name="id_card_time_type" value="永久" >
                    <p class="title">主体信息</p>
                    <div class="form-group name">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>企业名称：
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="organization_name" id="organization_name" placeholder="" style="width:100%;">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2" style="line-height: 30px;">
                            <span style="display:inline-block;padding-left: 27px;">企业营业<br>执照注册号：</span>
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="organization_code" id="organization_code" placeholder="" style="width:100%;">
                            <p style="margin-top: 14px;font-size:16px;color:#969696;">若有15位营业执照注册号或者统一社会信用代码请务必填写，并与营业执照上保持一致，若没有可暂时不填写</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group erweima">
                        <label for="erweima" style="margin-top: 20px;line-height: 30px;" class="col-md-2">
                            <span class="xing" style="display: inline-block;vertical-align: top;line-height: 60px;">*</span>
                            <span style="display:inline-block;">企业营业<br>执照扫描件:</span>
                        </label>
                        <div class="col-md-10">
                            <a href="javascript:;" class="attach">
                                <img src="{{asset('images/add-image.png')}}" style="width:206px; height:206px;" alt="" class="img-rounded type_files">
                                <input type="hidden" name="organization_img" />
                            </a>
                            <p style="margin-top: 14px;font-size:16px;color:#969696;">请上传营业执照扫描件，要求内容清晰可见，大小不超过5M</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p class="title" style="margin-top: 60px;">运营者信息</p>
                    <div class="form-group zhengjian-type">
                        <label for="exampleInputName2" class="col-md-2">
                            <span class="xing">*</span>证件类型：
                        </label>
                        <div class="col-md-10">
                            <div class="btn-group">
                                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    身份证 <span class="caret"></span>
                                </button> 
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group name">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>身份证姓名：
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="id_card_name" id="exampleInputName2" placeholder="请输入您的真实姓名">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>身份证号码：
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="id_card_num" id="exampleInputName2" placeholder="请输入您的身份证号">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2" style="padding-right: 5px;">
                            <span class="xing">*</span>身份证截止时间：
                        </label>
                        <div class="col-md-10">
                            <label class="radio-inline" style="margin-right: 40px;">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="永久有效" checked> 永久有效
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="截止日期"> 截止日期
                            </label>
                            <div style="display: none;" class="show-date">
                                <input type="text" class="form-control" name="id_card_end_time" id="close-date" placeholder="请输入身份证截止日期">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group uploads">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>证件上传：
                        </label>
                        <div class="col-md-10" style="padding-top: 60px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload1.png')}}" alt="" class="img-responsive type_files">
                                        <input type="hidden" name="id_card_zhengmian" />
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload2.png')}}" alt=""  class="img-responsive type_files">
                                        <input type="hidden" name="id_card_fanmian" />
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload3.png')}}" alt=""  class="img-responsive type_files">
                                        <input type="hidden" name="id_card_shouchi" />
                                    </a>
                                </div>
                            </div>
                            
                            <div class="checkbox">
                                <label style="line-height:1.4;">
                                    <input type="checkbox" class="reg_protol">我已阅读并接受<a href="">《服务协议》</a>
                                </label>
                            </div>
                            <button type="button" class="btn btn-default btn_bottom">提交</button>
                            <button type="button" class="btn btn-default return">返回上一步</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>
            </section>

        @elseif($type == '媒体')
            <!-- 媒体认证 -->
            <section class="container main authentication">
                <h3 class="title">填写媒体认证信息</h3>
                <ul class="steps text-center">
                    <li class="step step1 pull-left active" data-content="认证类型">
                        <span>1</span>
                    </li>
                    <li class="step step2 active" data-content="认证资料">
                        <span>2</span>
                    </li>
                    <li class="step step3 pull-right" data-content="等待审核">
                        <span>3</span>
                    </li>
                </ul>
                <form class="fill-info">
                    <input type="hidden" name="type" value="{!! $type !!}" />
                    <input type="hidden" name="id_card_time_type" value="永久" >
                    <p class="title">主体信息</p>
                    <div class="form-group name">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>组织名称：
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="organization_name" id="organization_name" placeholder="" style="width:100%;">
                            <p style="margin-top: 14px;font-size:16px;color:#969696;">请填写组织机构代码证中的组织名称，注册成功后组织名称不可修改</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2" style="line-height: 30px;">
                            <span style="display:inline-block;padding-left: 27px;">组织机构<br>代码：</span>
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="organization_code" id="organization_code" placeholder="" style="width:100%;">
                            <p style="margin-top: 14px;font-size:16px;color:#969696;">若有9位组织机构代码或者18位的统一社会信用代码请务必填写，若没有可暂时不填写</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group erweima">
                        <label for="erweima" style="margin-top: 20px;line-height: 30px;" class="col-md-2">
                            <span class="xing" style="display: inline-block;vertical-align: top;line-height: 60px;">*</span>
                            <span style="display:inline-block;">营业执照<br>扫描件:</span>
                        </label>
                        <div class="col-md-10">
                            <a href="javascript:;" class="attach">
                                <img src="{{asset('images/add-image.png')}}" style="width:206px; height:206px;" alt="" class="img-rounded type_files">
                                <input type="hidden" name="organization_img" />
                            </a>
                            <p style="margin-top: 14px;font-size:16px;color:#969696;">请上传营业执照扫描件，要求内容清晰可见，大小不超过5M</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p class="title" style="margin-top: 60px;">运营者信息</p>
                    <div class="form-group zhengjian-type">
                        <label for="exampleInputName2" class="col-md-2">
                            <span class="xing">*</span>证件类型：
                        </label>
                        <div class="col-md-10">
                            <div class="btn-group">
                                <button class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    身份证 <span class="caret"></span>
                                </button>  
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group name">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>身份证姓名：
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="id_card_name" id="id_card_name" placeholder="请输入您的真实姓名">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>身份证号码：
                        </label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="id_card_num" id="id_card_num" placeholder="请输入您的身份证号">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2" style="padding-right: 5px;">
                            <span class="xing">*</span>身份证截止时间：
                        </label>
                        <div class="col-md-10">
                            <label class="radio-inline" style="margin-right: 40px;">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="永久有效" checked> 永久有效
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="截止日期"> 截止日期
                            </label>
                            <div style="display: none;" class="show-date">
                                <input type="text" class="form-control" name="id_card_end_time" id="close-date" placeholder="请输入身份证截止日期">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                   
                    <div class="form-group uploads">
                        <label for="" class="col-md-2">
                            <span class="xing">*</span>证件上传：
                        </label>
                        <div class="col-md-10" style="padding-top: 60px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload1.png')}}" alt="" class="img-responsive type_files">
                                        <input type="hidden" name="id_card_zhengmian" />
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload2.png')}}" alt=""  class="img-responsive type_files">
                                        <input type="hidden" name="id_card_fanmian" />
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:;" class="attach">
                                        <img src="{{asset('images/upload3.png')}}" alt=""  class="img-responsive type_files">
                                        <input type="hidden" name="id_card_shouchi" />
                                    </a>
                                </div>
                            </div>
                            
                            <div class="checkbox">
                                <label style="line-height:1.4;">
                                    <input type="checkbox" class="reg_protol">我已阅读并接受<a href="">《服务协议》</a>
                                </label>
                            </div>
                            <button type="button" class="btn btn-default btn_bottom">提交</button>
                            <button type="button" class="btn btn-default return">返回上一步</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>
            </section>
    @endif

   
@endsection

@section('js')
    @include('front.auth.usercenter_js')
    <script type="text/javascript">
        $('.radio-inline').each(function(index, el) {
            $(this).click(function() {
                if(index==1){
                    $('input[name="id_card_time_type"]').val($(this).children().val());

                    $('.show-date').show();

                }else{
                    $('.show-date').hide();

                }
            });
        });
            //表单提交验证
        function formVarified(){
            $('.btn_bottom').removeClass('disabled').removeAttr('disabled');

            $.inputAttr('name,id_card').each(function(){
                if($.empty($(this).val())){
                    //console.log($(this));
                    $('.btn_bottom').addClass('disabled').attr('disabled','true');
                }
            });

        }
        //formVarified();
        //输入姓名身份证号
        $.inputAttr('name,id_card').keyup(function(){
            formVarified();
        });


        //点击提交审核
        $('.btn_bottom').click(function(){
            if(!$('.reg_protol').prop('checked')){
                $.alert('请先同意协议','error');
                return;
            }
            $.zcjyRequest('/ajax/certs/publish',function(res){
                console.log(1);
                if(res){
                    $.alert(res);
                    location.href="/user/center/certs";
                }
            },$('form').serialize(),'POST');
        });

        $('.return').click(function(){
            history.back(-1);
        });
        function verifyIdcard(card){
            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;  
            if(reg.test(card) === false){  
               alert("身份证输入不合法");  
               return  false;  
            }  
        }
    </script>
@endsection