<table class="table table-responsive" id="devElectricityMeters-table">
    <thead>
        <tr>
        <th>电表uuid</th>
        <th>Mac地址</th>
        <th>电表序号</th>
        <th>电表名称</th>
        <th>设备类型</th>
        <th>设备型号名称</th>
        <th>安装区域</th>

            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devElectricityMeters as $devElectricityMeter)
        <tr>
            <td>{!! $devElectricityMeter->uuid !!}</td>
            <td>{!! $devElectricityMeter->mac !!}</td>
            <td>{!! $devElectricityMeter->sn !!}</td>
            <td>{!! $devElectricityMeter->name !!}</td>
            <td>{!! $devElectricityMeter->model !!}</td>
            <td>{!! $devElectricityMeter->model_name !!}</td>
            <td>{!! app("common")->RegionRepo()->getNameById($devElectricityMeter->region_id) !!}</td>
            <td>
                {!! Form::open(['route' => ['devElectricityMeters.destroy', $devElectricityMeter->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('devElectricityMeters.show', [$devElectricityMeter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('devElectricityMeters.edit', [$devElectricityMeter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>