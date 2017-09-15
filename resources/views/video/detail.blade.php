@extends('layout.main')
@section('title','选择问题')
@section('resource')
    <script src="{{staticFile('js/video-detail.js')}}"></script>
    <link href="//vjs.zencdn.net/5.19/video-js.min.css" rel="stylesheet">
    <script src="//vjs.zencdn.net/5.19/video.min.js"></script>
    <script src="{{staticFile('js/videojs-contrib-hls.min.js')}}"></script>
@endsection
@section('content')
    <div class="bg">
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
                <source src="{{$data['path']}}" type="application/x-mpegURL">
            </video>
            <a href="javascript:void(0)" class="play">
                <img src="{{staticFile('images/active/world-video-play.png')}}" alt="下一个视屏">
            </a>
        </div>
        <div class="active-pic-details video-details">
            <p class="user-details">
					<span class="user-pic">
						<img src="{{staticFile('images/active/user.png')}}" alt="user-pic">
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
            <a href="{{urls('/video')}}"><img src="{{staticFile('images/active/question-btn-jion.png')}}"
                                              alt="我要参加"></a>
            <a href="{{urls('/')}}"><img src="{{staticFile('images/active/question-btn-4.png')}}" alt="返回首页"></a>
        </p>
    </div>
    <script>
        var player = videojs('example-video');
//        player.play();
        $(function () {
            $(document).on('click', '.play', function () {
                $(this).hide();
                player.play();
            })
        })
    </script>
@endsection