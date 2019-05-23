<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! getSettingValueByKeyCache("name") !!}管理后台</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('static/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('static/css/font-awesome.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('static/css/all.css') }}"> -->

    <link rel="stylesheet" href="{{ asset('vendor/adminLTE/css/AdminLTE.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/vendor/html5shiv.js') }}"></script>
    <script src="{{ asset('/vendor/respond.min.js') }}></script>
    <![endif]-->

    <style>
        .login-page, .register-page{
            background-image: url({{ asset('/images/bg.jpg') }});
            background-size: cover;
            position: relative;
        }
        .login-box, .register-box{
            margin: 0;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -180px; 
            margin-top: -110px;
        }
    </style>
    
</head>
<body class="hold-transition login-page ">

    <div class="login-box">
        <!--div class="login-logo">
            <a href="www.wiswebs.com">智琛佳源科技有限公司</a>
        </div--><!-- /.login-logo -->
        <div class="login-box-body">
            @include('admin.partials.error')
            @include('admin.partials.message')
            <p class="login-box-msg">{!! getSettingValueByKeyCache("name") !!}管理后台</p>
            <form action="/smart/login" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="用户名" />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="密码" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                       {{--  <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> 记住我
                        </label>
                        </div> --}}
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                    </div><!-- /.col -->
                </div>
            </form>
          {{--   <a href="/zcjy/password/reset">忘记密码</a> --}}
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
<!-- /.login-box -->


    <script src="{{ asset('static/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('static/js/select2.min.js') }}"></script>
    <script src="{{ asset('static/js/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
