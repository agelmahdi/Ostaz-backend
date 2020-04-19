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
                        <li class="breadcrumb-item"><a href="{{ route('Admin.academicyears.index') }}">Management
                                Category</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            @can('category-create')
                                <a class="btn btn-info" href="{{ route('Admin.academicyears.create') }}"> Create New
                                    Category</a>
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
                            <div style="text-align: right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" id="arabic" onclick="arabic()" class="btn btn-info" style="background-color: #2db2e4" selected>
                                        Ar
                                    </button>
                                    <button type="button" id="english" onclick="english()" class="btn btn-info" style="background-color: #6d6d6d">En
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th class="arabic"  >Title Ar</th>
                                        <th class="english" style="display: none">Title En</th>
                                        <th class="arabic"  >Slug Ar</th>
                                        <th class="english" style="display: none">Slug En</th>
                                        <th>Action</th>
                                    </tr>

                                    </thead>

                                    <tbody>

                                    @foreach($academics as $academic)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="arabic"  >{{$academic->title_ar}}</td>
                                            <td class="english" style="display: none">{{$academic->title_en}}</td>
                                            <td class="arabic"  >{{$academic->slug_ar}}</td>
                                            <td class="english" style="display: none">{{$academic->slug_en}}</td>
                                            <td>
                                                @can('academic_year-edit')
                                                    <a href="{{ route('Admin.academicyears.edit',$academic->id) }}"
                                                       class="btn btn-info waves-effect">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('academic_year-delete')
                                                    <button class="btn btn-danger"
                                                            data-myid={{$academic->id}} data-toggle="modal"
                                                            data-target="#delete"><i class="fa fa-trash"></i></button>
                                                @endcan

                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th class="arabic" >Title Ar</th>
                                        <th class="english" style="display: none">Title En</th>
                                        <th class="arabic"  >Slug Ar</th>
                                        <th class="english" style="display: none">Slug En</th>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                        </div>
                        <form action="{{route('Admin.academicyears.destroy','test')}}" method="post">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <p class="text-center">
                                    Are you sure you want to delete this?
                                </p>
                                <input type="hidden" name="academicyear_id" id="id" value="">

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
                <script>
                    $(document).ready(function () {
                        document.getElementById("english").style.backgroundColor = '#6d6d6d';
                        document.getElementById("arabic").style.backgroundColor = '#2db2e4';
                        $('#show').on('show.bs.modal', function (event) {

                            var button = $(event.relatedTarget)
                            var title_ar = button.data('mytitle_ar')
                            var title_en = button.data('mytitle_en')
                            var subcategorytitle_ar = button.data('subcategorytitle_ar')
                            var subcategorytitle_en = button.data('subcategorytitle_en')
                            var image = button.data('myimage')
                            var details_ar = button.data('mydetails_ar')
                            var details_en = button.data('mydetails_en')
                            var id = button.data('myid')
                            var modal = $(this)
                            var url = '{{ env('APP_URL') }}'
                            document.getElementById('imageBox').src = url + "/app/public/category/" + image;
                            document.getElementById('imageBox0').src = url + "/app/public/category/" + image;
                            modal.find('.modal-body #title_ar').val(title_ar);
                            modal.find('.modal-body #title_en').val(title_en);
                            modal.find('.modal-body #subcategorytitle_ar').val(subcategorytitle_ar);
                            modal.find('.modal-body #subcategorytitle_en').val(subcategorytitle_en);
                            modal.find('.modal-body #image').val(image);
                            modal.find('.modal-body #details_ar').val(details_ar);
                            modal.find('.modal-body #details_en').val(details_en);
                            modal.find('.modal-body #id').val(id);
                        })

                        $('#delete').on('show.bs.modal', function (event) {

                            var button = $(event.relatedTarget)
                            var id = button.data('myid')
                            var modal = $(this)

                            modal.find('.modal-body #id').val(id);
                        })


                    });
                    function arabic() {
                        document.getElementById("english").style.backgroundColor = '#6d6d6d';
                        document.getElementById("arabic").style.backgroundColor = '#2db2e4';
                        let arabic = document.getElementsByClassName("arabic");
                        let english = document.getElementsByClassName("english");
                        for (var i = 0; i < arabic.length; i += 1) {
                            arabic[i].style.display = 'table-cell';
                        }
                        for (var i = 0; i < english.length; i += 1) {
                            english[i].style.display = 'none';
                        }


                    }

                    function english() {
                        document.getElementById("arabic").style.backgroundColor = '#6d6d6d';
                        document.getElementById("english").style.backgroundColor = '#2db2e4';
                        let arabic = document.getElementsByClassName("arabic");
                        let english = document.getElementsByClassName("english");
                        for (var i = 0; i < arabic.length; i += 1) {
                            arabic[i].style.display = 'none';
                        }
                        for (var i = 0; i < english.length; i += 1) {
                            english[i].style.display = 'table-cell';
                        }


                    }
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
