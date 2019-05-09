@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gateway Dev
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($gatewayDev, ['route' => ['gatewayDevs.update', $gatewayDev->id], 'method' => 'patch']) !!}

                        @include('gateway_devs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection