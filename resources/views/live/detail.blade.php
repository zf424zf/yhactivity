@extends('layout.main')
@section('title','直播间')
@section('resource')
    <link href="//vjs.zencdn.net/5.19/video-js.min.css" rel="stylesheet">
    <script src="//vjs.zencdn.net/5.19/video.min.js"></script>
    <script src="{{staticFile('js/videojs-contrib-hls.min.js')}}"></script>

@endsection
@section('content')
    <div class="bg">
        <a href="">
            <img src="{{staticFile('images/active/act-beg-hea-logo.png')}}" alt="logo" class="active-logo">
        </a>
        <div class="live-on-header">
            <p class="user-details">
				<span class="user-pic">
					<img src="{{thumb($data['kol_user_avatar'])}}" alt="user-pic">
				</span>
                <span class="user-name">
					<i class="top">本场嘉宾：</i><i class="btm">{{$data['kol_user_name']}}</i>
				</span>
                <span class="user-like-number">
					{{array_get($data,'audience_num',0)}}&nbsp;在线
				</span>
                <span class="user-like">
					<img src="{{staticFile('images/active/love.png')}}" alt="love">
				</span>

            </p>
            <span class="btm-plu">
				主持人：{{$data['anchor_user_name']}}
			</span>
        </div>
        <!-- live-on -->
        <div class="live-on-con">
            <video playsinline id="example-video" width="600" height="300" class="live-on-video video-js vjs-default-skin" controls>
                <source
                        src="@if($data['status'] == 'end') {{$data['rtmp']}} @elseif($data['status'] == 'living') {{$data['hls']}} @endif"
                        type="application/x-mpegURL">
            </video>

        </div>
        <div class="live-on-comment-list">
            <img src="{{staticFile('images/active/like-live-on.png')}}" alt="like" class="like-live-on">
            <ul id="comments">
                @foreach($message as $item)
                    <li data-id="{{$item['id']}}">
                        <span class="user">{{$item['users']['nickname']}}：</span>
                        {{$item['content']}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="live-over">
            <form class="live-on-comment-in" onsubmit="return false;" method="">
                <input id="content" type="text" placeholder="输入文字">
                <input data-live-id="{{$data['id']}}" id="submit" type="submit" value="发送">
            </form>
        </div>
    </div>
    {{--<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>--}}
    <script>
        var lastId = '{{last($message)['id']}}'
        $(function () {
            $('#comments').scrollTop($('#comments')[0].scrollHeight);
            $(document).on('click', '#submit', function () {
                $('#content').blur();
                var content = $('#content').val();
                var id = $(this).data('liveId');
                var uid = '{{$uid}}';
                $.ajax({
                    url: '/api/comment/submit',
                    type: 'post',
                    data: {content: content, channel: id, uid: uid},
                    success: function (ret) {
                        $('#content').val('')
                        if (ret.code != 0) {
                            alert('发送失败，请稍后再试');
                        }else{
                            getComment();
                        }
                    }
                })
            });
            $('#content').bind('keydown',function(event){
                if(event.keyCode == "13") {
                    $(this).blur();
                }
            });
        })
        function getComment() {
            $.ajax({
                url: '/api/comment/msgList',
                type: 'get',
                data: {channel: '{{$data['id']}}', msgId: lastId},
                success: function (ret) {
                    if (ret.code == 0 && ret.data.length !=0) {
                        var datas = ret.data;
                        var li = '';
                        lastId = datas[datas.length - 1].id;
                        for(var i in datas){
                            var username = datas[i].users.nickname;
                            var content = datas[i].content;
                             li += '<li data-id="' + datas[i].id + '">' +
                                '<span class="user">' + username + '：</span>' + content + '</li>';

                        }
                        $("#comments").append(li);
                        $('#comments').scrollTop($('#comments')[0].scrollHeight);
                    }
                }
            })
        }
        setInterval("getComment()", 5000)
        var player = videojs('example-video');
        player.play();
    </script>
    {{--<script type="text/javascript" src="{{staticFile('/js/ckplayer/ckplayer.js')}}" charset="utf-8"></script>--}}
    {{--<script type="text/javascript">--}}
    {{--var flashvars={--}}
    {{--f:'{{$data['rtmp']}}',--}}
    {{--c:0,--}}
    {{--p:1--}}
    {{--};--}}

    {{--var param = {bgcolor:'#fff',allowFullScreen:false,wmode:'transparent'};--}}
    {{--CKobject.embedSWF('{{staticFile('js/ckplayer/ckplayer.swf')}}','a1','ckplayer_a1',330,330,flashvars,param);--}}
    {{--</script>--}}
@endsection