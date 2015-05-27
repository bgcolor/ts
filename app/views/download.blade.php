<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{{ $download_title }}}</title>
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
    <!--[if lte IE 9]>
    <p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
  <![endif]-->
  <div id="data" data-msg-delete="{{ $msg_delete }}"></div>
  @include('_navbar')
  
  <div class="am-cf admin-main">
    <!-- sidebar start -->
    @include('_sidebar')
    <!-- sidebar end -->
    <!-- content start -->
    <div class="admin-content">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?php if (Input::has('type') && Input::get('type') ) { echo '我的下载'; } else if (true == $manage_files) {echo '上传下载管理';} else if (true == $project_files) { echo '项目文件一览';}   ?></strong> / <small>Download</small></div>
      </div>
      
      <form action="" class="am-form am-form-inline am-margin-horizontal am-margin-vertical">
        <div class="am-form-group am-form-icon">
          <i class="am-icon-search"></i>
          <input type="text" class="am-form-field" placeholder="查询文件名" name="q">
        </div>

        <div class="am-form-group">
          <button type="button" class="am-btn am-btn-default" id="query-btn">
            查询
          </button>
        </div>
      </form>
      
      <!-- downloads start -->
      @include('_download_list')
      <!-- downloads end -->
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
    <script src="assets/js/common.js"></script>
    <!--<![endif]-->
    <script>
      (function(){
        var deleteSuccess = false;

        $(document).on("click", "#modal-alert .am-modal-btn", function() {
          if ($(".admin-content .am-panel-bd a").hasClass("am-success")) {
            location.reload();
          }

          if (deleteSuccess === true) {
            location.reload();
          }

        });

        $("#query-btn").on("click", function(){
          var q = $("[name=q]").val().trim();
          if (q != '') {
            location.href = window.baseUrl + 'download?q=' + encodeURI(q);
          } else {
            location.href = window.baseUrl + 'download';
          }
        });

        $(".download").on("click", function(e){
          var downloaderId = $(this).closest(".am-btn-toolbar").attr("data-user-id");
          var fileId = $(this).closest(".am-btn-toolbar").attr("data-file-id");

          window.open(window.baseUrl + 'download/process?file_id=' + fileId + '&downloader_id=' + downloaderId,'_blank');
          location.reload();
        });

        $(".delete").on("click",function(e){
          var fileId = $(this).closest(".am-btn-toolbar").attr("data-file-id");
          $.modalConfirm({
            confirm: function() {
              // log('confirm');
              $.ajax({
                url: window.baseUrl + 'file/delete',
                type: 'post',
                data: {
                  id: fileId
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
            cancel: function() {
              // log('cancel');
            },
            message: $("#data").attr("data-msg-delete")
          });
        });
      })();
    
    </script>
  </body>
</html>
