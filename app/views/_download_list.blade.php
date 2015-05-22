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
          <?php
          if (!isset($downloads) || !count($downloads)) {
          ?>
          <tr><td colspan="5">{{ $no_downloads }}</td></tr>
          <?php
          } else {
            foreach($downloads as $download) {
          ?>
          <tr>
            <td>$download->filename</td>
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
      <div class="am-cf">
        共 {{ $downloads->getTotal() }} 个文件
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