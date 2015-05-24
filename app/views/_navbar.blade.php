<header class="am-topbar admin-header">
  <img class="am-topbar-brand am-padding-vertical-xs" src="assets/i/logo.png" alt="">
  <div class="am-topbar-brand">
    <strong>{{{ $system_title }}}</strong> <small>{{{ $system_sub_title }}}</small>
  </div>
  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 您好， {{ $username }}
          <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="{{{ URL::to('/') }}}"><span class="am-icon-user"></span> 个人信息</a></li>
          <li><a href="{{{ URL::to('logout') }}}"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
    </ul>
  </div>
</header>