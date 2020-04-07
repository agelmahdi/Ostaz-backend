
<!DOCTYPE html>
@if(app()->getLocale()=="en")
    <html lang="en">
@else
    <html lang="en" dir="rtl">
@endif

@include('layouts.BackEnd.head')
@yield('css')


<body class="fix-header fix-sidebar card-no-border">
{{--<!-- ============================================================== -->--}}
{{--<!-- Preloader - style you can find in spinners.css -->--}}
{{--<!-- ============================================================== -->--}}
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">MainBlog</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">

    @include('layouts.BackEnd.header')

    @include('layouts.BackEnd.sidebar')


    @yield('content')
    @include('layouts.BackEnd.footer')

</div>


<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
@include('layouts.BackEnd.foot')
@yield('model')
@yield('ajax')
@yield('js')
</body>

</html>
