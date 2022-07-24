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
    <li class="nav-item @if (Request()->segment(1)=='dashboard')  active @endif">
        <a class="nav-link" href="{{route('dashboard')}}" >
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>


    <li class="nav-item  @if (Request()->segment(1)=='consume_units')  active @endif    ">
        <a class="nav-link" href="{{route('consume_units')}}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Meter Reading</span></a>
    </li>

 
 

    <li class="nav-item @if (Request()->segment(1)=='accounts') active @endif    ">
        <a class="nav-link" href="{{route('accounts')}}">
        <i class="fas fa-fw fa-wallet"></i>
        <span>Payments </span></a>
    </li>
   
    
    <li class="nav-item @if (Request()->segment(1)=='make') active @endif    ">
        <a class="nav-link" href="{{route('make.payment')}}">
        <i class="fas fa-fw fa-dollar"></i>
        <span>Pay Now </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>