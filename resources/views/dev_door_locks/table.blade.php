<table class="table table-responsive" id="devDoorLocks-table">
    <thead>
        <tr>
        <th>智慧设备唯一ID</th>
        <th class="hidden-xs">型号</th>
        <th>名称</th>
        <th class="hidden-xs">设备图片</th>
        <th>设备状态</th>
        <th>剩余电量</th>
        <th>设定区域</th>
 <!--        <th>Agt</th>
        <th>Agt State</th>
        <th>Is Join</th> -->
     <!--    <th>Join At</th> -->
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devDoorLocks as $devDoorLock)
        <tr>
            <td>{!! $devDoorLock->me !!}</td>
            <td  class="hidden-xs">{!! $devDoorLock->model !!}</td>
            <td>{!! $devDoorLock->name !!}</td>
            <td  class="hidden-xs"><img src="{!! $devDoorLock->image !!}" style="max-width: 100px;height: auto;" /></td>
            <td>{!! Smart::getDisplayName($devDoorLock->state,'state') !!}</td>
            <td>{!! $devDoorLock->battery !!}</td>
             <td>{!! app("common")->RegionRepo()->getNameById($devDoorLock->region_id) !!}</td>
    
       <!--      <td>{!! $devDoorLock->agt !!}</td>
            <td>{!! $devDoorLock->agt_state !!}</td>
            <td>{!! $devDoorLock->is_join !!}</td>
            <td>{!! $devDoorLock->join_at !!}</td> -->
            <td>
                {!! Form::open(['route' => ['devDoorLocks.destroy', $devDoorLock->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                   <!--  <a href="{!! route('devDoorLocks.show', [$devDoorLock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('devDoorLocks.edit', [$devDoorLock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?删除后将不能恢复')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>