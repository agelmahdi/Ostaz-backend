@extends('layouts.BackEnd.master')

@section('title','Management Role')

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
                            <h3 class="text-themecolor">User</h3>
                            <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('Admin.users.index') }}">Management User</a></li>
                            </ol>
                        </div>
                        <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
                                    @can('role-create')
                                        <a class="btn btn-info" href="{{ route('Admin.users.create') }}"> Create New User</a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        <div class="">
                            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->

                   <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="table-responsive m-t-40">
                                      <table id="myTable" class="table table-bordered table-striped">
                                          <thead>
                                              <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Roles</th>
                                                <th width="280px">Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                                  @foreach ($data as $key => $user)
                                                  <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                      @if(!empty($user->getRoleNames()))
                                                        @foreach($user->getRoleNames() as $v)
                                                           <label class="badge badge-success">{{ $v }}</label>
                                                        @endforeach
                                                      @endif
                                                    </td>
                                                    <td>
                                                       <a class="btn btn-info" href="{{ route('Admin.users.show',$user->id) }}">Show</a>
                                                       <a class="btn btn-primary" href="{{ route('Admin.users.edit',$user->id) }}">Edit</a>
                                                        {!! Form::open(['method' => 'DELETE','route' => ['Admin.users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                  </tr>
                                                  @endforeach
                                          </tbody>
                                          <thead>
                                                  <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Roles</th>
                                                    <th width="280px">Action</th>
                                                  </tr>
                                              </thead>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- ============================================================== -->
                  <!-- End PAge Content -->
                  <!-- ============================================================== -->
                 
              </div>
              <!-- ============================================================== -->
              <!-- End Container fluid  -->
              <!-- ============================================================== -->




@endsection
