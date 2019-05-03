@extends('front.partial.base')

@section('css')
<style type="text/css">
  
</style>
@endsection

@section('seo')
	<title>{!! getSettingValueByKey('name') !!}|通知中心</title>
    <meta name="keywords" content="{!! getSettingValueByKey('seo_keywords') !!}">
    <meta name="description" content="{!! getSettingValueByKey('seo_des') !!}">
@endsection

@section('content')
    <section class="container news-main main usercenter">
        @include('front.auth.usercenter_nav')
        <div class="notice-list">

            @foreach($notices as $notice)
                <div class="notice-item">
                    <h3>系统消息</h3>
                    <p class="time">{!! time_parse($notice->created_at)->format('Y-m-d') !!}</p>
                    <div class="result">
                        {!! $notice->content !!}
                    </div>
                    <span class="delete" data-id="{!! $notice->id !!}">删除</span>
                </div>
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
    $('.delete').click(function(){
        var that = this;
        var id = $(this).data('id');
        $.zcjyRequest('/ajax/delete_notice/'+id,function(res){
            if(res){
                $.alert(res);
                $(that).parent().remove();
            }
        },{},'POST');
    });
</script>
@endsection