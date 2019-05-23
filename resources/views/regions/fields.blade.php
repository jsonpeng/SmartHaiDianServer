<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '地区name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Desc Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('des', '地区描述:') !!}
    {!! Form::textarea('des', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('image', '区域图片:') !!}
         <div class="form-group">

                <div class="input-append">
                    {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image')">选择图片</a>
                    <img src="@if(isset($region)) {{$region->image}} @endif" style="max-width: 100%; max-height: 150px; display: block;">
                </div>

        </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('regions.index') !!}" class="btn btn-default">返回</a>
</div>
