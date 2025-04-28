<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/CreateWallet.css')}}">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="{{asset('css/supplier-dashboard.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
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

            <li>
                <a href="{{route('Client.View.Account')}}">
                    <i class='bx bx-user'></i>
                    <span class="text">My Account</span>
                </a>
            </li>

            <ul>
                <li>
                    <a href="{{route('view.chat.Suppliers')}}">
                        <i class='bx bxs-message-dots'></i>
                        <span class="text">Messages</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-cart'></i>
                        <span class="text">My Orders</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-heart'></i>
                        <span class="text">My Favourites</span>
                    </a>
                </li>
            </ul>


            <li>
                <a href="{{route('Logout.client')}}" class="logout">
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
                <a style="color: white;" class="home-page" href="{{route('ServiceHouse.Home.Client')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>
            </div>
        </nav>
        <!-- NAVBAR -->
        <!-- MAIN -->
        <main>
            <div class="wallet-section">
                <div class="wallet-form-wrapper">
                    <h2><i class='bx bx-wallet' style="color: #1ab79d; margin-right: 8px;"></i> Create Wallet</h2>
                    <form action="{{ route('store.wallet.clinet') }}" method="POST" style="max-width: 500px; margin: auto;">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="wallet_password" class="form-label">Wallet Password</label>
                            <input
                                type="password"
                                name="wallet_password"
                                id="wallet_password"
                                class="form-control @error('wallet_password') is-invalid @enderror"
                                required
                                minlength="10"
                                placeholder="Enter a strong password">
                        </div>
                        <div class="form-group mb-4">
                            <label for="wallet_password_confirmation" class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                name="wallet_password_confirmation"
                                id="wallet_password_confirmation"
                                class="form-control"
                                required
                                minlength="10"
                                placeholder="Re-enter the password">
                        </div>
                        @error('wallet_password')
                        <div style="color: red; font-size:13px;" class="invalid-feedback d-block mt-1">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="btn-submit">Create Wallet</button>
                        </div>
                    </form>
                </div>
                <div class="container floating-card">
                    <header>
                        <span style="padding: 10px; border-radius: 10px; border-style:outset; background-color: rgba(73, 83, 80, 0.253);" class="logo">
                            <img style="  width: 48px;margin-right: 10px;" src="{{asset('images/Flag_map_of_Syria.png')}}" alt="" />
                            <h6 style="font-family: Tektur, sans-serif; font-optical-sizing: auto; color:white; font-weight: 300; font-size: 12px;">
                                Syrian Arab Republic
                            </h6>
                        </span>
                        <img src="{{asset('images/logo-2.png')}}" alt="" class="chip" />
                    </header>
                    <div class="card-details">
                        <div class="name-number">
                            <h6>Card Number</h6>
                            <h5 class="number">SH-****-****</h5>
                            <h5 class="name">Name</h5>
                        </div>
                        <div class="valid-date">
                            <h5>Date</h5>
                            <h5>**/**</h5>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>