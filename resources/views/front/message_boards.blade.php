@extends('front.partial.base')

@section('css')
	<style type="text/css">
		.reply-box{
			margin-top: 30px;
		}
		.reply-box .more{
	        padding-top:30px;
	        text-align:right;
	    }
        .reply-box .more a{
          color:#fff;
          background-color: #008837;
          padding:8px 34px;
          border-radius: 15px;
          border: 1px solid #008837;
        }
        .reply-box .more a:first-child{
        	background-color: transparent;
        	color:#008837;
        	margin-right: 20px;
        }
        @keyframes mypraise{
			0% {
			    top: -20px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
			25% {
			    top: -22.5px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			50% {
			    top: -25px;
			    opacity: 1;
			    filter: Alpha(opacity=100);
			    -moz-opacity: 1;
			}
			75% {
			    top: -27.5px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			100% {
			    top: -30px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
		}
		@-webkit-keyframes mypraise{
			0% {
			    top: -20px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
			25% {
			    top: -25px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			50% {
			    top: -30px;
			    opacity: 1;
			    filter: Alpha(opacity=100);
			    -moz-opacity: 1;
			}
			75% {
			    top: -25px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			100% {
			    top: -20px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
		}
		@-moz-keyframes mypraise{
			0% {
			    top: -20px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
			25% {
			    top: -25px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			50% {
			    top: -30px;
			    opacity: 1;
			    filter: Alpha(opacity=100);
			    -moz-opacity: 1;
			}
			75% {
			    top: -25px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			100% {
			    top: -20px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
		}
		@-o-keyframes mypraise{
			0% {
			    top: -20px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
			25% {
			    top: -25px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			50% {
			    top: -30px;
			    opacity: 1;
			    filter: Alpha(opacity=100);
			    -moz-opacity: 1;
			}
			75% {
			    top: -25px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			100% {
			    top: -20px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
		}
		@keyframes myfirst{
			0% {
			    background-size: 15px 15px;
			}
			50% {
			    background-size: 20px 20px;
			}
			100% {
			    background-size: 15px 15px;
			}
		}
		@-webkit-keyframes myfirst{
			0% {
			    background-size: 15px 15px;
			}
			50% {
			    background-size: 20px 20px;
			}
			100% {
			    background-size: 15px 15px;
			}
		}
		@-moz-keyframes myfirst{
			0% {
			    background-size: 15px 15px;
			}
			50% {
			    background-size: 20px 20px;
			}
			100% {
			    background-size: 15px 15px;
			}
		}
		@-o-keyframes myfirst{
			0% {
			    background-size: 15px 15px;
			}
			50% {
			    background-size: 20px 20px;
			}
			100% {
			    background-size: 15px 15px;
			}
		}
		.animation{
			animation: myfirst 0.5s;
			-webkit-animation: myfirst 0.5s;
			-moz-animation: myfirst 0.5s;
			-o-animation: myfirst 0.5s;
		}
		.add-animation{
		    animation: mypraise 0.5s ;
		    -moz-animation: mypraise 0.5s ;	/* Firefox */
		    -webkit-animation: mypraise 0.5s ;	/* Safari 和 Chrome */
		    -o-animation: mypraise 0.5s ;	/* Opera */
		}
	</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
	<div class="container main-box">
		@include('front.partial.leftnav')
		<div class="main ">
			@include('front.comment.tem')
		</div>
		<div class="clearfix"></div>
	</div>
@endsection

@include('front.comment.js')