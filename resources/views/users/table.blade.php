<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
        <th>人脸识别uuid</th>
        <th>姓名</th>
        <th>开锁密码</th>
        <!-- <th>欢迎语音频地址</th> -->
        <th>性别</th>
        <th>欢迎语</th>
        <!-- <th>用户偏好场景</th> -->
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->uuid !!}</td>
            <td>{!! $user->name !!}</td>
            <td>{!! $user->pwd !!}</td>
            <!-- <td>{!! $user->welcome_sound_url !!}</td> -->
            <!-- <td>{!! $user->mobile !!}</td> -->
            <td>{!! $user->sex ? '男' : '女' !!}</td>
            <td>{!! $user->welcome !!}</td>
            <!-- <td>{!! app('common')->PreferenceRepo()->userPreferenceSceneName($user->id) !!}</td> -->
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                  <!--   <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>