@extends('layout.main')
@section('title','视频墙-最新')
@section('resource')
    <style>
        .content {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            overflow: auto;
        }
    </style>
@endsection
@section('content')
    <div class="page">
        <div class="bg content  infinite-scroll infinite-scroll-bottom">
            <a href="">
                <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
            </a>
            <div class="world-rank">
                <ul class="tab">
                    <li @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_SS || empty(Request::get('child'))) class="on" @endif>
                        <a href="{{'/video/new?module=2&child='.\App\Http\Api\VideoChild::VIDEO_SS}}">
                            @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_SS || empty(Request::get('child')))
                                <img class="on" src="{{staticFile('images/active/world-rank-h-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/world-rank-h-default.png')}}"
                                     alt="标题">
                            @endif
                        </a>
                    </li>
                    <li @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_LX ) class="on" @endif>
                        <a href="{{'/video/new?module=2&child='.\App\Http\Api\VideoChild::VIDEO_LX}}">
                            @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_LX )
                                <img class="on" src="{{staticFile('images/active/world-rank2-h-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/world-rank2-h-default.png')}}"
                                     alt="标题">
                            @endif
                        </a>
                    </li>
                    <li @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_NS ) class="on" @endif>
                        <a href="{{'/video/new?module=2&child='.\App\Http\Api\VideoChild::VIDEO_NS}}">
                            @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_NS )
                                <img class="on" src="{{staticFile('images/active/world-rank4-h-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/world-rank4-h-default.png')}}"
                                     alt="标题">
                            @endif
                        </a>
                    </li>
                    <li @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_MZ ) class="on" @endif>
                        <a href="{{'/video/new?module=2&child='.\App\Http\Api\VideoChild::VIDEO_MZ}}">
                            @if(\Request::get('child')== \App\Http\Api\VideoChild::VIDEO_MZ )
                                <img class="on" src="{{staticFile('images/active/world-rank3-h-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/world-rank3-h-default.png')}}"
                                     alt="标题">
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
            <div class="world-rank-content">
                <p class="world-rank-top">
                    <a href="{{urls('/video/rank?module=2&child='.\Request::get('child'))}}">
                        排行榜
                    </a>
                    <a href="{{urls('/video/new?module=2&child='.\Request::get('child'))}}" class="on">
                        最新
                    </a>
                </p>
                <div class="world-rank-over">
                    <div class="world-rank-list">
                        @if(isset($data) && !empty($data))
                        <ul class="list-container">
                            @foreach($data as $item)
                                <li class="on">
                                    <p class="vid-show">
                                        <a href="{{urls('/video/detail/'.$item->id)}}">
                                            <img src="{{$item->cover}}" alt="video" class="bg">
                                            <img src="{{staticFile('images/active/world-video-play.png')}}" alt="btn"
                                                 class="btn">
                                            {{--<img src="{{staticFile('images/active/world-video-info.png')}}" alt="tip"--}}
                                                 {{--class="tip">--}}
                                            {{--<span class="info">--}}
											{{--{{$item->qname}}--}}
										{{--</span>--}}
                                        </a>
                                    </p>
                                    <p class="user">
									<span class="user-photo">
										<img src="{{thumb($item->headicon)}}" alt="photo">
									</span>
                                        <span class="user-title">
										{{thumb($item->nickname)}}
									</span>
                                        <span class="user-like">
										<img src="{{staticFile('images/active/like.png')}}" alt="like">
                                            {{$item->cnt}}
									</span>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                        <div class="infinite-scroll-preloader">
                            <div class="preloader">
                            </div>
                        </div>
                        @else
                            <div class="no_data"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(document).on("pageInit", ".page", function (e, id, page) {
                var loading = false;
                var currentPage = 1;
                $('.infinite-scroll-preloader').hide();
                $(document).on('infinite', '.infinite-scroll-bottom', function () {
                    if (loading) {
                        return;
                    }
                    loading = true;
                    $('.infinite-scroll-preloader').show();
                    <?php
                           $params = \Request::all();
                           unset($params['page']);
                       ?>
                    $.ajax({
                        url: '/video/new/',
                        type: 'GET',
                        data: {
                            page: currentPage + 1,
                            module:'{{\Request::get('module')}}',
                            child:'{{\Request::get('child')}}'
                        },
                        dataType: 'html',
                        cache: false,
                        success: function (html) {
                            if ($(html).find('.no_data').length > 0) {
                                $('.infinite-scroll-preloader').remove();
                                $.detachInfiniteScroll($('.infinite-scroll'));
                            }
                            else {
                                $('.list-container').append($(html).find('.list-container').html());
                                $('.infinite-scroll-preloader').hide();
                                loading = false;
                                currentPage++;
                            }
                        }
                    });
                })
            });
            $.init();
        })
    </script>
@endsection