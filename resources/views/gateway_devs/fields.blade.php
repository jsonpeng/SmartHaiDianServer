<!-- Me Field -->
<div class="form-group col-sm-6">
    {!! Form::label('me', 'Me:') !!}
    {!! Form::text('me', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('gatewayDevs.index') !!}" class="btn btn-default">Cancel</a>
</div>
