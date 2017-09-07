@extends('layout.main')
@section('title','首页')
@section('resource')

@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <form class="upload-imga">
            <p class="container">
                <label class="upload-imga-left">
                    <input class="file" type="file">
                    <!--  上传图片展示 -->
                    <img data-id="{{$image['id']}}" src="{{thumb($image['path'])}}" alt="upload-img-show" class="show-img left-img">
                    <!-- <img src="../images/active/upload-imga-up-btn.png" alt="upload-imga-up-btn" class="btn"> -->
                    <em class="upload-imga-info">
                        <i>{{thumb($image['label'])}}</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                    {{--<input class="file" type="file">--}}
                    <!--  上传图片展示 -->
                    <img  alt="upload-img-show" class="show-img upload-image" style="display: none">
                    <img id="upload" src="{{staticFile('images/active/upload-imga-up-btn.png')}}" alt="upload-imga-btn" class="btn">
                    <em class="upload-imga-info">
                        <i>邂逅爱聊咖</i>
                    </em>
                </label>
            </p>
            <!-- upload-img-b -->
            <div class="upload-imgb-title">
                <p class="left">
                    <span class="upload-imgb-small-title">标签文案</span>
                    <span class="upload-img-b-ipt">
						<input class="ipt" type="text" placeholder="邂逅爱聊咖">
					</span>
                </p>
            </div>
            <!-- upload-img-b-end -->
            <p class="upload-imga-tip">
                *可使用默认文案或自行输入文案，限10个字以内
            </p>
            <p class="upload-imga-over">
                <a id="submit" href="javascript:void(0)" class="upload-imga-next">
                    <img src="{{staticFile('images/active/upload-imga-next.png')}}" alt="上传按钮">
                </a>
            </p>

        </form>
        <input type="hidden" data-module="{{$image['module']}}" id="module">
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
                var uploadImage = $('.upload-image');
                uploadImage.attr('src', url);
                uploadImage.data('path', url);
                uploadImage.css('display', '');
                $('#upload').css('display', 'none');
            });
            uploader.on('uploadError', function (file, response) {
            });

            uploader.on('uploadComplete', function (file, response) {
            });
            uploader.on('fileQueued', function (file, response) {
            });
            uploader.on('uploadProgress', function (file, percentage) {
            });

            $(document).on('click', '#submit', function () {
                $(this).css('display','none');
                var left = $('.left-img');
                var right = $('.upload-image');
                var defaultLabel = '邂逅爱聊咖';
                var originId = left.data('id');
                var rightUrl = right.data('path')
                var rightLabel = $('.ipt').val();

                var module = $('#module').data('module');
                if($.trim(rightLabel) == ''){
                    rightLabel = defaultLabel;
                }
                if(rightUrl == ''){
                    alert('请上传图片进行挑战');
                    $(this).css('display','');
                    return false;
                }
                $.ajax({
                    url:'/api/image/add',
                    type:'post',
                    data:{module:module,path:rightUrl,type:1,label:rightLabel,origin:originId},
                    success:function(ret){
                        window.location.href = '/photo/upload/success/'+ret.data.id;
                    }
                })
            });
        })
    </script>
@endsection