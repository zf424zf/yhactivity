@extends('layout.main')
@section('title','异次元合拍-详情')
@section('resource')
@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <div class="upload-imga">
            <p class="container">
                <label class="upload-imga-left">
                    <!--  上传图片展示 -->
                    <img src="{{thumb($data->originInfo->path,250,324)}}" alt="upload-img-show" class="show-img">
                    <em class="upload-imga-info">
                        <i>{{$data->originInfo->label or '邂逅爱聊咖'}}</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                    <!--  上传图片展示 -->
                    <img src="{{thumb($data->path,250,324)}}" alt="upload-img-show" class="show-img">
                    <em class="upload-imga-info">
                        <i>{{$data->label or '邂逅爱聊咖'}}</i>
                    </em>
                </label>
            </p>
            <div class="active-pic-details">
                <p class="user-details" data-child="{{$data->module}}" data-target="{{$data->id}}" data-can-like="{{$data->canLike}}">
					<span class="user-pic">
						<img src="{{$data->users->headicon}}" alt="user-pic">
					</span>
                    <span class="user-name">
						{{$data->users->nickname}}
					</span>
                    <span class="user-like-number" data-like-cnt="{{$data->cnt}}">
						{{$data->cnt}}
					</span>
                    <span class="user-like">
						<img src="{{staticFile('images/active/love.png')}}" alt="love">
					</span>
                </p>
            </div>
            <p class="upload-imga-over">
                <a href="{{urls('/')}}" class="upload-imga-next">
                    <img src="{{staticFile('images/active/active-pic-details-btn.png')}}" alt="上传按钮">
                </a>
            </p>

        </div>
    </div>
    <input type="hidden" class="niced" data-nice="{{$uid}}">
    <script src="{{staticFile('js/photo-detail.js')}}"></script>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script src="{{staticFile('js/share_photo.js')}}"></script>
@endsection