function log(msg) {
    return console.log(msg);
}

(function(w) {
    var getBaseUrl = function() {
        // pathArray = location.href.split( '/' );
        // protocol = pathArray[0];
        // host = pathArray[2];
        // return protocol + '//' + host;
        return 'http://localhost/ts/public/'
    }

    w.baseUrl = getBaseUrl();
})(window);

$.extend({
    modalAlert: function(options) {
        var title = options.title || '系统提示';
        var msg = options.message || null;
        var action = options.action || 'open';
        var type = options.type || 'info';
        var types = {};
        types['info'] = '<span class="am-icon-info-circle am-success" style="color: #3bb4f2"></span> ';
        types['warning'] = '<span class="am-icon-warning am-success" style="color: #f37b1d"></span> ';
        types['danger'] = '<span class="am-icon-close am-success" style="color: #dd514c"></span> ';

        if (action == 'open') {
            // log($("#modal-alert").length);
            if ($("#modal-alert").length) {
                $("#modal-alert .am-modal-hd div:first").html(types[type] + title);
                $("#modal-alert .am-modal-bd").html(msg);
                $("#modal-alert").modal('open');
                return;
            }

            var modalBox = '<div id="modal-alert" class="am-modal am-modal-alert" tabindex="-1"><div class="am-modal-dialog"><div class="am-modal-hd"><div>' + types[type] + title + '</div><a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a></div><div class="am-modal-bd">' + msg + '</div><div class="am-modal-footer"><span class="am-modal-btn">确定</span></div></div></div>'

            $("body").append(modalBox);
            $("#modal-alert").modal({
                closeViaDimmer: false
            }).modal('open');
        }

        if (action == 'close') {
            $("#modal-alert").modal('close');
        }
    },
    modalConfirm: function(options) {
        var title = options.title || '系统提示';
        var msg = options.message || '您好，貌似出错了！';
        var action = options.action || 'open';
        var type = options.type || 'warning';
        var types = {};
        var confirm = options.confirm || function(){}
        var cancel = options.cancel || function(){};
        types['info'] = '<span class="am-icon-info-circle am-success" style="color: #3bb4f2"></span> ';
        types['warning'] = '<span class="am-icon-warning am-success" style="color: #f37b1d"></span> ';
        types['danger'] = '<span class="am-icon-close am-success" style="color: #dd514c"></span> ';

        if (action == 'open') {
            // log($("#modal-alert").length);
            if ($("#modal-confirm").length) {
                $("#modal-confirm .am-modal-hd div:first").html(types[type] + title);
                $("#modal-confirm .am-modal-bd").html(msg);
                $("#modal-confirm").modal('open');
                return;
            }

            var modalBox = '<div id="modal-confirm" class="am-modal am-modal-confirm" tabindex="-1"><div class="am-modal-dialog"><div class="am-modal-hd"><div>' + types[type] + title + '</div><a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a></div><div class="am-modal-bd">' + msg + '</div><div class="am-modal-footer"><span class="am-modal-btn" data-am-modal-cancel>取消</span><span class="am-modal-btn" data-am-modal-confirm>确定</span></div></div></div>'

            $("body").append(modalBox);
            $("#modal-confirm").modal({
                closeViaDimmer: false,
                relatedTarget: this,
                onConfirm: confirm,
                onCancel: cancel
            }).modal('open');
        }

        if (action == 'close') {
            $("#modal-alert").modal('close');
        }
    },
    popupInfo: function(str) {
        $.ajax({
            url: window.baseUrl + 'statusinfo/get',
            data: {
                status_code: str
            },
            success: function(data) {
                // log(data);
                $.modalAlert({
                    type: 'warning',
                    message: data.data,
                });
            }
        });
    }
});

function getConstantString(id) {
    $.ajax({
        url: window.baseUrl + 'constant/get',
        data: {
            id: id
        },
        success: function(data) {
            return data.data ? data.data : false;
        },
        complete: function() {
            return false;
        }
    });
}

function getStatusInfo(str) {
    $.ajax({
        url: window.baseUrl + 'statusinfo/get',
        data: {
            status_code: str
        },
        success: function(data) {
            return data.data ? data.data : false;
        },
        complete: function() {
            return false;
        }
    });
}

$(function(){
    $(document).on("click", ".user-link", function(){
        var id = $(this).attr("data-id") || $(this).parent().attr("data-id");
        location.href = window.baseUrl + 'user?id=' + id;
    });
});