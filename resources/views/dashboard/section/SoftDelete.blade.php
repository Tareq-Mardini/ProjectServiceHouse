<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <title>Admin Dashboard</title>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
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
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                            aria-label="Search" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="d-flex justify-content-between align-items-center mb-1">

                            <a href="{{ route('section.index') }}" class="btn btn-secondary d-flex align-items-center">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Sections
                            </a>
                        </div>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="{{asset('images/istockphoto-2041572395-612x612.jpg')}}" />
                            </a>
                        </li>
                    </ul>
                </nav>
                <table style="margin:auto;width:97%;"  class="table table-hover table-bordered shadow-sm rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section as $data)
                        <tr>
                            <td class="align-middle">{{ $data->name }}</td>
                            <td class="align-middle" style="max-width: 300px;">{{ Str::limit($data->description, 100) }}</td>
                            <td class="align-middle text-center">
                                <img src="{{ asset($data->image) }}" alt="Image" class="img-fluid rounded" style="width: 120px; height: 80px; object-fit: cover;">
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.section.Archive.Restore', $data->id) }}" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-undo-alt mr-1"></i> Restore
                                    </a>
                                    <a style="margin-left: 10px;"  href="{{ route('admin.section.Archive.ForceDelete', $data->id) }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @if(session('success_restore'))
    <script>
      Notiflix.Notify.success("{{ session('success_restore') }}");
    </script>
    @endif
    @if(session('success_delete'))
    <script>
      Notiflix.Notify.success("{{ session('success_delete') }}");
    </script>
    @endif

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/Loading.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->


    <!-- Page level custom scripts -->

</body>

</html>