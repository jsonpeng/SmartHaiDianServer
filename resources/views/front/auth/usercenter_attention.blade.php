@extends('front.partial.base')

@section('css')
<style type="text/css">
    
</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}|我的收藏</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
    <section class="container news-main main usercenter">
        @include('front.auth.usercenter_nav')
        @if(count($posts))
            <div class="news-list">
                @foreach($posts as $post)
                    <a href="/post/{!! $post->id !!}" class="news-item media">
                        <div class="media-left">
                            <div class="img-box">
                                <img src="{!! $post->image !!}" onerror="javascript:this.src='{{asset('images/item1.jpg')}}';" alt="">
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {!! $post->name !!}
                            </h4>
                            <div class="total hidden-xs">{!! $post->view !!}</div>
                            <p class="hidden-xs">
                                {!! des($post->content,120) !!}
                            </p>
                            <div class="user hidden-xs">
                                <span class="user-time">{!! time_parse($post->created_at)->format('Y-m-d') !!}</span>
                                <span class="user-name">{!! $post->Author !!}</span>
                                <span class="more pull-right collectAction" data-id="{!! $post->id !!}">取消收藏</span>
                                {{-- <span class="collect-time pull-right">2018-11-25 收藏</span> --}}
                            </div>
                            <div class="user visible-xs">
                                <div class="info" style="padding:8px 0;">
                                    <span class="user-time">{!! time_parse($post->created_at)->format('Y-m-d') !!}</span>
                                    <span class="user-name">{!! $post->Author !!}</span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="collect-info" style="padding-left:6px;">
                                  {{--   <span class="collect-time pull-left">2018-11-25 收藏</span> --}}
                                    <span class="more pull-right collectAction" data-id="{!! $post->id !!}">取消收藏</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            {{--     <div class="get-more">
                    <a href="javascript:;"></a>
                </div> --}}
            </div>
        @endif
    </section>
@endsection

@section('js')
<script type="text/javascript">
    $('.collectAction').click(function(){
        event.preventDefault(); 
        var post_id = $(this).data('id');
        var parent = $(this).parent().parent().parent();
        $.zcjyRequest('/ajax/action_post/'+post_id,function(res){
                $.alert(res);
                parent.remove();
        },{},'POST');
        event.stopPropagation();
    });
</script>
@endsection