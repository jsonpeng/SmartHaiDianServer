<table class="table table-responsive" id="gatewayDevs-table">
    <thead>
        <tr>
            <th>devtype</th>
            <th>名称</th>
            <th>Me</th>
            
            <th>设备状态</th>
            <!-- <th>lHeart</th> -->
            <!-- <th>lDbm</th> -->
            <th>详细</th>
            <!-- <th colspan="3">操作</th> -->
        </tr>
    </thead>
    <tbody>

    @foreach($gatewayDevs as $key => $gatewayDevices)
        <tr>
            <td>{!! $key !!}</td>
        <tr>
        @if(count($gatewayDevices))
            @foreach($gatewayDevices as $gatewayDev)
            <tr>
                <td> </td>
                <td>{!! $gatewayDev['name'] !!}</td>
                <td>{!! $gatewayDev['me'] !!}</td>
                <td>{!! $gatewayDev['stat'] ? '在线' : '离线' !!}</td>
                <!-- <td>{!! $gatewayDev['lHeart'] !!}</td> -->
                <!-- <td>{!! $gatewayDev['lDbm'] !!}</td> -->
                <td style="width: 300px;">{!! $gatewayDev['data_encode'] !!}</td>
            </tr>
            @endforeach
        @endif
    @endforeach
    </tbody>
</table>