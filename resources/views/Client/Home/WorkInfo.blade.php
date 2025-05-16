<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/visitor.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/visitor-sections.css')}}">
    <link rel="stylesheet" href="{{asset('css/SupplierWork.css')}}">
    <link rel="stylesheet" href="{{asset('css/InfoWork.css')}}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('css/SupplierWork.css')}}">
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <title>Service House</title>
</head>

<body id="top">
    <header class="header" data-header>
        <div class="container">
            <a href="#" class="logo">
                <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="40" alt="EduWeb logo" style="margin-left: 70px;">
            </a>
            <nav class="navbar" data-navbar>
                <div class="wrapper">
                    <a href="#" class="logo">
                        <img src="{{asset('images/visitor/logo.png')}}" width="162" height="40" alt="EduWeb logo">
                    </a>
                    <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                        <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>
                <ul class="navbar-list">
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Home</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Benefits</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>About</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Sections</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse.Home.Client')}}" class="navbar-link" data-nav-link>Contact</a>
                    </li>
                    <li class="navbar-item">
                        <button style="width: 120px;" class="option-btn" id="customerBtn">
                            <a href="{{route('ServiceHouse.Client.Settings')}}">Settings</a>
                            <i class='bx bx-cog bx-spin'></i>
                        </button>
                    </li>
                </ul>
            </nav>
            <div class="header-actions">
                <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
                    <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
                </button>
            </div>
            <div class="overlay" data-nav-toggler data-overlay></div>
        </div>
    </header>
    <section style="margin-top: 150px;" id="content">
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
                <div style="margin-top: -10px;" class="large-box ">
                    <div class="media-container">
                        @if($youtubeId)
                        <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" class="active" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @else
                        <img src="{{ Storage::url($works->thumbnail) }}" alt="Work Image" class="active">
                        @endif
                        @foreach ($image as $image_path)
                        <img src="{{ Storage::url($image_path->image_path) }}" alt="Work Image">
                        @endforeach
                    </div>
                    <div class="arrow left" onclick="prevMedia()">❮</div>
                    <div class="arrow right" onclick="nextMedia()">❯</div>
                </div>
                <div class="small-box">
                    <h3 style="font-size: 22px;" class="title">
                        <i class='bx bx-show bx-flashing' style='color:#ee4962'></i>Work Information
                    </h3>
                    <div class="product-details">
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
                        <div class=" detail">
                            <span class="label"><i class="fa fa-user" style="margin-right: 5px; color: #6c757d;"></i> Supplier</span>
                            <span class="value">{{ $works->Supplier->name }}
                                <div class="portfolio-btn-container">
                                    <button class="main-toggle-btn" onclick="toggleMenu()"><i class="fa fa-cog" style="margin-right: 5px; color: #6c757d;"></i>
                                    </button>
                                    <div  class="toggle-menu" id="toggleMenu">
                                        <a href="{{ route('view.portfolio.Client', ['id' => $works->Supplier->id]) }}" class="portfolio-btn">
                                            <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 8px;"></i> View Portfolio
                                        </a>
                                        <a href="{{ route('view.chat.Client', ['id' => $works->Supplier->id]) }}" class="portfolio-btn">
                                            <i class='bx bx-message-dots'style="margin-right: 8px;"></i> Contact me
                                        </a>
                                        <a href="{{ route('Order', ['id' => $works->id]) }}" class="portfolio-btn">
                                            <i class='bx bx-cart'style="margin-right: 8px;"></i> Buy Now
                                        </a>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <style>
                            .portfolio-btn-container {
                                text-align: center;
                                margin-top: 20px;
                                position: relative;
                                display: inline-block;
                            }
                            .toggle-menu {
                                display: none;
                                position: absolute;
                                top: 100%;
                                left: 50%;
                                transform: translateX(-50%);
                                background-color: white;
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                                padding: 10px;
                                border-radius: 8px;
                                z-index: 999;
                                min-width: 200px;
                                flex-direction: column;
                                gap: 10px;
                            }
                            .portfolio-btn {
                                display: block;
                                padding: 10px;
                                text-decoration: none;
                                border-radius: 6px;
                                text-align: left;
                                transition: background-color 0.3s ease;
                                background: white;
                                color: black;
                            }
                            .portfolio-btn:hover {
                                background:rgb(255, 255, 255);
                                
                            }
                        </style>
                        <script>
                            function toggleMenu() {
                                const menu = document.getElementById('toggleMenu');
                                menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
                            }
                            document.addEventListener('click', function(event) {
                                const menu = document.getElementById('toggleMenu');
                                const button = document.querySelector('.main-toggle-btn');
                                if (!menu.contains(event.target) && !button.contains(event.target)) {
                                    menu.style.display = 'none';
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="offers-description-wrapper" style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px;max-width: 1260px;width: 100%;padding: 20px;margin:auto;">
                <!-- Extra Offers Box -->
  
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








<div class="offers-description-wrapper" style="display: flex; gap: 25px; flex-wrap: wrap; margin-top: 20px; max-width: 1300px; width: 100%; padding: 25px; margin: auto;">
    
    <!-- Ratings Summary Box -->
    <div class="extra-offers-section discription detail" style="flex: 1; min-width: 320px; border-radius: 15px; padding: 20px; background: #ffffffb5;">
        <h1 style="color: #ee4962; margin-bottom: 20px; text-align:center; font-size:24px">
            <i class='bx bx-bar-chart-alt'></i> Ratings Summary
        </h1>

        @php
            $averages = [
                'quality' => $reviews->avg('quality'),
                'communication' => $reviews->avg('communication'),
                'timeliness' => $reviews->avg('timeliness'),
                'satisfaction' => $reviews->avg('satisfaction'),
            ];
            $fields = [
                'quality' => 'Work Quality',
                'communication' => 'Communication',
                'timeliness' => 'Timeliness',
                'satisfaction' => 'Satisfaction',
            ];
        @endphp

        @foreach($fields as $key => $label)
            <div style="margin-bottom: 20px;">
                <strong style="display: block; color: #333; font-size: 18px;">{{ $label }}</strong>
                <div style="display: flex; align-items: center; gap: 6px; margin-top: 5px;">
                    @for($i = 1; $i <= 5; $i++)
                        <i class='bx bxs-star' style="font-size: 20px; color: {{ $i <= round($averages[$key]) ? '#f5c518' : '#ccc' }}"></i>
                    @endfor
                    <span style="color: #1ab79d; font-weight: bold; font-size: 17px;">{{ number_format($averages[$key], 1) }}/5</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Comments Box -->
    <div class="discription detail" style="flex: 1; min-width: 320px; border-radius: 15px; padding: 20px; background: #ffffffb5;">
        <h1 style="color: #ee4962; margin-bottom: 20px; text-align:center; font-size:24px">
            <i class='bx bx-comment-detail'></i> Client Comments
        </h1>
        
        @foreach($reviews as $review)
            <div style="border-bottom: 1px solid #ddd; padding: 15px 0; display: flex; gap: 15px; align-items: flex-start;">
                <img src="{{ Storage::url($review->client->image) }}" alt="User" style="width: 60px; height: 60px; border-radius: 50%;">
                <div>
                    <p style="margin: 0; font-weight: bold; color: #1ab79d; font-size: 17px;">{{ $review->client->name }}</p>
                    <p style="margin: 5px 0; color: #333; font-size: 16px;">{{ $review->comment }}</p>
                </div>
            </div>
        @endforeach
    </div>

</div>










        </main>
    </section>
    @if(session('have_wallet'))
    <script>
        Notiflix.Notify.warning("{{ session('have_wallet') }}");
    </script>
    @endif
    <!-- CONTENT -->
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/InfoWork.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>