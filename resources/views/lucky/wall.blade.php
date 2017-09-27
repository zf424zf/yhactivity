@extends('layout.main')
@section('title','晒单照片墙')
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
        <div class="bg content infinite-scroll infinite-scroll-bottom">
            <a href="">
                <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
            </a>
            <h1 class="gift-wall-h">
                <img src="{{staticFile('images/active/gift-wall-h.png')}}" alt="晒单照片墙">
            </h1>
            <div class="active-rank-content gift-wall-content">
                <div class="over">
                    @if(isset($data['data']) && !empty($data['data']))
                        <ul class="list-container">
                            @foreach($data['data'] as $item)
                                <li>
                                    <a href="{{"/lucky/detail/".$item['id']}}">
                                        <p class="photo">
                                            <img src="{{thumb($item['path'])}}" alt="photo">
                                        </p>
                                        <p class="info">
                                            <img src="{{thumb($item['users']['headicon'])}}" alt="user" class="user">
                                            <span class="name">{{$item['users']['nickname']}}</span>
                                        </p>
                                    </a>
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
                        url: '/lucky/wall?{{http_build_query($params,"","amp;")}}',
                        type: 'GET',
                        data: {
                            page: currentPage + 1,
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