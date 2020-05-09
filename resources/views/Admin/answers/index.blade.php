@extends('layouts.BackEnd.master')

@section('title','Management quiz')
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
                    <h3 class="text-themecolor">Answer</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.question.index',$question->id) }}">Management
                                Answer</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            @can('questions-create')
                                <a class="btn btn-info" href="{{ route('Admin.answer.create',$question->id) }}"> Create New
                                    Answer</a>
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
                                        <th>Question</th>
                                        <th>True</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>

                                    </thead>

                                    <tbody>

                                    @foreach($answers as $answer)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$answer->title}}</td>
                                            <td>{{$answer->question->title}}</td>
                                            <td> <input data-id="{{$answer->id}}" class="toggle-class checkmark" type="checkbox"
                                                        data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                        data-on="Yes" data-off="No" {{ $answer->right ? 'checked' : '' }}></td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $answer->created_at)->diffForHumans() }}</td>
                                            <td>
                                                @can('questions-edit')
                                                    <a href="{{ route('Admin.question.edit',$answer->id) }}"
                                                       class="btn btn-info waves-effect">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('questions-delete')

                                                    <button class="btn btn-danger"
                                                            data-myid={{$answer->id}} data-toggle="modal"
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
                                        <th>Quiz</th>
                                        <th>Answers Count</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                        </div>
                        <form action="{{route('Admin.question.destroy','test')}}" method="post">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <p class="text-center">
                                    Are you sure you want to delete this?
                                </p>
                                <input type="hidden" name="question_id" id="question_id" value="">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                <button type="submit" class="btn btn-warning">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
        @section('ajax')

            {!! Html::script('BackEnd/assets/node_modules/d3/d3.min.js') !!}
            {!! Html::script('BackEnd/assets/node_modules/c3-master/c3.min.js') !!}
            <!-- Popup message jquery -->
            {!! Html::script('BackEnd/assets/node_modules/toast-master/js/jquery.toast.js') !!}
            <!-- Chart JS -->
                <!-- ============================================================== -->
                <!-- Style switcher -->
                <!-- ============================================================== -->
            {!! Html::script('BackEnd/assets/node_modules/styleswitcher/jQuery.style.switcher.js') !!}
            {{---------------------------------------------------------------------------------}}
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
                    {{--data-myquestions="{{$quiz->questions->count()}}"--}}
                    $(document).ready(function () {
                        $('#show').on('show.bs.modal', function (event) {
                            console.log('yes');
                            var button = $(event.relatedTarget);
                            var title = button.data('mytitle');
                            var slug = button.data('myslug');
                            var time = button.data('mytime');
                            var lang = button.data('mylang');
                            var questions_number = button.data('myquestionsnumber');
                            var streamer = button.data('mystreamer');
                            var questions = button.data('myquestions');
                            var id = button.data('myid');
                            var modal = $(this);
                            var url = '{{ env('APP_URL') }}';
                            modal.find('.modal-body #title').val(title);
                            modal.find('.modal-body #slug').val(slug);
                            modal.find('.modal-body #time').val(time);
                            modal.find('.modal-body #lang').val(lang);
                            modal.find('.modal-body #questions_number').val(questions_number);
                            modal.find('.modal-body #streamer').val(streamer);
                            modal.find('.modal-body #questions').val(questions);
                            modal.find('.modal-body #id').val(id);
                        });
                        $('#delete').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget);
                            var id = button.data('myid');
                            var modal = $(this);
                            modal.find('.modal-body #question_id').val(id);
                        });
                    });
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
                    $(function () {
                        $('.toggle-class').change(function () {
                            var right = $(this).prop('checked') == true ? 1 : 0;
                            var id = $(this).data('id');

                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: 'http://127.0.0.1:8001/answer/changeStatus',
                                data: {'right': right, 'id': id},
                                success: function (data) {
                                    toastr.success("success Updated Status on Answer");
                                }
                            });
                        })
                    })
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
