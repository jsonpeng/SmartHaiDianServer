<!-- Uuid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('uuid', 'Uuid:') !!}
    {!! Form::text('uuid', null, ['class' => 'form-control']) !!}
</div>

<!-- Elecollector Uuid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('elecollector_uuid', 'Elecollector Uuid:') !!}
    {!! Form::text('elecollector_uuid', null, ['class' => 'form-control']) !!}
</div>

<!-- Mac Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mac', 'Mac:') !!}
    {!! Form::text('mac', null, ['class' => 'form-control']) !!}
</div>

<!-- Sn Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sn', 'Sn:') !!}
    {!! Form::text('sn', null, ['class' => 'form-control']) !!}
</div>

<!-- Elemeter Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('elemeter_type', 'Elemeter Type:') !!}
    {!! Form::text('elemeter_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version', 'Version:') !!}
    {!! Form::text('version', null, ['class' => 'form-control']) !!}
</div>

<!-- Onoff Line Field -->
<div class="form-group col-sm-6">
    {!! Form::label('onoff_line', 'Onoff Line:') !!}
    {!! Form::text('onoff_line', null, ['class' => 'form-control']) !!}
</div>

<!-- Onoff Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('onoff_time', 'Onoff Time:') !!}
    {!! Form::text('onoff_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Bind Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bind_time', 'Bind Time:') !!}
    {!! Form::text('bind_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', 'Model:') !!}
    {!! Form::text('model', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_name', 'Model Name:') !!}
    {!! Form::text('model_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Brand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand', 'Brand:') !!}
    {!! Form::text('brand', null, ['class' => 'form-control']) !!}
</div>

<!-- Operation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operation', 'Operation:') !!}
    {!! Form::text('operation', null, ['class' => 'form-control']) !!}
</div>

<!-- Operation Stage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operation_stage', 'Operation Stage:') !!}
    {!! Form::text('operation_stage', null, ['class' => 'form-control']) !!}
</div>

<!-- Charger Stage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('charger_stage', 'Charger Stage:') !!}
    {!! Form::text('charger_stage', null, ['class' => 'form-control']) !!}
</div>

<!-- Overdraft Stage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('overdraft_stage', 'Overdraft Stage:') !!}
    {!! Form::text('overdraft_stage', null, ['class' => 'form-control']) !!}
</div>

<!-- Capacity Stage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('capacity_stage', 'Capacity Stage:') !!}
    {!! Form::text('capacity_stage', null, ['class' => 'form-control']) !!}
</div>

<!-- Trans Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trans_status', 'Trans Status:') !!}
    {!! Form::text('trans_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Trans Status Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('trans_status_time', 'Trans Status Time:') !!}
    {!! Form::text('trans_status_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('devElectricityMeters.index') !!}" class="btn btn-default">Cancel</a>
</div>
