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
            <img src="{{staticFile('images/active/active-begin-bg.png')}}" alt="bg" class="act-beg-hea-bg">
            <a href="javascript:;" class="act-beg-hea-link">
                <span id="show-mask">活动说明</span>
            </a>
        </div>
        <ul class="active-begin-list">
            @foreach($data as $key=>$value)
                <?php
                    $first = current($value);
                    $end = end($value);
                ?>
            <li>
                <div class="act-beg-lis-tit"><img src="../images/active/act-beg-lis-tit{{$key}}.png" alt="变身擂台"></div>
                <a href="{{urls('/photo/challenge/'.$key)}}" class="act-beg-lis-link"><img src="{{staticFile('images/active/act-beg-lis-link.png')}}" alt="进入擂台"></a>
                <p class="act-beg-lis-tip">
                    本周超人气擂主{{$first->nickname}}，目前已获赞{{$first->cnt}}
                </p>
                <p class="act-beg-lis-group">
					<span class="act-lis-group-left">
						<img src="{{thumb(array_get($first->originInfo,'path'))}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{isset($first->originInfo->label) ?  $first->originInfo->label : '邂逅爱聊咖' }}</b>
						</em>
					</span>
                    <span class="act-lis-group-right">
						<img src="{{thumb($first->path)}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{empty($first->label) ? '邂逅爱聊咖' : $first->label}}</b>
						</em>
					</span>
                </p>
                <p class="act-beg-user-name">
                    <img src="{{staticFile('images/active/user.png')}}" alt="user" class="act-beg-lis-pic">
                    <span class="act-beg-lis-name">{{$first->nickname}}</span>
                </p>
                <p class="act-beg-lis-group">
					<span class="act-lis-group-left">
						<img src="{{thumb(array_get($end->originInfo,'path'))}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{isset($end->originInfo->label) ? $end->originInfo->label : '邂逅爱聊咖' }}</b>
						</em>
					</span>
                    <span class="act-lis-group-right">
						<img src="{{thumb($end->path)}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{isset($end->label) ? '邂逅爱聊咖' : $end->label}}</b>
						</em>
					</span>
                </p>
                <p class="act-beg-user-name">
                    <img src="{{staticFile('images/active/user.png')}}" alt="user" class="act-beg-lis-pic">
                    <span class="act-beg-lis-name">{{$end->nickname}}</span>
                </p>
                @endforeach
            </li>
        </ul>
        <p class="active-begin-more">
            <img src="{{staticFile('images/active/active-begin-more.png')}}" alt="more">
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
    <script>
        $(function(){
            $(document).on('click','.active-begin-more',function(){
                location.href = '/photo/list/rank?module=1&child=1'
            });
        })
    </script>
@endsection