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
    <title>Service House</title>
</head>

<body>
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
                        <a href="{{route('ServiceHouse')}}" class="navbar-link" data-nav-link>Home</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse')}}" class="navbar-link" data-nav-link>Benefits</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse')}}" class="navbar-link" data-nav-link>About</a>
                    </li>
                    <li class="navbar-item">
                        <a href="{{route('ServiceHouse')}}" class="navbar-link" data-nav-link>Contact</a>
                    </li>
                </ul>
            </nav>
            <div class="header-actions">
                <a href="#" class="btn has-before" id="loginBtn">
                    <span class="span">Login</span>
                    <ion-icon name="log-in-outline" aria-hidden="true" style="height: 32px; width:22px"></ion-icon>
                </a>
                <div id="loginModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h3>Choose The Account Type</h3>
                        <button class="option-btn" id="customerBtn"><a href="{{route('AuthLogin')}}">Client</a></button>
                        <button class="option-btn" id="serviceProviderBtn"><a href="{{route('AuthLoginn')}}">Supplier</a></button>
                    </div>
                </div>
                <a style="margin-left: -10px;" href="#" class="btn register-btn" id="openRegisterModal">
                    <span class="span">Register</span>
                    <ion-icon name="create-outline" aria-hidden="true" style="height: 32px; width:22px"></ion-icon>
                </a>
                <div id="registerModalWindow" class="modal-window">
                    <div class="modal-content-register">
                        <span class="close-register">&times;</span>
                        <h3>Choose The Account Type</h3>
                        <button class="register-option-btn" id="registerCustomerOption"><a href="{{route('register.client')}}">Client</a></button>
                        <button class="register-option-btn" id="registerServiceProviderOption"><a href="{{route('register.Supplier')}}">Supplier</a></button>
                    </div>
                </div>
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
                        <div class="detail">
                            <span class="label"><i class="fa fa-user" style="margin-right: 5px; color: #6c757d;"></i> Supplier</span>
                            <span class="value">{{ $works->Supplier->name }}</span>
                        </div>
                        <div class="portfolio-btn-container" style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('view.portfolio.visitor', ['id' => $works->Supplier->id]) }}"
                                class="portfolio-btn">
                                <i class="fa fa-folder-open" aria-hidden="true" style="margin-right: 8px;"></i> View Portfolio
                            </a>
                        </div>


                    </div>

                </div>
                <div class="discription detail">
                    <span class="label">
                        <h2 style="font-size: 19px;">Discription</h2>
                    </span>
                    <p style="font-size: 19px;">{!! nl2br(e($works->description)) !!}
                    </p>
                </div>
            </div>

        </main>
    </section>
    <!-- CONTENT -->
    <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
        <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>
    <script src="{{asset('js/visitor.js')}}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/InfoWork.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
</body>

</html>