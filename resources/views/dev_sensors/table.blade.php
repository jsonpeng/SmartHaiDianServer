<table class="table table-responsive" id="devSensors-table">
    <thead>
        <tr>
        <th>智慧设备唯一ID</th>
        <th>型号</th>
        <th>名称</th>
        <th>设备状态</th>
        <th>传感器类型</th>
        <th>告警门限</th>
        <th>告警音状态</th>
        <th>区域</th>
    <!--     <th>智慧中心ID</th>
        <th>智慧中心状态</th>
        <th>是否已接入</th> -->
        <!-- <th>接入时间</th> -->
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devSensors as $devSensor)
        <tr>
            <td>{!! $devSensor->me !!}</td>
            <td>{!! $devSensor->model !!}</td>
            <td>{!! $devSensor->name !!}</td>
            <td>{!! Smart::getDisplayName($devSensor->state,'state') !!}</td>
            <td>{!! Smart::getDisplayName($devSensor->type) !!}</td>
            <td>{!! $devSensor->threshold !!}</td>
            <td>{!! Smart::getDisplayName($devSensor->alarm_sound,'alarm_sound') !!}</td>
            <td>{!! Smart::getRegionName($devSensor->region_id) !!}</td>
  <!--           <td>{!! $devSensor->agt !!}</td>
            <td>{!! Smart::getDisplayName($devSensor->agt_state,'state') !!}</td>
            <td>{!! Smart::getDisplayName($devSensor->is_join,'is_join') !!}</td> -->
            <!-- <td>{!! $devSensor->join_at !!}</td> -->
            <td>
                {!! Form::open(['route' => ['devSensors.destroy', $devSensor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                 <!--    <a href="{!! route('devSensors.show', [$devSensor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('devSensors.edit', [$devSensor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>