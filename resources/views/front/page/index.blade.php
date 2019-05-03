@extends('front.partial.base')

@section('css')

@endsection

{{-- @include('front.page.seo') --}}

@section('content')
<div class="container main-box mt30">
		<div class="main ">
			<div class="content">
				<div class="detail-title text-center reveal1">
					<h4>{!! $page->name !!}</h4>
					<p class="mt15 mb25">
					{{-- 	<span>发布者 : {!! getSettingValueByKeyCache("name") !!}</span> --}}
						<span class="news-date">{!! time_parse($page->created_at)->format('Y/m/d') !!}</span>
					</p>
				</div>
				<div class="detail-content">
					<p>{!! $page->content !!}</p>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
@endsection


@section('js')
	<script type="text/javascript">
	    var mySwiper = new Swiper ('.swiper-container', {
		    // Optional parameters
		    loop: true,
	  	})
	</script>
@endsection