@extends('layouts.BackEnd.master')

@section('title','Management Categories')

@section('content')

    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Category</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subject.index') }}">Academic Year</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subject.create') }}">Create new
                                Academic Year</a></li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class=" modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">New Academic Year</h4>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" id="arabic" onclick="arabic()" class="btn btn-info" selected>Ar</button>
                        <button type="button" id="english" onclick="english()" class="btn btn-info">En</button>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('Admin.subject.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group arabic">
                                            <label for="title_ar">Title Ar</label>
                                            <input type="text" class="form-control" name="title_ar" id="title_ar"
                                                   value="{{old('title_ar')}}" onkeyup="slug_title_ar()">
                                        </div>
                                        <div class="form-group english">
                                            <label for="title_en">Title En</label>
                                            <input type="text" class="form-control" name="title_en" id="title_en"
                                                   value="{{old('title_en')}}" onkeyup="slug_title_en()">
                                        </div>
                                        <div class="form-group arabic">
                                            <label for="slug_ar">Slug Ar</label>
                                            <input type="text" class="form-control" name="slug_ar" id="slug_ar"
                                                   value="{{old('slug_ar')}}">
                                        </div>
                                        <div class="form-group english">
                                            <label for="slug_en">Slug En</label>
                                            <input type="text" class="form-control" name="slug_en" id="slug_en"
                                                   value="{{old('slug_en')}}">
                                        </div>
                                        <div class="form-group {{ $errors->has('streamers') ? 'focused error' : '' }}">
                                            <label for="Multi-Select">streamers</label>

                                            <select name="streamers[]" id="tag"
                                                    class="select2 m-b-10 select2-multiple select2-hidden-accessible"
                                                    style="width: 100%" multiple="" data-placeholder="Choose"
                                                    tabindex="-1" aria-hidden="true">
                                                @foreach($streamers as $streamer)
                                                    <option
                                                        value="{{ $streamer->id }}">{{ $streamer->name_en }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('Admin.subject.index') }}" class="btn btn-danger waves-effect">BACK</a>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    @endsection

    @section('css')
        <!-- page CSS -->
            {!! Html::style('BackEnd/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}
            {!! Html::style('BackEnd/assets/node_modules/select2/dist/css/select2.min.css') !!}
            {!! Html::style('BackEnd/assets/node_modules/switchery/dist/switchery.min.css') !!}
            {!! Html::style('BackEnd/assets/node_modules/bootstrap-select/bootstrap-select.min.css') !!}
            {!! Html::style('BackEnd/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') !!}
            {!! Html::style('BackEnd/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') !!}
            {!! Html::style('BackEnd/assets/node_modules/multiselect/css/multi-select.css') !!}
        @endsection
        @section('js')
            <script>

                $(document).ready(function () {
                    document.getElementById("english").style.backgroundColor = '#6d6d6d';
                    document.getElementById("arabic").style.backgroundColor = '#2db2e4';
                    let arabic = document.getElementsByClassName("arabic");
                    let english = document.getElementsByClassName("english");
                    for (var i = 0; i < arabic.length; i += 1) {
                        arabic[i].style.display = 'block';
                    }
                    for (var i = 0; i < english.length; i += 1) {
                        english[i].style.display = 'none';
                    }
                    if ($("#mymce").length > 0) {
                        tinymce.init({
                            selector: "textarea#mymce",
                            theme: "modern",
                            height: 300,
                            plugins: [
                                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                "save table contextmenu directionality emoticons template paste textcolor"
                            ],
                            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

                        });
                    }
                });

                function arabic() {
                    document.getElementById("english").style.backgroundColor = '#6d6d6d';
                    document.getElementById("arabic").style.backgroundColor = '#2db2e4';
                    let arabic = document.getElementsByClassName("arabic");
                    let english = document.getElementsByClassName("english");
                    for (var i = 0; i < arabic.length; i += 1) {
                        arabic[i].style.display = 'block';
                    }
                    for (var i = 0; i < english.length; i += 1) {
                        english[i].style.display = 'none';
                    }


                }

                function english() {
                    document.getElementById("arabic").style.backgroundColor = '#6d6d6d';
                    document.getElementById("english").style.backgroundColor = '#2db2e4';
                    let arabic = document.getElementsByClassName("arabic");
                    let english = document.getElementsByClassName("english");
                    for (var i = 0; i < arabic.length; i += 1) {
                        arabic[i].style.display = 'none';
                    }
                    for (var i = 0; i < english.length; i += 1) {
                        english[i].style.display = 'block';
                    }


                }

                function slug_title_ar() {
                    slugify('title_ar', 'slug_ar');
                }

                function slug_title_en() {
                    slugify('title_en', 'slug_en');
                }
            </script>
            {!! Html::script('BackEnd/main/js/slug.js')!!}
            {!! Html::script('BackEnd/assets/node_modules/switchery/dist/switchery.min.js')!!}
            {!! Html::script('BackEnd/assets/node_modules/select2/dist/js/select2.full.min.js')!!}
            {!! Html::script('BackEnd/assets/node_modules/bootstrap-select/bootstrap-select.min.js')!!}
            {!! Html::script('BackEnd/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')!!}
            {!! Html::script('BackEnd/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')!!}
            {!! Html::script('BackEnd/assets/node_modules/multiselect/js/jquery.multi-select.js')!!}
            {!! Html::script('BackEnd/assets/node_modules/multiselect/js/jquery.multi-select.js')!!}

            <script>
                $(function () {
                    // Switchery
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('.js-switch').each(function () {
                        new Switchery($(this)[0], $(this).data());
                    });
                    // For select 2
                    $(".select2").select2();
                    $('.selectpicker').selectpicker();
                    //Bootstrap-TouchSpin
                    $(".vertical-spin").TouchSpin({
                        verticalbuttons: true,
                        verticalupclass: 'ti-plus',
                        verticaldownclass: 'ti-minus'
                    });
                    var vspinTrue = $(".vertical-spin").TouchSpin({
                        verticalbuttons: true
                    });
                    if (vspinTrue) {
                        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                    }
                    $("input[name='tch1']").TouchSpin({
                        min: 0,
                        max: 100,
                        step: 0.1,
                        decimals: 2,
                        boostat: 5,
                        maxboostedstep: 10,
                        postfix: '%'
                    });
                    $("input[name='tch2']").TouchSpin({
                        min: -1000000000,
                        max: 1000000000,
                        stepinterval: 50,
                        maxboostedstep: 10000000,
                        prefix: '$'
                    });
                    $("input[name='tch3']").TouchSpin();
                    $("input[name='tch3_22']").TouchSpin({
                        initval: 40
                    });
                    $("input[name='tch5']").TouchSpin({
                        prefix: "pre",
                        postfix: "post"
                    });
                    // For multiselect
                    $('#pre-selected-options').multiSelect();
                    $('#optgroup').multiSelect({
                        selectableOptgroup: true
                    });
                    $('#public-methods').multiSelect();
                    $('#select-all').on('click', function () {
                        $('#public-methods').multiSelect('select_all');
                        return false;
                    });
                    $('#deselect-all').on('click', function () {
                        $('#public-methods').multiSelect('deselect_all');
                        return false;
                    });
                    $('#refresh').on('click', function () {
                        $('#public-methods').multiSelect('refresh');
                        return false;
                    });
                    $('#add-option').on('click', function () {
                        $('#public-methods').multiSelect('addOption', {
                            value: 42,
                            text: 'test 42',
                            index: 0
                        });
                        return false;
                    });
                    $(".ajax").select2({
                        ajax: {
                            url: "https://api.github.com/search/repositories",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function (data, params) {
                                // parse the results into the format expected by Select2
                                // since we are using custom formatting functions we do not need to
                                // alter the remote JSON data, except to indicate that infinite
                                // scrolling can be used
                                params.page = params.page || 1;
                                return {
                                    results: data.items,
                                    pagination: {
                                        more: (params.page * 30) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo, // omitted for brevity, see the source of this page
                        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                    });
                });
            </script>
            <!-- ============================================================== -->
            <!-- Style switcher -->
            <!-- ============================================================== -->
    {!! Html::script('BackEnd/assets/node_modules/styleswitcher/jQuery.style.switcher.js')!!}

@endsection
