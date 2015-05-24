<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $user['name'] }}的下载记录</strong> / <small>Personal Download Records</small></div>
</div>

<?php 
    if (isset($user['downloads']) && count($user['downloads'])) {
?>

<!-- table start -->
<div class="am-g">
  <div class="am-u-sm-12">
    <form class="am-form">
      <table class="am-table am-table-striped am-table-hover table-main">
        <thead>
          <tr>
            <th class="table-title">文件名</th><th class="table-author am-hide-sm-only">发布人</th><th class="table-date am-hide-sm-only">下载时间</th><th class="table-set">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- tbody start -->
          <?php 
          foreach ($user['downloads'] as $download) {
          ?>
            <tr>
              <td>{{ $download->filename }}</td>
              <td><a data-id="{{ $download->owner_id }}" href="javascript:;" class="user-link">{{ $download->owner_name }}</a></td>
              <td class="am-hide-sm-only">{{ $download->updated_at }}</td>
              <td>
                <div class="am-btn-toolbar" data-file-id="{{ $download->file_id }}" data-user-id="{{ $user['id'] }}">
                  <div class="am-btn-group am-btn-group-xs">
                    <?php 
                    if (true === $user['can_download']) {
                    ?>

                    <button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary download"><span class="am-icon-download"></span> 下载</button>

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
      <hr />
    </form>
  </div>
</div>
<!-- table end -->

<?php
    } else {
?>
  <p class="am-padding-left">{{ $no_downloads }}</p>
<?php
    }
?>
