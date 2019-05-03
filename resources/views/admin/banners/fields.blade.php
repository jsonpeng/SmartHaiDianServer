
<!-- Link Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@if($online)
	{!! Form::hidden('slug', null, ['class' => 'form-control']) !!}
@else
<!-- Sort Field -->
<div class="form-group col-sm-12">
    {!! Form::label('slug', '别名:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control','disabled'=>isset($banner) ? true : false]) !!}
</div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="" class="btn btn-default">取消</a>
</div>
