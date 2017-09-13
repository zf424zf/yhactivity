@extends('layout.main')
@section('title','选择问题')
@section('resource')
    <script src="{{staticFile('js/video-detail.js')}}"></script>
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
            <a href="" class="play">
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
                <span class="user-like-number" data-like-cnt="{{$data['likeCnt']}}">
						{{$data['likeCnt']}}
					</span>
                <span class="user-like" data-child="{{$data['module']}}" data-target="{{$data['id']}}" data-can-like="{{$data['canLike']}}">
						<img src="{{staticFile('images/active/love.png')}}" alt="love">
					</span>
            </p>
        </div>
        <p class="question-next video-details-next">
            <a href="{{urls('/video')}}"><img src="{{staticFile('images/active/question-btn-jion.png')}}" alt="我要参加"></a>
            <a href="{{urls('/')}}"><img src="{{staticFile('images/active/question-btn-4.png')}}" alt="返回首页"></a>
        </p>
    </div>

@endsection