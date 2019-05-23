<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', '场景名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', '场景描述:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::label('image', '场景图片:') !!}
         <div class="form-group">

                <div class="input-append">
                    {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'image']) !!}
                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image')">选择图片</a>
                    <img src="@if(isset($devScene)) {{$devScene->image}} @endif" style="max-width: 100%; max-height: 150px; display: block;">
                </div>

        </div>
</div>

<!-- Enabled Field -->
<div class="form-group col-sm-12">
    {!! Form::label('enabled', '是否开启场景:') !!}
    <select name="enabled" class="form-control">
        <option value="1" @if(isset($devScene) && $devScene->enabled) selected="selected" @endif>开启</option>
        <option value="0" @if(isset($devScene) && !$devScene->enabled) selected="selected" @endif>不开启</option>
    </select>
</div>

<!-- Region Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('region_id', '应用区域(一个区域只能同时开启一个场景):') !!}
    <select name="region_id" class="form-control">
        @foreach($Regions as $item)
            <option value="{!! $item->id !!}" @if(isset($devScene) && $devScene->region_id == $item->id) selected="selected" @endif>{!! $item->des !!}</option>
        @endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('devScenes.index') !!}" class="btn btn-default">返回</a>
</div>
