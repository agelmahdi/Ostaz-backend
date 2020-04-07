@extends('layouts.BackEnd.master')

@section('title','Show Role')
 
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
                    <h3 class="text-themecolor"> Show Role</h3>
                    <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Admin.roles.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">Show_Role</li>
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
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>   </div>
</div>   </div>
</div>
@endsection
