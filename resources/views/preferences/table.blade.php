<table class="table table-responsive" id="preferences-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Scene Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($preferences as $preference)
        <tr>
            <td>{!! $preference->user_id !!}</td>
            <td>{!! $preference->scene_id !!}</td>
            <td>
                {!! Form::open(['route' => ['preferences.destroy', $preference->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('preferences.show', [$preference->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('preferences.edit', [$preference->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>