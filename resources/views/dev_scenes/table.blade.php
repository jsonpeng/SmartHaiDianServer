<table class="table table-responsive" id="devScenes-table">
    <thead>
        <tr>
        <th>场景名称</th>
        <!-- <th>场景图片</th> -->
        <th class="hidden-xs">场景描述</th>
        <th>是否开启场景</th>
        <th>应用区域</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devScenes as $devScene)
        <tr>
            <td>{!! $devScene->name !!}</td>
            <!-- <td><img src="{!! $devScene->image !!}" style="max-width: 100px;height: auto;" /></td> -->
            <td class="hidden-xs">{!! $devScene->description !!}</td>
            <td>    {!! Form::model($devScene, ['route' => ['devScenes.update', $devScene->id], 'method' => 'patch']) !!} 
                <input type="hidden" name="name" value="{!! $devScene->name !!}"> 
                <input type="hidden" name="enabled" value="{!! $devScene->enabled  ? '0' : '1' !!}">
                {!! $devScene->EnabledStatus !!} 
            {!! Form::close() !!}</td>
            <td>{!! $devScene->region_id ? app("common")->RegionRepo()->getNameById($devScene->region_id) : '通用' !!}</td>
            <td>
                {!! Form::open(['route' => ['devScenes.destroy', $devScene->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="javascript:;" onclick="frameOpen('{!! route('devCommands.index') !!}?scene_id={!! $devScene->id !!}','{!! $devScene->name !!}')" target="_blank" class='btn btn-default btn-xs'>管理联动命令</a>
                    <a href="{!! route('devScenes.edit', [$devScene->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>