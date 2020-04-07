@extends('layouts.BackEnd.master')

@section('title','Create New Role')
@section('css')
    {!! Html::style('BackEnd/assets/node_modules/switchery/dist/switchery.min.css') !!}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    {!! Html::script('BackEnd/assets/node_modules/styleswitcher/jquery.checkall.js') !!}
    <style>
        /* The container */
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: -5px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .item-list UL LI {
            list-style-type: none;
        }
    </style>

@endsection
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
                    <h3 class="text-themecolor"> Create New Role</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.roles.index') }}">Role</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('Admin.roles.create') }}">Create_New_Role</a>
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

                            {!! Form::open(array('route' => 'Admin.roles.store','method'=>'POST')) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="group-all">
                                    <label class="container">Check
                                        All
                                        <input class="group-all-check-all" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    ///////////////////////////////////////////////////////
                                    <div class="clear"></div>

                                    @role('Admin')
                                    @foreach($permissioncategories as $permissioncategory)
                                        @php
                                            $count=0;
                                        @endphp
                                        @foreach($permission as $value)
                                            @if($permissioncategory->name==mb_split("-", $value->name)[0])
                                                @php
                                                    $count=+1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if($count!=0)

                                            <li style="list-style-type: none;">
                                                ------------------------------------------------------
                                                <label class="container">{{ucwords($permissioncategory->name)}}
                                                    <input class="group-{{$permissioncategory->name}}-check-all"
                                                           type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                                ------------------------------------------------------

                                                @endif
                                                <div class="group-all" action=""></div>
                                                <ul class="group-{{$permissioncategory->name}}">

                                                    @foreach($permission as $value)
                                                        @if($permissioncategory->name==mb_split("-", $value->name)[0])

                                                            <label
                                                                class="container">{{ucwords(mb_split("-", $value->name)[1])}}
                                                                {{ Form::checkbox('permission[]', $value->id, false)}}
                                                                <span class="checkmark"></span>
                                                            </label>

                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        @else
                                            @foreach($permissioncategories as $permissioncategory)
                                                @php
                                                    $count=0;
                                                @endphp
                                                @foreach($permission as $value)
                                                    @can($value->name)
                                                    @if($permissioncategory->name==mb_split("-", $value->name)[0])
                                                        @php
                                                            $count=+1;
                                                        @endphp
                                                    @endif
                                                    @endcan
                                                @endforeach
                                                @if($count!=0)

                                                    <li style="list-style-type: none;">
                                                        ------------------------------------------------------

                                                        <label class="container">{{ucwords($permissioncategory->name)}}
                                                            <input class="group-{{$permissioncategory->name}}-check-all"
                                                                   type="checkbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        ------------------------------------------------------

                                                        @endif
                                                        <div class="group-all" action=""></div>
                                                        <ul class="group-{{$permissioncategory->name}}">

                                                            @foreach($permission as $value)
                                                                @if($permissioncategory->name==mb_split("-", $value->name)[0])
                                                                    @can($value->name)
                                                                        <label
                                                                            class="container">{{ucwords(mb_split("-", $value->name)[1])}}
                                                                            {{ Form::checkbox('permission[]', $value->id, false)}}
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    @endcan
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    @endforeach

                                                    @endrole

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-primary" href="{{ route('Admin.roles.index') }}"> Back</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>


            <script type="text/javascript">
                @foreach($permissioncategories as $permissioncategory)
                // Specific scope usage
                $('.group-{{$permissioncategory->name}}-check-all').checkAll({
                    scope: $('.group-{{$permissioncategory->name}}')
                });
                @endforeach
                $('.group-all-check-all').checkAll({
                    scope: $('.group-all')
                });
            </script>


            @endsection
            @section('js')
                {!! Html::script('BackEnd/assets/node_modules/switchery/dist/switchery.min.js') !!}


                <script>
                    $(function () {
                        // Switchery
                        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                        $('.js-switch').each(function () {
                            new Switchery($(this)[0], $(this).data());
                        });
                        // For select 2
                        $(".select2").select2();
                        $('.selectpicker').selectpicker();
                        //Bootstrap-TouchSpin
                        $(".vertical-spin").TouchSpin({
                            verticalbuttons: true,
                            verticalupclass: 'ti-plus',
                            verticaldownclass: 'ti-minus'
                        });
                        var vspinTrue = $(".vertical-spin").TouchSpin({
                            verticalbuttons: true
                        });
                        if (vspinTrue) {
                            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                        }
                        $("input[name='tch1']").TouchSpin({
                            min: 0,
                            max: 100,
                            step: 0.1,
                            decimals: 2,
                            boostat: 5,
                            maxboostedstep: 10,
                            postfix: '%'
                        });
                        $("input[name='tch2']").TouchSpin({
                            min: -1000000000,
                            max: 1000000000,
                            stepinterval: 50,
                            maxboostedstep: 10000000,
                            prefix: '$'
                        });
                        $("input[name='tch3']").TouchSpin();
                        $("input[name='tch3_22']").TouchSpin({
                            initval: 40
                        });
                        $("input[name='tch5']").TouchSpin({
                            prefix: "pre",
                            postfix: "post"
                        });
                        // For multiselect
                        $('#pre-selected-options').multiSelect();
                        $('#optgroup').multiSelect({
                            selectableOptgroup: true
                        });
                        $('#public-methods').multiSelect();
                        $('#select-all').on('click', function () {
                            $('#public-methods').multiSelect('select_all');
                            return false;
                        });
                        $('#deselect-all').on('click', function () {
                            $('#public-methods').multiSelect('deselect_all');
                            return false;
                        });
                        $('#refresh').on('click', function () {
                            $('#public-methods').multiSelect('refresh');
                            return false;
                        });
                        $('#add-option').on('click', function () {
                            $('#public-methods').multiSelect('addOption', {
                                value: 42,
                                text: 'test 42',
                                index: 0
                            });
                            return false;
                        });
                        $(".ajax").select2({
                            ajax: {
                                url: "https://api.github.com/search/repositories",
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    return {
                                        q: params.term, // search term
                                        page: params.page
                                    };
                                },
                                processResults: function (data, params) {
                                    // parse the results into the format expected by Select2
                                    // since we are using custom formatting functions we do not need to
                                    // alter the remote JSON data, except to indicate that infinite
                                    // scrolling can be used
                                    params.page = params.page || 1;
                                    return {
                                        results: data.items,
                                        pagination: {
                                            more: (params.page * 30) < data.total_count
                                        }
                                    };
                                },
                                cache: true
                            },
                            escapeMarkup: function (markup) {
                                return markup;
                            }, // let our custom formatter work
                            minimumInputLength: 1,
                            templateResult: formatRepo, // omitted for brevity, see the source of this page
                            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                        });
                    });
                </script>
    {!! Html::script('BackEnd/assets/node_modules/styleswitcher/jQuery.style.switcher.js') !!}
@endsection
