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
                    <h3 class="text-themecolor">Quiz</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.quiz.index') }}">Quiz</a></li>
                        <li class="breadcrumb-item">Edit Quiz</li>
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
                    <h4 class="modal-title" id="myModalLabel">Edit Quiz</h4>
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
                <form action="{{ route('Admin.quiz.update',$quiz->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                   value="{{ $quiz->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="time">Time</label>
                                            <input type="text" class="form-control" name="time" id="time"
                                                   value="{{ $quiz->time}}">
                                        </div>
                                        <div class="form-group ">
                                            <label for="lang" >Language</label>
                                            <select class="custom-select col-12"  id="lang" name="lang">
                                                <option value="en" @if($quiz->lang=="en") selected @endif>English</option>
                                                <option value="ar" @if($quiz->lang=="ar") selected @endif>Arabic</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="questions_number">Questions Number</label>
                                            <input type="text" class="form-control" name="questions_number" id="questions_number"
                                                   value="{{ $quiz->questions_number}}">
                                        </div>
                                        <div class="form-group ">
                                            <label for="lang" >Streamer</label>

                                            <select class="custom-select col-12" id="streamer_id" name="streamer_id">
                                                @foreach($streamers as $streamer)
                                                    <option value="{{$streamer->id}}" @if($quiz->streamer_id==$streamer->id) selected @endif>{{$streamer->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('Admin.quiz.index') }}" class="btn btn-danger waves-effect">BACK</a>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        @endsection
        @section('js')
            {!! Html::script('BackEnd/assets/node_modules/tinymce/tinymce.min.js') !!}

    {!! Html::script('BackEnd/main/js/slug.js')!!}
@endsection
