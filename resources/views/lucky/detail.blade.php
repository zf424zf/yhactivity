@extends('layout.main')
@section('title','晒单详情')
@section('resource')

@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <div class="gift-details">
            <img src="{{thumb($data['path'])}}" alt="pic" class="gift-details-pic">
        </div>
        <p class="gift-user-con">
            <img src="{{thumb($data['users']['headicon'])}}" alt="user-photo" class="user-photo">
            <span class="name">
					{{$data['users']['nickname']}}
				</span>
        </p>
        <p class="gift-next">
            <a href="{{urls('/lucky')}}" class="l"><img src="{{staticFile('images/active/gift-details-btn1.png')}}" alt="我要参与"></a>
            <a href="{{urls('/')}}"><img src="{{staticFile('images/active/gift-details-btn2.png')}}" alt="回到首页"></a>
        </p>
    </div>
@endsection