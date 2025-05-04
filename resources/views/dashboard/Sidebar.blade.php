<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard<sup></sup></div>
    </a>
    <hr class="sidebar-divider my-0" />
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider" />
    <li class="nav-item">
        <a class="nav-link" href="{{route('section.index')}}">
            <i class="fas fa-th-large"></i>
            <span>Sections</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.view.service')}}">
            <i class="fas fa-concierge-bell"></i>
            <span>services</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.setting')}}">
            <i class="fas fa-user"></i>
            <span>My Account</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ViewTransactions')}}">
        <i class="fas fa-money-check-alt"></i>
        <span>Transactions</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ViewOrders')}}">
        <i class="fas fa-file-alt"></i>
        <span>Orders</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminlogout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></a>
        <form id="logout-form" action="{{ route('adminlogout') }}" method="get" style="display: none;">
            @csrf
        </form>
    </li>
    <hr class="sidebar-divider d-none d-md-block" />
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>