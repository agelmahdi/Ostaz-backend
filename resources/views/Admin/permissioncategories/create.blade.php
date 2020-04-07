@extends('layouts.BackEnd.master')

@section('title','Create New Permissioncategory')

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
                    <h3 class="text-themecolor"> Create New Permissioncategory</h3>
                    <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Admin.permissioncategories.index') }}">Permissioncategory</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('Admin.permissioncategories.create') }}">Create Permissioncategory</a></li>
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

    <form action="{{ route('Admin.permissioncategories.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>

</div>
</div>    </div>
</div>

@endsection
