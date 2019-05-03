<table class="table table-responsive" id="devLights-table">
    <thead>
        <tr>
        <th>智慧设备唯一ID</th>
        <th>型号</th>
        <th>名称</th>
        <th>设备状态</th>
        <th>灯光类型</th>
        <th>设定区域</th>
        <th>开关</th>
        <th>颜色值</th>
        <th>动态颜色值</th>
        <th>色温</th>
        <th>亮度</th>
        <th>智慧中心ID Agt</th>
        <th>智慧中心状态</th>
        <th>是否已接入</th>
        <th>接入时间</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devLights as $devLight)
        <tr>
            <td>{!! $devLight->me !!}</td>
            <td>{!! $devLight->model !!}</td>
            <td>{!! $devLight->name !!}</td>
            <td>{!! $devLight->StateStatus !!}</td>
            <td>{!! $devLight->type !!}</td>
            <td>{!! app("common")->RegionRepo()->getNameById($devLight->region_id) !!}</td>
            <td>{!! $devLight->IsOnStatus !!}</td>
            <td>{!! $devLight->rgbw !!}</td>
            <td>{!! $devLight->dyn !!}</td>
            <td>{!! $devLight->color_temp !!}</td>
            <td>{!! $devLight->bri !!}</td>
            <td>{!! $devLight->agt !!}</td>
            <td>{!! Smart::getDisplayName($devLight->agt_state,'state') !!}</td>
            <td>{!! $devLight->IsJoinStatus !!}</td>
            <td>{!! $devLight->join_at !!}</td>
            <td>
                {!! Form::open(['route' => ['devLights.destroy', $devLight->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                 <!--    <a href="{!! route('devLights.show', [$devLight->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('devLights.edit', [$devLight->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>