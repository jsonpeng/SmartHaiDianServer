@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($devCommand, ['route' => ['devCommands.update', $devCommand->id], 'method' => 'patch']) !!}

                        @include('dev_commands.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@include('dev_commands.js')