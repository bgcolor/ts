<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{{ $login_title }}}</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="assets/i/logo.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
    #login-container {
      border: solid 1px #eee;
    }
    </style>
  </head>
  <body>
    <!--[if lte IE 9]>
    <p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
  <![endif]-->
  <header class="am-topbar admin-header">
    <img class="am-topbar-brand am-padding-vertical-xs" src="assets/i/logo.png" alt="">
    <div class="am-topbar-brand">
      <strong>物流人才培训系统</strong> <small>管理平台</small>
    </div>
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
      <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
        <li style="line-height: 50px"><button type="button" class="am-btn am-btn-sm am-btn-primary" id="login-toggle">登录</button></li>
        <!-- <li class="am-dropdown" data-am-dropdown>
          <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
            <span class="am-icon-users"></span> 您好，管理员 <span class="am-icon-caret-down"></span>
          </a>
          <ul class="am-dropdown-content">
            <li><a href="#"><span class="am-icon-user"></span> 个人信息</a></li>
            <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
  </header>
  <div class="am-cf am-g am-container am-margin-vertical-lg">
    <img src="assets/i/banner.jpg" alt="" class="am-fl am-u-lg-8 am-padding-horizontal-lg">
    <div id="login-container" class="am-fr am-u-lg-4 am-padding-vertical-lg">
      <form class="am-form" id="login-form" method="get" action="">
        <fieldset>
          <legend>登录</legend>
          <div class="am-form-group">
            <input type="text" class="" id="username" placeholder="用户名" name="username">
          </div>
          <div class="am-form-group">
            <input type="password" class="" id="password" placeholder="密码" name="password">
          </div>
          <!-- <div class="am-form-group"> -->
            <button type="submit" class="am-btn am-btn-primary am-btn-block">登录</button>
          <!-- </div> -->
        </fieldset>
      </form>
    </div>
  </div>

  <footer class="am-g" style="bottom: 0;position: fixed">
    <hr>
    <p class="am-padding-left am-text-center">© 2015 AllMobilize, Inc. Licensed under MIT license.</p>
  </footer>
  <!--[if lt IE 9]>
  <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
  <script src="assets/js/polyfill/rem.min.js"></script>
  <script src="assets/js/polyfill/respond.min.js"></script>
  <script src="assets/js/amazeui.legacy.js"></script>
  <![endif]-->
  <!--[if (gte IE 9)|!(IE)]><!-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/amazeui.min.js"></script>
  <!--<![endif]-->
  <script>
    $("#login-toggle").on("click", function(){
      $("#login-form input:first").focus();
    });
  </script>
</body>
</html>