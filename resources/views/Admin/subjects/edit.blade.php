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
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subject.index') }}">Category</a></li>
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
                    <h4 class="modal-title" id="myModalLabel">Edit category</h4>
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
                <form action="{{ route('Admin.subject.update',$subject->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="arabic form-group">
                                            <label for="title_ar">Title Ar</label>
                                            <input type="text" class="form-control" name="title_ar" id="title_ar"
                                                   value="{{ $subject->title_ar}}"
                                                   onkeyup="slug_title_ar()">
                                        </div>
                                        <div class="english form-group">
                                            <label for="title_en">Title en</label>
                                            <input type="text" class="form-control" name="title_en" id="title_en"
                                                   value="{{ $subject->title_en}}"
                                                   onkeyup="slug_title_en()">
                                        </div>
                                        <div class="form-group arabic">
                                            <label for="slug_ar">Slug Ar</label>
                                            <input type="text" class="form-control" name="slug_ar" id="slug_ar"
                                                   value="{{$subject->slug_ar}}">
                                        </div>
                                        <div class="form-group english">
                                            <label for="slug_en">Slug En</label>
                                            <input type="text" class="form-control" name="slug_en" id="slug_en"
                                                   value="{{$subject->slug_en}}">
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
                function slug_title_ar(){
                    slugify('title_ar','slug_ar');
                }
                function slug_title_en(){
                    slugify('title_en','slug_en');
                }
            </script>
    {!! Html::script('BackEnd/main/js/slug.js')!!}
@endsection
