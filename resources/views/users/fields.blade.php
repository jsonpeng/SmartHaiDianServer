<!-- Uuid Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('uuid', 'Uuid:') !!}
    {!! Form::text('uuid', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '姓名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Pwd Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pwd', '开锁密码:') !!}
    {!! Form::text('pwd', null, ['class' => 'form-control']) !!}
</div>

<!-- Welcome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('welcome', '欢迎语:') !!}
    {!! Form::text('welcome', null, ['class' => 'form-control']) !!}
</div>

<!-- Welcome Sound Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('welcome_sound_url', '欢迎语音频地址:') !!}
    {!! Form::text('welcome_sound_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', '手机号:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Sex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sex', '性别:') !!}
    <?php $arr = ['0'=>'女','1'=>'男'];?>
    {!! Form::select('sex', $arr,null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('scene_id', '用户偏好场景:') !!}
    <select name="scene_id" class="form-control">
            <option value="" @if(!isset($user) || isset($user) && empty(app('common')->PreferenceRepo()->userPreferenceScene($user->id))) selected="selected" @endif>无</option>
        @foreach($scenes as $scene)
            <option value="{!! $scene->id !!}" @if(isset($user) && app('common')->PreferenceRepo()->userPreferenceScene($user->id) == $scene->id) selected="selected" @endif>{!! $scene->name !!} [{!! app("common")->RegionRepo()->getNameById($scene->region_id) !!}]</option>
        @endforeach
    </select>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">返回</a>
</div>
