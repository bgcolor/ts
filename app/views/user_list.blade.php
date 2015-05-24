<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{{ $list_title }}}</title>
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
  <div id="data" data-user-fail="{{ $user_fail }}" data-msg-delete="{{ $msg_delete }}" data-msg-reset="{{ $msg_reset }}"></div>
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
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg"><?php 
        switch($type) {
          case 1: echo '我的导师';break;
          case 2: echo '我的学徒';break;
          case 3: echo '项目用户一览';break;
          case 4: echo '用户一览';break;
        }

        ?></strong> / <small>User List</small></div>
      </div>
      
      <?php 
      if (3 == $type || 4 == $type) {
      ?>

      <form action="" class="am-form am-form-inline am-margin-horizontal am-margin-vertical">
        <div class="am-form-group am-form-icon">
          <i class="am-icon-search"></i>
          <input type="text" class="am-form-field" placeholder="查询用户名" name="q">
        </div>

        <div class="am-form-group">
          <button type="button" class="am-btn am-btn-default" id="query">
            查询
          </button>
        </div>
      </form>
      <?php 
      }
      ?>

      <?php 
      if (!isset($users) || !count($users)) {
      ?>
      <p class="am-padding-left">{{ $no_students }}</p>
      <?php 
      }
      ?>

      <ul class="am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-margin gallery-list">
      <?php 
        foreach ($users as $user) {
      ?>
        <li data-id="{{ $user->id }}" class="user-list">
            <a href="javascript:;" class="user-link" id="aa"><img class="am-img-thumbnail" src="{{ $user->photoUrl or 'http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80' }}" alt=""/></a>
            <div class="gallery-desc"><strong>姓名： </strong> <a href="javascript:;" class="user-link" data-id="{{ $user->id }}">{{ $user->name }}</a></div>
            
            <?php 
            if (isset($user->project)) {
            ?>
            <div class="gallery-desc"><strong>项目： </strong>{{ $user->project->name }}</div>
            <?php 
            } else {
            ?>
            <div class="gallery-desc"><strong>项目： </strong>无</div>
            <?php
              }
            ?>

            <div class="gallery-desc"><strong>身份： </strong><?php 
              $roleArr = array(
                '学徒',
                '评估师',
                '内审员',
                '外审员',
                '系统管理员'
              );
              $role = Session::get('role'); 
              echo $roleArr[$user->role - 1];
          ?></div>
            
            <?php 
              if (isset($user->students)) {
            ?>
            <div class="gallery-desc"><strong>学徒： </strong><?php 
                foreach ($user->students as $s) {
            ?><a href="javascript:;" class="user-link" data-id="{{ $s->id }}">{{ $s->name }}</a> <?php      
                }
            ?>
            </div>
            <?php 
              } else {
            ?>
            <div class="gallery-desc"><strong>学徒： </strong>无</div>
            <?php
              }
            ?>

            <?php 
              if (isset($user->tutor_id)) {
            ?>
            <div class="gallery-desc"><strong>导师： </strong><a href="javascript:;" class="user-link" data-id="{{ $user->tutor_id }}">{{ $user->tutor_name }}</a></div>
            <?php 
              } else {
            ?>
            <div class="gallery-desc"><strong>导师： </strong>无</div>
            <?php
              }
            ?>

            <?php 
              if (isset($user->evaluation)) {
            ?>
            <div class="gallery-desc"><strong>进度： </strong>{{ $user->evaluation->progress or 0 }}%</div>

            <div class="gallery-desc">
              <div class="am-progress am-progress-xs am-progress-striped am-active" style="margin-bottom: 0;margin-top: .6rem">
                <div class="am-progress-bar am-progress-bar-secondary"  style="width: {{ $user->evaluation->progress or 0 }}%"></div>
              </div>
            </div>
            <?php 
              } else {
            ?>
            <div class="gallery-desc"><strong>进度： </strong>无</div>
            <div class="gallery-desc">
              <div class="am-progress am-progress-xs am-progress-striped am-active" style="margin-bottom: 0;margin-top: .6rem">
                <div class="am-progress-bar am-progress-bar-secondary"  style="width: 0%"></div>
              </div>
            </div>
            <?php
              }
            ?>
            <div class="gallery-desc">
              <?php 
                if (true == $change_others_pass) { 
              ?>
              <a href="javascript:;" data-id="{{ $user->id }}" class="reset-pass">重置密码</a>
              <?php 
                }
              ?>
              <?php 
                if (true == $change_others_pass) { 
              ?>
              <a href="javascript:;" data-id="{{ $user->id }}" class="am-fr delete-user">删除用户</a>
              <?php 
                }
              ?>
            </div>

        </li>
      <?php 
        }
      ?>
      </ul>
      
      
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
      var deleteSuccess = false;

      $(document).on("click", "#modal-alert .am-modal-btn", function() {

        if (deleteSuccess === true) {
          location.reload();
        }

      });

      $("#query").on("click", function(){
        var q = $("[name=q]").val().trim();
        if (q != '') {
          location.href = window.baseUrl + 'userlist?type={{ $type }}&q=' + encodeURI(q);
        } else {
          location.href = window.baseUrl + 'userlist?type={{ $type }}';
        }
      });

      $(".reset-pass").on("click", function(){
        var userId = $(this).attr("data-id");
        
        $.modalConfirm({
          confirm: function() {
            // log('confirm');
            
            $.ajax({
              url: window.baseUrl + 'user/password/reset',
              type: 'post',
              data: {
                id: userId
              },
              success: function(data) {
                $.modalAlert({
                  type: data.status == 'success' ? 'info' : 'warning',
                  message: data.message,
                });

                // deleteSuccess = true;
              }
            });
          },
          message: $("#data").attr("data-msg-reset")
        });
      });

      $(".delete-user").on("click",function(e){
          var userId = $(this).attr("data-id");
          $.modalConfirm({
            confirm: function() {
              // log('confirm');
              $.ajax({
                url: window.baseUrl + 'user/delete',
                type: 'post',
                data: {
                  id: userId
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
            type: 'danger',
            message: $("#data").attr("data-msg-delete")
          });
        });

    })();
    
    </script>
  </body>
</html>
