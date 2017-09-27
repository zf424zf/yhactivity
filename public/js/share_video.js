/**
 * Created by 70427 on 2017/9/27.
 */
var opt = {
    name: "timeline, friend, qq, qzone, weibo",
    title: "想听真心话？呵呵，请开始你的表演〜",
    description: "够不够real你说了算！",
    url: window.location.href,
    icon: 'http://aha.oiily.com/images/active/share.jpg'
}
window.hybridBridge.headerBar.setShareConfig(opt);
wx.ready(function () {
    wx.onMenuShareTimeline({
        title: '想听真心话？呵呵，请开始你的表演〜', // 分享标题
        link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
        imgUrl: 'http://aha.oiily.com/images/active/share.jpg', // 分享图标
        desc: '够不够real你说了算！',
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    });
    wx.onMenuShareAppMessage({
        title: '想听真心话？呵呵，请开始你的表演〜', // 分享标题
        link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
        imgUrl: 'http://aha.oiily.com/images/active/share.jpg', // 分享图标
        desc: '够不够real你说了算！',
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
    });
})