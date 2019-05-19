@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gateway
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($gateway, ['route' => ['gateways.update', $gateway->id], 'method' => 'patch']) !!}

                        @include('gateways.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection