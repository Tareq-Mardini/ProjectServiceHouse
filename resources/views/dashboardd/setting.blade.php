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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
                <a class="nav-link" href="{{ route('adminlogout') }}"onclick="event.preventDefault();
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
                <style>
    .account-wrapper {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
    }

    .avatar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #0d6efd;
        margin-bottom: 20px;
    }

    .box-account {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 12px 15px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .box-account h5 {
        margin: 0;
        font-weight: 500;
        color: #333;
    }

    .btn-edit {
        margin-top: 20px;
        width: 100%;
        font-weight: 600;
    }

    .modal-content {
        border-radius: 16px;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-title {
        font-weight: bold;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.2);
    }

    .btn1 {
        font-weight: 600;
        width: 100%;
    }
</style>

<div class="account-wrapper text-center">
    <div class="avatar">
        <img src="{{ asset('images/avatar.png') }}" alt="Avatar">
    </div>

    <div class="content-box">
        <div class="box-account">
            <ion-icon name="mail-outline" class="me-2 text-primary" size="large"></ion-icon>
            <h5> Email: {{ $data->email }}</h5>
        </div>

        <div class="box-account">
            <ion-icon name="person-outline" class="me-2 text-primary" size="large"></ion-icon>
            <h5>Name: {{ $data->name }}</h5>
        </div>

        <div class="box-account">
            <ion-icon name="call-outline" class="me-2 text-primary" size="large"></ion-icon>
            <h5>Phone: {{ $data->ph_number }}</h5>
        </div>

        <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fas fa-user-edit me-2"></i> Update Account
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
            </div>

            <form method="POST" action="{{ route('admin.edit.account') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="ph_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="ph_number" value="{{ $data->ph_number }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password <small class="text-muted">(Optional)</small></label>
                    <input type="password" class="form-control" name="password" placeholder="••••••••••••••••••••">
                </div>

                <div class="mb-4">
                    <label for="current" class="form-label">Current Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="current" required>
                </div>

                <button type="submit" class="btn btn-primary btn1 mb-2">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>
                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
            </form>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Page level custom scripts -->

</body>

</html>