@extends('layout.main')
@section('title','首页')
@section('resource')

@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="../images/active/act-beg-hea-logo.png" alt="logo" class="active-logo">
        </a>
        <form class="upload-imga">
            <p class="container">
                <label class="upload-imga-left">
                    <input class="file" type="file">
                    <!--  上传图片展示 -->
                    {{--<img src="../images/active/1.png" alt="upload-img-show" class="show-img">--}}
                    <img src="../images/active/upload-imga-up-btn.png" alt="upload-imga-up-btn" class="btn">
                    <em class="upload-imga-info">
                        <i>邂逅爱聊咖</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                    <input class="file" type="file">
                    <!--  上传图片展示 -->
                    <!-- <img src="../images/active/1.png" alt="upload-img-show" class="show-img"> -->
                    <img src="../images/active/upload-imga-up-btn.png" alt="upload-imga-btn" class="btn">
                    <em class="upload-imga-info">
                        <i>邂逅爱聊咖</i>
                    </em>
                </label>
            </p>
            <div class="upload-imga-title">
                <p class="left">
                    <span class="upload-imga-small-title">左图标签文案</span>
                    <span>
						<input class="ipt" type="text" placeholder="邂逅爱聊咖">
					</span>
                </p>
                <p class="right">
                    <span class="upload-imga-small-title">右图标签文案</span>
                    <span>
						<input class="ipt" type="text" placeholder="邂逅爱聊咖">
					</span>
                </p>
            </div>
            <p class="upload-imga-tip">
                *可使用默认文案或自行输入文案，限10个字以内
            </p>
            <p class="upload-imga-over">
                <a href="./upload-img-b.html" class="upload-imga-next">
                    <img src="../images/active/upload-imga-next.png" alt="上传按钮">
                </a>
            </p>

        </form>
    </div>
@endsection