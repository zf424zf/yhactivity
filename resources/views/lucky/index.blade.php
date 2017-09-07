@extends('layout.main')
@section('title','首页')
@section('resource')
@endsection
@section('content')
    <div class="bg">
        <div class="active-begin-header">
            <a href="">
                <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
            </a>
            <img src="{{staticFile('images/active/gift-index-top.png')}}" alt="bg" class="act-beg-hea-bg gift-index-top">
            <a href="javascript:;" class="act-beg-hea-link">
                <span id="show-mask">活动说明</span>
            </a>
        </div>
        <form class="gift-index">
            <label class="select-photo">
                {{--<input type="file">--}}
                <!-- show img -->
                <img id="upload" src="{{staticFile('images/active/demo.png')}}" alt="pic" class="select-photo-show">
            </label>
            <input type="submit" value="" class="gift-index-submit">

        </form>
        <p class="gift-index-more">
            <a href="{{urls('lucky/rank/1')}}" class="l"><img src="{{staticFile('images/active/gift-goodluck-next.png')}}" alt="btn"></a>
            <a href="{{urls('lucky/wall')}}" class="r"><img src="{{staticFile('images/active/gift-photo-next.png')}}" alt="btn"></a>
        </p>
    </div>
    <!-- mask -->
    <div class="active-translate-mask-bg">&nbsp;</div>
    <div class="active-translate-mask">
        <div class="over-mask">
            <ul>
                <li>
                    <h1 class="active-translate-mask-tit">
                        活动时间
                    </h1>
                    <p class="active-translate-mask-info">
                        2017年9月25日至2017年10月25日
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        活动内容
                    </h1>
                    <p class="active-translate-mask-info">
                        晒出雅哈产品，赢大奖！
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        参与方式
                    </h1>
                    <p class="active-translate-mask-info">
                        凡购买雅哈产品，并晒单，即可抽取奖品
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖励机制
                    </h1>
                    <p class="active-translate-mask-info">
                        （1）9月25日-10月2日、10月3日-10月10日、10月11日-10月18日、10月19日-10月25日每个时间段抽取10份雅哈咖啡四联装礼盒，10套雅哈×nice定制对杯，1份888现金大奖
                    </p>
                    <p class="active-translate-mask-info">
                        （2）中奖名单在“邂逅有礼”版块公布，可关注雅哈咖啡微博微信同步获取获奖信息
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖品总数量
                    </h1>
                    <p class="active-translate-mask-info">
                        雅哈咖啡四联装礼盒，共40份
                    </p>
                    <p class="active-translate-mask-info">
                        雅哈咖啡×nice定制对杯，共40套
                    </p>
                    <p class="active-translate-mask-info">
                        现金红包888元，共4份
                    </p>
                </li>
                <li>
                    <p class="active-translate-mask-info">
                        本活动解释权归雅哈所有
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <script>
        $(function(){
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
            uploader.on( 'uploadSuccess', function( file,response) {
                var url = response.data.url;
                console.log(url);
//                var module = $('#module').data('module');
//                window.location.href = '/photo/uploadImage/'+module+'?isUpload=1&path='+url
            });
            uploader.on( 'uploadError', function( file,response ) {
            });

            uploader.on( 'uploadComplete', function( file ,response) {
            });
            uploader.on( 'fileQueued', function( file,response ) {
            });
            uploader.on( 'uploadProgress', function( file, percentage ) {
            });
        })
    </script>
@endsection