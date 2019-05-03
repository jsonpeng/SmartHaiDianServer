@extends('front.partial.base')

@section('css')
<style type="text/css">
    .main .news-list .news-item .media-left .img-box{
        width:110px;
    }
    .main .news-list .news-item .media-body h4{
        font-size:18px;
        line-height: 26px;
    }
    .main .news-list .news-item .media-body .user{
        line-height: 20px;
        bottom:10px;
    }
    .main .news-list .news-item .media-body .user .user-time{
        float:right;
        margin-right: 0;
        padding-left: 25px;
    }
    .main .news-list .news-item .media-body .user .user-name{
        float:left;
        padding-left: 25px;
    }
    .main .recommend-ad .media{
        padding:16px 0;
        position:relative;
        display: block;
    }
    .main .recommend-ad .media .media-left{
        padding-left: 36px;
        padding-right: 33px;
    }
</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}|优秀作家</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
    <section class="main container good-writer">
        <div class="pull-left left-content">
            <h3 class="title">
                优秀作家
            </h3>
            @if(count($writers))
            <div class="writer-list">

                <div class="row">

                    @foreach($writers as $writer)
                        <div class="col-md-2 text-center">
                            <img src="{!! $writer->head_image !!}" onerror="javascript:this.src='{{asset('images/write1.jpg')}}';" alt="" class="img-rounded">
                            <p>{!! $writer->ShowName !!}</p>
                        </div>
                    @endforeach
                </div>
        
            </div>
            @endif
        </div>
        <div class="pull-right right-content">
            <div class="apply-box">
                <h3>申请入驻</h3>
                <p>成为专栏作者，让更多人看到您的观点</p>
                <a href="/user/center/certs">申请成为作者</a>
            </div>

            @if(count($posts))
                <div class="expand">
                    <h3 class="title">
                        延伸阅读
                        <a href="">更多</a>
                    </h3>
                    <div class="news-list">
                        @foreach($posts as $post)
                            <a href="/post/{!! $post->id !!}" class="news-item media @if($post->is_top) zhiding @endif">
                                <div class="media-left">
                                    <div class="img-box">
                                        <img onerror="javascript:this.src='{{asset('images/item1.jpg')}}';"  src="{!! $post->image !!}" alt="">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        {!! $post->name !!}
                                    </h4>
                                    <div class="user">
                                        <span class="user-time">{!! time_parse($post->created_at)->format('Y-m-d') !!}</span>
                                        <span class="user-name nowrap">{!! $post->Author !!}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            @endif
      

            @if(count($bottom_guanggao))
                <div class="recommend-ad" style="margin-top: 38px;">

                    @foreach($bottom_guanggao as $guanggao)
                        <a href="{!! $guanggao->link !!}" class="media" target="_blank">
                            <div class="media-left media-middle">
                                <img class=""  onerror="javascript:thissrc='{{asset('images/icon-ad.png')}}';" src="{!! $guanggao->image  !!}" alt="">
                            </div>
                        {{--     <div class="media-body media-middle">
                                <h4 class="media-heading">香港福比特交易所</h4>
                                全球领先的区块链资产交易平台
                            </div>
                            <div class="text">广告</div> --}}
                        </a>
                    @endforeach
                </div>
            @endif
            
 {{--            <div class="recommend-ad">
                <a href="" class="media">
                    <div class="media-left media-middle">
                        <img class="media-object" src="{{asset('images/icon-ad.png')}}" alt="">
                    </div>
                    <div class="media-body media-middle">
                        <h4 class="media-heading">香港福比特交易所</h4>
                        全球领先的区块链资产交易平台
                    </div>
                    <div class="text">广告</div>
                </a>
                <a href="" class="media">
                    <div class="media-left media-middle">
                        <img class="media-object" src="{{asset('images/icon-ad.png')}}" alt="">
                    </div>
                    <div class="media-body media-middle">
                        <h4 class="media-heading">香港福比特交易所</h4>
                        全球领先的区块链资产交易平台
                    </div>
                    <div class="text">广告</div>
                </a>
            </div> --}}
        </div>
        <div class="clearfix"></div>
    </section>
@endsection

@section('js')
    <script>
        $(".nowrap").each(function(){
            var maxwidth=4;
            if($(this).text().length>maxwidth){
                $(this).text($(this).text().substring(0,maxwidth));
                $(this).html($(this).html()+'…');
            }
        });
    </script>
@endsection