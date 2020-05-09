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
                        <li class="breadcrumb-item"><a href="{{ route('Admin.group.index') }}">Group</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.group.create') }}">Create new
                                Group</a></li>
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
                    <h4 class="modal-title" id="myModalLabel">New Group</h4>
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
                <form action="{{ route('Admin.group.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title" >Title</label>
                                            <input type="text" class="form-control" name="title" id="title"  value="{{old('title')}}" onkeyup="slug_title()">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug" >Slug</label>
                                            <input type="text" class="form-control" name="slug" id="slug"  value="{{old('slug')}}">
                                        </div>
                                        <div class="description">
                                            <label for="description">Description </label>
                                            <textarea id="mymce" name="description">{{old('description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="start" >Start</label>
                                            <input type="date" class="form-control" name="start" id="start"  value="{{old('start')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="end" >End</label>
                                            <input type="date" class="form-control" name="end" id="end"  value="{{old('end')}}">
                                        </div>
                                        <div class="form-group ">
                                            <label for="lang" >Streamer</label>

                                            <select class="custom-select col-12" id="streamer_id" name="streamer_id">
                                                @foreach($streamers as $streamer)
                                                    <option value="{{$streamer->id}}">{{$streamer->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="lang" >Academic year</label>
                                            <select class="custom-select col-12" id="academic_year_id" name="academic_year_id">
                                                @foreach($academic_years as $academic_year)
                                                    <option value="{{$academic_year->id}}">{{$academic_year->title_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="lang" >Subject</label>
                                            <select class="custom-select col-12" id="subject_id" name="subject_id">
                                                @foreach($subjects as $subject)
                                                    <option value="{{$subject->id}}">{{$subject->title_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('Admin.group.index') }}" class="btn btn-danger waves-effect">BACK</a>

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

                $(document).ready(function () {
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

                function slug_title(){
                    slugify('title','slug');
                }
            </script>
    {!! Html::script('BackEnd/main/js/slug.js')!!}
@endsection
