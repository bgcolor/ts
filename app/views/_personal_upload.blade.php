<?php 
  if ($my_upload) {
?>

<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">我的上传</strong> / <small>Upload</small></div>
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
          <tr>
            <td>文件1.doc</td>
            <td><a href="javascript:;" data-am-popover="{content: 'xxx，xxx等人已下载'}">5</a></td>
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
            <td><a href="javascript:;" data-am-popover="{content: 'xxx，xxx等人已下载'}">5</a></td>
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