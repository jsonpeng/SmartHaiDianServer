<table class="table table-responsive" id="devElectricityMeters-table">
    <thead>
        <tr>
            <th>Uuid</th>
        <th>Elecollector Uuid</th>
        <th>Mac</th>
        <th>Sn</th>
        <th>Elemeter Type</th>
        <th>Version</th>
        <th>Onoff Line</th>
        <th>Onoff Time</th>
        <th>Bind Time</th>
        <th>Name</th>
        <th>Model</th>
        <th>Model Name</th>
        <th>Brand</th>
        <th>Operation</th>
        <th>Operation Stage</th>
        <th>Charger Stage</th>
        <th>Overdraft Stage</th>
        <th>Capacity Stage</th>
        <th>Trans Status</th>
        <th>Trans Status Time</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($devElectricityMeters as $devElectricityMeter)
        <tr>
            <td>{!! $devElectricityMeter->uuid !!}</td>
            <td>{!! $devElectricityMeter->elecollector_uuid !!}</td>
            <td>{!! $devElectricityMeter->mac !!}</td>
            <td>{!! $devElectricityMeter->sn !!}</td>
            <td>{!! $devElectricityMeter->elemeter_type !!}</td>
            <td>{!! $devElectricityMeter->version !!}</td>
            <td>{!! $devElectricityMeter->onoff_line !!}</td>
            <td>{!! $devElectricityMeter->onoff_time !!}</td>
            <td>{!! $devElectricityMeter->bind_time !!}</td>
            <td>{!! $devElectricityMeter->name !!}</td>
            <td>{!! $devElectricityMeter->model !!}</td>
            <td>{!! $devElectricityMeter->model_name !!}</td>
            <td>{!! $devElectricityMeter->brand !!}</td>
            <td>{!! $devElectricityMeter->operation !!}</td>
            <td>{!! $devElectricityMeter->operation_stage !!}</td>
            <td>{!! $devElectricityMeter->charger_stage !!}</td>
            <td>{!! $devElectricityMeter->overdraft_stage !!}</td>
            <td>{!! $devElectricityMeter->capacity_stage !!}</td>
            <td>{!! $devElectricityMeter->trans_status !!}</td>
            <td>{!! $devElectricityMeter->trans_status_time !!}</td>
            <td>
                {!! Form::open(['route' => ['devElectricityMeters.destroy', $devElectricityMeter->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('devElectricityMeters.show', [$devElectricityMeter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('devElectricityMeters.edit', [$devElectricityMeter->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>