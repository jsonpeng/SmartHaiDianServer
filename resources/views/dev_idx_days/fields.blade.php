<!-- Idx Field -->
<div class="form-group col-sm-12">
    {!! Form::label('idx', '设备类型:') !!}
    {!! Form::text('idx', null, ['class' => 'form-control']) !!}
</div>

<!-- Val Field -->
<div class="form-group col-sm-12">
    {!! Form::label('val', '取值:') !!}
    {!! Form::text('val', null, ['class' => 'form-control']) !!}
</div>

<!-- Record At Field -->
<div class="form-group col-sm-12">
    {!! Form::label('record_at', '纪录时间:') !!}
    {!! Form::text('record_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('devIdxDays.index') !!}" class="btn btn-default">返回</a>
</div>
