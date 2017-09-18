@extends('layout.main')
@section('title','真心话大比拼')
@section('resource')
@endsection
@section('content')
    <div class="bg">
        <div class="active-begin-header">
            <a href="">
                <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
            </a>
            <img src="{{staticFile('images/active/world-index-bg.png')}}" alt="bg" class="world-index-bg">
            <a href="javascript:;" class="act-beg-hea-link">
                <span id="show-mask">活动说明</span>
            </a>
        </div>
        <div class="world-video">
            <video width="620" playsinline src="{{$data['path']}}" class="video" autoplay="autoplay">
                您的浏览器版本过低
            </video>
            @if($id > 1)
            <a  href="javascript:void(0)" class="btn prev"><img src="{{staticFile('images/active/world-video-prev.png')}}" alt="上一个视屏"></a>
            @endif
            @if($id < $count)
            <a href="javascript:void(0)" class="btn next"><img src="{{staticFile('images/active/world-video-next.png')}}" alt="下一个视屏"></a>
{{--            <a href="" class="play"><img src="{{staticFile('images/active/world-video-play.png')}}" alt="下一个视屏"></a>--}}
            @endif
            <p class="user">
                <span class="user-pic"><img src="{{thumb($data['headicon'])}}" alt="user-pic"></span>
                <span class="user-name">
					{{$data['nickname']}}
				</span>
            </p>
            {{--<p class="info">--}}
                {{--<img src="{{staticFile('images/active/world-video-info.png')}}" alt="tip">--}}
                {{--<span class="text">--}}
					{{--<b>如果你非要参加前任的结婚宴，你会穿什么颜色的衣服？</b>--}}
				{{--</span>--}}
            {{--</p>--}}
        </div>
        <p class="world-video-next">
            <a href="http://m.oneniceapp.com/go/toNice?action=storyPublish?lens_id=10" class="btn mar"><img src="{{staticFile('images/active/world-video-recoding.png')}}" alt=""></a>
            <a href="{{urls('/video/rank')}}" class="btn"><img src="{{staticFile('images/active/world-video-hot.png')}}" alt=""></a>
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
                        参与雅哈咖啡“真心话大比拼”story短视频互动环节，赢大奖！
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        参与方式
                    </h1>
                    <p class="active-translate-mask-info">
                        用户选择要挑战的短视频问题，根据问题录制一段12秒以内的视频并上传，可分享朋友圈为自己拉票点赞。获得点赞最高的用户，将获得雅哈咖啡送出的奖励。
                    </p>
                    <p class="active-translate-mask-info">
                        参与活动的视频请确保真实，自主创作或经过权利人合法授权。
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖励机制
                    </h1>
                    <p class="active-translate-mask-info">
                        （1）截止10月2日、10月10日、10月18日、10月25日24点，各擂台点赞数排名TOP10用户，可获得雅哈咖啡产品礼盒各一份，每个获奖ID限一份。
                    </p>
                    <p class="active-translate-mask-info">
                        （2） 截止10月25日24点，各擂台点赞数排名TOP1用户，可获得雅哈咖啡送出的擂台大奖，4个擂台各一份。
                    </p>
                    <p class="active-translate-mask-info">
                        （3）中奖名单在“邂逅有礼”版块公布，可关注雅哈微博微信同步获取获奖信息。
                    </p>
                    <p class="active-translate-mask-info">
                        雅哈微信ID：雅哈愉快聊<br/>
                        雅哈微博ID：统一雅哈咖啡
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖品
                    </h1>
                    <p class="active-translate-mask-info">
                        雅哈咖啡产品礼盒
                    </p>
                    <p class="active-translate-mask-info">
                        最潮擂台大奖-Casio自拍相机
                    </p>
                    <p class="active-translate-mask-info">
                        冒险擂台大奖-Rimowa旅行箱
                    </p>
                    <p class="active-translate-mask-info">
                        吃货擂台大奖-当地米其林/顶级餐厅双人套餐
                    </p>
                    <p class="active-translate-mask-info">
                        变身擂台大奖-日本Yaman美容仪
                    </p>
                </li>
                <li>
                    <p class="active-translate-mask-info">
                        奖品以实物为准。
                    </p>
                </li>
                <li>
                    <p class="active-translate-mask-info">
                        <img style="width: 300px" src="{{staticFile('images/zhenxinhua_jiangpin.png')}}">
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            // 活动说明遮罩层
            $("#show-mask").on('tap',function(){
                $(".active-translate-mask-bg,.active-translate-mask").toggleClass('on');
            });
            $('.active-translate-mask-bg').on('tap',function(){
                $(".active-translate-mask-bg,.active-translate-mask").toggleClass('on');
            })
            $(document).on('click','.video',function(){
               var isPause = $(this).attr('paused');
               if(isPause){
                   $(this)[0].play();
               }else{
                   $(this)[0].pause();
               }
            })
            $(document).on('click','.next',function(){
                var curId = '{{$id}}';
                var id = parseInt(curId) + 1;
                window.location.href = '/video/'+id;
            })
            $(document).on('click','.prev',function(){
                var curId = '{{$id}}';
                var id = parseInt(curId) - 1;
                window.location.href = '/video/'+id;
            })
        })
    </script>
@endsection