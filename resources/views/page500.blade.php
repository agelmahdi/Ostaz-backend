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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    {!! Html::style('BackEnd/assets/node_modules/bootstrap/css/bootstrap.min.css') !!}
    <!-- Custom CSS -->
    {!! Html::style('BackEnd/main/css/style.css') !!}
    <!-- page css -->
    {!! Html::style('BackEnd/main/css/pages/error-pages.css') !!}
    <!-- You can change the theme colors from here -->
    {!! Html::style('BackEnd/main/css/colors/default.css') !!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>500</h1>
            <h3 class="text-uppercase">You Don't have permission to see this page !</h3>
            <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
            <a href="{{ route('Admin.home') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
        <footer class="footer text-center">© 2017 Adminwrap.</footer>
    </div>
</section>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
{!! Html::script('BackEnd/assets/node_modules/jquery/jquery.min.js') !!}
<!-- Bootstrap popper Core JavaScript -->
{!! Html::script('BackEnd/assets/node_modules/bootstrap/js/popper.min.js') !!}
{!! Html::script('BackEnd/assets/node_modules/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('BackEnd/main/js/waves.js') !!}
</body>

</html>
