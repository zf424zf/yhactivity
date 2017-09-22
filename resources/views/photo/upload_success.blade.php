@extends('layout.main')
@section('title','上传成功')
@section('resource')
    <script src="http://www.oneniceapp.com/webapp-open-static/js/main.js"></script>
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
                    <img src="{{thumb(array_get($image['originInfo'],'path'),143,194)}}" alt="upload-img-show"
                         class="show-img">
                    <em class="upload-imga-info">
                        <i>{{array_get($image['originInfo'],'label')}}</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                {{--<input class="file" type="file" >--}}
                <!--  上传图片展示 -->
                    <img src="{{thumb(array_get($image,'path'),143,194)}}" alt="upload-img-show"
                         class="show-img upload-success-reset">
                    <em class="upload-imga-info">
                        <i>{{$image->label}}</i>
                    </em>
                </label>
            </p>
            <h2 class="upload-success-h2">
                <img src="{{staticFile('images/active/upload-success-title.png')}}" alt="赶快号召你的好友来点赞吧~">
            </h2>
            <ul class="upload-success-list">
                <li><a data-image-id="{{$image['id']}}" href="javascript:void(0)" class="remake"><img
                                src="{{staticFile('images/active/upload-success-list1.png')}}" alt=""></a></li>
                <li class="share"><a href="javascript:void(0)"><img src="{{staticFile('images/active/upload-success-list2.png')}}" alt=""></a></li>
                <li><a href="{{urls('/photo/list/rank')}}"><img
                                src="{{staticFile('images/active/upload-success-list3.png')}}" alt=""></a></li>
                <li><a href="{{urls('/')}}"><img src="{{staticFile('images/active/upload-success-list4.png')}}" alt=""></a>
                </li>
            </ul>
        </div>
        <input class="photo-module" type="hidden" data-module="{{$image['module']}}">
    </div>
    <script>
        $(function () {
            $(document).on('click','.share',function(){
                call_share();
            })
            $(document).on('click', '.remake', function () {
                var id = $(this).data('imageId');
                $.ajax({
                    type: 'delete',
                    url: '/api/file/del',
                    data: {uid: '{{$uid}}', module: 1, target: id},
                    success: function (ret) {
                        if (ret.code == 0) {
                            var module = $('.photo-module').data('module');
                            window.location.href = '/photo/challenge/' + module
                        } else {
                            alert('删除失败，请稍后再试')
                        }
                    }
                })
            })
        })
    </script>
    <script>
        function call_share() {
            require(['open/nice-sdk-1.0'], function (nicesdk) {
                nicesdk.systemShare({
                    name: "friend",//这是分享到哪里  例如:timeline 表示分享到微信朋友圈，friend表示分享到微信好友
                    title: "nicer",
                    description: "nice",
                    url: "http://activity.dev/photo/upload/success/92",
                    icon: ""
                });
            });
        }
    </script>
@endsection