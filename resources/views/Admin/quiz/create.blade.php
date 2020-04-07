@extends('layouts.BackEnd.master')

@section('title','Create New Permission')

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
                    <h3 class="text-themecolor"> Create New Permissions</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.roles.index') }}">Permission</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('Admin.roles.create') }}">Create_New_Permission</a>
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


                            <form action="{{ route('Admin.permissions.store')}}" method="POST">
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
                                            <th>Question</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="addmore[0][question]"
                                                       placeholder="Enter your Question"
                                                       class="form-control"/>
                                                <table class="table table-bordered" id="dynamicTableAnswer0">
                                                    <tr>
                                                        <td><input type="text" name="addmore[0][0][answer0]"
                                                                   placeholder="Enter your Answer"
                                                                   class="form-control"/></td>
                                                        <td>
                                                            <button type="button" name="add_answer0" id="add_answer0"
                                                                    class="btn btn-success">Add
                                                                More
                                                            </button>
                                                        </td>
                                                    </tr>

                                                </table>

                                            </td>

                                            <td>
                                                <button type="button" name="add" id="add" class="btn btn-success">Add
                                                    More
                                                </button>
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                                <button type="submit" class="btn btn-success">Save</button>
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

     @for($i=0;$i<=100;$i++)
            var x{{$i}} = 0;
            $("#add_answer{{$i}}").click(function () {
                ++x{{$i}};
                $("#dynamicTableAnswer{{$i}}").append('<tr><td><input type="text" name="addmore[{{$i}}][' + x{{$i}} + '][answer{{$i}}]" placeholder="Enter your Answer" class="form-control" /></td><td><button type="button" class="btn btn-danger answer-remove-tr{{$i}}">Remove</button></td></tr>');
            });
            $(document).on('click', '.answer-remove-tr{{$i}}', function () {
                $(this).parent().remove();
            });
            @endfor




        var i = 0;

        $("#add").click(function () {
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="addmore[' + i + '][question]" placeholder="Enter your Question" class="form-control" />  <table class="table table-bordered" id="dynamicTableAnswer' + i + '"><tr><td><input type="text" name="addmore[' + i + '][0][answer' + i + ']"placeholder="Enter your Answer"class="form-control"/></td><td><button type="button" name="add_answer' + i + '" id="add_answer' + i + '"class="btn btn-success">Add More</button></td></tr></table></td><td><button type="button" class="btn btn-danger question-remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.question-remove-tr', function () {
            $(this).parents('tr').remove();
        });
        $(document).on('click', '.answer-remove-tr', function () {
            $(this).parents('tr').remove();
        });


    </script>
@endsection


