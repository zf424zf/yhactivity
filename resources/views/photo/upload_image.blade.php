@extends('layout.main')
@section('title','上传图片')
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
                    {{--<input class="file" type="file">--}}
                    <!--  上传图片展示 -->
                    <img data-path="{{$path}}" src="{{thumb($path,143,202)}}" alt="upload-img-show" class="show-img">
                    {{--<img src="../images/active/upload-imga-up-btn.png" alt="upload-imga-up-btn" class="btn">--}}
                    <em class="upload-imga-info left-image-label">
                        <i>邂逅爱聊咖</i>
                    </em>
                </label>
                <label class="upload-imga-right">
                {{--<input class="file upload-btn" type="file">--}}
                <!--  上传图片展示 -->
                    <img data-path="" src="" alt="upload-img-show" class="show-img upload-image" style="display: none">
                    <img src="{{staticFile('images/active/upload-imga-up-btn.png')}}" id="upload" alt="upload-imga-btn"
                         class="btn upload-bg">
                    <em class="upload-imga-info right-image-label">
                        <i>邂逅爱聊咖</i>
                    </em>
                </label>
            </p>
            <div class="upload-imga-title">
                <p class="left">
                    <span class="upload-imga-small-title">左图标签文案</span>
                    <span>
						<input class="ipt ipt-left" type="text" placeholder="邂逅爱聊咖">
					</span>
                </p>
                <p class="right">
                    <span class="upload-imga-small-title">右图标签文案</span>
                    <span>
						<input class="ipt ipt-right" type="text" placeholder="邂逅爱聊咖">
					</span>
                </p>
            </div>
            <p class="upload-imga-tip">
                *可使用默认文案或自行输入文案，限10个字以内
            </p>
            <p class="upload-imga-over">
                <a id="submit" href="javascript:void(0)" class="upload-imga-next">
                    <img src="{{staticFile('images/active/upload-imga-next.png')}}" alt="上传按钮">
                </a>
            </p>

        </form>

        <input id="module" type="hidden" data-module="{{$module}}">
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
                resize: false,
                formData:{upload_type:1}
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

            $('.ipt-left,.ipt-right').bind('keydown',function(event){
                if(event.keyCode == "13") {
                    $(this).blur();
                }
            });

            $(document).on('click', '#submit', function () {
                $(this).css('display','none');
                var left = $('.upload-imga-left img');
                var right = $('.upload-image');
                var defaultLabel = '邂逅爱聊咖';
                var leftUrl = left.data('path');
                var rightUrl = right.data('path')
                var leftLabel = $('.ipt-left').val();
                var rightLabel = $('.ipt-right').val();
                var module = $('#module').data('module');
                if ($.trim(leftLabel) == '') {
                    leftLabel = defaultLabel;
                }
                if($.trim(rightLabel) == ''){
                    rightLabel = defaultLabel;
                }
                if(leftUrl == ''||leftUrl == undefined){
                    alert('请选择挑战图片再上传');
                    $(this).css('display','');
                    return false;
                }
                if(rightUrl == '' || rightUrl == undefined){
                    alert('请上传图片进行挑战');
                    $(this).css('display','');
                    return false;
                }
                $.ajax({
                    url:'/api/image/add',
                    type:'post',
                    data:{module:module,path:leftUrl,type:0,label:leftLabel,uid:'{{$uid}}'},
                    success:function(ret){
                        if(ret.code == 0){
                            var originId = ret.data.id;
                            $.ajax({
                                url:'/api/image/add',
                                type:'post',
                                data:{module:module,path:rightUrl,type:1,label:rightLabel,origin:originId,uid:'{{$uid}}'},
                                success:function(ret){
                                    if(ret.code == 0){
                                        window.location.href = '/photo/upload/success/'+ret.data.id;
                                    }else{
                                        $(this).css('display','');
                                        alert(ret.message);
                                    }
                                }
                            })
                        }else{
                            $(this).css('display','');
                            alert(ret.message);
                        }
                    }
                })
            });
        })
    </script>
@endsection