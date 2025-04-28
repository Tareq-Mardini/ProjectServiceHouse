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
      <div style="position: relative; display: inline-block;">
        <a style="color: white;" class="home-page" href="{{route('ServiceHouse.Home.Supplier')}}">
          Home Page <i class='bx bx-right-arrow-alt'></i>
        </a>
        <button onclick="toggleMenu()" style="background: none; border: none; color: white; cursor: pointer; margin-left: 10px;">
          <i class='bx bx-dots-vertical-rounded' style="font-size: 20px; color:#1ab79d;"></i>
        </button>
        <div id="actionMenu" style="display: none; position: absolute; right: 0; background-color: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); z-index: 10; min-width: 150px;">
          <a href="{{ route('edit.wallet.supplier')}}" style="display: block; padding: 10px; color: black; text-decoration: none;">
            🔁 Data update
          </a>
          <a href="{{ route('Supplier.balance', ['wallet_id' => $existingWallet->id]) }}" style="display: block; padding: 10px; color: black; text-decoration: none;">
            💰 Balance inquiry
          </a>
        </div>
      </div>
    </nav>
    <script>
      function toggleMenu() {
        var menu = document.getElementById("actionMenu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
      }
      document.addEventListener('click', function(event) {
        var menu = document.getElementById("actionMenu");
        var button = event.target.closest('button');
        if (!event.target.closest('#actionMenu') && !button) {
          menu.style.display = 'none';
        }
      });
    </script>
    <!-- NAVBAR -->
    <!-- MAIN -->
    <main>
      <div style="margin: auto; height: fit-content;margin-top:100px; max-width:450px" class="container floating-card">
        <header>
          <span style="padding: 10px; border-radius: 10px; border-style:outset; background-color: rgba(73, 83, 80, 0.253);" class="logo">
            <img style="  width: 48px;margin-right: 10px;" src="{{asset('images/Flag_map_of_Syria.png')}}" alt="" />
            <h6 style=" font-optical-sizing: auto; color:white; font-weight: 300; font-size: 12px;">
              Syrian Arab Republic
            </h6>
          </span>
          <img src="{{asset('images/logo-2.png')}}" alt="" class="chip" />
        </header>
        <div class="card-details">
          <div class="name-number">
            <h6>Card Number</h6>
            <h5 class="number">{{$existingWallet->wallet_number}}</h5>
            <h5 class="name">{{$existingWallet->Supplier->name}}</h5>
          </div>
          <div class="valid-date">
            <h6 style="text-align: center; ">Date</h6>
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
  @if(session('Balance'))
  <script>
    Notiflix.Notify.init({
      success: {
        background: '#1ab79d',
        iconColor: '#fff',
        fontSize: '16px',
      },
    });
    Notiflix.Notify.success("💰 {{ session('Balance') }}");
  </script>
  @endif
  @if(session('SuccessCreateWallet'))
  <script>
    Notiflix.Notify.success("{{ session('SuccessCreateWallet') }}");
  </script>
  @endif
  @if(session('ErrorCreateWallet'))
  <script>
    Notiflix.Notify.failure("{{ session('ErrorCreateWallet') }}");
  </script>
  @endif
  @if(session('SuccessUpdateWallet'))
  <script>
    Notiflix.Notify.success("{{ session('SuccessUpdateWallet') }}");
  </script>
  @endif
</body>

</html>