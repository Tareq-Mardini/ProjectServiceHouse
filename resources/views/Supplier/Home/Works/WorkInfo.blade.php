<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
          <div  class="media-container">
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
              <span class="label"><i class="fas fa-tools" style="color:#1ab79d;"></i> Service</span>
              <span class="value">{{ $name_service->name }}</span>
            </div>
            <div class="detail">
              <span class="label"><i class="fa fa-tag" style="margin-right: 5px; color: #007bff;"></i> Title</span>
              <span class="value">{{ $works->title }}</span>
            </div>
            <div class="detail">
              <span class="label"><i class="fa fa-dollar-sign" style="margin-right: 5px; color: #28a745;"></i> Price</span>
              <span class="value">{{ $works->price }}$</span>
            </div>
            <div class="detail">
              <span class="label"><i class="fa fa-clock" style="margin-right: 5px; color: #ffc107;"></i> Average Delivery Time</span>
              <span class="value">{{ $works->Average_delivery_time }}</span>
            </div>
            <div class="detail">
              <span class="label"><i class="fa fa-bolt" style="margin-right: 5px; color: #fd7e14;"></i> Average Speed of Response</span>
              <span class="value">{{ $works->Average_speed_of_response }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="offers-description-wrapper" style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px;">
        <!-- Extra Offers Box -->
        @if ($offers->count())
        <div class="extra-offers-section discription detail" style="flex: 1; min-width: 300px; border-radius: 15px; padding: 15px;">
          <h2 style="color: #ee4962; margin-bottom: 15px; text-align:center;font-size:22px">
            <i class='bx bx-gift' style='color:#ee4962'></i> Extra Offers
          </h2>
          @foreach ($offers as $offer)
          <div class="extra-offer-box" style="border: 1px solid #ddd; padding: 15px; border-radius: 10px; margin-bottom: 10px; background: #ffffffb5;">
            <h3 style="margin: 0; color: #333;font-size:17px;">
              <i class='bx bxs-star' style='color:#f5c518'></i> {{ $offer->title }}
            </h3>
            <p style="margin: 5px 0 0; color: #555;font-size:17px">
              <strong><i class='bx bxs-dollar-circle' style='color:#1ab79d'></i> Price:</strong> {{ $offer->price }}$
            </p>
          </div>
          @endforeach
        </div>
        @endif
        <!-- Description Box -->
        <div class="discription detail" style="flex: 1; min-width: 300px; height:fit-content;">
          <span class="label">
            <h2 style="text-align:center;color:#ee4962;font-size:22px">
              <i class='bx bx-detail' style='color:#ee4962'></i> Description
            </h2>
          </span>
          <p style="font-size:17px">{!! nl2br(e($works->description)) !!}</p>
        </div>
      </div>

    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
  <script src="{{asset('js/Loading.js')}}"></script>
  <script src="{{asset('js/InfoWork.js')}}"></script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>