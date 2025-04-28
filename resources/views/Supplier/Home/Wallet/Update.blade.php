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
    <!-- NAVBAR -->
    <main>
      <div class="wallet-section">
        <div class="wallet-form-wrapper">
          <h2><i class='bx bx-lock-alt' style="color: #1ab79d; margin-right: 8px;"></i> Update Wallet Password</h2>

          <!-- Flash Messages -->

          <form action="{{ route('update.wallet.supplier') }}" method="POST" style="max-width: 500px; margin: auto;">
            @csrf
            <!-- Old Password -->
            <div class="form-group mb-3">
              <label for="old_password" class="form-label">Current Password</label>
              <input type="password" name="old_password" id="old_password"
                class="form-control @error('old_password') is-invalid @enderror"
                required placeholder="Enter current password">
              @if(session('error'))
              <div style="color: red; font-size: 13px; margin-top: 5px;">
                {{ session('error') }}
              </div>
              @endif
            </div>

            <!-- New Password -->
            <div class="form-group mb-3">
              <label for="wallet_password" class="form-label">New Password</label>
              <input type="password" name="wallet_password" id="wallet_password"
                class="form-control @error('wallet_password') is-invalid @enderror"
                required minlength="10" placeholder="Enter new strong password">

            </div>

            <!-- Confirm Password -->
            <div class="form-group mb-4">
              <label for="wallet_password_confirmation" class="form-label">Confirm New Password</label>
              <input type="password" name="wallet_password_confirmation" id="wallet_password_confirmation"
                class="form-control" required minlength="10" placeholder="Confirm new password">
              @error('wallet_password')
              <div class="invalid-feedback d-block mt-1" style="color: red; font-size: 13px;">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="text-center">
              <button type="submit" class="btn-submit">Update Password</button>
            </div>
          </form>
        </div>

        <!-- Same Wallet Card Design -->
        <div class="container floating-card">
          <header>
            <span style="padding: 10px; border-radius: 10px; border-style:outset; background-color: rgba(73, 83, 80, 0.253);" class="logo">
              <img style="width: 48px; margin-right: 10px;" src="{{ asset('images/Flag_map_of_Syria.png') }}" alt="" />
              <h6 style="font-family: Tektur, sans-serif; color: white; font-weight: 300; font-size: 12px;">
                Syrian Arab Republic
              </h6>
            </span>
            <img src="{{ asset('images/logo-2.png') }}" alt="" class="chip" />
          </header>
          <div class="card-details">
            <div class="name-number">
              <h6>Card Number</h6>
              <h5 class="number">{{$existingWallet->wallet_number}}</h5>
              <h5 class="name">{{$existingWallet->Supplier->name}}</h5>
            </div>
            <div class="valid-date">
              <h5>Date</h5>
              <h5>{{ $existingWallet->created_at->format('Y-m-d') }}</h5>
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