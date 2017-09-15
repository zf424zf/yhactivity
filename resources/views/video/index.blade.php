@extends('layout.main')
@section('title','选择问题')
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
            <video src="{{staticFile('videos/test.ogg')}}" class="video" autoplay="autoplay">
                您的浏览器版本过低
            </video>
            <a href="" class="btn prev"><img src="{{staticFile('images/active/world-video-prev.png')}}" alt="上一个视屏"></a>
            <a href="" class="btn next"><img src="{{staticFile('images/active/world-video-next.png')}}" alt="下一个视屏"></a>
{{--            <a href="" class="play"><img src="{{staticFile('images/active/world-video-play.png')}}" alt="下一个视屏"></a>--}}
            <p class="user">
                <span class="user-pic"><img src="{{staticFile('images/active/user.png')}}" alt="user-pic"></span>
                <span class="user-name">
					我是用户ID
				</span>
            </p>
            <p class="info">
                <img src="{{staticFile('images/active/world-video-info.png')}}" alt="tip">
                <span class="text">
					<b>如果你非要参加前任的结婚宴，你会穿什么颜色的衣服？</b>
				</span>
            </p>
        </div>
        <p class="world-video-next">
            <a href="{{urls('/video/question')}}" class="btn mar"><img src="{{staticFile('images/active/world-video-recoding.png')}}" alt=""></a>
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
                        参与雅哈“异次元合拍”拼图互动环节，赢大奖！
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        参与方式
                    </h1>
                    <p class="active-translate-mask-info">
                        选择要挑战的原图，上传自己的图片来完成创意拼图。
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖励机制
                    </h1>
                    <p class="active-translate-mask-info">
                        （1） 截止10月2日、10月10日、10月18日、10月25日24点各擂台被点赞数排名TOP10用户，可获得雅哈×nice定制对杯
                    </p>
                    <p class="active-translate-mask-info">
                        （2） 截止10月25日24点各擂台被点赞数排名TOP1用户可获得该擂台大奖
                    </p>
                    <p class="active-translate-mask-info">
                        （3）中奖名单在“邂逅有礼”版块公布，可关注雅哈微博微信同步获取获奖信息
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖品
                    </h1>
                    <p class="active-translate-mask-info">
                        雅哈×nice定制对杯，共160套
                    </p>
                    <p class="active-translate-mask-info">
                        最潮擂台大奖-卡西欧自拍神器，共1台
                    </p>
                    <p class="active-translate-mask-info">
                        冒险擂台大奖-Rimowa旅行箱，共1份
                    </p>
                    <p class="active-translate-mask-info">
                        吃货擂台大奖-当地米其林/顶级餐厅双人畅吃，共1份
                    </p>
                    <p class="active-translate-mask-info">
                        变身擂台大奖-日本yaman美容仪，共1台
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
        })
    </script>
@endsection