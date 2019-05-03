@extends('front.partial.base')

@section('css')
	<style>

	</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
<section class="container news-main main usercenter">
	<h3 class="title">搜索结果<span style="color:#666;margin-left: 10px;font-size:16px;">已为您找到相关结果{!! $count !!}个</span></h3>
	<div class="news-list">
        @foreach($messages as $item)
            <a href="/post/{!! $item->id !!}" class="news-item media">
                <div class="media-left">
                    <div class="img-box">
                        <img onerror="javascript:this.src='{{asset('images/item1.jpg')}}';" src="{!! $item->image !!}" alt="">
                    </div>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        {!! $item->name !!}
                    </h4>
                    <div class="total hidden-xs">{!! $item->view !!}</div>
                    <p class="hidden-xs">
                        {!! des($item->content,120) !!}
                    </p>
                    <div class="user hidden-xs">
                        <span class="user-time">{!! time_parse($item->created_at)->format('Y-m-d') !!}</span>
                        <span class="user-name">郭敬明</span>
                    </div>
                    <div class="user visible-xs">
                        <div class="info" style="padding:8px 0;">
                            <span class="user-time">{!! time_parse($item->created_at)->format('Y-m-d') !!}</span>
                            <span class="user-name">郭敬明</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    {{--     <div class="get-more">
            <a href="javascript:;"></a>
        </div> --}}
    </div>
</section>
@endsection
	

@section('js')

@endsection
