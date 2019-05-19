<table class="table table-responsive" id="gatewayDevs-table">
    <thead>
        <tr>
            <th>devtype</th>
            <th>名称</th>
            <th>Me</th>
            
            <th>设备状态</th>
            <td>智慧中心信息</td>
            <!-- <th>lHeart</th> -->
            <!-- <th>lDbm</th> -->
            <th style="display: none;">详细</th>
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
                <td>{!! $gatewayDev['stat'] ? '在线' : '<span style=color:red;>'.'离线'.'</span>' !!}</td>
                <td>{!! $gatewayDev['agt'] !!} 
                    {{--@if($gatewayDev['agt_status'] == '不在线') <span style="color: red;">[{!! $gatewayDev['agt_status'] !!}]</span> @else [{!! $gatewayDev['agt_status'] !!}] @endif--}}
                </td>

                <!-- <td>{!! $gatewayDev['lHeart'] !!}</td> -->
                <!-- <td>{!! $gatewayDev['lDbm'] !!}</td> -->
                <td class="detailTd" style="width: 300px;display: none;">{!! $gatewayDev['data_encode'] !!}</td>
            </tr>
            @endforeach
        @endif
    @endforeach
    </tbody>
</table>