<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $user['name'] }}的资料</strong> / <small>Personal information</small></div>
</div>

<div class="am-g">
  <div class="am-u-sm-12 am-u-md-2">
    <div class="am-panel am-panel-default">
      <div class="am-panel-bd">
            <img id="photo-image" class="am-img-thumbnail" src="
            <?php  
              echo isset($user['photo_url']) ? $user['photo_url'] : 'http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80'
            ?>" alt=""/>
      </div>
    </div>
  </div>
  <div class="am-u-sm-12 am-u-md-8 am-u-end">
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
          <input type="text" id="user-email" placeholder="请选择项目 / Project" disabled value="{{ $user['project']->name }}" data-id="{{ $user['project']->id }}">
        </div>
      </div>
      <?php
      }
      ?>
      

      <?php 
      if (isset($user['tutor'])) {
      ?>
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">导师</label>
        <div class="am-u-sm-9 am-u-end">

          <!-- <select data-am-selected="{searchBox: 1}">
            <option value="a">Apple</option>
            <option value="b">Banana</option>
            <option value="o">Orange</option>
            <option value="m" selected>Mango</option>
          </select> -->
          <a href="javascript:;" class="user-link-x user-link" data-id="{{ $user['tutor']->id }}">{{ $user['tutor']->name }}</a>        
        </div>
      </div>
      <?php
      } ?>
         
      <?php 
      if (isset($user['students'])) { 
      ?>
      
      <!-- from-group start   -->
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">学徒</label>
        <div class="am-u-sm-9 am-u-end">
        <!-- <input type="email" id="user-email" placeholder="请选择导师 / Tutor"> -->

      <?php
          foreach($user['students'] as $student) {
      ?>
      <a href="javascript:;" class="user-link-x user-link" data-id="{{ $student->id }}"><?php echo $student->name ?></a>
      <?php 
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
          <input type="email" id="user-email" placeholder="未留" value="{{ $user->email or '' }}" disabled>
        </div>
      </div>
      <div class="am-form-group">
        <label for="user-phone" class="am-u-sm-2 am-form-label">电话</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="text" id="user-phone" placeholder="未留" value="{{ $user->phone_no or '' }}" disabled>
        </div>
      </div>
    </form>
  </div>
</div>

<?php 
  if (true == $user['has_progress']) {
?>
<div class="am-g">
  <div class="am-panel am-panel-default am-margin-horizontal am-margin-vertical">
    <div class="am-panel-bd">
      <div class="user-info">
        <h3>{{ $user['name'] }}的进度</h3>
        <?php
            if (isset($user['evaluation'])) {
        ?>
        <div class="am-progress am-progress-striped am-progress-sm am-active">
          <div class="am-progress-bar" style="width: {{ $user['evaluation']->progress }}%"></div>
        </div>
        <p class="user-info-order"><strong>完成进度：</strong>{{ $user['evaluation']->progress }}%</p>
        <p class="user-info-order"><strong>评审人：</strong> <a href="javascript:;" class="user-link-s user-link" data-id="{{ $user['evaluation']->evaluator_id }}">{{ $user['evaluation']->evaluator_name }}</a></p>
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

        <?php 
        if (true == $evaluate_others) {
        ?>

        <button type="button" class="am-btn am-btn-primary am-btn-xs evaluate" data-id="{{ $user['id'] }}">评审</button>

        <?php
        }
        ?>
        
      </div>
    </div>
  </div>
</div>
<?php
  }
?>
