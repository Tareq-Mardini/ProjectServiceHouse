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
    <title> Admin Dashboard </title>
</head>
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
        display: none;
    }

    .btn-animated {
        transition: all 0.3s ease-in-out;
    }

    .btn-animated:hover {
        transform: translateY(-2px);
    }
</style>

<body id="page-top">
    <div id="wrapper">
    @include('dashboard.sidebar')

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
                    <div class="form-wrapper">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3><i class="fas fa-concierge-bell me-2 text-primary"></i> Create New Service</h3>

                        </div>
                        <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">Service Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Enter service name..." required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="section_id" class="form-label fw-bold text-secondary mb-2">
                                    <i class="fas fa-th-large me-2 text-primary"></i> Select Section
                                </label>
                                <br>
                                <select name="section_id" id="section_id"
                                    class="form-select rounded-3 px-4 py-2 shadow-sm border-0"
                                    style="background-color: #f8f9fa; font-weight: 500;" required>
                                    <option disabled selected hidden>Choose a section...</option>
                                    @foreach ($data as $datas)
                                    <option value="{{ $datas->id }}">{{ $datas->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold">Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="4" placeholder="Write service description..." required></textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold">Upload Image</label>
                                <input type="file" name="image" class="form-control" required onchange="previewImage(event)">
                                <img id="image-preview" class="img-preview" alt="Preview">
                                @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-animated">
                                    <i class="fas fa-save me-1"></i> Save
                                </button>
                                <a style="margin-left: 10px;" href="{{ route('admin.view.service') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
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