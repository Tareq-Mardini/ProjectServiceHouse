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
    <link rel="stylesheet" href="{{asset('css/ViewPortfolio.css')}}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/visitor-sections.css')}}">
    <link rel="stylesheet" href="{{asset('css/MyWorks.css')}}">
    <link rel="stylesheet" href="{{asset('css/portfolio.css')}}">
    <link rel="stylesheet" href="{{asset('css/MyPortfolio.css')}}">
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <title>Service House</title>
</head>

<body>

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
                                <a href="">Settings</a>
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
        <section style="margin-top: 80px;" id="content">
            <main>
                <section class="hero" id="hero">
                    <div style="margin-top: -177px;" class="hero-content">
                        <h1>Welcome to <span>My Portfolio</span></h1>
                        <p>Hello Im <span>{{$data->name}}</span></p>
                        <div class="profile-picture">
                            <img src="{{ Storage::url($data->image) }}" alt="Tareq Profile Picture">
                        </div>
                    </div>
                </section>

                <section id="about">
                    <div class="about-container">
                        <!-- القسم الأيسر: النص -->
                        <div class="about-left">
                            <h2 class="section-title">About Me</h2>
                            <p>
                                {{$portfolio->about_me}}
                            </p>
                        </div>

                        <!-- القسم الأيمن: الأزرار والمحتوى -->
                        <div class="about-right">
                            <!-- التبويبات -->
                            <div class="tabs">
                                <button class="tab-button active" data-tab="skills">Skills</button>
                                <button class="tab-button" data-tab="experience">Experience</button>
                                <button class="tab-button" data-tab="education">Education</button>
                                <button class="tab-button" data-tab="language">Languages</button>

                            </div>

                            <!-- محتوى التبويبات -->
                            <div class="tab-content">
                                <div id="skills" class="tab-pane active">
                                    <h3 class="section-title">Skills</h3>
                                    <ul class="styled-list">
                                        @foreach ($portfolio->skills as $data)
                                        <li>
                                            <i class="fas fa-tools icon"></i> <!-- أيقونة المهارات -->
                                            <strong class="item-title">{{$data->title}}:</strong>
                                            <span class="item-description">{{$data->description}}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div id="experience" class="tab-pane">
                                    <h3 class="section-title">Experience</h3>
                                    <ul class="styled-list">
                                        @foreach ($portfolio->Experiences as $data)
                                        <li>
                                            <i class="fas fa-briefcase icon"></i> <!-- أيقونة الخبرة -->
                                            <strong class="item-title">{{$data->date}}:</strong>
                                            <span class="item-description">{{$data->description}}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div id="education" class="tab-pane">
                                    <h3 class="section-title">Education</h3>
                                    <ul class="styled-list">
                                        @foreach ($portfolio->educations as $data)
                                        <li>
                                            <i class="fas fa-graduation-cap icon"></i> <!-- أيقونة التعليم -->
                                            <strong class="item-title">{{$data->date}}:</strong>
                                            <span class="item-description">{{$data->description}}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div id="language" class="tab-pane">
                                    <h3 class="section-title">Languages</h3>
                                    <p class="styled-paragraph">
                                        <i class="fas fa-globe icon"></i> <!-- أيقونة اللغات -->
                                        {{$portfolio->language}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="projects">
                    <h2 class="section-title">My Works</h2>
                    <div class="projects-container">
                        @foreach ($works as $data)
                        <div class="project-card">
                            <img src="{{ Storage::url($data->thumbnail) }}" alt="Project 1">
                            <h3>{{$data->title}}</h3>
                            <p style="font-weight: bold;">Price: <span style="font-weight: bold; color:green">{{$data->price}}<i class="fa fa-dollar-sign"></i></span></p>
                            <a href="{{ route('Works.info.Client', ['id' => $data->id]) }}" class="modern-button">Read more</a>
                        </div>
                        @endforeach
                    </div>
                </section>

                <section id="projects">
                    <h2 class="section-title">My Galleries</h2>
                    <div class="projects-container">
                        @foreach ($portfolio->galleries as $data)
                        <div class="project-card">
                            <div class="thumbnail-container">
                                <img src="{{ Storage::url($data->thumbnail) }}" alt="Project Thumbnail" class="project-thumbnail">
                            </div>
                            <div class="project-details">
                                <h3 class="project-title">{{$data->title}}</h3>
                                <p class="project-platform">
                                    Website:
                                    @if ($data->platform === 'GitHub')
                                    <i class="fab fa-github github-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Behance')
                                    <i class="fab fa-behance behance-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Dribbble')
                                    <i class="fab fa-dribbble dribbble-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'LinkedIn')
                                    <i class="fab fa-linkedin linkedin-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Instagram')
                                    <i class="fab fa-instagram instagram-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'ArtStation')
                                    <i class="fas fa-palette artstation-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Figma')
                                    <i class="fab fa-figma figma-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Sketchfab')
                                    <i class="fas fa-cube sketchfab-icon"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Pinterest')
                                    <i class="fab fa-pinterest pinterest-icon"></i> {{$data->platform}}
                                    @else
                                    <i class="fas fa-globe default-icon"></i> {{$data->platform}}
                                    @endif
                                </p>

                                <a href="{{$data->link}}" class="modern-button">Visit</a>
                            </div>
                        </div>
                    </div> @endforeach
                </section>
            </main>
        </section>
        <script src="{{asset('js/supplier-dashboard.js')}}"></script>
        <script src="{{asset('js/supplier-dashboard.js')}}"></script>
        <script src="{{asset('js/portfolio.js')}}"></script>
        <script src="{{asset('js/visitor.js')}}" defer></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </body>

</html>