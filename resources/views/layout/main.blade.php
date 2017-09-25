<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - 雅哈</title>
    {{--<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">--}}
    <link rel="stylesheet" href="{{staticFile('css/style.css')}}">
    <link rel="stylesheet" href="{{staticFile('css/webuploader.css')}}">
    <style>
        .modal.modal-in {
            opacity: 1;
            -webkit-transition-duration: .4s;
            transition-duration: .4s;
            -webkit-transform: translate3d(0,0,0) scale(1);
            transform: translate3d(0,0,0) scale(1);
        }
        .modal {
            width: 13.5rem;
            position: absolute;
            z-index: 11000;
            left: 50%;
            margin-left: -6.75rem;
            margin-top: 0;
            top: 50%;
            text-align: center;
            border-radius: .35rem;
            opacity: 0;
            -webkit-transform: translate3d(0,0,0) scale(1.185);
            transform: translate3d(0,0,0) scale(1.185);
            -webkit-transition-property: -webkit-transform,opacity;
            transition-property: transform,opacity;
            color: #3d4145;
            display: none;
        }
        .modal-no-buttons .modal-inner {
            border-radius: .35rem;
        }

        .modal-inner {
            padding: .75rem;
            border-radius: .35rem .35rem 0 0;
            position: relative;
            background: #e8e8e8;
        }
        .modal-title {
            font-weight: 500;
            font-size: .9rem;
            text-align: center;
        }
        .modal-title+.modal-text {
            margin-top: .25rem;
        }
        .modal .preloader {
            width: 1.7rem;
            height: 1.7rem;
        }
        .modal .preloader {
            width: 1.7rem;
            height: 1.7rem;
        }
        .preloader {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            -webkit-transform-origin: 50%;
            transform-origin: 50%;
            -webkit-animation: preloader-spin 1s steps(12,end) infinite;
            animation: preloader-spin 1s steps(12,end) infinite;
        }
        .preloader {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            -webkit-transform-origin: 50%;
            transform-origin: 50%;
            -webkit-animation: preloader-spin 1s steps(12,end) infinite;
            animation: preloader-spin 1s steps(12,end) infinite;
        }
        .modal-overlay.modal-overlay-visible, .popup-overlay.modal-overlay-visible, .preloader-indicator-overlay.modal-overlay-visible {
            visibility: visible;
            opacity: 1;
        }
        .modal-overlay, .popup-overlay, .preloader-indicator-overlay {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,.4);
            z-index: 10600;
            visibility: hidden;
            opacity: 0;
            -webkit-transition-duration: .4s;
            transition-duration: .4s;
        }
        .preloader:after {
            display: block;
            content: "";
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml;charset=utf-8,<svg%20viewBox%3D'0%200%20120%20120'%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20xmlns%3Axlink%3D'http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink'><defs><line%20id%3D'l'%20x1%3D'60'%20x2%3D'60'%20y1%3D'7'%20y2%3D'27'%20stroke%3D'%236c6c6c'%20stroke-width%3D'11'%20stroke-linecap%3D'round'%2F><%2Fdefs><g><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.27'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.27'%20transform%3D'rotate(30%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.27'%20transform%3D'rotate(60%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.27'%20transform%3D'rotate(90%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.27'%20transform%3D'rotate(120%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.27'%20transform%3D'rotate(150%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.37'%20transform%3D'rotate(180%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.46'%20transform%3D'rotate(210%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.56'%20transform%3D'rotate(240%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.66'%20transform%3D'rotate(270%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.75'%20transform%3D'rotate(300%2060%2C60)'%2F><use%20xlink%3Ahref%3D'%23l'%20opacity%3D'.85'%20transform%3D'rotate(330%2060%2C60)'%2F><%2Fg><%2Fsvg>");
            background-position: 50%;
            background-size: 100%;
            background-repeat: no-repeat;
        }
        @keyframes preloader-spin{100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }}
    </style>
    @yield('resource')
</head>
<body>
<script type="text/javascript" src="{{staticFile('js/zepto.js')}}"></script>
<script src="http://apps.bdimg.com/libs/underscore.js/1.7.0/underscore-min.js"></script>
{{--    <script type="text/javascript" src="{{staticFile('js/zepto.data.js')}}"></script>--}}
<script type="text/javascript" src="{{staticFile('js/zepto.callbacks.js')}}"></script>
<script type="text/javascript" src="{{staticFile('js/zepto.deferred.js')}}"></script>
<script type="text/javascript" src="{{staticFile('js/touch.js')}}"></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/??sm.min.js,sm-extend.min.js' charset='utf-8'></script>
<script type="text/javascript" src="{{staticFile('js/webuploader.html5only.min.js')}}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(function(){
        window.alert = function(name){
            var iframe = document.createElement("IFRAME");
            iframe.style.display="none";
            iframe.setAttribute("src", 'data:text/plain,');
            document.documentElement.appendChild(iframe);
            window.frames[0].window.alert(name);
            iframe.parentNode.removeChild(iframe);
        }
        $(".select-question-list li").click(function(){
            $(this).find('input[type="radio"]').get(0).checked = true;
            $(".select-question-list li").each(function(){
                $(this).removeClass('on');
                if($(this).find('input[type="radio"]').get(0).checked){
                    $(this).addClass('on');
                }
            });
        });
    })
</script>
<script type="text/javascript">
    (function (doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                docEl.style.fontSize = 40 * (clientWidth / 750) + 'px';
            };

        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
</script>
<script>
    $(function(){
        $(document).on('pageInit','.page',function(e,id,page){
            if($('#'+id).data('config')){
                wx.config(JSON.parse($('#'+id).data('config')))
            }
        })
    })
</script>
@yield('content')
</body>
</html>