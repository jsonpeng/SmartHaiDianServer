@extends('front.partial.base')

@section('css')
<style type="text/css">
    
</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}|我的发布</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
    <section class="container news-main main usercenter">
        @include('front.auth.usercenter_nav')
        <div class="news-list">
            @foreach($posts as $post)
                <a href="/post/{!! $post->id !!}" class="news-item media">
                    <div class="media-left">
                        <div class="img-box" >
                            <img  src="{!! $post->image !!}" onerror="javascript:this.src='{{asset('images/item1.jpg')}}';" alt="">
                        </div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            {!! $post->name !!}
                        </h4>
                        <div class="total">{!! $post->view !!}</div>
                        <p class="hidden-xs">
                          {!! des($post->content,120) !!}
                        </p>
                        <div class="user">
                            <span class="user-time">{!! time_parse($post->created_at)->format('Y-m-d') !!}</span>
                            <span class="more pull-right deletePost">删除</span>
                        </div>
                    </div>
                </a>
            @endforeach
       {{--      <div class="get-more">
                <a href="javascript:;"></a>
            </div> --}}
        </div>
    </section>
@endsection

@section('js')
 {{-- @include('front.auth.usercenter_js') --}}
 <script type="text/javascript">
     $('.deletePost').click(function(){
        $(this).parent().parent().parent().remove();
     });
 </script>
@endsection