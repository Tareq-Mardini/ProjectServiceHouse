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
    <link rel="stylesheet" href="{{asset('css/InfoWork.css')}}">
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
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
        <a href="#">
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
        <!-- MAIN -->
        <main>
            @php
            if (!function_exists('getYoutubeId')) {
            function getYoutubeId($url) {
            preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
            return $matches[1] ?? null;
            }
            }
            $youtubeId = null;
            if (!empty($works->youtube_link)) {
            $youtubeId = getYoutubeId($works->youtube_link);
            }
            @endphp
            <div class="container">
                <div class="large-box">
                    <div class="media-container">
                        @if($youtubeId)
                        <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" class="active" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                        <img src="{{ Storage::url($works->thumbnail) }}" alt="Work Image">
                        @endif
                        @foreach ($image as $image_path)
                        <img src="{{ Storage::url($image_path->image_path) }}" alt="Work Image">
                        @endforeach
                    </div>
                    <div class="arrow left" onclick="prevMedia()">❮</div>
                    <div class="arrow right" onclick="nextMedia()">❯</div>
                </div>
                <div class="small-box">
                    <h3 class="title">
                        <i class='bx bx-show bx-flashing' style='color:#ee4962'></i>Work Information
                    </h3>
                    <div class="product-details">
                        <div class="detail">
                            <span class="label">Service</span>
                            <span class="value">{{ $name_service->name }}</span>
                        </div>
                        <div class="detail">
                            <span class="label">Title</span>
                            <span class="value">{{ $works->title }}</span>
                        </div>
                        <div class="detail">
                            <span class="label">Price</span>
                            <span class="value">{{ $works->price }}$</span>
                        </div>
                        <div class="detail">
                            <span class="label">Average Delivery Time</span>
                            <span class="value">{{ $works->Average_delivery_time }}</span>
                        </div>
                        <div class="detail">
                            <span class="label">Average Speed of Response</span>
                            <span class="value">{{ $works->Average_speed_of_response }}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="discription detail">
                <span class="label">
                    <h2>Discription</h2>
                </span>
                <p>{!! nl2br(e($works->description)) !!}
                </p>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script src="{{asset('js/InfoWork.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>