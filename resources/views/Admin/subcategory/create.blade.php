@extends('layouts.BackEnd.master')

@section('title','Management SubCategories')

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
                    <h3 class="text-themecolor">SubCategory</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subcategory.index') }}">SubCategory</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subcategory.create') }}">Create new
                                SubCategory</a></li>
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
                    <h4 class="modal-title" id="myModalLabel">New SubCategory</h4>
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
                <form action="{{ route('Admin.subcategory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Title_Ar,Title_En,Images</h4>
                                        <div class="arabic form-group">
                                            <label for="title_ar">Title_Ar</label>
                                            <input type="text" class="form-control" name="title_ar" id="title_ar">
                                        </div>
                                        <div class="english form-group">
                                            <label for="title_en">Title_en</label>
                                            <input type="text" class="form-control" name="title_en" id="title_en">
                                        </div>
                                        <div class="arabic details_ar">
                                            <label for="details_ar">Details_Ar</label>
                                            <textarea id="mymce" name="details_ar"></textarea>
                                        </div>
                                        <div class=" english details_en">
                                            <label for="details_en">Details_En</label>
                                            <textarea id="mymce" name="details_en"></textarea>
                                        </div>

                                        <div class="form-group">

                                            <label>Image</label>
                                            <input type="file" class="form-control" name="image" id="image"
                                                   aria-describedby="fileHelp">
                                        </div>


                                        <div class="form-group {{ $errors->has('categories') ? 'focused error' : '' }}">
                                            <label for="Multi-Select">Categories</label>
                                            <br>
                                            <select name="categories" id="category"
                                                    class=" select2 form-control custom-select" style="width: 90%">
                                                @foreach($categories as $Category)
                                                    <option value="{{$Category->id}}">{{$Category->title_ar}}
                                                        =={{$Category->title_en}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('Admin.subcategory.index') }}"
                               class="btn btn-danger waves-effect">BACK</a>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
{{--        <input type="text" id="main" onkeyup ="slug_title()">--}}
{{--        <input type="text" id="slugi" value="">--}}
        @endsection
        @section('js')
            {!! Html::script('BackEnd/assets/node_modules/tinymce/tinymce.min.js') !!}
            <script>
                $(function () {

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
            </script>
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
                function slug_title_ar(){
                    slugify('title_ar','slug_ar');
                }
                function slug_title_en(){
                    slugify('title_en','slug_en');
                }
            </script>
            {!! Html::script('BackEnd/assets/node_modules/select2/dist/js/select2.full.min.js') !!}
            {!! Html::script('BackEnd/main/js/slug.js')!!}
        @endsection
        @section('css')

            <link href="{{asset('BackEnd/assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet"
                  type="text/css"/>


@endsection

