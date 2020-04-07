<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" style='background: #fff;'>
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                {!! Html::image('BackEnd/assets/images/logo-icon.png') !!}
                <!-- Light Logo icon -->
                    {!! Html::image('BackEnd/assets/images/logo-light-icon.png') !!}
                </b>
                <!--End Logo icon -->
                <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         {!! Html::image('BackEnd/assets/images/logo-text.png', 'homepage',  array('class' => 'dark-logo')) !!}

                <!-- Light Logo text -->

                    {!! Html::image('BackEnd/assets/images/logo-text.png','homepage', array('class' => 'light-logo')) !!}
                         </span> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                                        href="javascript:void(0)"><i class="sl-icon-menu"></i></a></li>
                <li class="nav-item"><a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark"
                                        href="javascript:void(0)"><i class="sl-icon-menu"></i></a></li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item hidden-xs-down search-box"><a
                        class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i
                            class="icon-Magnifi-Glass2"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i
                                class="ti-close"></i></a></form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- mega menu -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End mega menu -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->

                @if(App::isLocale('en'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                        <div class="dropdown-menu dropdown-menu-right animated bounceInDown">
                            <a class="dropdown-item" href="{{  url(str_replace("en/","ar/",Request::path()))}}">
                                <i class="flag-icon flag-icon-eg"></i> عربي</a>

                        </div>
                    </li>
                @endif
                @if(App::isLocale('ar'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-eg"></i></a>
                        <div class="dropdown-menu dropdown-menu-right animated bounceInDown">
                            <a class="dropdown-item" href="{{  url(str_replace("ar/","en/",Request::path()))}}">
                                <i class="flag-icon flag-icon-us"></i> English</a>

                        </div>
                    </li>
            @endif
            <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! Html::image('BackEnd/assets/images/users/1.jpg', 'user',  array('class' => '')) !!}
                        <span class="hidden-md-down">Mark Sanders &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img">
                                        {!! Html::image('BackEnd/assets/images/users/1.jpg','user')!!}
                                    </div>
                                    <div class="u-text">
                                        <h4>Steave Jobs</h4>
                                        <p class="text-muted">varun@gmail.com</p><a href="pages-profile.html"
                                                                                    class="btn btn-rounded btn-danger btn-sm">View
                                            Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
