@extends('layout.main')
@section('title','视频详情')
@section('resource')
    <link href="//vjs.zencdn.net/5.19/video-js.min.css" rel="stylesheet">
    <style>
        .video-js.vjs-default-skin .vjs-big-play-button { display: none; }
        .video-js .vjs-control{
            width: 3em!important;
        }
    </style>
@endsection
@section('content')
    <div class="bg page"  data-config='<?php echo app('wechat')->js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage')) ?>'>
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <div class="question-header">
            <h1 class="question-h">
                问题
            </h1>
            <p class="title">
                {{$data['question']['question']}}
            </p>
            <img src="{{staticFile('images/active/question-h-r.png')}}" alt="img" class="question-h-r">
        </div>
        <div class="world-video">
            <video playsinline poster="{{$data['cover']}}" id="example-video" width="600" height="280"
                   class="live-on-video video-js vjs-default-skin" controls>
                <source src="{{$data['path']}}" type="video/mp4">
            </video>
            <a href="javascript:void(0)" class="play">
                <img src="{{staticFile('images/active/world-video-play.png')}}" alt="下一个视屏">
            </a>
        </div>
        <div class="active-pic-details video-details">
            <p class="user-details">
					<span class="user-pic">
						<img src="{{$data['users']['headicon']}}" alt="user-pic">
					</span>
                <span class="user-name">
						{{$data['users']['nickname']}}
					</span>
                <span class="user-like-number" data-cnt="{{$data['likeCnt']}}">
						{{$data['likeCnt']}}
					</span>
                <span class="user-like" data-child="{{$data['module']}}" data-target="{{$data['id']}}"
                      data-like="{{$data['canLike']}}">
						<img src="{{staticFile('images/active/love.png')}}" alt="love">
					</span>
            </p>
        </div>
        <p class="question-next video-details-next">
            <a href="http://m.oneniceapp.com/go/toNice?action=storyPublish?lens_id={{$jtId}}"><img src="{{staticFile('images/active/question-btn-jion.png')}}"
                                              alt="我要参加"></a>
            <a href="{{urls('/')}}"><img src="{{staticFile('images/active/question-btn-4.png')}}" alt="返回首页"></a>
        </p>
    </div>
    <input type="hidden" class="niced" data-nice="{{$uid}}">
    <script src="{{staticFile('js/video-detail.js')}}"></script>
    <script src="//vjs.zencdn.net/5.19/video.min.js"></script>
    <script src="{{staticFile('js/videojs-contrib-hls.min.js')}}"></script>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script src="{{staticFile('js/share_video.js')}}"></script>
    <script>
        var player = videojs('example-video');
        $(function () {
            $(document).on('click', '.play', function () {
                $(this).hide();
                player.play();
            })

            player.on("ended", function(){
                $('.play').show();
            })
            $(document).on('pageInit','.page',function(e,id,page){
                if($('#'+id).data('config')){
                    wx.config(JSON.parse($('#'+id).data('config')))
                }
            })
            $.init();
        })
    </script>
@endsection
