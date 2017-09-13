@extends('layout.main')
@section('title','首页')
@section('resource')

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
					56518&nbsp;在线
				</span>
                <span class="user-like">
					<img src="{{staticFile('images/active/love.png')}}" alt="love">
				</span>

            </p>
            <span class="btm-plu">
				主持人：我是主持人ID
			</span>
        </div>
        <!-- live-on -->
        <div class="live-on-con">
            {{--<div id="a1" class="live-on-videos"></div>--}}
            <video playsinline
                   src="@if($data['status'] == 'end') {{$data['rtmp']}} @else {{$data['hls']}} @endif"
                   class="live-on-video">

                {{--            <video src="@if($data['status'] == 'living') {{$data['hdl']}} @elseif($data['status'] == 'end') {{$data['rtmp']}} @endif" class="live-on-video">--}}
                你的浏览器版本太低\(^o^)/~
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
    <script>
        var lastId = '{{last($message)['id']}}'
        $(function () {
            $(document).on('click', '#submit', function () {
                var content = $('#content').val();
                var id = $(this).data('live-id');
                var uid = '{{$uid}}';
                $.ajax({
                    url: '/api/comment/submit',
                    type: 'post',
                    data: {content: content, channel: id, uid: uid},
                    success: function (ret) {
                        $('#content').val('')
                        if (ret.code != 0) {
                            alert('发送失败，请稍后再试');
                        }
                    }
                })
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
                    }
                }
            })
        }
        setInterval("getComment()", 5000)
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