@extends('layout.main')
@section('title','邂逅有礼')
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
            <input type="button"  value="" class="submit gift-index-submit">

        </form>
        <span style="font-size: .5rem;width: 10rem;margin: .5rem auto;display: block;line-height: .8rem">晒出你与雅哈咖啡的合影，即可参与抽奖，每人每日限一次机会！</span>
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
                        参与晒雅哈，赢大奖！
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        参与方式
                    </h1>
                    <p class="active-translate-mask-info">
                        凡购买雅哈产品，并晒出你与雅哈的合影，即可获得抽奖机会
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖励机制
                    </h1>
                    <p class="active-translate-mask-info">
                        （1）以下每个时间段将送出各种奖品：
                        9月25日-10月02日
                        10月03日-10月10日
                        10月11日-10月18日
                        10月19日-10月25日
                    </p>
                    <p class="active-translate-mask-info">
                        （2）抽到奖品后请在中奖弹出框中填写有效联系方式，中奖名单会在“邂逅有礼”版块公布，并可关注雅哈咖啡微博微信同步获取获奖信息，工作人员会在72小时内审核上传照片，联系获奖者派发奖品。
                    </p>
                    <p class="active-translate-mask-info">
                        雅哈微信ID：雅哈愉快聊
                        雅哈微博ID：统一雅哈咖啡
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖品
                    </h1>
                    <p class="active-translate-mask-info">
                        雅哈咖啡产品礼盒：每周抽取10份，共40份
                    </p>
                    <p class="active-translate-mask-info">
                        雅哈咖啡×nice定制对杯：每周抽取10套，共40套，80个杯子
                    </p>
                    <p class="active-translate-mask-info">
                        888现金大奖：每周抽取一个，共4个
                    </p>
                </li>
                <li>
                    <p class="active-translate-mask-info">
                        奖品以实物为准
                    </p>
                </li>
                <li>
                    <p class="active-translate-mask-info">
                        <img style="width: 300px" src="{{staticFile('images/xiehouyouli_jiangpin.png')}}">
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script>
        var opt = {
            name:"timeline, friend, qq, qzone, weibo",
            title:"来，拿个红包压压惊!",
            description:"不砸得你哈哈大笑算我输〜",
            url: window.location.href,
            icon: '{{staticFile('images/active/share.jpg')}}'
        }
        window.hybridBridge.headerBar.setShareConfig(opt);
        $(function(){
            // 活动说明遮罩层
            $("#show-mask").on('tap',function(){
                $(".active-translate-mask-bg,.active-translate-mask").toggleClass('on');
            });
            $('.active-translate-mask-bg').on('tap',function(){
                $(".active-translate-mask-bg,.active-translate-mask").toggleClass('on');
            })
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
            uploader.on( 'uploadSuccess', function( file,response) {
                $.hidePreloader();
                var url = response.data.url;
                var upload = $('#upload');
                upload.data('url',url);
                upload.attr('src',url);

//                window.location.href = '/photo/uploadImage/'+module+'?isUpload=1&path='+url
            });
            uploader.on( 'uploadComplete', function( file,response) {
                $.hidePreloader();
            });

            uploader.on( 'uploadError', function( file,response ) {
                $.hidePreloader();
            });
            uploader.on( 'fileQueued', function( file,response ) {
            });
            uploader.on( 'uploadProgress', function( file, percentage ) {
                $.showPreloader('上传中')
            });

            $(document).on('click','.submit',function(){
                var upload = $('#upload');
                var path = upload.data('url');
                if(path == '' || path == undefined){
                    alert('您还没有上传图片');
                    return false;
                }
                $.ajax({
                    url:'/api/image/add',
                    type:'post',
                    data:{type:9,module:9,path:path,uid:'{{$uid}}'},
                    success:function(ret){
                        if(ret.data.haveChance == 1){
                            location.href = '/lucky/prize?image_id='+ret.data.id;
                        }else{
                            location.href = '/lucky/wall'
                        }
                    }
                })
            })
        })
    </script>
@endsection