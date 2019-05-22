<table class="table table-responsive" id="devModels-table">
    <thead>
        <tr>
        <th>模型分类名称</th>
        <!-- <th>模型图片</th> -->
        <th>型号</th>
            <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devModels as $devModel)
        <tr>
            <td>{!! $devModel->name !!}</td>
            <!-- <td>{!! $devModel->image !!}</td> -->
            <td>{!! $devModel->model !!}</td>
            <td>
                {!! Form::open(['route' => ['devModels.destroy', $devModel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                  <!--   <a href="{!! route('devModels.show', [$devModel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->
                    <a href="{!! route('devModels.edit', [$devModel->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>