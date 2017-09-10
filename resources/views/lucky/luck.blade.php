@extends('layout.main')
@section('title','首页')
@section('resource')
@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <h1 class="goodluck-h">
            <img src="{{staticFile('images/active/goodluck-h.png')}}" alt="恭喜你">
        </h1>
        <div class="goodluck-game">
            <table class="goodluck-game-btns" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="on"><img src="{{staticFile('images/active/game-2.png')}}" alt="gift" data="0"></td>
                    <td><img src="{{staticFile('images/active/game-5.png')}}" alt="gift" data="1"></td>
                    <td><img src="{{staticFile('images/active/game-4.png')}}" alt="gift" data="2"></td>
                </tr>
                <tr>
                    <td><img src="{{staticFile('images/active/game-5.png')}}" alt="gift" data="7"></td>
                    <td><a href="javascript:;" class="begin" status="true">&nbsp;</a></td>
                    <td><img src="{{staticFile('images/active/game-5.png')}}" alt="gift" data="3"></td>
                </tr>
                <tr>
                    <td><img src="{{staticFile('images/active/game-1.png')}}" alt="gift" data="6"></td>
                    <td><img src="{{staticFile('images/active/game-5.png')}}" alt="gift" data="5"></td>
                    <td><img src="{{staticFile('images/active/game-2.png')}}" alt="gift" data="4"></td>
                </tr>
            </table>
        </div>
        <p class="goodluck-tip">
            *每人每天仅限一次抽奖机会
        </p>
        <div class="goodluck-next">
            <a href="{{urls('/lucky/wall')}}" class="l"><img src="{{staticFile('images/active/goodluck-next-btn1.png')}}" alt="照片墙"></a>
            <a href="{{urls('/')}}"><img src="{{staticFile('images/active/goodluck-next-btn2.png')}}" alt="回到首页"></a>
        </div>
        <!-- mask -->
        <div class="gift-translate-mask-bg">&nbsp;</div>

        <!-- 现金 -->
        <div class="gift-translate-mask gift-translate-mask0">
            <form action="" class="winning-money">
                <label for="" class="mar">
                    姓名<input type="text" class="money-name">
                </label>
                <label for="">
                    电话<input type="text" class="money-tel">
                </label>
                <label for="">
                    地址<input type="text" class="money-address">
                </label>
                <a data-prefix="money" href="javascript:void(0);" class="winning-money-next">
                    <img src="{{staticFile('images/active/gift-submit.png')}}" alt="">
                </a>
            </form>
        </div>
        <!-- 礼盒 -->
        <div class="gift-translate-mask gift-translate-mask1">
            <form action="" class="winning-money">
                <label for="" class="mar">
                    姓名<input type="text" class="gift-name">
                </label>
                <label for="">
                    电话<input type="text" class="gift-tel">
                </label>
                <label for="">
                    地址<input type="text" class="gift-address">
                </label>
                <a data-prefix="gift" href="javascript:void(0);" class="winning-money-next">
                    <img src="{{staticFile('images/active/gift-submit.png')}}" alt="">
                </a>
            </form>
        </div>
        <!-- 对杯 -->
        <div class="gift-translate-mask gift-translate-mask2">
            <form action="" class="winning-money">
                <label for="" class="mar">
                    姓名<input type="text" class="cup-name">
                </label>
                <label for="">
                    电话<input type="text" class="cup-tel">
                </label>
                <label for="">
                    地址<input type="text" class="cup-address">
                </label>
                <a data-prefix="cup" href="javascript:void(0);" class="winning-money-next">
                    <img src="{{staticFile('images/active/gift-submit.png')}}" alt="">
                </a>
            </form>
        </div>
        <!-- 未中奖 -->
        <div class="gift-translate-mask gift-translate-mask3">
            <img src="{{staticFile('images/active/gift-translate-mask3.png')}}" alt="为中奖" class="not-winning">
        </div>
    </div>
    <input type="hidden" data-win_id="" class="win">
    <script type="text/javascript">
        $(function () {
            $(document).on('click', '.winning-money-next', function () {
                var prefix = $(this).data('prefix');
                var name = $('.'+prefix+'-name').val();
                var address = $('.'+prefix+'-address').val();
                var tel = $('.'+prefix+'-tel').val();
                var win = $('.win').data('win-id');
                if(win == undefined || win == ''){
                    alert('您尚未中奖');
                    return false;
                }
                if($.trim(name) == '' ||$.trim(address) == ''||$.trim(tel) == ''){
                    alert('请填写完整的个人信息');
                    return false;
                }
                $.ajax({
                    url:'/api/luck/contact',
                    type:'post',
                    data:{win_id:win,name:name,tel:tel,address:address},
                    success:function(ret){
                        if(ret.code == 0){
                            alert('填写成功，请等待审核');
                            window.location.href = '/lucky/wall'
                        }else{
                            alert('网络错误 请稍后再试');
                        }
                    }
                })
            });
            // game
            $(".begin").on('tap', function () {

                var timer = null;//快速
                var slow = null;//匀减速
                var $lists = $('.goodluck-game-btns td img');
                var length = $lists.length;
                var num = '' || Math.floor(Math.random() * 10 + 2);//随机转圈
                var the = -1;//初始化第一个
                var t = 100;//慢速初始时间
                var flag = $(this).attr('status');
                var that = this;
                $(this).attr('status', false);
                if (!flag) return false;
                $(this).addClass('on');
                $lists.parent('td').removeClass('on');
                $lists.sort(function (a, b) {
                    return $(a).attr('data') - $(b).attr('data');
                });
                function target(tar) {
                    the = -1;
                    var notWinning = [1, 3, 5, 7];
                    var winningMoney = [0, 4];
                    var winningGift = 2;
                    var winningGlass = 6;

                    var x = function () {
                        slow = setTimeout(function () {
                            if (tar <= the) {

                                clearTimeout(slow);
                                $(this).attr('status', true);
                                // 活动说明遮罩层

                                switch (tar) {
                                    case 0 || 4://现金
                                        $(".gift-translate-mask-bg,.gift-translate-mask0").addClass('on');
                                        break;
                                    case 2://礼盒
                                        $(".gift-translate-mask-bg,.gift-translate-mask1").addClass('on');
                                        break;
                                    case 6://对杯
                                        $(".gift-translate-mask-bg,.gift-translate-mask2").addClass('on');
                                        break;
                                    default:
                                        $(".gift-translate-mask-bg,.gift-translate-mask3").addClass('on');
                                        break;
                                }
                                $(that).removeClass('on');
                            } else {
                                $($lists.get(the)).parent('td').removeClass('on');
                                the++;
                                $($lists.get(the)).parent('td').addClass('on');
                                clearTimeout(slow);
                                x();
                            }
                        }, t);
                    }
                    t += 150;
                    x();
                }

                function rotate(tar) {

                    timer = setInterval(function () {

                        if (num > 0) {
                            if (the < length) {
                                $($lists.get(the)).parent('td').removeClass('on');
                                the++;
                                $($lists.get(the)).parent('td').addClass('on');
                            } else {
                                num--;
                                the = -1;
                                $($lists.get(the)).parent('td').removeClass('on');
                                the++;
                                $($lists.get(the)).parent('td').addClass('on');
                            }

                        } else {
                            clearInterval(timer);
                            target(tar);
                        }
                    }, 80);
                }

                /**
                 * 编号0-7
                 * 6=>要转到的编号
                 */
                if ('{{$flag}}' == 0) {
                    alert('您当天的抽奖次数已经用完！')
                    return false;
                }
                $.ajax({
                    type: 'get',
                    url: '/api/luck',
                    data: {uid: '{{$uid}}', image_id: '{{$image}}'},
                    success: function (ret) {
                        if (ret.code == 0) {
                            var data = ret.data.data;
                            var winId = data.id;
                            if (data.is_win == 1) {
                                if (data.win_lv == 3) {
                                    rotate(2)
                                } else if (data.win_lv == 2) {
                                    rotate(6)
                                } else if (data.win_lv == 1) {
                                    rotate(4)
                                } else {
                                    rotate(1);
                                }
                                $('.win').data('win-id',winId);
                            } else {
                                rotate(1);
                            }
                        } else {
                            alert(ret.message);
                        }

                    }
                });

            });
            //mask
            $('.gift-translate-mask-bg').on('tap', function () {
                $(".gift-translate-mask-bg,.gift-translate-mask").removeClass('on');
                return false;
            });
        })
    </script>
@endsection