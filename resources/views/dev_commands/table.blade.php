<table class="table table-responsive" id="devCommands-table">
    <thead>
        <tr>
        <th>命令描述</th>
        <th>应用场景</th>
        <th>Me</th>
        <th>Idx</th>
        <th>Type</th>
        <th>Val</th>
        <th>Agt</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devCommands as $devCommand)
        <tr>
            <td>{!! $devCommand->tag !!}</td>
            <td>{!! app("common")->DevSceneRepo()->getSceneNameById($devCommand->scene_id) !!}</td>
            <td>{!! $devCommand->me !!}</td>
            <td>{!! $devCommand->idx !!}</td>
            <td>{!! $devCommand->type !!}</td>
            <td>{!! $devCommand->val !!}</td>
            <td>{!! $devCommand->agt !!}</td>
            <td>
                {!! Form::open(['route' => ['devCommands.destroy', $devCommand->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                <!--     <a href="{!! route('devCommands.show', [$devCommand->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('devCommands.edit', [$devCommand->id]) !!}@if($scene_id)?scene_id={!! $scene_id !!}@endif" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>