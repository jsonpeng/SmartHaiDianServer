@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Lifesmart场景管理</h1>
       <!--  <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('lfScenes.create') !!}">Add New</a>
        </h1> -->
        <div class="row">
            <a class="btn btn-sm col-sm-1" href="{!! route('lfScenes.index') !!}" @if(empty(Request::get('agt'))) style="color:red;" @endif>
                设备场景
            </a>
            <a class="btn btn-sm col-sm-1" href="{!! route('lfScenes.index') !!}?agt=A3QAAABGAD4DRzcyMjc1NQ" @if(Request::get('agt')) style="color:red;" @endif>
                沙盘场景
            </a>
        </div>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('lf_scenes.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

