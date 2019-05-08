<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Scene Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scene_id', 'Scene Id:') !!}
    {!! Form::text('scene_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('preferences.index') !!}" class="btn btn-default">Cancel</a>
</div>
