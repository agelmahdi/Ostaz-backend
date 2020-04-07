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
                        <li class="breadcrumb-item"><a href="{{ route('Admin.category.index') }}">Category</a></li>
                        <li class="breadcrumb-item">Edit Category</li>
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
                    <h4 class="modal-title" id="myModalLabel">New category</h4>
                </div>
                <form action="{{ route('Admin.web_setting.update') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Website_Name_En">Website Name English</label>
                                            <input type="text" class="form-control" name="Website_Name_En"
                                                   id="Website_Name_En"
                                                   value="{{option('Website_Name_En')}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="Website_Name_En">Website Name Arabic</label>
                                            <input type="text" class="form-control" name="Website_Name_Ar"
                                                   id="Website_Name_Ar"
                                                   value="{{option('Website_Name_Ar')}}">

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('Admin.category.index') }}"
                                   class="btn btn-danger waves-effect">BACK</a>

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

@endsection
