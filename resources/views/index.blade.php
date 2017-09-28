@extends('layout.main')
@section('title','首页')
@section('resource')
@endsection
@section('content')
    <img src="http://img.guoshish.com/aha/h5/begin-index.gif" alt="face" class="begin-index">
    <div class="body-index">
        <div class="show page"
             data-config='<?php echo app('wechat')->js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage')) ?>'>
            <!-- 背景 -->
            <div class="index-bg">&nbsp;</div>
            <!-- 第一幅画面 -->
            <img src="http://img.guoshish.com/aha/h5/plus-1.gif" alt="arm" class="plus-1">
            <img src="http://img.guoshish.com/aha/h5/boy-arm.gif" alt="arm" class="boy-arm">
            <img src="http://img.guoshish.com/aha/h5/g-arm.gif" alt="arm" class="girl-arm">
            <img src="http://img.guoshish.com/aha/h5/b-face.gif" alt="face" class="boy-face">
            <img src="http://img.guoshish.com/aha/h5/g-face.gif" alt="face" class="girl-face">
            <img src="http://img.guoshish.com/aha/h5/index-down.gif" alt="down" class="index-down">
            <!-- 第二幅画面 -->
            <img src="http://img.guoshish.com/aha/h5/index-2-like.gif" alt="like" class="index-2-like">
            <img src="http://img.guoshish.com/aha/h5/index-boy-arm.gif" alt="boy-hand" class="index-2-boy-hand">
            <img src="http://img.guoshish.com/aha/h5/index-2-boy.png" alt="boy-hand" class="index-2-boy">
            <img src="http://img.guoshish.com/aha/h5/index-2-hand.gif" alt="girl-hand" class="index-2-girl-hand">
            <img src="http://img.guoshish.com/aha/h5/index-2-girl-mouth.gif" alt="girl-mouth"
                 class="index-2-girl-mouth">
            <img src="http://img.guoshish.com/aha/h5/index-2-mouth.gif" alt="boy-mouth" class="index-2-boy-mouth">
            <!-- 第三幅画面 -->
            <img src="http://img.guoshish.com/aha/h5/index-3-face.gif" alt="boy-face" class="index-3-face">
            @if(!empty($data))
                <img src="{{$data['kol_user_avatar']}}" alt="雅哈" class="yaha-phone">
            @else
                <img src="http://img.guoshish.com/aha/h5/yaha-phone.png" alt="雅哈" class="yaha-phone">
            @endif
            <img src="http://img.guoshish.com/aha/h5/index-3-hand.gif" alt="hand" class="index-3-hand">
            <img src="http://img.guoshish.com/aha/h5/index-3-boy.png" alt="hand" class="index-3-boy">
            <img src="http://img.guoshish.com/aha/h5/index-3-have.gif" alt="hand" class="index-3-have">
            <!-- 第四幅画面 -->
            <img src="http://img.guoshish.com/aha/h5/index-3-boy.gif" alt="boy" class="index-4-boy">
            <img src="http://img.guoshish.com/aha/h5/index-link-small.gif" alt="boy" class="index-4-small">
            <!-- 左边2个雅哈 -->
            <img src="http://img.guoshish.com/aha/h5/index-change-1.png" alt="雅哈" class="index-change-1">
            <img src="http://img.guoshish.com/aha/h5/index-btm.png" alt="雅哈" class="index-change-2">
            <!-- 4个按钮 -->
            <a href="{{urls('/photo')}}" class="index-link index-link-1">&nbsp;</a>
            <a href="{{urls('/video/1')}}" class="index-link index-link-2">&nbsp;</a>
            <a href="{{urls('/live')}}" class="index-link index-link-3">&nbsp;</a>
            <a href="{{urls('/lucky')}}" class="index-link index-link-4">&nbsp;</a>
        </div>
    </div>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script>
        var opt = {
            name: "timeline, friend, qq, qzone, weibo",
            title: "我们爱聊荤段子〜",
            description: "我要下车！这根本不是去幼儿园的路！",
            url: window.location.href,
            icon: '{{staticFile('images/active/share.jpg')}}'
        }
        window.hybridBridge.headerBar.setShareConfig(opt);
        $(function () {
            //初始化页面
            setTimeout(function () {
                $(".begin-index").hide();
            }, 3000)
            $(document).on('pageInit', '.page', function (e, id, page) {
                if ($('#' + id).data('config')) {
                    wx.config(JSON.parse($('#' + id).data('config')))
                }
            })
            $.init();
        })
        wx.ready(function () {

            wx.onMenuShareTimeline({
                title: '我们爱聊荤段子〜', // 分享标题
                link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
                imgUrl: '{{staticFile('images/active/share.jpg')}}', // 分享图标
                desc: '我要下车！这根本不是去幼儿园的路！',
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareAppMessage({
                title: '我们爱聊荤段子〜', // 分享标题
                link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
                imgUrl: '{{staticFile('images/active/share.jpg')}}', // 分享图标
                desc: '我要下车！这根本不是去幼儿园的路！',
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        })
    </script>
    @include('layout.music_60')
@endsection
@section('music')
    <script>
        wx.ready(function () {
            var media = document.getElementById("music");
            media.play();
        })
    </script>
@endsection