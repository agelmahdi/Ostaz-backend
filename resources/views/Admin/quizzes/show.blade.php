@extends('layouts.BackEnd.master')
@section('title','Show permission')
 
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
                    <h3 class="text-themecolor"> Show Permission</h3>
                    <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Admin.permissions.index') }}">Permission</a></li>
                        <li class="breadcrumb-item active">Show Permission</li>
                    </ol>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>

            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Permission</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('Admin.permissions.index') }}"> Back</a>
            </div>
        </div>
    </div>
  

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $permission->name }}
            </div>
        </div>
       
    </div>  </div>
       
</div>  </div>
       
</div>
@endsection
