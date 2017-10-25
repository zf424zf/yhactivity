$(function(){
    $(document).on('click','.user-like',function(){
        var self = $(this);
        var canLike = self.data('like');
        var child = self.data('child');
        var target = self.data('target');
        var nice = $('.niced').data('nice');
        if (canLike == 1) {
            $.ajax({
                url: '/like',
                type: 'get',
                data: {uid: nice, module: 2, target: target, child: child},
                success: function (ret) {
                    if (ret.code == 1009) {
                        self.data('like', 0)
                        alert(ret.message);
                    } else if (ret.code == 0) {
                        var $likeNum = $('.user-like-number');
                        var origin = $likeNum.data('cnt');
                        $likeNum.data('cnt', origin + 1);
                        $likeNum.html($likeNum.data('cnt'))
                    }
                }
            })
        } else {
            alert('您今天已经点赞该视频5次啦');
        }
    })
})
