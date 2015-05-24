<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{{ $profile_title }}}</title>
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
  <div id="data" data-maxsize="{{ $post_max_size }}" data-msgabovemax="{{ $msg_above_max }}"  data-msg-delete="{{ $msg_delete }}"></div>
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
      <!-- profile start -->
      @include('_someone_profile')
      
      <!-- profile end -->

      <!-- download start -->
      @include('_someone_download')
      <!-- download end -->

      <!-- upload start -->
      @include('_someone_upload')
      <!-- upload end -->
      
      <!-- progress start  -->
      @include('_someone_students')
      <!-- progress end  -->
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

        if (deleteSuccess === true) {
          location.reload();
        }

      });

      // 选择头像
      $("[name=userfile]").on("change",function(){
        var value = this.value.split("\\");
        var len = value.length;
        var filename = value[len - 1];
        var point = $("#upload-photo p");
        var panel = '<div class="am-panel am-panel-default"><div class="am-panel-bd"><small>' + filename + ' </small><a href="javascript:;" class="am-close">&times;</a><div class="am-progress am-progress-xs am-progress-striped am-active" style="margin-bottom: 0;margin-top: .6rem"><div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%"></div></div></div>';
        log(filename);

        $("#upload-photo").ajaxSubmit({
          url: window.baseUrl + 'upload/only',
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
                $("#upload-photo .am-panel").remove();
                return false;
              }
              
              $("#upload-photo .am-panel").remove();
              point.after(panel);

              
          },
          beforeSend: function(xhr) {
              $(document).on("click",".am-close", function(){
                xhr.abort();
                // log('abort');
                $("#upload-photo .am-panel").remove();
              });
          },
          uploadProgress: function(event, position, total, percentComplete) {
              var percentVal = percentComplete + '%';
              // log(percentVal);
              $("#upload-photo .am-progress-bar").css({
                width: percentVal
              });
          },
          success: function(responseText, statusText, xhr, $form) {
            log('success');
            if (responseText.status == 'success') {
              $("#update-photo [name=photo_url]").val(window.baseUrl + responseText.data);
              $("#photo-image").attr("src",window.baseUrl + responseText.data);
              $("#upload-photo .am-panel-bd a").removeClass("am-close").addClass("am-icon-check-circle am-success").text("");
              $("#upload-photo .am-progress-bar").css({
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

      // 头像保存按钮按下
      $("#update-photo-btn").on("click",function(){
        var $theForm = $("#update-photo");
        
        $theForm.ajaxSubmit({
          url: window.baseUrl + 'user/update',
          type: 'post',
          beforeSubmit: function(xhr) {
            if ($("#update-photo [name=photo_url]").val().trim() == '') {
              $.popupInfo('2005');
              return false;
            }
          },
          success: function(responseText, statusText, xhr, $form) {
            // log('success');
            if (responseText.status) {
              $.modalAlert({
                type: responseText.status == 'success' ? 'info' : 'danger', 
                message: responseText.message
              });
            }
          }
        });

      });

      $("#profile-btn").on("click",function(){

        $.ajax({
          url: window.baseUrl + 'user/update',
          data: {
            id: $(this).attr("data-id"),
            email: $("#user-email").val(),
            phone_no: $("#user-phone").val()
          },
          type: 'post',
          success: function(data) {
            log(data);
            if (data.status) {
              $.modalAlert({
                type: data.status == 'success' ? 'info' : 'danger', 
                message: data.message
              });
            }
          }
        });
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

        $(".evaluate").on("click",function(){
          location.href = window.baseUrl + 'evaluate?id=' + $(this).attr("data-id");
        });

    })();
    
    </script>
  </body>
</html>
