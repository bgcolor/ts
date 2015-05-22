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
          <?php
          if (!isset($uploads) || !count($uploads)) {
          ?>
          <tr><td colspan="5">{{ $no_uploads }}</td></tr>
          <?php
          } else {
            foreach($uploads as $upload) {
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
            <td><a href="javascript:;" data-id="{{ $upload->user_id }}}">{{ $upload->user_name }}</a></td>
            <td class="am-hide-sm-only">{{ $upload->created_at }}</td>
            <td>
              <div class="am-btn-toolbar" data-file-id="{{ $upload->id }}" data-user-id="{{ $user_id }}">
                <div class="am-btn-group am-btn-group-xs">
                  <button type="button" class="am-btn am-btn-default am-text-secondary am-btn-xs download"><span class="am-icon-download"></span> 下载</button>
                  <!-- <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button> -->
                  <!-- <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button> -->
                  <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only delete"><span class="am-icon-trash-o"></span> 删除</button>
                </div>
              </div>
            </td>
          </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
    <div class="am-cf">
      共 {{ $uploads->getTotal() }} 个文件
      <div class="am-fr">
        <ul class="am-pagination">
          <?php echo with(new AmPresenter($paginator))->render(); ?>
        </ul>
      </div>
    </div>
    <hr />
  </form>
</div>
</div>