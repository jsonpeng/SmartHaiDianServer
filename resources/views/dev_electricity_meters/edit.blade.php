@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Dev Electricity Meter
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($devElectricityMeter, ['route' => ['devElectricityMeters.update', $devElectricityMeter->id], 'method' => 'patch']) !!}

                        @include('dev_electricity_meters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection