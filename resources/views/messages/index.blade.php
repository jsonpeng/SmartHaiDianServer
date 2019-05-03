@extends('layouts.app')

@section('content')
    <section class="content-header">
        {!! Form::open(['route' => ['messages.report']]) !!}
                
      <!--       <button type="submit" class="btn btn-primary pull-left" onclick="report()">全部导出</button> -->

               
        {!! Form::close() !!}

         {!! Form::open(['route' => ['messages.alldel']]) !!}
             <button type="submit" class="btn btn-danger pull-left"  style="margin-left: 10px;">全部删除</button>
         {!! Form::close() !!}
         <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('messages.create') !!}">添加</a>
        </h1> 
    </section>

    <div class="content">
        <div class="clearfix"></div>
  
        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('messages.table')
            </div>
        </div>

        <div style="text-align: center;">{{$messages->links()}}</div>
    </div>
@endsection

