@extends('front.partial.base')

@section('css')
<style type="text/css">
  .{!! getSettingValueByKeyCache("name") !!}_protocol_search_img{
    position: absolute;
    top: 22px;
    right: 40px;
  }
  .{!! getSettingValueByKeyCache("name") !!}_protocol_link_menu a{
    color: black;
    font-size: 16px;
    display: inline-block;
    margin-left: 30px;
  }
  .{!! getSettingValueByKeyCache("name") !!}_protocol_content{
    border: 1px solid #ccc;
    padding-left: 15px;
    padding-right: 15px;
  }
</style>
@endsection

@section('seo')
	  <title>{!! getSettingValueByKey('name') !!}|平台协议</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
	<div class="container pt100 pb120">
          <div class="row">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-8 p_relative">
                <input class="form-control h60 pl15" placeholder="简单描述您的问题" name="" />
                <img src="/images/{!! getSettingValueByKeyCache("name") !!}/search_gray.png" class="{!! getSettingValueByKeyCache("name") !!}_protocol_search_img" />
              </div>
              <div class="col-sm-2">
              </div>
          </div>

          <div class="pt50 {!! getSettingValueByKeyCache("name") !!}_protocol_link_menu">
            <a>小屋由来</a>
            <a>小屋用户注册协议</a>
            <a>小屋隐私政策</a>
          </div>

          <div class="mt30 {!! getSettingValueByKeyCache("name") !!}_protocol_content pt30">
            <p>小屋用户注册协议</p>
            <p>小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议小屋用户注册协议</p>
          </div>

	</div>
@endsection