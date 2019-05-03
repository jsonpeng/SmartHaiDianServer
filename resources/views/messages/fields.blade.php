<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('info', '公告内容:') !!}
    {!! Form::textarea('info', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('messages.index') !!}" class="btn btn-default">返回</a>
</div>
