@extends('layout.main')
@section('title','上传图片')
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
                    {{--<input class="file" type="file">--}}
                    <!--  上传图片展示 -->
                    <img data-id="{{$image['id']}}" src="{{thumb($image['path'])}}" alt="upload-img-show" class="show-img left-img">
                    <!-- <img src="../images/active/upload-imga-up-btn.png" alt="upload-imga-up-btn" class="btn"> -->
                    <em class="upload-imga-info">
                        <i>{{$image['label']}}</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                    {{--<input class="file" type="file">--}}
                    <!--  上传图片展示 -->
                    <img  alt="upload-img-show" class="show-img upload-image" style="display: none">
                    <img id="upload" src="{{staticFile('images/active/upload-imga-up-btn.png')}}" alt="upload-imga-btn" class="btn">
                    <em class="upload-imga-info right-label">
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

        </div>
        <input type="hidden" data-module="{{$image['module']}}" id="module">
    </div>
    <script>
        $(function () {
            var uploader = WebUploader.create({
                auto: true,
//                fileNumLimit: 1,
                // 文件接收服务端。
                server: '/api/upload',
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#upload',
                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false,
                formData:{upload_type:1},
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });
            uploader.on('uploadSuccess', function (file, response) {
                $.hidePreloader();
                hideAlert();
                var url = response.data.url;
                var uploadImage = $('.upload-image');
                uploadImage.attr('src', url);
                uploadImage.data('path', url);
                uploadImage.css('display', '');
                $('#upload').css('display', 'none');
            });
            uploader.on('uploadError', function (file, response) {
                $.hidePreloader();
                hideAlert();
                alert('上传失败，请稍后再试')
            });

            uploader.on('uploadComplete', function (file, response) {
                $.hidePreloader();
                hideAlert();
            });
            uploader.on('fileQueued', function (file, response) {
            });
            uploader.on('uploadProgress', function (file, percentage) {
                $.showPreloader('上传中')
            });
            $('.ipt').bind('keydown',function(event){
                if(event.keyCode == "13") {
                    $(this).blur();
                }
            });
            $(document).on('input propertychange','.ipt',function(){
                var value = $(this).val();
                $('.right-label i').html(value);
            })
            var uploading = false;
            $(document).on('click', '#submit', function () {
                if(uploading){
                    return false;
                }
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
                if(rightUrl == '' || rightUrl == undefined){
                    alert('请上传图片进行挑战');
                    $(this).css('display','');
                    return false;
                }
                uploading = true;
                $.ajax({
                    url:'/api/image/add',
                    type:'post',
                    data:{module:module,path:rightUrl,type:1,label:rightLabel,origin:originId,uid:'{{$uid}}'},
                    success:function(ret){
                        uploading = false;
                        window.location.href = '/photo/upload/success/'+ret.data.id;
                    },
                    error:function () {
                        uploading = false;
                        alert('上传失败，请稍后再试');
                    }
                })
            });
        })

    </script>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script src="{{staticFile('js/share_photo.js')}}"></script>
@endsection