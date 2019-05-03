<?php $user = auth('web')->user();$notices_count = count(app('notice')->authNotices($user));?>
<h3 class="title">
    个人中心
</h3>
<ul class="nav-child hidden-xs">
    <li @if(Request::is('user/center/index')) class="active" @endif>
        <a href="/user/center/index">基本资料</a>
    </li>
    <li @if(Request::is('user/center/account')) class="active" @endif>
        <a href="/user/center/account">账号安全</a>
    </li>
    <li @if(Request::is('user/center/attention')) class="active" @endif>
        <a href="/user/center/attention">我的收藏</a>
    </li>
    <li @if(Request::is('user/center/publish')) class="active" @endif>
        <a href="/user/center/publish">我发布的</a>
    </li>
    <li class="@if($notices_count) notice @endif @if(Request::is('user/center/notice')) active @endif">
        <a href="/user/center/notice">我的消息</a>
    </li>
</ul>
<ul class="nav-child row visible-xs">
    <li class="col-xs-4 @if(Request::is('user/center/index')) active @endif">
        <a href="/user/center/index">基本资料</a>
    </li>
    <li class="col-xs-4 @if(Request::is('user/center/account')) active @endif">
        <a href="/user/center/account">账号安全</a>
    </li>
    <li class="col-xs-4 @if(Request::is('user/center/attention')) active @endif">
        <a href="/user/center/attention">我的收藏</a>
    </li>
    <li class="col-xs-4 @if(Request::is('user/center/publish')) active @endif">
        <a href="/user/center/publish">我发布的</a>
    </li>
    <li class="col-xs-4 notice @if(Request::is('user/center/notice')) active @endif">
        <a href="/user/center/notice">我的消息</a>
    </li>
</ul>