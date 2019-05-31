<!-- Uuid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('uuid', '电表唯一uuid:') !!}
    {!! Form::text('uuid', null, ['class' => 'form-control']) !!}
</div>

<!-- Mac Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mac', '设备MAC地址:') !!}
    {!! Form::text('mac', null, ['class' => 'form-control']) !!}
</div>

<!-- Sn Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sn', '设备序列号:') !!}
    {!! Form::text('sn', null, ['class' => 'form-control']) !!}
</div>

<!-- Onoff Line Field -->
<div class="form-group col-sm-6">
    {!! Form::label('onoff_line', '电表状态:') !!}
    {!! Form::text('onoff_line', null, ['class' => 'form-control']) !!}
</div>

<!-- Bind Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bind_time', '设备注册时间时间戳:') !!}
    {!! Form::text('bind_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '电表名字:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', '设备类型:') !!}
    {!! Form::text('model', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model_name', '设备型号名称:') !!}
    {!! Form::text('model_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Brand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand', '品牌:') !!}
    {!! Form::text('brand', null, ['class' => 'form-control']) !!}
</div>



<div class="form-group col-sm-6">
    {!! Form::label('power_total', '总电量:') !!}
    {!! Form::text('power_total', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('capacity', '额定功率:') !!}
    {!! Form::text('capacity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('consume_amount', '电表当前电量:') !!}
    {!! Form::text('consume_amount', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('region_id', '区域:') !!}
    <select name="region_id" class="form-control">
        @foreach($Regions as $item)
            <option value="{!! $item->id !!}" @if(isset($devLight) && $devLight->region_id == $item->id) selected="selected" @endif>{!! $item->des !!}</option>
        @endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('devElectricityMeters.index') !!}" class="btn btn-default">返回</a>
</div>
