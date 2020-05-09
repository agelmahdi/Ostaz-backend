@extends('layouts.BackEnd.master')

@section('title','Management Category')

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
                        <li class="breadcrumb-item"><a href="{{ route('Admin.lesson.index') }}">Management
                                Lesson</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            @can('group-create')
                                <a class="btn btn-info" href="{{ route('Admin.lesson.create') }}"> Create New Lesson</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="">
                    <button
                        class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10">
                        <i class="ti-settings text-white"></i></button>
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
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Group</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($lessons as $lesson)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{$lesson->title}}</td>
                                            <td>{{$lesson->slug}}</td>
                                            <td>{{$lesson->start}}</td>
                                            <td>{{$lesson->end}}</td>
                                            <td>{{$lesson->group->title}}</td>

                                            <td>
                                                @can('lesson-edit')
                                                    <a href="{{ route('Admin.lesson.edit',$lesson->id) }}"
                                                       class="btn btn-info waves-effect">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('lesson-delete')
                                                    <button class="btn btn-danger"
                                                            data-myid={{$lesson->id}} data-toggle="modal"
                                                            data-target="#delete"><i class="fa fa-trash"></i></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Group</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection
            @section('model')
                @include('Admin.groups.model')
            @endsection
            @section('ajax')
                <script>
                    {{--data-myquestions="{{$quiz->questions->count()}}"--}}
                    $(document).ready(function () {

                        $('#delete').on('show.bs.modal', function (event) {

                            var button = $(event.relatedTarget);
                            var id = button.data('myid');
                            var modal = $(this);
                            modal.find('.modal-body #lesson_id').val(id);
                        });


                    });

                </script>
                    {!! Html::script('BackEnd/assets/node_modules/d3/d3.min.js') !!}
                    {!! Html::script('BackEnd/assets/node_modules/c3-master/c3.min.js') !!}
                    <!-- Popup message jquery -->
                    {!! Html::script('BackEnd/assets/node_modules/toast-master/js/jquery.toast.js') !!}
                    <!-- Chart JS -->

                    <!-- ============================================================== -->
                    <!-- Style switcher -->
                    <!-- ============================================================== -->
                    {!! Html::script('BackEnd/assets/node_modules/styleswitcher/jQuery.style.switcher.js') !!}

                        -----------------------------------------------------------------------------
                    <!--stickey kit -->
                    {!! Html::script('BackEnd/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') !!}
                    {!! Html::script('BackEnd/assets/node_modules/sparkline/jquery.sparkline.min.js') !!}
                    {!! Html::script('BackEnd/assets/node_modules/datatables/jquery.dataTables.min.js') !!}
                    <!-- start - This is for export functionality only -->
                <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
                <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
                <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
                <!-- end - This is for export functionality only -->
                <script>
                    $(function () {
                        $('#myTable').DataTable();
                        var table = $('#example').DataTable({
                            "columnDefs": [{
                                "visible": false,
                                "targets": 2
                            }],
                            "order": [
                                [2, 'asc']
                            ],
                            "displayLength": 25,
                            "drawCallback": function (settings) {
                                var api = this.api();
                                var rows = api.rows({
                                    page: 'current'
                                }).nodes();
                                var last = null;
                                api.column(2, {
                                    page: 'current'
                                }).data().each(function (group, i) {
                                    if (last !== group) {
                                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                        last = group;
                                    }
                                });
                            }
                        });
                        // Order by the grouping
                        $('#example tbody').on('click', 'tr.group', function () {
                            var currentOrder = table.order()[0];
                            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                                table.order([2, 'desc']).draw();
                            } else {
                                table.order([2, 'asc']).draw();
                            }
                        });

                    });
                    $('#example23').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    });

                </script>
                @if ($message = Session::get('success'))
                    <script>
                        $.toast({
                            heading: 'success',
                            text: '{{ $message }}',
                            position: 'top-right',
                            loaderBg: '#f33c49',
                            icon: 'success',
                            hideAfter: 6000,
                            stack: 6
                        })
                    </script>
    @endif
@endsection
