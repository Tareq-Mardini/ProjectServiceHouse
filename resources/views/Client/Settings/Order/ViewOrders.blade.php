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
  <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
  <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
  <link rel="stylesheet" href="{{asset('css/OrderClient.css')}}">
  <title>Service House</title>
</head>

<body>
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="logo">
      <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="100" alt="EduWeb logo" style="margin-left: 70px; margin-top:20px">
    </a>
    @include('Client.Settings.sidebar')

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
      <div class="modern-orders-grid">
        @foreach ($info as $data)
        <div class="order-card-modern">
          <img class="work-thumbnail-modern" src="{{ Storage::url($data->work->thumbnail) }}" alt="Work Thumbnail">

          <div class="card-content">
            <h3 class="work-title-modern">
              <i class='bx bx-briefcase-alt-2'></i> {{ $data->work->title }}
            </h3>

            <div class="supplier-info-modern">
              <img class="supplier-avatar-modern" src="{{ Storage::url($data->Supplier->image) }}" alt="Supplier Image">
              <div class="supplier-details">
                <span class="supplier-name-modern"><i class='bx bx-user'></i> {{ $data->Supplier->name }}</span>
                <span class="supplier-role"><i class='bx bx-briefcase'></i> Supplier</span>
              </div>
            </div>

            <a href="{{ url('ServiceHouse/Client/Settings/MyOrders/OrderInfo/' . $data->id) }}" class="read-more-modern">
              <i class='bx bx-right-arrow-alt'></i> Read More
            </a>
          </div>
        </div>

        @endforeach
      </div>

    </main>
    <!-- MAIN -->
  </section>
  @if(session('success_order'))
  <script>
    Notiflix.Notify.success("{{ session('success_order') }}");
  </script>
  @endif
  <!-- CONTENT -->
  <script src="{{asset('js/Loading.js')}}"></script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>