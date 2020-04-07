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
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subcategory.index') }}">SubCategory</a></li>
                        <li class="breadcrumb-item">Edit SubCategory</li>
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
                </div>
                <form action="{{ route('Admin.subcategory.update',$subcategory->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Title_Ar,Title_En,Images</h4>
                                        <div class="form-group">
                                            <label for="title_ar">Title_Ar</label>
                                            <input type="text" class="form-control" name="title_ar" id="title_ar"
                                                   value="{{ $subcategory->title_ar }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="title_en">Title_en</label>
                                            <input type="text" class="form-control" name="title_en" id="title_en"
                                                   value="{{ $subcategory->title_en }}">
                                        </div>
                                        <div class="form-group">

                                            <label>Image</label>
                                            <input type="file" class="form-control" name="image" id="image"
                                                   aria-describedby="fileHelp">
                                        </div>
                                        <label for="Multi-Select">Categories</label>
                                        <select name="categories" id="category" class="select2 form-control custom-select" style="width: 100%" >
                                            @foreach($categories as $Category)
                                                <option {{ $Category->id == $subcategory->category_id ? 'selected' : '' }} value="{{$Category->id}}">{{$Category->title_en}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="details_ar">
                                        <label for="details_ar">Details_Ar</label>
                                        <textarea id="mymce" name="details_ar">{{ $subcategory->details_ar }}</textarea>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="details_en">
                                        <label for="details_en">Details_En</label>
                                        <textarea id="mymce" name="details_en">{{ $subcategory->details_en }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('Admin.subcategory.index') }}" class="btn btn-danger waves-effect">BACK</a>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

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
            {!! Html::script('BackEnd/assets/node_modules/select2/dist/js/select2.full.min.js') !!}

            <script>
                $(function() {
                    // Switchery
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    $('.js-switch').each(function() {
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
                    $('#select-all').on('click', function() {
                        $('#public-methods').multiSelect('select_all');
                        return false;
                    });
                    $('#deselect-all').on('click', function() {
                        $('#public-methods').multiSelect('deselect_all');
                        return false;
                    });
                    $('#refresh').on('click', function() {
                        $('#public-methods').multiSelect('refresh');
                        return false;
                    });
                    $('#add-option').on('click', function() {
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
                            data: function(params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page
                                };
                            },
                            processResults: function(data, params) {
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
                        escapeMarkup: function(markup) {
                            return markup;
                        }, // let our custom formatter work
                        minimumInputLength: 1,
                        templateResult: formatRepo, // omitted for brevity, see the source of this page
                        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                    });
                });
            </script>

        @endsection
        @section('css')

            <link href="{{asset('BackEnd/assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />


@endsection

