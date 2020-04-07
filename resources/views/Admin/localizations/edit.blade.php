@extends('layouts.BackEnd.master')

@section('title','Edit Permission')

@section('content')
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
                    <h3 class="text-themecolor"> Edit Permission</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.localization.index') }}">option</a></li>
                        <li class="breadcrumb-item active">Edit option</li>
                    </ol>
                </div>
                <div class="">
                    <button
                        class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10">
                        <i class="ti-settings text-white"></i></button>
                </div>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('Admin.localization.update',$localization->id) }}" method="POST">
                                @csrf
                                @method('PUT')


                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>key:</strong>
                                            <input type="text" name="key" value="{{ $localization->key }}"
                                                   class="form-control" placeholder="key">
                                        </div>
                                        <div class="form-group">
                                            <strong>value En:</strong>
                                            <input type="text" name="value_en" value="{{ $localization->value_en }}"
                                                   class="form-control" placeholder="value">
                                        </div>

                                    <div class="form-group">
                                        <strong>value Ar:</strong>
                                        <input type="text" name="value_ar" value="{{ $localization->value_ar }}"
                                               class="form-control" placeholder="value">
                                    </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>



                    </div>
                </div>
            </div>
        </div>

@endsection
