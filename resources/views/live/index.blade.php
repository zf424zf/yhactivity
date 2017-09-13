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
            <img src="{{staticFile('images/active/live-list-top.png')}}" alt="bg" class="act-beg-hea-bg">
            <a href="javascript:;" class="act-beg-hea-link">
                <span id="show-mask">活动说明</span>
            </a>
        </div>
        <!-- live-list -->
        <ul class="live-list">
            <!-- live-list-on-btn ### 正在直播-->
            <!-- live-list-back-btn ### 查看回放-->
            <!-- live-list-begin-btn ### 即将开始-->
            @foreach($list['data'] as $item)
            <li>
                <img src="{{staticFile('images/active/live-list-logo.png')}}" alt="logo" class="live-list-logo">
                <img src="{{thumb($item['kol_user_avatar'])}}" alt="pic" class="live-list-user">
                <p class="live-list-con">
					<span class="title">
						{{$item['auth']}}
					</span>
                    <span class="name">
						{{$item['kol_user_name']}}
					</span>
                    <span class="bardian">
						{{$item['title']}}
					</span>
                    <span class="time">
						{{$item['date']}}
					</span>
                    <a @if($item['status'] == 'living' ||$item['status'] == 'end') href="{{urls('/live/'.$item['id'])}}" @else href="javascript:void(0)" @endif class="btn">
                        @if($item['status'] == 'living')
                            <img src="{{staticFile('images/active/live-list-on-btn.png')}}" alt="正在直播">
                        @elseif($item['status'] == 'ready')
                            <img src="{{staticFile('images/active/live-list-begin-btn.png')}}" alt="即将开始">
                        @else
                            <img src="{{staticFile('images/active/live-list-back-btn.png')}}" alt="查看回放">
                        @endif
                    </a>
                </p>
            </li>
                @endforeach
        </ul>
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
        $(function () {
            // 活动说明遮罩层
            $("#show-mask").on('tap', function () {
                $(".active-translate-mask-bg,.active-translate-mask").toggleClass('on');
            });
            $('.active-translate-mask-bg').on('tap', function () {
                $(".active-translate-mask-bg,.active-translate-mask").toggleClass('on');
            })
        })
    </script>

@endsection