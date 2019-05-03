<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>1</title>
    <link rel="icon" href="" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
        @yield('css')
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lte IE 9]>
            <script src="{{ asset('vendor/html5shiv.min.js') }}"></script>
            <script src="{{ asset('vendor/respond.min.js') }}"></script>
        <![endif]-->
</head>
<body style="position: relative;">
    
    <!--[if lte IE 8]>
        <script>
            alert("您正在使用的浏览器版本过低，为了您的最佳体验，请先升级浏览器。");window.location.href="http://support.dmeng.net/upgrade-your-browser.html?referrer="+encodeURIComponent(window.location.href);
        </script>
    <![endif]-->
    <!-- Add your site or application content here -->
 
    @yield('content')

    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('js/touch.js')}}"></script>
    <script src="{{ asset('vendor/layer/layer.js') }}"></script>
    <script  src="{{ asset('vendor/scrollreveal.min.js') }}"></script>
    <!-- 图片缓加载 -->
    <script src="{{ asset('vendor/jquery.lazyload.min.js') }}"></script>
    <script>
        $("img.lazy").lazyload({effect: "fadeIn"});
    </script>
    <script src="{{asset('js/zcjy.js')}}"></script>
    <script type="text/javascript">

    </script>

    
    @yield('js')
</body>
</html>
