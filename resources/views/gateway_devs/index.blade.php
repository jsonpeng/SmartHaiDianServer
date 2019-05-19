@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">当前网关设备</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right seeDetail" style="margin-top: -10px;margin-bottom: 5px" href="javascript:;">查看详细</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('gateway_devs.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.seeDetail').click(function(){
        $('tr>th:last').toggle();
        $('.detailTd').toggle();
    });
</script>
@endsection
