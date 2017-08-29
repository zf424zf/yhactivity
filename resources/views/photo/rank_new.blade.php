@extends('layout.main')
@section('title','首页')
@section('resource')
    <script src="{{staticFile('/js/rank.js')}}"></script>
@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <div class="active-rank">
            <ul class="tab">
                <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_MX || empty(Request::get('child'))) class="on" @endif>
                    <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_MX}}">
                        @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_MX || empty(Request::get('child')))
                            <img class="on" src="{{staticFile('images/active/h1-on.png')}}" alt="标题">
                        @else
                            <img class="default" src="{{staticFile('images/active/h1-default.png')}}" alt="标题">
                        @endif
                    </a>
                </li>
                <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_BS ) class="on" @endif>
                    <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_BS}}">
                        @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_BS )
                            <img class="on" src="{{staticFile('images/active/h2-on.png')}}" alt="标题">
                        @else
                            <img class="default" src="{{staticFile('images/active/h2-default.png')}}" alt="标题">
                        @endif
                    </a>
                </li>
                <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_ZC ) class="on" @endif>
                    <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_ZC}}">
                        @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_ZC )
                            <img class="on" src="{{staticFile('images/active/h3-on.png')}}" alt="标题">
                        @else
                            <img class="default" src="{{staticFile('images/active/h3-default.png')}}" alt="标题">
                        @endif
                    </a>
                </li>
                <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_CH ) class="on" @endif >
                    <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_CH}}">
                        @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_CH )
                            <img class="on" src="{{staticFile('images/active/h4-on.png')}}" alt="标题">
                        @else
                            <img class="default" src="{{staticFile('images/active/h4-default.png')}}" alt="标题">
                        @endif
                    </a>
                </li>
            </ul>
        </div>
        <div class="active-rank-content">
            <p class="active-rank-top">
                <a href="{{'/photo/list/rank'}}">
                    排行榜
                </a>
                <a href="/" class="on">
                    最新
                </a>
            </p>
            <div class="active-rank-over">
                <div class="active-rank-list">
                    <ul>
                        @foreach($data as $item)
                            <li>
                                <a href="./active-pic-details.html">
                                    <p class="pic">
                                        <img src="{{stripslashes($item->originInfo['path'])}}" alt="nan">
                                        <img src="{{$item->path}}" alt="nv">
                                        <span class="tip l">{{isset($item->originInfo->label) ?  $item->originInfo->label : '邂逅爱聊咖' }}</span>
                                        <span class="tip r">{{isset($item->label) ?  $item->label : '邂逅爱聊咖' }}</span>
                                    </p>
                                </a>
                                <p class="user">
										<span class="user-photo">
											<img src="{{staticFile('images/active/user.png')}}" alt="photo">
										</span>
                                    <span class="user-title">
                                        {{$item->nickname}}
                                    </span>
                                    <span data-child="{{$item->module}}" data-target="{{$item->id}}" data-can-like="{{$item->canLike}}" class="user-like">
                                        <img src="{{staticFile('images/active/like.png')}}" alt="like">
                                        <span class="like-num" data-like-cnt="{{$item->cnt}}">{{$item->cnt}}</span>
                                    </span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection