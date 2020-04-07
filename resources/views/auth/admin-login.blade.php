<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    {!! Html::favicon('BackEnd/assets/images/favicon.png') !!}
    <title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
{!! Html::style('BackEnd/assets/node_modules/bootstrap/css/bootstrap.min.css') !!}
<!-- page css -->
{!! Html::style('BackEnd/main/css/pages/login-register-lock.css') !!}
<!-- Custom CSS -->
{!! Html::style('BackEnd/main/css/style.css') !!}
<!-- You can change the theme colors from here -->

{!! Html::style('BackEnd/main/css/colors/default.css') !!}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Admin Wrap</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="login-register login-sidebar"
         style="background-image:url({{asset('BackEnd/assets/images/background/login-register.jpg')}});">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material" method="POST" action="{{ route('admin.login') }}">
                <a href="javascript:void(0)" class="text-center db">
                    {!! Html::image('BackEnd/assets/images/logo-icon.png',"Home") !!}
                    <br/>
                    {!! Html::image('BackEnd/assets/images/logo-text.png',"Home") !!}
                </a>

                <form method="POST" action="{{ route('admin.login.post')}}">
                    @csrf
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   placeholder="Email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   placeholder="Password"
                                   required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            &nbsp&nbsp&nbsp
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>

                        </div>
                    </div>

                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase btn-rounded">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>

                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Reset
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
{!! Html::script('BackEnd/assets/node_modules/jquery/jquery.min.js') !!}
<!-- Bootstrap tether Core JavaScript -->
{!! Html::script('BackEnd/assets/node_modules/bootstrap/js/popper.min.js') !!}
{!! Html::script('BackEnd/assets/node_modules/js/bootstrap.min.js') !!}

<!--Custom JavaScript -->
<script type="text/javascript">
    $(function () {
        $(".preloader").fadeOut();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>

</body>

</html>

