@extends('layouts.BackEnd.master')

@section('title','Management SubCategory')

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
                    <h3 class="text-themecolor">SubCategory</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.subcategory.index') }}">Management SubCategory</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            @can('subcategory-create')
                                <a class="btn btn-info" href="{{ route('Admin.subcategory.create') }}"> Create New SubCategory</a>
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
                                        <th>Title_ar</th>
                                        <th>Title_en</th>
                                        <th>Slug</th>
                                        <th>created_AT</th>
                                        <th>Action</th>
                                    </tr>

                                    </thead>

                                    <tbody>

                                    @foreach($subcategories as $subcategory)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{$subcategory->title_ar}}</td>
                                            <td>{{$subcategory->title_en}}</td>
                                            <td>{{$subcategory->slug}}</td>

                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $subcategory->updated_at)->diffForHumans() }}</td>
                                            <td>


                                                @can('subcategory-showdetails')
                                                    <button class="btn btn-success waves-effect"
                                                        data-mytitle_ar="{{$subcategory->title_ar}}"
                                                        data-mytitle_en="{{$subcategory->title_en}}"
                                                        data-mycategorytitle_ar="{{$subcategory->category->title_ar}}"
                                                        data-mycategorytitle_en="{{$subcategory->category->title_en}}"
                                                        data-myimage="{{$subcategory->image}}"
                                                        data-mydetails_ar="{!!$subcategory->details_ar!!}"
                                                        data-mydetails_en="{!!$subcategory->details_en!!}"
                                                        data-myid={{$subcategory->id}} data-toggle="modal"
                                                        data-target="#show"><i class="fa fa-eye"></i></button>
                                                @endcan
                                                    @can('subcategory-edit')
                                                        <a href="{{ route('Admin.subcategory.edit',$subcategory->id) }}"
                                                   class="btn btn-info waves-effect">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                    @endcan
                                                    @can('subcategory-delete')

                                                <button class="btn btn-danger"
                                                        data-myid={{$subcategory->id}} data-toggle="modal"
                                                        data-target="#delete"><i class="fa fa-trash"></i></button>
                                                    @endcan

                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Title_ar</th>
                                        <th>Title_en</th>
                                        <th>Slug</th>
                                        <th>created_AT</th>
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
                @include('Admin.subcategory.model')
            @endsection
            @section('ajax')
                <script>

                    $('#show').on('show.bs.modal', function (event) {

                        var button = $(event.relatedTarget)
                        var title_ar = button.data('mytitle_ar')
                        var title_en = button.data('mytitle_en')
                        var categorytitle_ar = button.data('mycategorytitle_ar')
                        var categorytitle_en = button.data('mycategorytitle_en')
                        var image = button.data('myimage')
                        var details_ar = button.data('mydetails_ar')
                        var details_en = button.data('mydetails_en')
                        var id = button.data('myid')
                        var modal = $(this)
                        var url='{{ env('APP_URL') }}'
                        document.getElementById('imageBox').src = url+"/app/public/subcategory/" + image;
                        document.getElementById('imageBox0').src = url+"/app/public/subcategory/" + image;
                        modal.find('.modal-body #title_ar').val(title_ar);
                        modal.find('.modal-body #title_en').val(title_en);
                        modal.find('.modal-body #categorytitle_ar').val(categorytitle_ar);
                        modal.find('.modal-body #categorytitle_en').val(categorytitle_en);
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


                </script>
@endsection
            @section('js')
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
