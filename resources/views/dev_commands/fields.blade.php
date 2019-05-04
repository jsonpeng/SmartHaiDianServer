<?php $devices = \Smart::getCanUseDevices();?>


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
