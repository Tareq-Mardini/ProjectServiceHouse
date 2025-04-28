<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="{{asset('css/supplier-dashboard.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('css/SupplierAccount.css')}}">
    <link rel="stylesheet" href="{{asset('css/SupplierUpdateAccount.css')}}">
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <title>Service House</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="logo">
            <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="100" alt="EduWeb logo" style="margin-left: 70px; margin-top:20px">
        </a>
        <ul style="margin-top:0px" class="side-menu top">
            <li class="">
                <a href="{{route('Supplier.View.Portfolio')}}">
                    <i class='bx bxs-user-circle'></i>
                    <span class="text">My Portfolio</span>
                </a>
            </li>
            <li>
                <a href="{{route('Supplier.Show.Myworks')}}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My works</span>
                </a>
            </li>
            <li>
                <a href="{{route('Supplier.View.Account')}}">
                    <i class='bx bx-user'></i>
                    <span class="text">My Account</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li>
                <a href="{{route('ViewChats')}}">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Message</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="text">Mange Order</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="{{route('Logout.supplier')}}" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->
    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <div>
                <a style="color: white;" class="home-page" href="{{route('ServiceHouse.Home.Supplier')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>

            </div>
        </nav>
        <!-- MAIN -->
        <main style="padding-top: 15px;">
            <div class="card">
                <div class="card-header">
                    <h2>Update Account Information <i class='bx bxs-message-square-edit'></i></h2>
                </div>
                <form action="{{ route('Supplier.Edit.Account') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
                            @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone"><i class="fa fa-phone"></i> Phone Number</label>
                            <input type="text" id="phone" name="phone_number" value="{{ old('phone_number', $supplier->phone_number) }}" required>
                            @if ($errors->has('phone_number'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="address"><i class="fa fa-map-marker-alt"></i> Address</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $supplier->address) }}" required>
                            @if ($errors->has('address'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('address') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth"><i class="fa fa-calendar"></i> Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $supplier->date_of_birth) }}" required>
                            @if ($errors->has('date_of_birth'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('date_of_birth') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image"><i class="fa fa-image"></i> Profile Image</label>
                            <input type="file" id="image" name="image" accept="image/*">
                            @if ($errors->has('image'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </div>
                            @endif
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="new_password"><i class="fa fa-lock"></i> New Password</label>
                            <input placeholder="optional" type="password" id="new_password" name="new_password">
                            @if ($errors->has('new_password'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('new_password') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation"><i class="fa fa-lock"></i> Confirm Password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                            @if ($errors->has('new_password_confirmation'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="current_password"><i class="fa fa-lock"></i> Current Password</label>
                            <input placeholder="Enter the old password to complete the process" type="password" id="current_password" name="current_password" required>
                            @error('current_password')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="update-btn">Save</button>
                        </div>
                </form>

            </div>
        </main>
    </section>
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>