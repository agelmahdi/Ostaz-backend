@extends('layouts.BackEnd.master')

@section('title','Create New option')

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
                    <h3 class="text-themecolor"> Create New Option</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.options.index') }}">Option</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('Admin.options.create') }}">Create_New_Option</a>
                        </li>
                    </ol>
                </div>
                <div class="">
                    <button
                        class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10">
                        <i class="ti-settings text-white"></i></button>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
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


                            <form action="{{ route('Admin.options.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (Session::has('success'))
                                        <div class="alert alert-success text-center">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <p>{{ Session::get('success') }}</p>
                                        </div>
                                    @endif

                                    <table class="table table-bordered" id="dynamicTable">
                                        <tr>
                                            <th>Key</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="addmore[0][key]" placeholder="Enter your Key"
                                                       class="form-control"/></td>
                                            <td>
                                                <input type="text" name="addmore[0][value]" placeholder="Enter your Value"
                                                       class="form-control"/>
                                            </td>
                                            <td>
                                                <button type="button" name="add" id="add" class="btn btn-success">Add
                                                    More
                                                </button>
                                            </td>
                                        </tr>
                                    </table>

                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection
@section('js')

    <script type="text/javascript">

        var i = 0;

        $("#add").click(function () {

            ++i;

            $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i + '][key]" placeholder="Enter your Key" class="form-control" /></td><td><input type="text" name="addmore[' + i + '][value]" placeholder="Enter your Value" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function () {
            $(this).parents('tr').remove();
        });

    </script>
@endsection


