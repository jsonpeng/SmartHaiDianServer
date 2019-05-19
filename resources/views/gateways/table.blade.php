<table class="table table-responsive" id="gateways-table">
    <thead>
        <tr>
            <th>智慧中心名称</th>
            <th>agt</th>
            <th>在线状态</th>
        </tr>
    </thead>
    <tbody>
    @foreach($gateways as $gateway)
        <tr>
            <td>{!! $gateway['name'] !!}</td>
            <td>{!! $gateway['agt'] !!}</td>
            <td>{!! $gateway['stat_status'] !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>