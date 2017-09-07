@extends('layout.main')
@section('title','首页')
@section('resource')

@endsection
@section('content')
    <div class="bg">
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
                    <img src="{{thumb(array_get($image['originInfo'],'path'),143,194)}}" alt="upload-img-show" class="show-img">
                    <em class="upload-imga-info">
                        <i>{{array_get($image['originInfo'],'label')}}</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                    {{--<input class="file" type="file" >--}}
                    <!--  上传图片展示 -->
                    <img src="{{thumb(array_get($image,'path'),143,194)}}" alt="upload-img-show" class="show-img upload-success-reset">
                    <em class="upload-imga-info">
                        <i>{{$image->label}}</i>
                    </em>
                </label>
            </p>
            <h2 class="upload-success-h2">
                <img src="{{staticFile('images/active/upload-success-title.png')}}" alt="赶快号召你的好友来点赞吧~">
            </h2>
            <ul class="upload-success-list">
                <li><a href="{{urls('/photo')}}"><img src="{{staticFile('images/active/upload-success-list1.png')}}" alt=""></a></li>
                <li><a href=""><img src="{{staticFile('images/active/upload-success-list2.png')}}" alt=""></a></li>
                <li><a href="{{urls('/photo/list/rank')}}"><img src="{{staticFile('images/active/upload-success-list3.png')}}" alt=""></a></li>
                <li><a href="{{urls('/')}}"><img src="{{staticFile('images/active/upload-success-list4.png')}}" alt=""></a></li>
            </ul>
        </div>

    </div>
@endsection