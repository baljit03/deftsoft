<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            @if(Auth::user()->usertype!='others')
            <li>
                <a href="{{url('admin/manage-pages')}}"><i class="fa fa-table fa-fw"></i> Manage Pages</a>
            </li>
            <li>
                <a href="{{url('admin/manage-posts')}}"><i class="fa fa-file fa-fw"></i> Manage Posts</a>
            </li>
            <li>
                <a href="{{url('admin/manage-portfolio')}}"><i class="fa  fa-camera-retro "></i> Manage Portfolio</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manage Menu's<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('admin/manage-header-menu')}}">Header Menu</a>
                    </li>
                    <li>
                        <a href="{{url('admin/manage-footer-menu')}}">Footer Menu</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{url('admin/business-partner-records')}}"><i class="fa  fa-sitemap  "></i> Manage Business Partner Records</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Job's<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('admin/manage-jobs')}}"><i class="fa fa-trophy  "></i> Manage Jobs</a>
                    </li>
                    <li>
                        <a href="{{url('admin/manage-job-applications')}}"><i class="fa fa-envelope  "></i> Manage Job Applications</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="{{url('admin/contact-us-records')}}"><i class="fa   fa-child"></i> Manage Contact Records</a>
            </li>
            @endif
            @if(Auth::user()->usertype =='superadmin')
            <li>
                <a href="{{url('admin/manage-users')}}"><i class="fa fa-users fa-fw"></i> Manage Users</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-gear"></i> Setting<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('admin/access-control')}}"><i class="fa fa-key fa-fw"></i>Access Control System</a>
                    </li>
                    <li>
                        <a href="{{url('admin/system-setting')}}"><i class="fa fa-cogs"></i> Core Setting</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            @endif
            <li>
                <a href="{{url('admin/manage-blog')}}"><i class="fa fa-file fa-paragraph "></i> Manage Blog</a>
            </li>

            <li>
                <a href="{{url('admin/manage-testimonial')}}"><i class="fa fa-comment  fa-fw"></i>Manage Client Testimonial</a>
            </li>










        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>