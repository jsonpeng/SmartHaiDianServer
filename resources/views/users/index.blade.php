@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">门锁用户配置</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users.create') !!}">添加</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('users.table')
            </div>
        </div>
        <div class="text-center">
            {!! $users->links() !!}
        </div>
    </div>
@endsection


@section('scripts')
<script type="text/javascript">
    $('.triggerUser').click(function(){
        var user_id = $(this).data('id');
        $.zcjyRequest('/ajax/trigger_user_pre/'+user_id,function(res){
            if(res)
            {
                $.alert(res);
            }
        });
    });
</script>
@endsection

