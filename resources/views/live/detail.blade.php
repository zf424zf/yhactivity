@extends('layout.main')
@section('title','首页')
@section('resource')

@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <div class="live-on-header">
            <p class="user-details">
				<span class="user-pic">
					<img src="{{thumb($data['kol_user_avatar'])}}" alt="user-pic">
				</span>
                <span class="user-name">
					<i class="top">本场嘉宾：</i><i class="btm">{{$data['kol_user_name']}}</i>
				</span>
                <span class="user-like-number">
					56518&nbsp;在线
				</span>
                <span class="user-like">
					<img src="{{staticFile('images/active/love.png')}}" alt="love">
				</span>

            </p>
            <span class="btm-plu">
				主持人：我是主持人ID
			</span>
        </div>
        <!-- live-on -->
        <div  class="live-on-con">
            {{--<div id="a1" class="live-on-videos"></div>--}}
            <video playsinline src="http://media.oneniceapp.com/recordings/z1.nicelive.178258685826433034/178258685826433034.m3u8" class="live-on-video">

{{--            <video src="@if($data['status'] == 'living') {{$data['hdl']}} @elseif($data['status'] == 'end') {{$data['rtmp']}} @endif" class="live-on-video">--}}
            你的浏览器版本太低\(^o^)/~
            </video>
        </div>
        <div class="live-on-comment-list">
            <img src="{{staticFile('images/active/like-live-on.png')}}" alt="like" class="like-live-on">
            <ul>
                @foreach($message as $item)
                    <li data-id="{{$item['id']}}">
                        <span class="user">{{$item['users']['name']}}：</span>
                        {{$item['content']}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="live-over">
            <form class="live-on-comment-in" action="" method="">
                <input type="text" placeholder="输入文字">
                <input type="submit" value="发送">
            </form>
        </div>
    </div>
    {{--<script type="text/javascript" src="{{staticFile('/js/ckplayer/ckplayer.js')}}" charset="utf-8"></script>--}}
    {{--<script type="text/javascript">--}}
        {{--var flashvars={--}}
            {{--f:'{{$data['rtmp']}}',--}}
            {{--c:0,--}}
            {{--p:1--}}
        {{--};--}}

        {{--var param = {bgcolor:'#fff',allowFullScreen:false,wmode:'transparent'};--}}
        {{--CKobject.embedSWF('{{staticFile('js/ckplayer/ckplayer.swf')}}','a1','ckplayer_a1',330,330,flashvars,param);--}}
    {{--</script>--}}
@endsection