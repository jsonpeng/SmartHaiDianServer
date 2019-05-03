@extends('layouts.app')

@section('content')
    <?php $scene_id = Request::get("scene_id");?>
    <section class="content-header">
        <h1 class="pull-left">联动命令管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('devCommands.create') !!}@if($scene_id)?scene_id={!! $scene_id !!}@endif">添加</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('dev_commands.table')
            </div>
        </div>
        <div class="text-center">
          {!! $devCommands->appends($input)->links() !!}
        </div>
    </div>
@endsection

