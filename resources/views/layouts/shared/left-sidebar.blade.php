<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">
                @if(Auth::user()->role_id == 1)
                <li>
                    <a href="{{route('accounttypeIndex',['admin','accounttype' ,'index']) }}">
                        <i class="fas fa-user"></i>
                        <span> انواع الحسابات </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('companiesIndex',['admin','companies' ,'index']) }}">
                        <i class="fas fa-city"></i>
                        <span> الشركات </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('employeesIndex',['admin','employees' ,'index']) }}">
                        <i class="far fa-id-badge"></i>
                        <span> الموظفين </span>
                    </a>
                </li>
                
                <li>
                <a href="{{route('personsIndex',['admin','persons' ,'index']) }}">
                    <i class="fas fa-user-friends"></i>
                    <span> أفراد </span>
                </a>
                </li>
                <li>
                    <a href="{{route('projectsIndex',['admin','projects' ,'index']) }}">
                        <i class="fas fa-project-diagram"></i>
                        <span> المشاريع </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('personleavesIndex',['admin','personleaves' ,'index']) }}">
                        <i class="fa fa-leaf" aria-hidden="true"></i>
                        <span> الطلبات </span>
                    </a>
                </li>

                
                <li>
                    <!--<a href="{{route('usersIndex',['admin','users' ,'index']) }}">-->
                        <a href="#">
                        <i class="fas fa-file"></i>
                        <span> التقارير </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('rolesIndex',['admin','roles' ,'index']) }}">
                        <i class="fa fa-tasks"></i>
                        <span>أدوار</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('settingsIndex',['admin','settings' ,'index']) }}">
                        <i class="fa fa-cog"></i> 
                        <span> الاعدادات </span>
                    </a>
                </li>
                
                @endif
                @if(Auth::user()->role_id != 1)

                <li>
                    <a href="{{route('employeesIndex',['admin','employees' ,'index']) }}">
                        <i class="far fa-id-badge"></i>
                        <span> الموظفين </span>
                    </a>
                </li>
                <li>
                <a href="{{route('personsIndex',['admin','persons' ,'index']) }}">
                    <i class="fas fa-user-friends"></i>
                    <span> أفراد </span>
                </a>
                <li>
                    <a href="{{route('projectsIndex',['admin','projects' ,'index']) }}">
                        <i class="fas fa-project-diagram"></i>
                        <span> المشاريع </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('personleavesIndex',['admin','personleaves' ,'index']) }}">
                        <i class="fa fa-leaf" aria-hidden="true"></i>
                        <span> الطلبات </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-file"></i>
                        <span> التقارير </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-tasks"></i>
                        <span> العمليات </span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-file-invoice"></i>
                        <span> الفواتير </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-question-circle"></i>
                        <span> دعم فني </span>
                    </a>
                </li>
                   
                
                   

                   
                @endif
               
{{--
                <li>
                    <a href="#sidebarDashboards" data-toggle="collapse">
                         <i data-feather="settings"></i> 
                        <span> الاعدادات </span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('apisIndex',['admin','apis' ,'index']) }}">
                                    <span> API </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                --}}
              
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
