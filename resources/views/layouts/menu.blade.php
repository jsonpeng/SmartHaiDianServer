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

<li class="header">智能设备管理</li>
<li class="{{ Request::is('smart/devLights*') ? 'active' : '' }}">
    <a href="{!! route('devLights.index') !!}"><i class="fa fa-edit"></i><span>灯光设备</span></a>
</li>

<li class="{{ Request::is('smart/devSensors*') ? 'active' : '' }}">
    <a href="{!! route('devSensors.index') !!}"><i class="fa fa-edit"></i><span>传感器设备</span></a>
</li>

<li class="{{ Request::is('smart/devCurtains*') ? 'active' : '' }}">
    <a href="{!! route('devCurtains.index') !!}"><i class="fa fa-edit"></i><span>窗帘电机</span></a>
</li>

<li class="header">联动设置</li>
<li class="{{ Request::is('smart/devScenes*') ? 'active' : '' }}">
    <a href="{!! route('devScenes.index') !!}"><i class="fa fa-edit"></i><span>场景管理</span></a>
</li>

<li class="{{ Request::is('smart/devCommands*') ? 'active' : '' }}">
    <a href="{!! route('devCommands.index') !!}"><i class="fa fa-edit"></i><span>联动命令管理</span></a>
</li>


<li class="">
    <a href="javascript:;" id="refresh"><i class="fa fa-refresh"></i><span>刷新缓存</span></a>
</li>










