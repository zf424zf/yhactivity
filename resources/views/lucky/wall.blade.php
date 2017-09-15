@extends('layout.main')
@section('title','晒单照片墙')
@section('resource')

@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <h1 class="gift-wall-h">
            <img src="{{staticFile('images/active/gift-wall-h.png')}}" alt="晒单照片墙">
        </h1>
        <div class="active-rank-content gift-wall-content">
            <div class="over">
                <ul>
                    @foreach($data['data'] as $item)
                    <li>
                        <a href="{{"/lucky/detail/".$item['id']}}">
                            <p class="photo">
                                <img src="{{thumb($item['path'])}}" alt="photo">
                            </p>
                            <p class="info">
                                <img src="{{thumb($item['users']['headicon'])}}" alt="user" class="user">
                                <span class="name">{{$item['users']['nickname']}}</span>
                            </p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection