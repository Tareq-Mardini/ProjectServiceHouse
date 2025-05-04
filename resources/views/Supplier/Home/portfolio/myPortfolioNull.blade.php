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
  <link rel="stylesheet" href="{{asset('css/MyWorks.css')}}">
  <link rel="stylesheet" href="{{asset('css/portfolio.css')}}">
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
    @include('Supplier.Home.sidebar')

  </section>
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <div>
        <a style="color: white;" class="home-page" href="{{route('ServiceHouse.Home.Supplier')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>
        <a style="color: white; margin-left:15px; background-color:#007c92" class="home-page" href="{{route('Supplier.Create.Portfolio')}}">Create Portfolio <i class='bx bx-add-to-queue' style='color:#ffffff'></i> </a>
      </div>
    </nav>
    <main>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
    <script src="{{asset('js/Loading.js')}}"></script>
    @if(session('Success_Delete'))
    <script>
      Notiflix.Notify.success("{{ session('Success_Delete') }}");
    </script>
    @endif
  </section>
</body>
</html>