<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
  <div class="am-offcanvas-bar admin-offcanvas-bar">
    <ul class="am-list admin-sidebar-list">
      <li><a href="{{ URL::to('/') }}" class="am-cf"><?php 
            $roleArr = array(
              '学徒',
              '评估师',
              '内审员',
              '外审员',
              '系统管理员'
            );
            $role = Session::get('role'); 
            echo $roleArr[$role - 1];
          ?>
          <strong style="color: #0e90d2">
          <?php
            echo Session::get('uname');
          ?>
          </strong>，您好！</a></li>
      <?php if ($my_profile === true) { ?>
        <li><a href="{{ URL::to('/') }}" class="am-cf"><span class="am-icon-user"></span> 我的信息</a></li>
      <?php } ?>
      <?php if ($my_tutor === true) { ?>
      <li><a href="{{ URL::to('userlist') }}?type=1"><span class="am-icon-mortar-board"></span> 我的导师</a></li>
      <?php } ?>
      <?php if ($my_student === true) { ?>
      <li><a href="{{ URL::to('userlist') }}?type=2"><span class="am-icon-book"></span> 我的学徒</a></li>
      <?php } ?>
      <?php if ($project_users === true) { ?>
      <li><a href="{{ URL::to('userlist') }}?type=3"><span class="am-icon-book"></span> 项目用户一览</a></li>
      <?php } ?>
      <?php if ($all_users === true) { ?>
      <li><a href="{{ URL::to('userlist') }}?type=4"><span class="am-icon-book"></span> 用户一览</a></li>
      <?php } ?>
      <?php if ($my_download === true) { ?>
      <li><a href="{{ URL::to('download') }}"><span class="am-icon-download"></span> 我的下载</a></li>
      <?php } ?>
      <?php if ($my_upload === true) { ?>
      <li><a href="{{ URL::to('upload') }}"><span class="am-icon-upload"></span> 我的上传</a></li>
      <?php } ?>
      <?php if ($manage_files === true) { ?>
      <li><a href="{{ URL::to('download') }}"><span class="am-icon-file-text-o"></span> 上传下载管理</a></li>
      <?php } ?>
      <?php if ($project_files === true) { ?>
      <li><a href="{{ URL::to('download') }}"><span class="am-icon-file-text-o"></span> 项目文件一览</a></li>
      <?php } ?>
      <?php if ($create_user === true) { ?>
      <li><a href="{{ URL::to('createuser') }}"><span class="am-icon-user-plus"></span> 添加用户</a></li>
      <?php } ?>
      <?php if ($create_project === true) { ?>
      <li><a href="{{ URL::to('createproject') }}"><span class="am-icon-plus-square"></span> 添加项目</a></li>
      <?php } ?>
      <?php if ($change_pass === true) { ?>
      <li><a href="{{ URL::to('changepass') }}"><span class="am-icon-calculator"></span> 修改密码</a></li>
      <?php } ?>
      <li><a href="logout"><span class="am-icon-sign-out"></span> 注销</a></li>
    </ul>
    <div class="am-panel am-panel-default admin-sidebar-panel">
      <div class="am-panel-bd">
        <p><span class="am-icon-bookmark"></span> 公告</p>
        <p>{{ $public_msg }}</p>
      </div>
    </div>
  </div>
</div>