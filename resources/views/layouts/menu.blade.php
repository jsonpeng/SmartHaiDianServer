<!-- <li class="">
    <a href="/" target="_blank"><i class="fa fa-home"></i><span>网站首页</span></a>
</li> -->

<!-- <li class="header">说明文档</li>
 <li class="{{ Request::is('smart/doc')  ? 'active' : '' }}">
      <a href="/smart/doc"><i class="fa fa-cog"></i><span>系统说明文档</span></a>
</li> -->
<?php $settingActive = Request::is('smart/settings/setting*') || Request::is('smart');?>

<li class="treeview @if($settingActive) active @endif">
    <a href="#">
    <i class="fa fa-laptop"></i>
        <span>系统设置</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" @if($settingActive) style="display: block;" @else style="display: none;" @endif >
        <li class="{{ Request::is('smart/settings/setting*') || Request::is('smart')  ? 'active' : '' }}">
            <a href="/smart"><i class="fa fa-edit"></i><span>系统设置</span></a>
        </li>
    </ul>
</li>

<!-- <li class="header">系统设置</li>
    <li class="{{ Request::is('smart/settings/setting*') || Request::is('smart') ? 'active' : '' }}">
      <a href="/smart"><i class="fa fa-cog"></i><span>系统设置</span></a>
    </li> -->
<?php $regionActive = Request::is('smart/regions*');?>

<li class="treeview @if($regionActive) active @endif">
    <a href="#">
    <i class="fa fa-laptop"></i>
        <span>区域设置</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" @if($regionActive) style="display: block;" @else style="display: none;" @endif >
        <li class="{{ $regionActive ? 'active' : '' }}">
            <a href="{!! route('regions.index') !!}"><i class="fa fa-edit"></i><span>区域管理</span></a>
        </li>
    </ul>
</li>
<!-- 
<li class="header">区域设置</li>
<li class="{{ Request::is('smart/regions*') ? 'active' : '' }}">
    <a href="{!! route('regions.index') !!}"><i class="fa fa-edit"></i><span>区域管理</span></a>
</li> -->

<?php $chartDataActive = Request::is('smart/chartDatas*');?>

<li class="treeview @if($chartDataActive) active @endif">
    <a href="#">
    <i class="fa fa-laptop"></i>
        <span>数据及模拟管理</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" @if($chartDataActive) style="display: block;" @else style="display: none;" @endif >
     <li class="{{ Request::is('smart/chartDatas*') ? 'active' : '' }}">
            <a href="{!! route('chartDatas.index') !!}"><i class="fa fa-edit"></i><span>图表数据管理</span></a>
        </li>
    </ul>
</li>

<!-- <li class="header">数据及模拟管理</li>
<li class="{{ Request::is('smart/devIdxDays*') ? 'active' : '' }}">
    <a href="{!! route('devIdxDays.index') !!}"><i class="fa fa-edit"></i><span>指标数据管理</span></a>
</li>
<li class="{{ Request::is('smart/chartDatas*') ? 'active' : '' }}">
    <a href="{!! route('chartDatas.index') !!}"><i class="fa fa-edit"></i><span>图表数据管理</span></a>
</li>
 -->

<?php $deviceAllActive = Request::is('smart/gateways*') || Request::is('smart/gatewayDevs*') || Request::is('smart/devLights*') || Request::is('smart/devSensors*') || Request::is('smart/devCurtains*') || Request::is('smart/devModels*') || Request::is('smart/devDoorLocks*');?>

<li class="treeview @if($deviceAllActive) active @endif">
    <a href="#">
    <i class="fa fa-laptop"></i>
        <span>智能设备管理</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" @if($deviceAllActive) style="display: block;" @else style="display: none;" @endif >

        <li class="{{ Request::is('smart/gateways*') ? 'active' : '' }}">
            <a href="{!! route('gateways.index') !!}"><i class="fa fa-edit"></i><span>网关智慧中心管理</span></a>
        </li>
        <li class="{{ Request::is('smart/gatewayDevs*') ? 'active' : '' }}">
            <a href="{!! route('gatewayDevs.index') !!}"><i class="fa fa-edit"></i><span>网关设备列表</span></a>
        </li>

        <li class="{{ Request::is('smart/devModels*') ? 'active' : '' }}">
            <a href="{!! route('devModels.index') !!}"><i class="fa fa-edit"></i><span>设备模型分类</span></a>
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

    </ul>
</li>

<!-- <li class="header">智能设备管理</li>

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
</li> -->

<?php $userActive = Request::is('smart/users*');?>

<li class="treeview @if($userActive) active @endif">
    <a href="#">
    <i class="fa fa-laptop"></i>
        <span>用户设置</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" @if($userActive) style="display: block;" @else style="display: none;" @endif >
        <li class="{{ Request::is('smart/users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>门锁用户及偏好管理</span></a>
        </li>
    </ul>
</li>

<!-- <li class="header">用户设置</li>
<li class="{{ Request::is('smart/users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>门锁用户及偏好管理</span></a>
</li> -->

<?php $lianDonActive = Request::is('smart/devScenes*') || Request::is('smart/devCommands*');?>

<li class="treeview @if($lianDonActive) active @endif">
    <a href="#">
    <i class="fa fa-laptop"></i>
        <span>联动设置</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" @if($lianDonActive) style="display: block;" @else style="display: none;" @endif >
        <li class="{{ Request::is('smart/devScenes*') ? 'active' : '' }}">
            <a href="{!! route('devScenes.index') !!}"><i class="fa fa-edit"></i><span>场景管理</span></a>
        </li>

        <li class="{{ Request::is('smart/devCommands*') ? 'active' : '' }}">
            <a href="{!! route('devCommands.index') !!}"><i class="fa fa-edit"></i><span>联动命令管理</span></a>
        </li>
    </ul>
</li>

<!-- <li class="header">联动设置</li>
<li class="{{ Request::is('smart/devScenes*') ? 'active' : '' }}">
    <a href="{!! route('devScenes.index') !!}"><i class="fa fa-edit"></i><span>场景管理</span></a>
</li>

<li class="{{ Request::is('smart/devCommands*') ? 'active' : '' }}">
    <a href="{!! route('devCommands.index') !!}"><i class="fa fa-edit"></i><span>联动命令管理</span></a>
</li> -->

<?php $postActive = Request::is('smart/cats*') || Request::is('smart/posts*');?>

<li class="treeview @if($postActive) active @endif">
    <a href="#">
    <i class="fa fa-laptop"></i>
        <span>文案设置</span>
    <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" @if($postActive) style="display: block;" @else style="display: none;" @endif >
        <li class="{{ Request::is('smart/cats*') ? 'active' : '' }}">
            <a href="{!! route('cats.index') !!}"><i class="fa fa-edit"></i><span>文案分类</span></a>
        </li>

        <li class="{{ Request::is('smart/posts*') ? 'active' : '' }}">
            <a href="{!! route('posts.index') !!}"><i class="fa fa-edit"></i><span>文章</span></a>
        </li> 
    </ul>
</li>

<!-- <li class="header">文案设置</li>
<li class="{{ Request::is('smart/cats*') ? 'active' : '' }}">
    <a href="{!! route('cats.index') !!}"><i class="fa fa-edit"></i><span>文案分类</span></a>
</li>

<li class="{{ Request::is('smart/posts*') ? 'active' : '' }}">
    <a href="{!! route('posts.index') !!}"><i class="fa fa-edit"></i><span>文章</span></a>
</li> -->

<li class="">
    <a href="javascript:;" id="refresh"><i class="fa fa-refresh"></i><span>刷新缓存</span></a>
</li>


















