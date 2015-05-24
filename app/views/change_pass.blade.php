<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{{ $change_pass_title }}}</title>
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
  </head>
  <body>
  <div id="data" data-pass-fail="{{ $pass_fail }}"></div>
    <!--[if lte IE 9]>
    <p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
  <![endif]-->
  @include('_navbar')
  
  <div class="am-cf admin-main">
    <!-- sidebar start -->
    @include('_sidebar')
    <!-- sidebar end -->
    <!-- content start -->
    <div class="admin-content">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">修改密码</strong> / <small>Change Password</small></div>
      </div>

      <hr/>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <form class="am-form am-form-horizontal" id="change-pass-form">
            <div class="am-form-group">
                <input class="am-form-field" type="password" name="old-password" placeholder="请输入旧密码">
            </div>

            <div class="am-form-group">
                <input class="am-form-field" type="password" name="new-password" placeholder="请输入新密码">
            </div>

            <div class="am-form-group">
                <input class="am-form-field" type="password" name="confirm-password" placeholder="请再次输入">
            </div>

            <div class="am-form-group">
                <button class="am-btn am-btn-primary" id="change-pass-btn">修改密码</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- content end -->
    
    <footer class="am-g">
      <hr>
      <p class="am-padding-left am-text-center">{{{ $powered_by }}}</p>
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
    <script src="assets/js/jquery.form.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/common.js"></script>
    <!--<![endif]-->
    <script>
    (function(){

      $("#change-pass-form").validate({
        // errorElement: '<div class="am-alert am-alert-danger" data-am-alert><button type="button" class="am-close">&times;</button></div>',
        errorElement: 'p',
        errorClass: 'am-form-error',
        errorPlacement: function(error, element) {
            var group = element.closest(".am-form-group");
            group.after('<div class="am-alert am-alert-danger" data-am-alert><button type="button" class="am-close">&times;</button></div>');
            // log(.am-alert);
            error.appendTo(group.next(".am-alert"));
        },
        highlight: function(element, errorClass, validClass) {
          $(element).closest('.am-form-group').addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).closest('.am-form-group').removeClass(errorClass).next(".am-alert").remove();
        },
        messages: {
          'old-password': "请输入旧密码",
          'new-password': "请输入新密码，长度6-20",
          'confirm-password': "两次输入不一致!",
        },
        rules: {
          'old-password' : {
            required: true,
            minlength: 6,
            maxlength: 20
          },
          'new-password' : {
            required: true,
            minlength: 6,
            maxlength: 20
          },
          'confirm-password' : {
            equalTo: "[name=new-password]"
          },
        },
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
            $(form).ajaxSubmit({
              url: window.baseUrl + 'user/password/change',
              type: 'post',
              success: function(data) {
                $.modalAlert({
                  type: data.status == 'success' ? 'info' : 'warning',
                  message: data.message,
                });

                $(form)[0].reset();
              },
              fail: function() {
                $.modalAlert({
                  type: data.status == 'success' ? 'info' : 'warning',
                  message: $("#data").attr("data-pass-fail")
                });
              }
            });
          }
      });

    })();
    
    </script>
  </body>
</html>
