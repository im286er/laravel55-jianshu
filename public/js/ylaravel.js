$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var editor = new wangEditor('content');
if (editor.config) {
    // 上传图片（举例）
    editor.config.uploadImgUrl = '/posts/image/upload';

    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
    editor.config.hideLinkImg = true;
    editor.create();
}

$('.follow-button').click(function(event) {
	var target = $(event.target);
	var current_follow = target.attr('follow-value');
	var user_id = target.attr('follow-user');
	if (current_follow == 1) {
		// 取消关注
		$.ajax({
			url: '/users/' + user_id + '/unfan',
			method: 'POST',
			dataType: 'json',
			success: function(data) {
				if (data.error != 0) {
					alert(data.msg);
					return;
				}

				target.attr('follow-value', 0);
				target.text("关注");
			}
		})
	}else{
		// 关注
		$.ajax({
			url: '/users/' + user_id + '/fan',
			method: 'POST',
			dataType: 'json',
			success: function(data) {
				if (data.error != 0) {
					alert(data.msg);
					return;
				}

				target.attr('follow-value', 1);
				target.text("取消关注");
			}
		})
	}
});
