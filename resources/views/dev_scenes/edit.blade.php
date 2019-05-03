@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑场景
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($devScene, ['route' => ['devScenes.update', $devScene->id], 'method' => 'patch']) !!}

                        @include('dev_scenes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection