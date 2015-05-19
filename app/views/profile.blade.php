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
    <style>
    .user-link-x {
    display: inline-block;
    padding-top: .6em;
    }
    .user-link-s {
    display: inline-block;
    }
    </style>
  </head>
  <body>
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
      @include('_personal_profile')
      
      <!-- profile end -->

      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">我的下载</strong> / <small>Personal Download</small></div>
      </div>
      
      <!-- table start -->
      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
                <tr>
                  <th class="table-title">文件名</th><th class="table-type">我已下载</th><th class="table-type">下载人数</th><th class="table-author am-hide-sm-only">发布人</th><th class="table-date am-hide-sm-only">上传日期</th><th class="table-set">操作</th>
                </tr>
              </thead>
              <tbody>
                <!-- tbody start -->
                <tr>
                  <td>文件1.doc</td>
                  <td><a href="javascript:;" data-am-popover="{content: '您在2015/08/15 16:53时下载', trigger: 'hover focus'}">已下载</a></td>
                  <td><a href="javascript:;" data-am-popover="{content: 'xxx，xxx等人已下载', trigger: 'hover focus'}">5</a></td>
                  <td><a href="javascript:;">xxx</a></td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                    <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                        <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-download"></span> 下载</button>
                        <!-- <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button> -->
                        <!-- <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button> -->
                        <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>文件1.doc</td>
                  <td>未下载</td>
                  <td><a href="javascript:;" data-am-popover="{content: 'xxx，xxx等人已下载', trigger: 'hover focus'}">5</a></td>
                  <td><a href="javascript:;">xxx</a></td>
                  <td class="am-hide-sm-only">2014年9月4日 7:28:47</td>
                  <td>
                    <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                        <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-download"></span> 下载</button>
                        <!-- <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button> -->
                        <!-- <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button> -->
                        <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- tbody end -->
              </tbody>
            </table>
            <hr />
          </form>
        </div>
      </div>
      <!-- table end -->
      
      <!-- progress start  -->
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">我的学徒</strong> / <small>My Students</small></div>
      </div>
      
      <div class="am-panel am-panel-default am-margin-horizontal">
        <div class="am-panel-bd">
          <div class="user-info">
            <h3><a href="">xxx</a>的进度</h3>
            <div class="am-progress am-progress-sm">
              <div class="am-progress-bar" style="width: 60%"></div>
            </div>
            <p class="user-info-order"><strong>完成进度：</strong>60%</p>
            <p class="user-info-order"><strong>评审人：</strong> <a href="javascript:;" class="user-link-s">张三</a></p>
            <p class="user-info-order"><strong>评审进度描述：</strong> 已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，
            </p>
            <button type="button" class="am-btn am-btn-primary am-btn-xs">评审</button>
          </div>
        </div>
      </div>
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

      // 选择头像
      $("[name=userfile]").on("change",function(){
        var value = this.value.split("\\");
        var len = value.length;
        var filename = value[len - 1];
        var point = $("#upload-photo p");
        var panel = '<div class="am-panel am-panel-default"><div class="am-panel-bd"><small>' + filename + '</small><a href="javascript:;" class="am-close">&times;</a><div class="am-progress am-progress-xs am-progress-striped am-active" style="margin-bottom: 0;margin-top: .6rem"><div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%"></div></div></div>';
        log(filename);

        $("#upload-photo").ajaxSubmit({
          url: window.baseUrl + 'upload/only',
          type: 'post',
          beforeSend: function(xhr) {
              var percentVal = '0%';
              
              $("#upload-photo .am-panel").remove();
              point.after(panel);

              $(".am-close").on("click", function(){
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
            // log('success');
            if (responseText.status == 'success') {
              $("#update-photo [name=photo_url]").val(window.baseUrl + responseText.data);
              $("#photo-image").attr("src",window.baseUrl + responseText.data);
              $("#upload-photo .am-panel-bd a").removeClass("am-close").addClass("am-icon-check-circle am-success").text("");
              $("#upload-photo .am-progress-bar").css({
                width: '100%'
              });

              alert(responseText.message);
            } else {
              if (responseText.message) {
                alert(responseText.message);
              }
            }
          },
          complete: function(xhr) {
            if (xhr.responseText.indexOf('error') != -1) {
              alert('文件大小超过限制');
              $("#upload-photo .am-panel").remove();
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
          beforeSend: function(xhr) {
            if ($("#update-photo [name=photo_url]").val().trim() == '') {
              alert('您还未上传！');
              return false;
            }
          },
          success: function(responseText, statusText, xhr, $form) {
            // log('success');
            if (responseText.status) {
              alert(responseText.message);
            }
          }
        })
      });

      $("#profile-btn").on("click",function(){
        $("#profile-form input:not(:disabled)")
      });

    })();
    
    </script>
  </body>
</html>
