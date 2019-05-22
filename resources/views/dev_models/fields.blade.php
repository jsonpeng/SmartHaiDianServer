<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '模型分类名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12">
    {!! Form::label('image', '模型图片:') !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-12">
    {!! Form::label('model', '型号:') !!}
    {!! Form::text('model', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('devModels.index') !!}" class="btn btn-default">返回</a>
</div>
