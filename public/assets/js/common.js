function log(msg) {
  return console.log(msg);
}

(function(w){
	var getBaseUrl = function() {
		// pathArray = location.href.split( '/' );
		// protocol = pathArray[0];
		// host = pathArray[2];
		// return protocol + '//' + host;
		return 'http://localhost/ts/public/'
	}
	
	w.baseUrl = getBaseUrl();
})(window);

$.extend({myModal: function(options){
	var title = options.title || '系统提示';
	var msg = options.message || null;
	var action = options.action || 'open';
	var type = options.type || 'info';
	var types = {};
	types['info'] = '<span class="am-icon-info-circle am-success" style="color: #3bb4f2"></span> ';
	types['warning'] = '<span class="am-icon-warning am-success" style="color: #f37b1d"></span> ';
	types['danger'] = '<span class="am-icon-close am-success" style="color: #dd514c"></span> ';

	if (action == 'open') {

		$("#modal-box").remove();

		var modalBox = '<div id="modal-box" class="am-modal am-modal-alert" tabindex="-1" id="my-alert"><div class="am-modal-dialog"><div class="am-modal-hd">' + types[type] + title + '</div><div class="am-modal-bd">' + msg + '</div><div class="am-modal-footer"><span class="am-modal-btn">确定</span></div></div></div>'

		$("body").append(modalBox);
		$("#modal-box").modal({
			closeViaDimmer: false
		}).modal('open');
	}

	if (action == 'close') {
		$("#modal-box").modal('close');
	}
}});