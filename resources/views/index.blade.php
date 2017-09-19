@extends('layout.main')
@section('title','首页')
@section('resource')
@endsection
@section('content')
    <img src="{{staticFile('images/index/begin-index.gif')}}" alt="face" class="begin-index">
    <div class="body-index">
        <div class="show">
            <!-- 背景 -->
            <div class="index-bg">&nbsp;</div>
            <!-- 第一幅画面 -->
            <img src="{{staticFile('images/index/plus-1.gif')}}" alt="arm" class="plus-1">
            <img src="{{staticFile('images/index/boy-arm.gif')}}" alt="arm" class="boy-arm">
            <img src="{{staticFile('images/index/g-arm.gif')}}" alt="arm" class="girl-arm">
            <img src="{{staticFile('images/index/b-face.gif')}}" alt="face" class="boy-face">
            <img src="{{staticFile('images/index/g-face.gif')}}" alt="face" class="girl-face">
            <img src="{{staticFile('images/index/index-down.gif')}}" alt="down" class="index-down">
            <!-- 第二幅画面 -->
            <img src="{{staticFile('images/index/index-2-like.gif')}}" alt="like" class="index-2-like">
            <img src="{{staticFile('images/index/index-boy-arm.gif')}}" alt="boy-hand" class="index-2-boy-hand">
            <img src="{{staticFile('images/index/index-2-boy.png')}}" alt="boy-hand" class="index-2-boy">
            <img src="{{staticFile('images/index/index-2-hand.gif')}}" alt="girl-hand" class="index-2-girl-hand">
            <img src="{{staticFile('images/index/index-2-girl-mouth.gif')}}" alt="girl-mouth"
                 class="index-2-girl-mouth">
            <img src="{{staticFile('images/index/index-2-mouth.gif')}}" alt="boy-mouth" class="index-2-boy-mouth">
            <!-- 第三幅画面 -->
            <img src="{{staticFile('images/index/index-3-face.gif')}}" alt="boy-face" class="index-3-face">
            @if(!empty($data))
                <img src="{{$data['kol_user_avatar']}}" alt="雅哈" class="yaha-phone">
            @else
                <img src="{{staticFile('images/index/yaha-phone.png')}}" alt="雅哈" class="yaha-phone">
            @endif
            <img src="{{staticFile('images/index/index-3-hand.gif')}}" alt="hand" class="index-3-hand">
            <img src="{{staticFile('images/index/index-3-boy.png')}}" alt="hand" class="index-3-boy">
            <img src="{{staticFile('images/index/index-3-have.gif')}}" alt="hand" class="index-3-have">
            <!-- 第四幅画面 -->
            <img src="{{staticFile('images/index/index-3-boy.gif')}}" alt="boy" class="index-4-boy">
            <img src="{{staticFile('images/index/index-link-small.gif')}}" alt="boy" class="index-4-small">
            <!-- 左边2个雅哈 -->
            <img src="{{staticFile('images/index/index-change-1.png')}}" alt="雅哈" class="index-change-1">
            <img src="{{staticFile('images/index/index-btm.png')}}" alt="雅哈" class="index-change-2">
            <!-- 4个按钮 -->
            <a href="{{urls('/photo')}}" class="index-link index-link-1">&nbsp;</a>
            <a href="{{urls('/video/1')}}" class="index-link index-link-2">&nbsp;</a>
            <a href="{{urls('/live')}}" class="index-link index-link-3">&nbsp;</a>
            <a href="{{urls('/lucky')}}" class="index-link index-link-4">&nbsp;</a>
        </div>
    </div>
    <script>
        $(function () {
            //初始化页面
            setTimeout(function () {
                $(".begin-index").hide();
            }, 3000)
        })
    </script>
@endsection