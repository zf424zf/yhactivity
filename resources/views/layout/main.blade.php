<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('title') - 雅哈</title>
    <link rel="stylesheet" href="{{staticFile('css/style.css')}}">
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
    <script type="text/javascript" src="{{staticFile('js/zepto.js')}}"></script>
    <script type="text/javascript" src="{{staticFile('js/zepto.data.js')}}"></script>
    <script type="text/javascript" src="{{staticFile('js/zepto.callbacks.js')}}"></script>
    <script type="text/javascript" src="{{staticFile('js/zepto.deferred.js')}}"></script>
    <script type="text/javascript" src="{{staticFile('js/touch.js')}}"></script>
    <script type="text/javascript" src="{{staticFile('js/webuploader.html5only.min.js')}}"></script>
    <link rel="stylesheet" href="{{staticFile('css/webuploader.css')}}">
    @yield('resource')
</head>
<body>
@yield('content')

<script type="text/javascript">
    $(function(){
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
</body>
</html>