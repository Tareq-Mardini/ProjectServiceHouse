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
                <div class="container my-5">
                    <style>
                        .form-wrapper {
                            background: #f8f9fa;
                            border-radius: 16px;
                            padding: 40px;
                            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                            transition: all 0.3s ease-in-out;
                        }

                        .form-wrapper:hover {
                            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
                        }

                        .form-label {
                            font-weight: 600;
                        }

                        .custom-input:focus {
                            border-color: #0d6efd;
                            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
                        }

                        .img-preview {
                            margin-top: 10px;
                            width: 150px;
                            height: 100px;
                            object-fit: cover;
                            border-radius: 8px;
                        }

                        .btn-animated {
                            transition: all 0.3s ease-in-out;
                        }

                        .btn-animated:hover {
                            transform: translateY(-2px);
                        }
                    </style>
                    <div class="form-wrapper">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3><i class="fas fa-pen-nib me-2 text-primary"></i> Update Section</h3>
                        </div>

                        <form action="{{ route('section.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    <input type="text" id="name" name="name" class="form-control custom-input @error('name') is-invalid @enderror" value="{{ $data->name }}" required>
                                </div>
                                @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" rows="4" class="form-control custom-input @error('description') is-invalid @enderror" required>{{ $data->description }}</textarea>
                                @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)">
                                @if ($data->image)
                                <img id="image-preview" class="img-preview" src="{{ asset($data->image) }}" alt="Current Image">
                                @else
                                <img id="image-preview" class="img-preview" style="display: none;" alt="Preview">
                                @endif
                                @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary btn-animated">
                                    <i class="fas fa-save me-1"></i> Save Changes
                                </button>
                                <a style="margin-left: 10px;" href="{{ route('section.index') }}" class="btn btn-outline-dark btn-animated">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function previewImage(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            const preview = document.getElementById('image-preview');
                            preview.src = reader.result;
                            preview.style.display = 'block';
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
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
    <!-- Page level plugins -->
    <!-- Page level custom scripts -->
</body>
</html>