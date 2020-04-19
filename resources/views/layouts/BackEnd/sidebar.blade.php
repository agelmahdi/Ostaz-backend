<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">--- {{ trans('admin.PERSONAL') }}</li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('Admin.home') }}" aria-expanded="false"><i
                            class="icon-Car-Wheel">
                        </i><span class="hide-menu">
                                    {{ trans('admin.dashboard') }}

                        </span></a>
                </li>
                @can('main-userManagement')
                    <li class="nav-small-cap">--- {{ trans('admin.usermanegment') }}</li>
                    @can('permissioncategory-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Lock-2"></i><span class="hide-menu">{{ trans('admin.permissioncategory') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('permissioncategory-create')
                                    <li>{!! Html::linkRoute('Admin.permissioncategories.create','Add Permissioncategory') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.permissioncategories.index','Permissioncategories') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('permission-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Lock-2"></i><span class="hide-menu">{{ trans('admin.permission') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('permission-create')
                                    <li>{!! Html::linkRoute('Admin.permissions.create','Add Permission') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.permissions.index','Permissions') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('role-list')

                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class="icon-Lock-User"></i><span class="hide-menu">{{ trans('admin.role') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('role-create')
                                    <li>{!! Html::linkRoute('Admin.roles.create','Add Role') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.roles.index','Roles') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('user-create')

                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Administrator"></i><span class="hide-menu">{{ trans('admin.user') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('user-create')
                                    <li>{!! Html::linkRoute('Admin.users.create','Add User') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.users.index','Users') !!}</li>
                            </ul>
                        </li>
                    @endcan
                @endcan
                @can('main-dataManagement')
                    <li class="nav-small-cap">--- {{ trans('admin.datamanagement') }}</li>
                    @can('academic_year-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Folder-Organizing"></i><span class="hide-menu">{{ trans('admin.academicyears') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('academic_year-create')
                                    <li>{!! Html::linkRoute('Admin.academicyears.create','Add Year') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.academicyears.index','Academic Year') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('category-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Folder-Organizing"></i><span class="hide-menu">{{ trans('admin.category') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('category-create')

                                    <li>{!! Html::linkRoute('Admin.category.create','Add Category') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.category.index','Category') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('subcategory-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class="icon-Folder-Open"></i><span class="hide-menu">{{ trans('admin.subcategory') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('subcategory-create')

                                    <li>{!! Html::linkRoute('Admin.subcategory.create','Add SubCategory') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.subcategory.index','SubCategory') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('quiz-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Folder-Organizing"></i><span class="hide-menu">{{ trans('admin.quiz') }}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('quiz-create')

                                    <li>{!! Html::linkRoute('Admin.quiz.create','Add Quiz') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.quiz.index','Quiz') !!}</li>
                            </ul>
                        </li>
                    @endcan
                @endcan
                @can('main-site')
                    <li class="nav-small-cap">---{{ trans('admin.sitedata')}}</li>
                    <li>
                    <a class="waves-effect waves-dark" href="{{ route('Admin.websetting.index') }}" aria-expanded="false"><i
                            class="icon-Data-Settings">
                        </i><span class="hide-menu">
                                     {{ trans('admin.settings')}}

                        </span></a>
                    </li>
                    @can('option-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Folder-Organizing"></i><span class="hide-menu">{{ trans('admin.option')}}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('option-create')

                                    <li>{!! Html::linkRoute('Admin.options.create','Add Option') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.options.index','Option') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('localization-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Folder-Organizing"></i><span class="hide-menu">{{ trans('admin.localization')}}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('localization-create')

                                    <li>{!! Html::linkRoute('Admin.localization.create','Add Localization') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.localization.index','Localization') !!}</li>
                            </ul>
                        </li>
                    @endcan
                    @can('adminlocalization-list')
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class=" icon-Folder-Organizing"></i><span class="hide-menu">{{ trans('admin.adminlocalization')}}</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @can('adminlocalization-create')

                                    <li>{!! Html::linkRoute('Admin.adminlocalization.create','Add Admin Localization') !!}</li>
                                @endcan
                                <li>{!! Html::linkRoute('Admin.adminlocalization.index','Admin Localization') !!}</li>
                            </ul>
                        </li>
                    @endcan
                @endcan
                <li class="nav-small-cap">--- {{ trans('admin.logout')}}</li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('admin.logout') }}" aria-expanded="false" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">

                        <i class="mdi mdi-logout">
                        </i><span class="hide-menu">
                                    {{ trans('admin.logout')}}

                        </span></a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
