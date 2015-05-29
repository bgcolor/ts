<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{{ $project_title }}}</title>
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
  <div id="data" data-project-fail="{{ $project_fail }}" data-msg-project-delete="{{ $msg_project_delete }}"></div>
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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">添加项目</strong> / <small>Create Project</small></div>
      </div>

      <hr/>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <form class="am-form am-form-horizontal" id="project-form">
            <input type="hidden" value="{{ $project->id }}" name="id">
            <div class="am-form-group">
                <input class="am-form-field" type="text" name="name" placeholder="请输入项目名称" value="{{ $project->name }}">
            </div>

            <div class="am-form-group">
                <textarea class="am-form-field" name="description" placeholder="请输入项目描述">{{ $project->description }}</textarea>
            </div>

            <div class="am-form-group">
                <button class="am-btn am-btn-primary" id="change-pass-btn">更改</button>
                <button type="button" class="am-btn am-btn-primary" id="delete" data-id="{{ $project->id }}">删除</button>
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

      var mdfSuccess = false;
      var deleteSuccess = false;

      $(document).on("click", "#modal-alert .am-modal-btn", function() {

        if (mdfSuccess === true) {
          location.reload();
        }

        if (deleteSuccess === true) {
          location.href = window.baseUrl;
        }

      });

      $("#project-form").validate({
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
          'name': "项目名称长度2-20字",
          'description': {
            maxlength: "项目描述最大250字",
            required: "项目描述不能为空"
          }
        },
        rules: {
          'name' : {
            required: true,
            minlength: 2,
            maxlength: 20
          },
          'description' : {
            required: true,
            maxlength: 250
          }
        },
        submitHandler: function(form) {
            // some other code
            // maybe disabling submit button
            // then:
            $(form).ajaxSubmit({
              url: window.baseUrl + 'project/update',
              type: 'post',
              success: function(data) {
                $.modalAlert({
                  type: data.status == 'success' ? 'info' : 'warning',
                  message: data.message,
                });

                if (data.status == 'success') {
                  mdfSuccess = true;
                  $(form)[0].reset();
                }

                
              },
              fail: function() {
                $.modalAlert({
                  type: data.status == 'success' ? 'info' : 'warning',
                  message: $("#data").attr("data-project-fail")
                });
              }
            });
          }
      });

      $("#delete").on("click", function(){
        var id = $(this).attr("data-id");
        $.modalConfirm({
          confirm: function() {
            // log('confirm');
            
            $.ajax({
              url: window.baseUrl + 'project/delete',
              type: 'post',
              data: {
                id: id
              },
              success: function(data) {
                $.modalAlert({
                  type: data.status == 'success' ? 'info' : 'warning',
                  message: data.message,
                });

                deleteSuccess = true;
              }
            });
          },
          message: $("#data").attr("data-msg-project-delete")
        });
      });

    })();
    
    </script>
  </body>
</html>
