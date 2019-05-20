<!-- <li class="">
    <a href="/" target="_blank"><i class="fa fa-home"></i><span>网站首页</span></a>
</li> -->

<!-- <li class="header">说明文档</li>
 <li class="{{ Request::is('smart/doc')  ? 'active' : '' }}">
      <a href="/smart/doc"><i class="fa fa-cog"></i><span>系统说明文档</span></a>
</li> -->

<li class="header">系统设置</li>
    <li class="{{ Request::is('smart/settings/setting*') || Request::is('smart') ? 'active' : '' }}">
      <a href="/smart"><i class="fa fa-cog"></i><span>系统设置</span></a>
    </li>

<li class="header">区域设置</li>
<li class="{{ Request::is('smart/regions*') ? 'active' : '' }}">
    <a href="{!! route('regions.index') !!}"><i class="fa fa-edit"></i><span>区域管理</span></a>
</li>

<li class="header">数据及模拟管理</li>
<!-- <li class="{{ Request::is('smart/devIdxDays*') ? 'active' : '' }}">
    <a href="{!! route('devIdxDays.index') !!}"><i class="fa fa-edit"></i><span>指标数据管理</span></a>
</li> -->
<li class="{{ Request::is('smart/chartDatas*') ? 'active' : '' }}">
    <a href="{!! route('chartDatas.index') !!}"><i class="fa fa-edit"></i><span>图表数据管理</span></a>
</li>

<li class="header">智能设备管理</li>

<li class="{{ Request::is('smart/gateways*') ? 'active' : '' }}">
    <a href="{!! route('gateways.index') !!}"><i class="fa fa-edit"></i><span>网关智慧中心管理</span></a>
</li>

<li class="{{ Request::is('smart/gatewayDevs*') ? 'active' : '' }}">
    <a href="{!! route('gatewayDevs.index') !!}"><i class="fa fa-edit"></i><span>网关设备列表</span></a>
</li>

<li class="{{ Request::is('smart/devLights*') ? 'active' : '' }}">
    <a href="{!! route('devLights.index') !!}"><i class="fa fa-edit"></i><span>灯光设备</span></a>
</li>

<li class="{{ Request::is('smart/devSensors*') ? 'active' : '' }}">
    <a href="{!! route('devSensors.index') !!}"><i class="fa fa-edit"></i><span>传感器设备</span></a>
</li>

<li class="{{ Request::is('smart/devCurtains*') ? 'active' : '' }}">
    <a href="{!! route('devCurtains.index') !!}"><i class="fa fa-edit"></i><span>窗帘电机设备</span></a>
</li>

<li class="{{ Request::is('smart/devDoorLocks*') ? 'active' : '' }}">
    <a href="{!! route('devDoorLocks.index') !!}"><i class="fa fa-edit"></i><span>门锁设备管理</span></a>
</li>

<li class="header">用户设置</li>
<li class="{{ Request::is('smart/users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>门锁用户及偏好管理</span></a>
</li>

<li class="header">联动设置</li>
<li class="{{ Request::is('smart/devScenes*') ? 'active' : '' }}">
    <a href="{!! route('devScenes.index') !!}"><i class="fa fa-edit"></i><span>场景管理</span></a>
</li>

<li class="{{ Request::is('smart/devCommands*') ? 'active' : '' }}">
    <a href="{!! route('devCommands.index') !!}"><i class="fa fa-edit"></i><span>联动命令管理</span></a>
</li>

<li class="header">文案设置</li>
<li class="{{ Request::is('smart/cats*') ? 'active' : '' }}">
    <a href="{!! route('cats.index') !!}"><i class="fa fa-edit"></i><span>文案分类</span></a>
</li>

<li class="{{ Request::is('smart/posts*') ? 'active' : '' }}">
    <a href="{!! route('posts.index') !!}"><i class="fa fa-edit"></i><span>文章</span></a>
</li>

<li class="">
    <a href="javascript:;" id="refresh"><i class="fa fa-refresh"></i><span>刷新缓存</span></a>
</li>
















