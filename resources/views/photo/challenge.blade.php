@extends('layout.main')
@section('title','挑战')
@section('resource')
    <style>
        .content {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            overflow: auto;
        }
    </style>
@endsection
@section('content')
    <div class="page">
        <div class="bg content infinite-scroll infinite-scroll-bottom">
            <div class="active-enge-title">
                <a href="">
                    <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
                </a>
                <!-- <img src="../images/active/enge-title.png" alt="冒险擂台" class="active-enge-title-bg">
                <img src="../images/active/enge-title1.png" alt="变身擂台" class="active-enge-title-bg">
                <img src="../images/active/enge-title2.png" alt="最潮擂台" class="active-enge-title-bg"> -->
                <img src="{{staticFile('images/active/enge-title'.$module.'.png')}}" alt="吃货擂台"
                     class="active-enge-title-bg">
            </div>
            <div class="enge-upload-img">
                <div class="enge-upload-img-bg">
                    <label class="enge-upload-img-left">
                        <img id="upload" src="{{staticFile('images/active/enge-upload-img-up.png')}}" alt="上传图片"
                             class="enge-upload-img-up">
                        {{--<input  type="file" class="file">--}}
                    </label>
                    <p class="enge-upload-img-right">
                        <img src="" alt="上传图片展示" class="enge-upload-img-show">
                    </p>
                </div>
            </div>
            <div class="enge-list">
                @if(isset($data['data']) && !empty($data['data']))
                    <ul class="list-container">
                        @foreach($data['data'] as $item)
                            <li>
                                <p>
                                    <img src="{{thumb($item['path'])}}" alt="pic" class="img">
                                    <em class="engr-info">
                                        <i>{{empty($item['label']) ? '邂逅爱聊咖' : $item['label']}}</i>
                                    </em>
                                    <a href="{{urls('/photo/uploadImage/'.$item['module'].'?isUpload=2&origin='.$item['id'])}}"
                                       class="enge-btn">
                                        <img class="btn" src="{{staticFile('images/active/enge-btn.png')}}" alt="挑战">
                                    </a>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                    <div class="infinite-scroll-preloader">
                        <div class="preloader">
                        </div>
                    </div>
                @else
                    <div class="no_data"></div>
                @endif
                <input id="module" type="hidden" data-module="{{$module}}">
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var uploader = WebUploader.create({
                auto: true,
                fileNumLimit: 9,
                // 文件接收服务端。
                server: '/api/upload',
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#upload',
                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false
            });
            uploader.on('uploadSuccess', function (file, response) {
                var url = response.data.url;
                var module = $('#module').data('module');
                window.location.href = '/photo/uploadImage/' + module + '?isUpload=1&path=' + url
            });
            uploader.on('uploadError', function (file, response) {
            });

            uploader.on('uploadComplete', function (file, response) {
            });
            uploader.on('fileQueued', function (file, response) {
            });
            uploader.on('uploadProgress', function (file, percentage) {
            });

            $(document).on("pageInit", ".page", function (e, id, page) {
                var loading = false;
                var currentPage = 1;
                $('.infinite-scroll-preloader').hide();
                $(document).on('infinite', '.infinite-scroll-bottom', function () {
                    if (loading) {
                        return;
                    }
                    loading = true;
                    $('.infinite-scroll-preloader').show();
                    $.ajax({
                        url: '/photo/challenge/' + '{{$module}}',
                        type: 'GET',
                        data: {
                            page: currentPage + 1
                        },
                        dataType: 'html',
                        cache: false,
                        success: function (html) {
                            if ($(html).find('.no_data').length > 0) {
                                $('.infinite-scroll-preloader').remove();
                                $.detachInfiniteScroll($('.infinite-scroll'));
                            }
                            else {
                                $('.list-container').append($(html).find('.list-container').html());
                                $('.infinite-scroll-preloader').hide();
                                loading = false;
                                currentPage++;
                            }
                        }
                    });
                })
            });
            $.init();
        })
    </script>
@endsection