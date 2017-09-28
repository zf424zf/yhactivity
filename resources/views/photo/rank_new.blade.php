@extends('layout.main')
@section('title','照片墙-最新')
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
    <div class="page" data-config='<?php echo app('wechat')->js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage')) ?>'>
        <div class="bg content infinite-scroll infinite-scroll-bottom">
            <a href="{{urls('/photo')}}">
                <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
            </a>
            <div class="active-rank">
                <ul class="tab">
                    <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_ZC ) class="on" @endif>
                        <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_ZC}}">
                            @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_ZC )
                                <img class="on" src="{{staticFile('images/active/h3-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/h3-default.png')}}" alt="标题">
                            @endif
                        </a>
                    </li>
                        <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_MX || empty(Request::get('child'))) class="on" @endif>
                        <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_MX}}">
                            @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_MX || empty(Request::get('child')))
                                <img class="on" src="{{staticFile('images/active/h1-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/h1-default.png')}}" alt="标题">
                            @endif
                        </a>
                    </li>

                    <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_CH ) class="on" @endif >
                        <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_CH}}">
                            @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_CH )
                                <img class="on" src="{{staticFile('images/active/h4-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/h4-default.png')}}" alt="标题">
                            @endif
                        </a>
                    </li>
                    <li @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_BS ) class="on" @endif>
                        <a href="{{'/photo/list/new?module=1&child='.\App\Http\Api\PhotoChild::PHOTO_BS}}">
                            @if(\Request::get('child')== \App\Http\Api\PhotoChild::PHOTO_BS )
                                <img class="on" src="{{staticFile('images/active/h2-on.png')}}" alt="标题">
                            @else
                                <img class="default" src="{{staticFile('images/active/h2-default.png')}}" alt="标题">
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
            <div class="active-rank-content">
                <p class="active-rank-top">
                    <a href="{{urls('/photo/list/rank?module=1&child='.\Request::get('child'))}}">
                        排行榜
                    </a>
                    <a href="{{urls('/photo/list/new?module=1&child='.\Request::get('child'))}}" class="on">
                        最新
                    </a>
                </p>
                <div class="active-rank-over">
                    <div class="active-rank-list">
                        @if(isset($data) && !empty($data))
                            <ul class="list-container">
                                @foreach($data as $item)
                                    <li>
                                        <a href="{{urls('/photo/detail/'.$item->id)}}">
                                            <p class="pic">
                                                <img src="{{stripslashes($item->originInfo['path'])}}" alt="nan">
                                                <img src="{{$item->path}}" alt="nv">
                                                <span class="tip l">{{isset($item->originInfo['label']) ?  $item->originInfo['label'] : '邂逅爱聊咖' }}</span>
                                                <span class="tip r">{{isset($item->label) ?  $item->label : '邂逅爱聊咖' }}</span>
                                            </p>
                                        </a>
                                        <p class="user">
										<span class="user-photo">
											<img src="{{thumb($item->headicon)}}" alt="photo">
										</span>
                                            <span class="user-title">
                                        {{$item->nickname}}
                                    </span>
                                            <span data-child="{{$item->module}}" data-target="{{$item->id}}"
                                                  data-can-like="{{$item->canLike}}" class="user-like">
                                        <img src="{{staticFile('images/active/like.png')}}" alt="like">
                                        <span class="like-num" data-like-cnt="{{$item->cnt}}">{{$item->cnt}}</span>
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
    <script src="{{staticFile('/js/rank.js')}}"></script>
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
                        url: '/photo/list/new/?{{http_build_query($params,"","amp;")}}',
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
            $(document).on('pageInit', '.page', function (e, id, page) {
                if ($('#' + id).data('config')) {
                    wx.config(JSON.parse($('#' + id).data('config')))
                }
            })
            $.init();
        })
    </script>
    <script src="{{staticFile('js/share.js')}}"></script>
    <script src="{{staticFile('js/share_photo.js')}}"></script>
    @include('layout.music_60')
@endsection