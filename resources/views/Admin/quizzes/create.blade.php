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
                        <li class="breadcrumb-item"><a href="{{ route('Admin.quiz.index') }}">Quiz</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.quiz.create') }}">Create new
                                Quiz</a></li>
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
                    <h4 class="modal-title" id="myModalLabel">New Quiz</h4>
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
                <form action="{{ route('Admin.quiz.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group ">
                                            <label for="title" >Title</label>
                                            <input type="text" class="form-control" name="title" id="title"  value="{{old('title')}}">
                                        </div>
                                        <div class="form-group ">
                                            <label for="time" >Time By Minutes</label>
                                            <input type="number" class="form-control" name="time" id="time"  value="{{old('time')}}">
                                        </div>
                                        <div class="form-group ">
                                            <label for="lang" >Language</label>

                                            <select class="custom-select col-12"  id="lang" name="lang">
                                                <option value="en">English</option>
                                                <option value="ar">Arabic</option>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="questions_number" >Number Of Questions</label>
                                            <input type="number" class="form-control" name="questions_number" id="questions_number"  value="{{old('questions_number')}}">
                                        </div>
                                        <div class="form-group ">
                                            <label for="lang" >Streamer</label>

                                            <select class="custom-select col-12" id="streamer_id" name="streamer_id">
                                                @foreach($streamers as $streamer)
                                                <option value="{{$streamer->id}}">{{$streamer->name_en}}</option>
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

