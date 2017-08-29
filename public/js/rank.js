/**
 * Created by 70427 on 2017/8/28.
 */
$(function () {
    $(document).on('click', '.user-like', function () {
        var self = $(this);
        var canLike = self.data('can-like');
        var child = self.data('child');
        var target = self.data('target');
        if (canLike == 1) {
            $.ajax({
                url: '/api/like',
                type: 'post',
                data: {uid: 1, module: 1, target: target, child: child},
                success: function (ret) {
                    if (ret.code == 1009) {
                        self.data('can-like', 0)
                        alert(ret.message);
                    } else if (ret.code == 0) {
                        var $likeNum = self.find('.like-num');
                        var origin = $likeNum.data('like-cnt');
                        $likeNum.data('like-cnt', origin + 1);
                        $likeNum.html($likeNum.data('like-cnt'))
                    }
                }
            })
        } else {
            alert('您今天已经点赞该图片5次啦');
        }
    })
});