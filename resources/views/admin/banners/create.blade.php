@extends('layouts.app')

@section('content')
    <div class="input-append" style="text-align: center;display: none;">
        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" id="seeImg">查看设计图片</a>
        <img src="" style="width: 100%; height: auto; display: block;">
    </div>
    @include('admin.partial.imagemodel')
@endsection

@section('scripts')
<script type="text/javascript">
	$("#seeImg").click();
	$(".close").css("display","none");

	$(document).on('click',':not(.modal)',function(){
          location.reload();
     })
</script>
@endsection
