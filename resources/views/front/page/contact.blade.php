@extends('front.partial.base')

@section('css')
	
	<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
	<style>
		#map_canvas td{
			box-sizing: content-box;
		}
	</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
	<h1>联系我们</h1>
@endsection


@section('js')


@endsection

