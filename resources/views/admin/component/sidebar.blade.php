<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{{ asset('admin/img/profile_small.jpg') }}" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth()->user()->name}}</strong>
                         </span> <span class="text-muted text-xs block">{{Auth()->user()->role==1?'Admin':'Editor'}} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); 
                                    document.getElementById('form-logout').submit();">
                                Logout
                            </a>    
                            <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{url()->current() == route('admin.dashboard')?'active':''}}">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-diamond"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ request()->is('*/user/*') ? 'active':''}}">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">QL Thành Viên</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{url()->current() == route('admin.user_catalogue.index')?'active':''}}">
                        <a href="{{route('admin.user_catalogue.index')}}">QL Nhóm Thành Viên</a>
                    </li>
                    <li class="{{url()->current() == route('admin.user.index')?'active':''}}">
                        <a href="{{route('admin.user.index')}}">QL Thành Viên</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
            </li>
            
        </ul>

    </div>
</nav>