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
               <?php $tools = 1;?>
        <div class="box box-default box-solid mb10-xs @if(!$tools) collapsed-box @endif">
                        <div class="box-header with-border">
                          <h3 class="box-title">查询</h3>
                          <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-{!! !$tools?'plus':'minus' !!}"></i></button>
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="order_search">
                               
                                <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                    <label for="shelf">人脸识别uuid</label>
                                    <input type="text" name="uuid" class="form-control" value="{!! Request::get('uuid') !!}" />
                                </div>

                                <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                    <label for="shelf">姓名</label>
                                     <input type="text" name="name" class="form-control" value="{!! Request::get('name') !!}" />
                                </div>

                                <div class="form-group col-lg-1 col-md-1 hidden-xs hidden-sm" style="padding-top: 25px;">
                                    <button type="submit" class="btn btn-primary pull-right " >查询</button>
                                </div>
                                <div class="form-group col-lg-1 col-md-1 hidden-xs hidden-sm" style="padding-top: 25px;">
                                    <a href="{!! route('users.index') !!}" class="btn btn-primary pull-right " >重置</a>
                                </div>
                                <div class="form-group col-xs-6 visible-xs visible-sm" >
                                    <button type="submit" class="btn btn-primary pull-left " >查询</button>
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('users.table')
            </div>
        </div>
        <div class="text-center">
            {!! $users->appends($input)->links() !!}
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

