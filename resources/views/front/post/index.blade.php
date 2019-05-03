@extends('front.partial.base')

@section('css')
	<style>
		.main .left-content .ads{
			margin-top: 34px;
		}
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
	        padding-left: 28px;
	    }
	    .main .news-list .news-item .media-body .user .user-name{
	        float:left;
	        padding-left: 28px;
	    }
	    .main .recommend-ad .media{
	        padding:0;
	        position:relative;
	        display: block;
	    }
	    .main .recommend-ad .media .media-left{
	        padding-left: 36px;
	        padding-right: 33px;
	    }
	    @media (max-width:767px){
	    	.main .recommend-ad .media .media-left{
	       		padding:0 15px;
	    	}
	    }
	</style>
@endsection


@section('content')
	<h1>文章详情页</h1>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection

