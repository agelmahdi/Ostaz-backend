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
                    <h3 class="text-themecolor">quiz</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.quiz.index') }}">Management
                                Quiz</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            @can('quiz-create')
                                <a class="btn btn-info" href="{{ route('Admin.quiz.create') }}"> Create New
                                    Quiz</a>
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
                                        <th>streamer</th>
                                        <th>Questions Count</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>

                                    </thead>

                                    <tbody>

                                    @foreach($quizzes as $quiz)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$quiz->title}}</td>
                                            <td>{{$quiz->streamer->name_en}}</td>
                                            <td>{{$quiz->questions->count()}}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $quiz->created_at)->diffForHumans() }}</td>
                                            <td>
                                                @can('quiz-showdetails')
                                                    <button class="btn btn-success waves-effect"
                                                            data-mytitle="{{$quiz->title}}"
                                                            data-myslug="{{$quiz->slug}}"
                                                            data-mytime="{{$quiz->time}}"
                                                            data-mylang="{{$quiz->lang}}"
                                                            data-myquestionsnumber="{{$quiz->questions_number}}"
                                                            data-mystreamer="{{$quiz->streamer->name_en}}"
                                                            data-myquestions="{{$quiz->questions->count()}}"
                                                            data-myid={{$quiz->id}} data-toggle="modal"
                                                            data-target="#show"><i class="fa fa-eye"></i></button>
                                                @endcan
                                                @can('quiz-edit')
                                                    <a href="{{ route('Admin.quiz.edit',$quiz->id) }}"
                                                       class="btn btn-info waves-effect">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('quiz-delete')

                                                    <button class="btn btn-danger"
                                                            data-myid={{$quiz->id}} data-toggle="modal"
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
                                        <th>streamer</th>
                                        <th>Questions Count</th>
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
                        <form action="{{route('Admin.quiz.destroy','test')}}" method="post">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <p class="text-center">
                                    Are you sure you want to delete this?
                                </p>
                                <input type="hidden" name="quiz_id" id="quiz_id" value="">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                                <button type="submit" class="btn btn-warning">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">show Quiz</h4>
                        </div>
                        <form action="{{route('Admin.quiz.show','test')}}" method="post" enctype="multipart/form-data">
                            {{method_field('patch')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <input type="hidden" name="quiz_id" id="id" value="">
                            {{--------------------The ShowForm -----------------------------}}
                            <!-- row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="tab-content tabcontent-border">
                                                    <div class="tab-pane active" role="tabpanel">
                                                        <div class="p-20">
                                                            <label for="title">Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                   id="title" disabled>
                                                            </br>
                                                            <label for="streamer">streamer</label>
                                                            <input type="text" class="form-control" name="streamer"
                                                                   id="streamer" disabled>
                                                            </br>
                                                            <label for="slug">Slug</label>
                                                            <input type="text" class="form-control" name="slug"
                                                                   id="slug" disabled>
                                                            </br>
                                                            <label for="questions">Question Number</label>
                                                            <input type="text" class="form-control" name="questions"
                                                                   id="questions" disabled>
                                                            </br>
                                                            <label for="questions_number">Questions Limiter</label>
                                                            <input type="text" class="form-control"
                                                                   name="questions_number" id="questions_number"
                                                                   disabled>
                                                            </br>
                                                            <label for="time">time</label>
                                                            <input type="text" class="form-control" name="time"
                                                                   id="time" disabled>
                                                            </br>
                                                            <label for="lang">lang</label>
                                                            <input type="text" class="form-control" name="lang"
                                                                   id="lang" disabled>
                                                            </br>


                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--------------------End ShowForm -----------------------------}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

            {{--                -------------------------------------------------------------------------------}}
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
                            modal.find('.modal-body #quiz_id').val(id);
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
