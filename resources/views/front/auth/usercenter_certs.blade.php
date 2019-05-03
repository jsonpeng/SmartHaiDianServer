@extends('front.partial.base')

@section('css')
<style type="text/css">
    .authentication-type{
        margin-top: 150px;
    }
    .item{
        padding:0 60px;
        font-size:16px;
        line-height: 27px;
        color:#666;
    }
    .item p{
        font-size:22px;
        margin:22px 0 18px 0;
        color:#333;
    }
</style>
@endsection

@section('seo')
    <title>{!! getSettingValueByKey('name') !!}|实名认证</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
        @if(empty($cert))
            <section class="container main authentication">
                <h3 class="title">认证步骤</h3>
                <ul class="steps text-center">
                    <li class="step step1 pull-left active" data-content="认证类型">
                        <span>1</span>
                    </li>
                    <li class="step step2" data-content="认证资料">
                        <span>2</span>
                    </li>
                    <li class="step step3 pull-right" data-content="等待审核">
                        <span>3</span>
                    </li>
                </ul>
                <div class="authentication-type">
                    <div class="row">
                        <div class="item col-md-4 text-center">
                            <a href="/user/center/certs/publish">
                                <img src="{{asset('images/renzheng1.png')}}" alt="">
                            </a>
                            <p>
                                个人
                            </p>
                            <div class="">适合行业专家、意见领袖、评论 家及自媒体人士申请。</div>
                        </div>
                        <div class="item col-md-4 text-center">
                            <a href="/user/center/certs/publish?type=媒体">
                                <img src="{{asset('images/renzheng2.png')}}" alt="">
                            </a>
                            <p>
                                媒体
                            </p>
                            <div>
                                适合企业、公司，分支机构，企 业相关品牌，产品与服务等。
                            </div>
                        </div>
                        <div class="item col-md-4 text-center">
                            <a href="/user/center/certs/publish?type=企业">
                                <img src="{{asset('images/renzheng3.png')}}" alt="">
                            </a>
                            <p>
                                企业
                            </p>
                            <div>
                                适合各类媒体及有新闻资质的网站 等内容生产公司/机构申请。
                            </div>
                        </div> 
                    </div>
                </div>
            </section>
        @else

            <section class="container main authentication success">
                <h3 class="title">填写个人认证信息</h3>
                <ul class="steps text-center">
                    <li class="step step1 pull-left active" data-content="认证类型">
                        <span>1</span>
                    </li>
                    <li class="step step2 active" data-content="认证资料">
                        <span>2</span>
                    </li>
                    <li class="step step3 pull-right active" data-content="{!! $cert->status !!}">
                        <span>3</span>
                    </li>
                </ul>

                @if($cert->status == '审核中')
                    <div class="result text-center">
                        <img src="{{asset('images/renzheng-success.png')}}" alt="">
                        <h3>提交成功</h3>
                        <p>已经收到您的认证申请，预计在2个工作日内完成审核，请您耐心等待</p>
                        <a href="/" class="btn btn-default">返回首页</a>
                    </div>
                @elseif($cert->status == '已通过')
                    <div class="result text-center">
                        <img src="{{asset('images/renzheng-success.png')}}" alt="">
                        <h3>{!! $cert->status !!}</h3>
                        <p>您的认证当前{!! $cert->status !!},请放心操作</p>
                        <a href="/" class="btn btn-default">返回首页</a>
                    </div>
                @elseif($cert->status == '未通过')   
                    <div class="result text-center">
                        <img src="{{asset('images/renzheng-success.png')}}" alt="">
                        <h3>{!! $cert->status !!}</h3>
                        <p>您的认证当前{!! $cert->status !!}！</p>
                        <a href="/" class="btn btn-default">返回首页</a>
                    </div> 
                @endif
                
            </section>

        @endif
  
@endsection

@section('js')
  {{-- @include('front.auth.usercenter_js') --}}
@endsection