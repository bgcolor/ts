<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{{ $upload_title }}}</title>
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
  <div id="data" data-maxsize="{{ $post_max_size }}" data-msgabovemax="{{ $msg_above_max }}" data-msg-delete="{{ $msg_delete }}"></div>
  @include('_navbar')
  
  <div class="am-cf admin-main">
    <!-- sidebar start -->
    @include('_sidebar')
    <!-- sidebar end -->
    <!-- content start -->
    <div class="admin-content">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">我的上传</strong> / <small>Upload</small></div>
      </div>
      
      <form class="am-form am-form-inline am-margin-horizontal am-margin-vertical">
        <div class="am-form-group am-form-icon">
          <i class="am-icon-search"></i>
          <input type="text" class="am-form-field" placeholder="查询文件名" name="q">
        </div>

        <div class="am-form-group">
          <button type="button" class="am-btn am-btn-default" id="query">
            查询
          </button>
        </div>
      </form>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
              <label type="button" class="am-btn am-btn-default" for="userfile"><span class="am-icon-plus"></span> 上传</label>
              <form style="display: none" id="upload-form">
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
                <!-- Name of input element determines name in $_FILES array -->
                <input id="userfile" name="userfile" type="file" />
                <input type="text" name="id" value="{{ $user_id }}">
              </form>
            </div>
          </div>
        </div>
      </div>

      @include('_upload_list')

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

      // upload file
      $("#userfile").on("change",function(){
        var value = this.value.split("\\");
        var len = value.length;
        var filename = value[len - 1];
        var point = $(this).closest(".am-g");
        var panel = '<div class="am-g"><div class="am-panel am-panel-default  upload-panel am-u-md-4"><div class="am-panel-bd"><small>' + filename + ' </small><a href="javascript:;" class="am-close">&times;</a><div class="am-progress am-progress-xs am-progress-striped am-active" style="margin-bottom: 0;margin-top: .6rem"><div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%"></div></div></div></div>';
        log(filename);

        $("#upload-form").ajaxSubmit({
          url: window.baseUrl + 'upload/process',
          type: 'post',
          beforeSubmit: function() {
              var percentVal = '0%';
              var maxSize = $("#data").attr("data-maxsize");
              var msgAboveMax = $("#data").attr("data-msgabovemax");

              if (maxSize < $("[name=userfile]")[0].files[0].size) {
                $.modalAlert({
                  type: 'danger',
                  message: msgAboveMax
                });
                $(".admin-content .am-panel").remove();
                return false;
              }
              
              $(".admin-content .am-panel").remove();
              point.after(panel);

          },
          beforeSend: function(xhr) {
            $(document).on("click",".am-close", function(){
              xhr.abort();
              // log('abort');
              $(".admin-content .am-panel").remove();
            });
          },
          uploadProgress: function(event, position, total, percentComplete) {
              var percentVal = percentComplete + '%';
              // log(percentVal);
              $(".admin-content .am-progress-bar").css({
                width: percentVal
              });
          },
          success: function(responseText, statusText, xhr, $form) {
            log('success');
            log(responseText.status);
            if (responseText.status == 'success') {

              $(".admin-content .am-panel-bd a").removeClass("am-close").addClass("am-icon-check-circle am-success").text("");
              $(".admin-content .am-progress-bar").css({
                width: '100%'
              });

              $.modalAlert({
                message: responseText.message
              });

            } else {
              if (responseText.message) {
                $.modalAlert({
                  type: 'warning',
                  message: responseText.message
                });
              }
            }
          }
        });
      });
      // upload file end

      $(document).on("click", "#modal-alert .am-modal-btn", function() {
        if ($(".admin-content .am-panel-bd a").hasClass("am-success")) {
          location.reload();
        }

        if (deleteSuccess === true) {
          location.reload();
        }

      });

      $("#query").on("click", function(){
        var q = $("[name=q]").val().trim();
        if (q != '') {
          location.href = window.baseUrl + 'upload?q=' + encodeURI(q);
        } else {
          location.href = window.baseUrl + 'upload';
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
