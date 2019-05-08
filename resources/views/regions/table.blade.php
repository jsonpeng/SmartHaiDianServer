<table class="table table-responsive" id="regions-table">
    <thead>
        <tr>
        <th>地区name</th>
        <th>区域图片</th>
        <th>地区描述</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($regions as $region)
        <tr>
            <td>{!! $region->name !!}</td>
            <td><img src="{!! $region->image !!}" style="max-width: 100px;height: auto;" /></td>
            <td>{!! $region->desc !!}</td>
            <td>
                {!! Form::open(['route' => ['regions.destroy', $region->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!-- <a href="{!! route('regions.show', [$region->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('regions.edit', [$region->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                   <!--  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!} -->
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>