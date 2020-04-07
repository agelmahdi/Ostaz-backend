<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    @if(!strstr(Request::path(),'en/')&&!strstr(Request::path(),'ar/'))
        <meta http-equiv="refresh" content="0; url = {{url("en"."/".Request::path())}}"/>
    @endif

<!-- Favicon icon -->
    {!! Html::favicon('BackEnd/assets/images/favicon.png') !!}
    <title>{{ option('Website_Name_En') }} _ @yield('title')</title>
    <!-- Bootstrap Core CSS -->
{!! Html::style('BackEnd/assets/node_modules/bootstrap/css/bootstrap.min.css') !!}
{!! Html::style('BackEnd/assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css') !!}
<!-- This page CSS -->
    <!-- chartist CSS -->
{!! Html::style('BackEnd/assets/node_modules/morrisjs/morris.css') !!}
<!--c3 CSS -->
{!! Html::style('BackEnd/assets/node_modules/c3-master/c3.min.css') !!}
<!--Toaster Popup message CSS -->
{!! Html::style('BackEnd/assets/node_modules/toast-master/css/jquery.toast.css') !!}
<!-- Custom CSS -->
@if(app()->getLocale()=="en")
    {!! Html::style('BackEnd/main/css/style.css') !!}
    <!-- Dashboard 1 Page CSS -->
    {!! Html::style('BackEnd/main/css/pages/dashboard1.css') !!}
    <!-- You can change the theme colors from here -->
    {!! Html::style('BackEnd/main/css/colors/default.css') !!}
@else
    {!! Html::style('BackEnd/main-ar/css/style.css') !!}
    <!-- Dashboard 1 Page CSS -->
    {!! Html::style('BackEnd/main-ar/css/pages/dashboard1.css') !!}
    <!-- You can change the theme colors from here -->
    {!! Html::style('BackEnd/main-ar/css/colors/default.css') !!}
@endif

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .sidebar-nav > ul > li > a.active {
            background: #ffffff;
        }

        .sidebar-nav ul li a.active {
            color: #20aee3;
        }

        @if(app()->getLocale()=="en")

                 @else

                 .sidebar-nav ul li a {
            font-weight: bold;
            padding: 1px 17px 6px 86px !important;


        }
        .sidebar-nav ul li ul li a {
            padding: 7px 55px 7px 15px !important;
        }
        .sidebar-nav ul li {
            font-weight: bold;
            float: right !important;
        }

        .sidebar-nav > ul > li.active > a {
            font-weight: bold;
            float: right !important;
        }
        @endif


    </style>
</head>
