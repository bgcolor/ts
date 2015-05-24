<?php 
if ($my_student) {
?>

<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">我的学徒</strong> / <small>My Students</small></div>
</div>

<?php 
  if (isset($user['students']) && count($user['students'])) {
    foreach ($user['students'] as $s) {
?>
<div class="am-panel am-panel-default am-margin-horizontal">
  <div class="am-panel-bd">
    <div class="user-info">
      <h3><a href="javascript:;" class="user-link" data-id="{{ $s->id }}">{{ $s->name }}</a>的进度</h3>
      <?php
          if (isset($s->evaluation)) {
      ?>
      <div class="am-progress am-progress-striped am-progress-sm am-active">
        <div class="am-progress-bar" style="width: {{ $s->evaluation->progress }}%"></div>
      </div>
      <p class="user-info-order"><strong>完成进度：</strong>{{ $s->evaluation->progress }}%</p>
      <p class="user-info-order"><strong>评审人：</strong> <a href="javascript:;" class="user-link-s user-link" data-id="$s->evaluation->evaluator_id">{{ $s->evaluation->evaluator_name }}</a></p>
      <p class="user-info-order"><strong>评审进度描述：</strong> {{ $s->evaluation->description }}
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
  }
?>


<?php  
}
?>