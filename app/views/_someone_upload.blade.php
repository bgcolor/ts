<?php 
if (true == $user['has_uploads']) {
?>

<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $user['name'] }}的上传</strong> / <small>Personal Upload</small></div>
</div>

<?php 
    if (isset($user['uploads'])) {
?>

<div class="am-g">
  <div class="am-u-sm-12">
    <form class="am-form">
      <table class="am-table am-table-striped am-table-hover table-main">
        <thead>
          <tr>
            <th class="table-title">文件名</th><th class="table-type">下载人数</th><th class="table-author am-hide-sm-only">发布人</th><th class="table-date am-hide-sm-only">上传日期</th><th class="table-set">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- tbody start -->
          <?php 
          foreach ($user['uploads'] as $upload) {
          ?>
          <tr>
            <td>{{ $upload->filename }}</td>
            <td><a href="javascript:;" data-am-popover="<?php
              if (isset($upload->downloaders) && count($upload->downloaders)) {echo 1;
              ?>{content: '<?php
              foreach ($upload->downloaders as $k => $d) {
              if ($k != 0) {
              echo '，';
              }
              echo $d->downloader_name;
              }
              ?>等人已下载', trigger: 'hover focus'}<?php
              }
              
            ?>"><?php echo isset($upload->downloaders) ? count($upload->downloaders) : 0 ?></a></td>
            <td><a href="javascript:;" class="user-link" data-id="{{ $upload->user_id }}">{{ $upload->user_name }}</a></td>
            <td class="am-hide-sm-only">{{ $upload->created_at }}</td>
            <td>
              <div class="am-btn-toolbar" data-file-id="{{ $upload->id }}" data-user-id="{{ $upload->user_id }}">
                <div class="am-btn-group am-btn-group-xs">
                  <?php 
                  if (true === $user['can_download']) {
                  ?>

                  <button type="button" class="am-btn am-btn-default am-text-secondary am-btn-xs download"><span class="am-icon-download"></span> 下载</button>

                  <?php
                  }
                  
                  if (true === $user['can_delete']) {
                  ?>

                  <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only delete"><span class="am-icon-trash-o"></span> 删除</button>
                  
                  <?php
                  }
                  ?>
                  
                </div>
              </div>
            </td>
          </tr>
          <?php
          }
          ?>
          
          
          <!-- tbody end -->
        </tbody>
      </table>

    </form>
  </div>
</div>

<?php
    } else {
?>
  <p class="am-padding-left">{{ $no_uploads }}</p>
<?php
    }
}
?>