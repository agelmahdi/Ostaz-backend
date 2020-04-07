@extends('layouts.BackEnd.master')

@section('title','Edit Permissioncategory')

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
                    <h3 class="text-themecolor"> Edit Permissioncategory</h3>
                    <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Admin.permissioncategories.index') }}">Permissioncategory</a></li>
                        <li class="breadcrumb-item active">Edit Permissioncategory</li>
                    </ol>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
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
    <form action="{{ route('Admin.permissioncategories.update',$permissioncategory->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" value="{{ $permissioncategory->name }}" class="form-control" placeholder="Name">
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
