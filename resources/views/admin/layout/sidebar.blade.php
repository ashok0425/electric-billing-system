<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">
        MENU BAR
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    @if (Auth::guard('admin')->user()->type=='admin')
    <li class="nav-item @if (Request()->segment(2)=='dashboard')  active @endif">
        <a class="nav-link" href="{{route('admin.dashboard')}}" >
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    @endif


    @if (Auth::guard('admin')->user()->type=='admin'||Auth::guard('admin')->user()->type=='franchise')
    <li class="nav-item @if (Request()->segment(2)=='user_details')active @endif">
        <a class="nav-link" href="{{route('admin.user_details.index')}}">
        <i class="fas fa-fw fa-users"></i>
        <span>Consumer</span></a>
    </li>
    @endif

    <li class="nav-item  @if (Request()->segment(2)=='meter') active @endif
    ">
        <a class="nav-link" href="{{route('admin.meter.index')}}">
        <i class="fas fa-fw fa-users"></i>
        <span>Meter List</span></a>
    </li>

    <li class="nav-item  @if (Request()->segment(2)=='consume_units')  active @endif    ">
        <a class="nav-link" href="{{route('admin.consume_units.index')}}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Meter Reading</span></a>
    </li>

    @if (Auth::guard('admin')->user()->type=='admin'||Auth::guard('admin')->user()->type=='franchise')
 
    @if (Auth::guard('admin')->user()->type=='admin')
    <li class="nav-item  @if (Request()->segment(2)=='franchises')   active @endif    ">
        <a class="nav-link" href="{{route('admin.franchises.index')}}">
        <i class="fas fa-fw fa-home"></i>
        <span>Area Branch </span></a>
    </li>
@endif


    <li class="nav-item @if (Request()->segment(2)=='accounts') active @endif    ">
        <a class="nav-link" href="{{route('admin.accounts.index')}}">
        <i class="fas fa-fw fa-wallet"></i>
        <span>Payments </span></a>
    </li>
    @if (Auth::guard('admin')->user()->type=='admin')
    <li class="nav-item @if (Request()->segment(2)=='transfer_meters')  active @endif  ">
        <a class="nav-link" href="{{route('admin.transfer_meters.index')}}">
        <i class="fas fa-fw fa-exchange-alt"></i>
        <span>Meter transfer </span></a>
    </li>
@endif

@if (Auth::guard('admin')->user()->type=='admin')
    <li class="nav-item @if (Request()->segment(2)=='cms') active @endif ">
        <a class="nav-link" href="{{route('admin.cms.edit')}}">
        <i class="fas fa-fw fa-copy"></i>
        <span>Cms </span></a>
    </li>
    <li class="nav-item  @if (Request()->segment(2)=='blogs') active @endif  ">
        <a class="nav-link" href="{{route('admin.blogs.index')}}">
        <i class="fas fa-fw fa-copy"></i>
        <span>Blog </span></a>
    </li>

    <li class="nav-item  @if (Request()->segment(2)=='contacts') active @endif  ">
        <a class="nav-link" href="{{route('admin.contacts.index')}}">
        <i class="fas fa-fw fa-users"></i>
        <span>Contact </span></a>
    </li>

    <li class="nav-item  @if (Request()->segment(2)=='primary_setup')   active @endif  ">
        <a class="nav-link" href="{{route('admin.primary.setup')}}">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Primary Setup</span></a>
    </li>
@endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>