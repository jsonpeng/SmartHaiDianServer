<table class="table table-responsive" id="messages-table">
    <thead>
        <tr>
            <th>公告内容</th>
{{--             <th>邮箱</th> --}}
    <!--         <th>手机号</th>
            <th>预约课程名称</th>
            <th>提交预约时间</th> -->
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($messages as $message)
        <tr>
            <td>{!! $message->info !!}</td>

    <!--         <td>{!! $message->tel !!}</td>
            <td>{!! $message->info !!}</td>
            <td>{!! $message->created_at !!}</td> -->
            <td>
                {!! Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('messages.edit', [$message->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确认删除?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>