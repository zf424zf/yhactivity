@extends('layout.main')
@section('title','上传成功')
@section('resource')
@endsection
@section('content')
    <div class="bg page" data-config='<?php echo app('wechat')->js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage')) ?>'>
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <p class="clear-upload-success">&nbsp;</p>
        <h1 class="upload-success-h">
            上传成功
        </h1>
        <div class="upload-imga">
            <p class="container">
                <label class="upload-imga-left">
                {{--<input class="file" type="file" >--}}
                <!--  上传图片展示 -->
                    <img src="{{thumb(array_get($image['originInfo'],'path'),143,194)}}" alt="upload-img-show"
                         class="show-img">
                    <em class="upload-imga-info">
                        <i>{{array_get($image['originInfo'],'label')}}</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                {{--<input class="file" type="file" >--}}
                <!--  上传图片展示 -->
                    <img src="{{thumb(array_get($image,'path'),143,194)}}" alt="upload-img-show"
                         class="show-img upload-success-reset">
                    <em class="upload-imga-info">
                        <i>{{$image->label}}</i>
                    </em>
                </label>
            </p>
            <h2 class="upload-success-h2">
                <img src="{{staticFile('images/active/upload-success-title.png')}}" alt="赶快号召你的好友来点赞吧~">
            </h2>
            <ul class="upload-success-list">
                <li><a data-image-id="{{$image['id']}}" href="javascript:void(0)" class="remake"><img
                                src="{{staticFile('images/active/upload-success-list1.png')}}" alt=""></a></li>
                <li class="share"><a href="javascript:void(0)"><img src="{{staticFile('images/active/upload-success-list2.png')}}" alt=""></a></li>
                <li><a href="{{urls('/photo/list/rank')}}"><img
                                src="{{staticFile('images/active/upload-success-list3.png')}}" alt=""></a></li>
                <li><a href="{{urls('/')}}"><img src="{{staticFile('images/active/upload-success-list4.png')}}" alt=""></a>
                </li>
            </ul>
        </div>
        <input class="photo-module" type="hidden" data-module="{{$image['module']}}">
        <input class="photo-id" type="hidden" data-id="{{$image['id']}}">
    </div>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script>
        var opt = {
            name:"timeline, friend, qq, qzone, weibo",
            title:"我已拼赢整个世界，不服就来看看呗",
            description:"专治不服三百年！",
            url: window.location.href,
            icon: '{{staticFile('images/active/share.jpg')}}'
        }
        window.hybridBridge.headerBar.setShareConfig(opt);
        wx.ready(function () {
            wx.onMenuShareTimeline({
                title: '我已拼赢整个世界，不服就来看看呗', // 分享标题
                link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
                imgUrl: '{{staticFile('images/active/share.jpg')}}', // 分享图标
                desc: '专治不服三百年！',
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareAppMessage({
                title: '我已拼赢整个世界，不服就来看看呗', // 分享标题
                link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
                imgUrl: '{{staticFile('images/active/share.jpg')}}', // 分享图标
                desc: '专治不服三百年！',
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        })
        $(function () {
            var imageId = $('.photo-id').data('id');
            $(document).on('click','.share',function(){
                window.hybridBridge.system.share({
                    name: 'timeline,friend,qq,qzone,weibo',
                    title: "我已拼赢整个世界，不服就来看看呗",
                    description: "专治不服三百年！",
                    url: '/image/detail/'+imageId,
                    icon: '{{staticFile('images/active/share.jpg')}}'
                });
            })
            $(document).on('click', '.remake', function () {
                var id = $(this).data('imageId');
                $.ajax({
                    type: 'delete',
                    url: '/api/file/del',
                    data: {uid: '{{$uid}}', module: 1, target: id},
                    success: function (ret) {
                        if (ret.code == 0) {
                            var module = $('.photo-module').data('module');
                            window.location.href = '/photo/challenge/' + module
                        } else {
                            alert('删除失败，请稍后再试')
                        }
                    }
                })
            })
            $(document).on('pageInit','.page',function(e,id,page){
                if($('#'+id).data('config')){
                    wx.config(JSON.parse($('#'+id).data('config')))
                }
            })
            $.init();
        })
    </script>
    <script>

    </script>
@endsection