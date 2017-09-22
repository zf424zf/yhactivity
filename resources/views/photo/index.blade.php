@extends('layout.main')
@section('title','异次元合拍')
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
                    <div class="act-beg-lis-tit"><img src="../images/active/act-beg-lis-tit{{$key}}.png" alt="变身擂台">
                    </div>
                    <a href="{{urls('/photo/challenge/'.$key)}}" class="act-beg-lis-link"><img
                                src="{{staticFile('images/active/act-beg-lis-link.png')}}" alt="进入擂台"></a>
                    @if(!empty($value))
                        <p class="act-beg-lis-tip">
                            本周超人气擂主{{$first->trueName}}，目前已获赞{{$first->trueCnt}}
                        </p>
                        <p class="act-beg-lis-group">
					<span class="act-lis-group-left">
						<img src="{{$first->originInfo->cut_path}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{isset($first->originInfo->label) ?  $first->originInfo->label: '邂逅爱聊咖' }}</b>
						</em>
					</span>

                            <span class="act-lis-group-right">
						<img src="{{thumb($first->cut_path)}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{empty($first->label) ? '邂逅爱聊咖' : $first->label}}</b>
						</em>
					</span>
                        </p>
                        <p class="act-beg-user-name">
                            <img src="{{$first->originInfo->headicon}}" alt="user" class="act-beg-lis-pic">
                            <span class="act-beg-lis-name">{{$first->originInfo->nickname}}</span>
                        </p>
                        <p class="act-beg-user-name" style="margin: -2rem 0 0 0;padding-left: 9rem;">
                            <img src="{{$first->headicon}}" alt="user" class="act-beg-lis-pic">
                            <span class="act-beg-lis-name">{{$first->nickname}}</span>
                        </p>
                        <p class="act-beg-lis-group">
					<span class="act-lis-group-left">
						<img src="{{$end->originInfo->cut_path}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{isset($end->originInfo->label) ? $end->originInfo->label : '邂逅爱聊咖' }}</b>
						</em>
					</span>
                            <span class="act-lis-group-right">
						<img src="{{thumb($end->cut_path)}}" alt="phone">
						<em class="act-beg-lis-group-info">
							<b>{{!isset($end->label) ? '邂逅爱聊咖' : $end->label}}</b>
						</em>
					</span>
                        </p>
                        <p class="act-beg-user-name" >
                            <img src="{{$end->originInfo->headicon}}" alt="user" class="act-beg-lis-pic">
                            <span class="act-beg-lis-name">{{$end->originInfo->nickname}}</span>
                        </p>
                        <p class="act-beg-user-name" style="margin: -2rem 0 0 0;padding-left: 9rem;">
                            <img src="{{$end->headicon}}" alt="user" class="act-beg-lis-pic" >
                            <span class="act-beg-lis-name">{{$end->nickname}}</span>
                        </p>
                    @endif
                </li>
            @endforeach

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
                        活动时间：
                    </h1>
                    <p class="active-translate-mask-info">
                        2017年9月25日至2017年10月25日
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        活动内容:
                    </h1>
                    <p class="active-translate-mask-info">
                        参与雅哈咖啡“异次元合拍”创意拼图互动环节，赢大奖！
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        参与方式：
                    </h1>
                    <p class="active-translate-mask-info">
                        用户选择要挑战的原图并上传自己的照片来完成创意拼图，或自行上传照片来挑战拼图。上传照片完成拼图后，获得点赞最高的用户，将获得雅哈咖啡送出的奖励。 </p>
                    <p class="active-translate-mask-info">
                        参与活动的照片请确保真实，自主创作或经过权利人合法授权。
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖励机制
                    </h1>
                    <p class="active-translate-mask-info">
                        （1）每周奖励： 截止10月2日、10月10日、10月18日、10月25日24点，各擂台点赞数排名TOP10用户，可获得雅哈咖啡×nice定制对杯各一份，每个获奖ID限一份。
                    </p>
                    <p class="active-translate-mask-info">
                        （2） 月度冠军： 截止10月25日24点，各擂台点赞数排名TOP1用户，可获得雅哈咖啡送出的擂台大奖，4个擂台各一份。
                    </p>
                    <p class="active-translate-mask-info">
                        （3）中奖名单在“邂逅有礼”版块公布，可关注雅哈微博微信同步获取获奖信息。
                    </p>
                    <p class="active-translate-mask-info">
                        雅哈微信ID：雅哈愉快聊<br/>
                        雅哈微博ID：雅哈咖啡
                    </p>
                </li>
                <li>
                    <h1 class="active-translate-mask-tit">
                        奖品
                    </h1>
                    <p class="active-translate-mask-info">
                        雅哈×nice定制对杯
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
                        <img style="width: 300px" src="{{staticFile('images/pintu_jiangpin.png')}}">
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <script>
        $(function () {
            $(document).on('click', '.active-begin-more', function () {
                location.href = '/photo/list/rank?module=1&child=3'
            });
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