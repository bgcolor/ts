<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人资料</strong> / <small>Personal information</small></div>
</div>

<div class="am-g">
  <div class="am-u-sm-12 am-u-md-4">
    <div class="am-panel am-panel-default">
      <div class="am-panel-bd">
        <div class="am-g">
          <div class="am-u-md-4">
            <img class="am-img-thumbnail" src="http://amui.qiniudn.com/bw-2014-06-19.jpg?imageView/1/w/1000/h/1000/q/80" alt=""/>
          </div>
          <div class="am-u-md-8">
            <p>{{{ $photo_remark1 }}}</p>
            <form class="am-form">
              <div class="am-form-group">
                <input type="file" id="user-pic">
                <p class="am-form-help">{{{ $photo_remark2 }}}</p>
                <button type="button" class="am-btn am-btn-primary">保存</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="am-panel am-panel-default">
      <div class="am-panel-bd">
        <div class="user-info">
          <h3>我的进度</h3>
          <div class="am-progress am-progress-sm">
            <div class="am-progress-bar" style="width: 60%"></div>
          </div>
          <p class="user-info-order"><strong>完成进度：</strong>60%</p>
          <p class="user-info-order"><strong>评审人：</strong> <a href="javascript:;" class="user-link-s">张三</a></p>
          <p class="user-info-order"><strong>评审进度描述：</strong> 已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，已基本主要资料的学习，
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-12 am-u-md-8">
    <form class="am-form am-form-horizontal">
      <div class="am-form-group">
        <label for="user-name" class="am-u-sm-2 am-form-label">姓名</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="text" id="user-name" placeholder="姓名 / Name" disabled value="{{ $user['name'] }}">
        </div>
      </div>
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">项目</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="email" id="user-email" placeholder="请选择项目 / Project" disabled value="{{ $user['project_name'] }}">
        </div>
      </div>
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">导师</label>
        <div class="am-u-sm-9 am-u-end">
          <!-- <select data-am-selected="{searchBox: 1}">
            <option value="a">Apple</option>
            <option value="b">Banana</option>
            <option value="o">Orange</option>
            <option value="m" selected>Mango</option>
          </select> -->
          <a href="javascript:;" class="user-link-x" data-id="{{ $user['tutor_id'] }}">{{ $user['tutor_name'] }}</a>
        </div>
      </div>
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">学徒</label>
        <div class="am-u-sm-9 am-u-end">
          <!-- <input type="email" id="user-email" placeholder="请选择导师 / Tutor"> -->
          <a href="javascript:;" class="user-link-x">张三</a>
          <a href="javascript:;" class="user-link-x">张三</a>
          <a href="javascript:;" class="user-link-x">张三</a>
          <a href="javascript:;" class="user-link-x">张三</a>
          <a href="javascript:;" class="user-link-x">张三</a>
          <a href="javascript:;" class="user-link-x">张三</a>
        </div>
      </div>
      <div class="am-form-group">
        <label for="user-email" class="am-u-sm-2 am-form-label">电子邮件</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="email" id="user-email" placeholder="输入你的电子邮件 / Email">
        </div>
      </div>
      <div class="am-form-group">
        <label for="user-phone" class="am-u-sm-2 am-form-label">电话</label>
        <div class="am-u-sm-9 am-u-end">
          <input type="email" id="user-phone" placeholder="输入你的电话号码 / Telephone">
        </div>
      </div>
      <div class="am-form-group">
        <div class="am-u-sm-9 am-u-sm-push-2">
          <button type="button" class="am-btn am-btn-primary">保存修改</button>
        </div>
      </div>
    </form>
  </div>
</div>