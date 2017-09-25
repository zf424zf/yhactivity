@extends('layout.main')
@section('title','大咖有话说')
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
                        参与雅哈咖啡“大咖有话说”看KOL直播，赢奖品！
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        参与方式
                    </h1>
                    <p class="active-translate-mask-info">
                        每周双休日晚8点看直播，与你忠爱的KOL近距离互动聊天，呼唤朋友一起来看直播赢奖励。
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖励机制
                    </h1>
                    <p class="active-translate-mask-info">
                        观看直播，配合主持人口令、直播留言、截取有雅哈咖啡logo的直播画面，发至微博@统一雅哈咖啡即有机会领取定制奖品。
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
                        雅哈咖啡×nice定制对杯
                    </p>
                </li>
                <li>
                    <p class="active-translate-mask-info">
                        奖品以实物为准
                    </p>
                </li>
                <li>
                    <p class="active-translate-mask-info">
                        <img style="width: 300px" src="{{staticFile('images/dakayouhuashuo_jiangpin.png')}}">
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script type="text/javascript">
        var opt = {
            name:"timeline, friend, qq, qzone, weibo",
            title:"这个直播尺度太大，再不看一会可能就被河蟹了~",
            description:"Aha ha ha ha ha ha ha ha…",
            url: window.location.href,
            icon: '{{staticFile('images/active/share.jpg')}}'
        }
        window.hybridBridge.headerBar.setShareConfig(opt);
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