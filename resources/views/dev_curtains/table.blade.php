<table class="table table-responsive" id="devCurtains-table">
    <thead>
        <tr>
        <th>智慧设备唯一ID</th>
        <th>型号</th>
        <th>名称</th>
        <th>设备图片</th>
        <th>设备开关状态</th>
        <th>设备状态</th>
    <!--     <th>智慧中心ID Agt</th>
        <th>智慧中心状态</th> -->
        <th>设定区域</th>
    <!--     <th>Is Join</th>
        <th>Join At</th>
        <th>Idx</th> -->
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devCurtains as $devCurtain)
        <tr>
            <td>{!! $devCurtain->me !!}</td>
            <td>{!! $devCurtain->model !!}</td>
            <td>{!! $devCurtain->name !!}</td>
              <td><img src="{!! $devCurtain->image !!}" style="max-width: 100px;height: auto;" /></td>
            <td>{!! $devCurtain->is_on ? '开启' : '关闭' !!}</td>
            <td>{!! $devCurtain->state ? '在线' : '离线' !!}</td>
        <!--     <td>{!! $devCurtain->agt !!}</td>
            <td>{!! $devCurtain->agt_state !!}</td> -->
            <td>{!! app("common")->RegionRepo()->getNameById($devCurtain->region_id) !!}</td>
         <!--    <td>{!! $devCurtain->is_join !!}</td>
            <td>{!! $devCurtain->join_at !!}</td>
            <td>{!! $devCurtain->idx !!}</td> -->
            <td>
                {!! Form::open(['route' => ['devCurtains.destroy', $devCurtain->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
            <!--         <a href="{!! route('devCurtains.show', [$devCurtain->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('devCurtains.edit', [$devCurtain->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>