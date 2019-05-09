<table class="table table-responsive" id="devIdxDays-table">
    <thead>
        <tr>
        <th>指标类型</th>
        <th>取值</th>
        <th>纪录时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devIdxDays as $devIdxDay)
        <tr>
            <td>{!! $devIdxDay->idxName !!}</td>
            <td>{!! $devIdxDay->val !!}</td>
            <td>{!! $devIdxDay->record_at !!}</td>
            <td>
                {!! Form::open(['route' => ['devIdxDays.destroy', $devIdxDay->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
               <!--      <a href="{!! route('devIdxDays.show', [$devIdxDay->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('devIdxDays.edit', [$devIdxDay->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>