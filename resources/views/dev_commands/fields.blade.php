<?php $devices = \Smart::getCanUseDevices(Request::get('scene_id'));?>


<!-- Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag', '命令描述:') !!}
    {!! Form::text('tag', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('device', '请选择可用的设备:') !!}
    <select class="form-control selectDevices">
        @foreach($devices as $device)
            <option value="{!! $device['me'] !!}" supportidx="{!! $device['supportIdx'] !!}" @if(isset($devCommand) && $devCommand->me == $device['me']) selected="selected" @endif>{!! $device['name'] !!}</option>
        @endforeach
    </select>
</div>

{!! Form::hidden('me', null, ['class' => 'form-control']) !!}

<!-- Idx Field -->
<div class="form-group col-sm-6">
    {!! Form::label('idx', 'Idx:') !!}
    {!! Form::select('idx',$idx,null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type',$type,null, ['class' => 'form-control']) !!}
</div>

<!-- Val Field -->
<div class="form-group col-sm-6">
    {!! Form::label('val', 'Val:') !!}
    {!! Form::text('val', null, ['class' => 'form-control']) !!}
    <div class="row">
    <div class="col-sm-6 col-xs-12">
        <p>精选颜色(适用RGBW[灯泡,灯带]):</p>
        <p>橙色:16734720</p>
        <p>红色:16720896 16717312</p>
        <p>黄色:16755200 15138560</p>
        <p>紫色:16711760 6553855 2949375</p>
        <p>绿色:1376000  65320</p>
        <p>蓝色:65520</p>
        <p>白色:4278196580 4278206719</p>
        <p>精选颜色(适用RGB[超级碗]):</p>
        <p>白色:16645629 10333693</p>
    </div>
    <div class="col-sm-6 col-xs-12">
        <p>精选动态光(仅适用DYN超级碗也可以用)</p>
        <p>青草  0x8218cc80</p>
        <p>海浪  0x8318cc80</p>
        <p>深蓝山脉    0x8418cc80</p>
        <p>紫色妖姬    0x8518cc80</p>
        <p>树莓  0x8618cc80</p>
        <p>橙光  0x8718cc80</p>
        <p>冰淇淋 0x8918cc80</p>
        <p>魔力红 0x9318cc80</p>
        <p>秋实  0x8818cc80</p>
        <p>高原  0x8020cc80</p>
        <p>披萨  0x8120cc80</p>
        <p>果汁  0x8a20cc80</p>
        <p>光斑  0x9518cc80</p>
        <p>晨曦  0x9618cc80</p>
        <p>木槿  0x9818cc80</p>
        <p>温暖小屋    0x8b30cc80</p>
        <p>蓝粉知己    0x9718cc80</p>
        <p>缤纷时代    0x9918cc80</p>
        <p>天上人间    0xa318cc80</p>
        <p>魅蓝  0xa718cc80</p>
        <p>炫红  0xa918cc80</p>
    </div>
</div>
</div>



<!-- Agt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('agt', 'Agt:') !!}
    {!! Form::text('agt', getSettingValueByKey('agt') , ['class' => 'form-control']) !!}
</div>


<?php $scene_id = Request::get('scene_id');?>

<!-- Scene Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scene_id', '应用场景:') !!}
    <select name="scene_id" class="form-control">
        @foreach($scenes as $scene)
            <option value="{!! $scene->id !!}" @if(isset($devCommand) && $devCommand->scene_id == $scene->id || $scene_id == $scene->id) selected="selected" @endif>{!! $scene->name !!}</option>
        @endforeach
    </select>
</div>

@if($scene_id)
<input type="hidden" name="_scene_id" value="{!! $scene_id !!}">
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('devCommands.index') !!}@if($scene_id)?scene_id={!! $scene_id !!}@endif" class="btn btn-default">返回</a>
</div>
