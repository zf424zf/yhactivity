var opt = {
    name: "timeline, friend, qq, qzone, weibo",
    title: "嘿嘿，这件事一个人做，不如两个人做！",
    description: "合不合拍，试了才知道！",
    url: window.location.href,
    icon: '../images/active/share.jpg'
}
window.hybridBridge.headerBar.setShareConfig(opt);
wx.ready(function () {
    wx.onMenuShareTimeline({
        title: '嘿嘿，这件事一个人做，不如两个人做！', // 分享标题
        link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
        imgUrl: '../images/active/share.jpg', // 分享图标
        desc: '合不合拍，试了才知道！',
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareAppMessage({
        title: '嘿嘿，这件事一个人做，不如两个人做！', // 分享标题
        link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
        imgUrl: '../images/active/share.jpg', // 分享图标
        desc: '合不合拍，试了才知道！',
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    });
})