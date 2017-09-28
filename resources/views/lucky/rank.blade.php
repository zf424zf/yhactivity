@extends('layout.main')
@section('title','晒单中奖名单')
@section('resource')
@endsection
@section('content')
    <div class="bg page" data-config='<?php echo app('wechat')->js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage')) ?>'>
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <div class="active-rank">
            <ul class="tab">
                @foreach($sections as $key=>$section)
                <li class="on">
                    <a href="{{urls('/lucky/rank/'.$key)}}">
                        @if($curSection == $key)
                        <img class="on" src="{{staticFile('images/active/gift-rank'.$key.'-on.png')}}" alt="标题">
                        @else
                        <img class="default" src="{{staticFile('images/active/gift-rank'.$key.'-default.png')}}" alt="标题">
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="gift-rank" id="rank">
            <div class="gift-rank-wapper">
                <div class="gift-rank-over"  id="content">
                    @foreach($data as $item)
                    <div class="gift-rank-h">
                        <p>
                            {{$item['title']}}
                        </p>
                    </div>
                    <ul class="gift-rank-list">
                        @foreach($item['nameArr'] as$key => $name)
                        <li>
                            <span @if(empty($key % 2)) class="l" @else class="r" @endif>{{$name}}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endforeach
                </div>
            </div>
            <div id="scrollbar">
                <div class="bar-swiper" id="bar-go"><img src="{{staticFile('images/active/bar-swiper.png')}}" alt="bar"></div>
            </div>
        </div>
        <p class="gift-height">&nbsp;</p>
    </div>
    <script type="text/javascript">
        window.onload=function(){
            var gundongX = 0;
            var gundongY = 0;
            var moveEle =document.getElementById('content');
            var rank =document.getElementById('rank');
            var barGo =document.getElementById('bar-go');
            var stx = sty = etx = ety = curX = curY = 0;
            var maxHeight = moveEle.offsetHeight-rank.offsetHeight;
            var barNumber = 0;

            moveEle.addEventListener("touchstart", function(event) { //touchstart
                gundongX = 0;
                gundongY = 0;

                event.preventDefault();
                // 元素当前位置
                etx = parseInt(getT3d(moveEle, "x"));
                ety = parseInt(getT3d(moveEle, "y"));

                // 手指位置
                stx = event.touches[0].pageX;
                sty = event.touches[0].pageY;
            }, false);

            moveEle.addEventListener("touchmove", function(event) {
                // 防止拖动页面
                event.preventDefault();

                // 手指位置 减去 元素当前位置 就是 要移动的距离
                gundongX = event.touches[0].pageX - stx;
                gundongY = event.touches[0].pageY - sty;



                // 目标位置 就是 要移动的距离 加上 元素当前位置
                curX = gundongX + etx;
                curY = gundongY + ety;
                barNumber =( curY/-maxHeight)*0.93;

                // 自由移动
                // moveEle.style.webkitTransform = 'translate3d(' + (curX) + 'px, ' + (curY) + 'px,0px)';
                // 只能移动Y轴方向
                //
                if(curY >0){
                    curY = 0;
                }else if(curY <-maxHeight){
                    curY =-maxHeight;
                }
                if(barNumber>0.93){
                    barNumber=0.93;
                }else if(barNumber<0){
                    barNumber=0;
                }
                moveEle.style.webkitTransform = 'translate3d(' + 0 + ', ' + (curY) + 'px,0)';
                barGo.style.top = barNumber*100+'%';


            }, false);
            moveEle.addEventListener("touchend", function(event) { //touchend
                etx = curX;
                ety = curY;
            }, false);

            function getT3d(elem, ename) {
                var str1 = elem.style.webkitTransform;
                if (str1 == "") return "0";
                str1 = str1.replace("translate3d(", "");
                str1 = str1.replace(")", "");
                var carr = str1.split(",");

                if (ename == "x") return carr[0];
                else if (ename == "y") return carr[1];
                else if (ename == "z") return carr[2];
                else return "";
            }
            $(document).on('pageInit','.page',function(e,id,page){
                if($('#'+id).data('config')){
                    wx.config(JSON.parse($('#'+id).data('config')))
                }
            })
            $.init();
        }

    </script>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script src="{{staticFile('js/share_luck.js')}}"></script>
    @include('layout.music_60')
@endsection