<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人资料</strong> / <small>Personal information</small></div>
</div>

<div class="am-g">
  <div class="am-u-sm-12 am-u-md-4">
    <div class="am-panel am-panel-default">
      <div class="am-panel-bd">
        <div class="am-g">
          <div class="am-u-md-4">
            <img id="photo-image" class="am-img-thumbnail" src="
            <?php  
              echo isset($user['photo_url']) ? $user['photo_url'] : 'http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80'
            ?>" alt=""/>
          </div>
          <div class="am-u-md-8">
            <p>{{{ $photo_remark1 }}}</p>
            <form class="am-form" id="upload-photo" enctype="multipart/form-data">
              <div class="am-form-group">
                <input type="file" id="user-pic" name="userfile">
                <p class="am-form-help">{{{ $photo_remark2 }}}</p>
                <button type="button" class="am-btn am-btn-primary" id="update-photo-btn">保存</button>
              </div>
            </form>
            <form style="display:none" id="update-photo">
              <input type="text" name="id" value="{{ $user['id'] }}">
              <input type="text" name="photo_url">
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php 
    if ($my_progress) {
    ?>
    <div class="am-panel am-panel-default">
      <div class="am-panel-bd">
        <div class="user-info">
          <h3>我的进度</h3>
          <?php
              if (isset($user['evaluation'])) {
          ?>
          <div class="am-progress am-progress-striped am-progress-sm am-active">
            <div class="am-progress-bar" style="width: {{ $user['evaluation']->progress }}%"></div>
          </div>
          <p class="user-info-order"><strong>完成进度：</strong>{{ $user['evaluation']->progress }}%</p>
          <p class="user-info-order"><strong>评审人：</strong> <a href="javascript:;" class="user-link-s" data-id="$user['evaluation']->evaluator_id">{{ $user['evaluation']->evaluator_name }}</a></p>
          <p class="user-info-order"><strong>评审进度描述：</strong> {{ $user['evaluation']->description }}
          </p>
          <?php
              } else {
          ?>
          <div class="am-progress am-progress-sm">
            <div class="am-progress-bar" style="width: 0%"></div>
          </div>
          <p class="user-info-order"><strong>完成进度：</strong>0%</p>
          <p class="user-info-order">{{ $no_evaluation }}</p>
          <?php
              }
          ?>
          
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    
  </div>
  <div class="am-u-sm-12 am-u-md-8">
    <form class="am-form am-form-horizontal" id="profile-form">
      <div class="am-form-group">
        <label for="user-name" class="am-u-sm-2 am-form-label">姓名</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="text" id="user-name" placeholder="姓名 / Name" disabled value="{{ $user['name'] }}">
        </div>
      </div>
      <?php 
      if (isset($user['project'])) {
      ?>
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">项目</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="email" id="user-email" placeholder="请选择项目 / Project" disabled value="{{ $user['project']->name }}" data-id="{{ $user['project']->id }}">
        </div>
      </div>
      <?php
      }
      ?>
      

      <?php 
      if ($my_tutor) {
      ?>
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">导师</label>
        <div class="am-u-sm-9 am-u-end">
      <?php 
        if (isset($user['tutor'])) {
      ?>
          <!-- <select data-am-selected="{searchBox: 1}">
            <option value="a">Apple</option>
            <option value="b">Banana</option>
            <option value="o">Orange</option>
            <option value="m" selected>Mango</option>
          </select> -->
          <a href="javascript:;" class="user-link-x" data-id="{{ $user['tutor']->id }}">{{ $user['tutor']->name }}</a>
      <?php 
        } else {
          echo $no_tutor;
        }
      ?>
          
        </div>
      </div>
      <?php
      } ?>
         
      <?php 
      if ($my_student === true) { 
      ?>
      
      <!-- from-group start   -->
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">学徒</label>
        <div class="am-u-sm-9 am-u-end">
        <!-- <input type="email" id="user-email" placeholder="请选择导师 / Tutor"> -->

      <?php
        if (isset($user['students'])) {
          foreach($user['students'] as $student) {
      ?>
      <a href="javascript:;" class="user-link-x" data-id="$student->id"><?php echo $student->name ?></a>
      <?php 
          }
        } else {
          echo $no_students;
        }
      ?>

        </div>
      </div>
      <!-- from-group end   -->
      <?php 
      }
      ?>
        
      
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">电子邮件</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="email" id="user-email" placeholder="输入你的电子邮件 / Email" value="{{ $user['email'] or '' }}">
        </div>
      </div>
      <div class="am-form-group">
        <label for="user-phone" class="am-u-sm-2 am-form-label">电话</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="text" id="user-phone" placeholder="输入你的电话号码 / Telephone" value="{{ $user['phone_no'] or '' }}">
        </div>
      </div>
      <div class="am-form-group">
        <div class="am-u-sm-9 am-u-sm-push-2">
          <button type="button" class="am-btn am-btn-primary" id="profile-btn" data-id="{{ $user['id'] }}">保存修改</button>
        </div>
      </div>
    </form>
  </div>
</div>