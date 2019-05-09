<table class="table table-responsive" id="chartDatas-table">
    <thead>
        <tr>
        <th>指标类型</th>
        <!-- <th>Desc</th> -->
        <th>取值</th>
        <th>时间跨度</th>
        <th>记录时间</th>
     
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($chartDatas as $chartData)
        <tr>
            <td>{!! $chartData->IdxName !!}</td>
            <!-- <td>{!! $chartData->desc !!}</td> -->
            <td>{!! $chartData->val !!}</td>
            <td>{!! $chartData->TimeName !!}</td>
            <td>{!! $chartData->TimeCurrent !!}</td>
            <td>
                {!! Form::open(['route' => ['chartDatas.destroy', $chartData->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
            
                    <a href="{!! route('chartDatas.edit', [$chartData->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>