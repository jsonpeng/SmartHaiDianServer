<table class="table table-responsive" id="lfScenes-table">
    <thead>
        <tr>
            <th>唯一标识</th>
            <th>场景名称</th>
            <th>场景描述</th>
            <!-- <th colspan="3">Action</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach($lfScenes as $lfScene)
        <tr>
            <td>{!! $lfScene['id'] !!}</td>
            <td>{!! $lfScene['name'] !!}</td>
            <td>{!! $lfScene['desc'] !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>