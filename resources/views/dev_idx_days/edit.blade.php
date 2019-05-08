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
                   {!! Form::model($devIdxDay, ['route' => ['devIdxDays.update', $devIdxDay->id], 'method' => 'patch']) !!}

                        @include('dev_idx_days.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@include('dev_idx_days.js')