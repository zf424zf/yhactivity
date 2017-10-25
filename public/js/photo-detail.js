$(function(){
    $(document).on('click','.user-details',function(){
        var self = $(this);
        var canLike = self.data('canLike');
        var child = self.data('child');
        var target = self.data('target');
        var nice = $('.niced').data('nice');
        if (canLike == 1) {
            $.ajax({
                url: '/like',
                type: 'post',
                data: {uid: nice, module: 1, target: target, child: child},
                success: function (ret) {
                    if (ret.code == 1009) {
                        self.data('canLike', 0)
                        alert(ret.message);
                    } else if (ret.code == 0) {
                        var $likeNum = self.find('.user-like-number');
                        var origin = $likeNum.data('likeCnt');
                        $likeNum.data('likeCnt', origin + 1);
                        $likeNum.html($likeNum.data('likeCnt'))
                    }
                }
            })
        } else {
            alert('您今天已经点赞该图片10次啦');
        }
    })
})