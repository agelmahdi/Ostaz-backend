
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    {!! Html::script('BackEnd/assets/node_modules/jquery/jquery.min.js') !!}
    <!-- Bootstrap popper Core JavaScript -->
    {!! Html::script('BackEnd/assets/node_modules/bootstrap/js/popper.min.js') !!}
    {!! Html::script('BackEnd/assets/node_modules/bootstrap/js/bootstrap.min.js') !!}
    <!-- slimscrollbar scrollbar JavaScript -->
    {!! Html::script('BackEnd/assets/node_modules/ps/perfect-scrollbar.jquery.min.js') !!}
    <!--Wave Effects -->
    @if(app()->getLocale()=="en")
        {!! Html::script('BackEnd/main/js/waves.js') !!}
        {!! Html::script('BackEnd/main/js/sidebarmenu.js') !!}
        <!--Custom JavaScript -->
        {!! Html::script('BackEnd/main/js/custom.min.js') !!}
{{--        {!! Html::script('BackEnd/main/js/dashboard1.js') !!}--}}
    @else
        {!! Html::script('BackEnd/main-ar/js/waves.js') !!}
        {!! Html::script('BackEnd/main-ar/js/sidebarmenu.js') !!}
        <!--Custom JavaScript -->
        {!! Html::script('BackEnd/main-ar/js/custom.min.js') !!}
{{--        {!! Html::script('BackEnd/main-ar/js/dashboard1.js') !!}--}}
    @endif

{{--    <!-- ============================================================== -->--}}
{{--    <!-- This page plugins -->--}}
{{--    <!-- ============================================================== -->--}}
{{--    <!--morris JavaScript -->--}}
{{--    {!! Html::script('BackEnd/assets/node_modules/raphael/raphael-min.js') !!}--}}
{{--    {!! Html::script('BackEnd/assets/node_modules/morrisjs/morris.min.js') !!}--}}
{{--    <!--c3 JavaScript -->--}}

