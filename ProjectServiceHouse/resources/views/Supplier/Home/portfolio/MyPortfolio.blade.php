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
    <link rel="stylesheet" href="{{asset('css/MyPortfolio.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <link rel="icon" href="{{asset('images/visitor/logo-3.png')}}" type="image/png">
    <title>Service House</title>
</head>

<body>

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
                <div>
                    <a style="color: white; background-color:#007c92" class="home-page" href="{{route('Supplier.Edit.Portfolio')}}">Update Portfolio <i class="fa fa-edit"></i></a>
                </div>
                <div>
                    <a style="color: white; background-color:red" class="home-page" href="javascript:void(0)" class="delete-button" id="openDeleteModal">Delete Portfolio <i class="fa fa-trash"></i></a>
                </div>
                <div id="deletePortfolioModal" class="modal">
                    <div class="modal-content">
                        <span class="close-modal">&times;</span>
                        <div style="color: red; font-size:18px" class="modal-header">
                            <i class='bx bx-error-alt bx-tada' style='color:red ;margin-right: 3px;'></i> Are you sure you want to delete this portfolio?
                        </div>
                        <div class="modal-body">
                            This action cannot be undone. Please confirm if you want to delete your portfolio.
                        </div>
                        <div class="modal-footer">
                            <button class="btn-secondary" id="cancelDeleteBtn">Cancel</button>
                            <a style="color: white;" href="{{ route('Supplier.Delete.Portfolio') }}" class="btn-danger">Yes, Delete</a>
                        </div>
                    </div>
                </div>
            </nav>
            <main>
                <section class="hero" id="hero">
                    <div class="hero-content">
                        <h1>Welcome to <span>My Portfolio</span></h1>
                        <p>Hello Im <span>{{$data->name}}</span></p>
                        <div class="profile-picture">
                            <img src="{{ Storage::url($data->image) }}" alt="Tareq Profile Picture">
                        </div>
                    </div>
                </section>
                <section id="about">
                    <div class="about-container">
                        <div class="about-left">
                            <h2 class="section-title">About Me</h2>
                            <p>
                                {{$portfolio->about_me}}
                            </p>
                        </div>
                        <div class="about-right">
                            <!-- التبويبات -->
                            <div class="tabs">
                                <button class="tab-button active" data-tab="skills">Skills</button>
                                <button class="tab-button" data-tab="experience">Experience</button>
                                <button class="tab-button" data-tab="education">Education</button>
                                <button class="tab-button" data-tab="language">Languages</button>
                            </div>
                            <div class="tab-content">
                                <div id="skills" class="tab-pane active">
                                    <h3 class="section-title">Skills</h3>
                                    <ul class="styled-list">
                                        @foreach ($portfolio->skills as $data)
                                        <li>
                                            <i class="fas fa-tools icon"></i>
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
                            <p style="font-weight: bold;">Price: <span style="font-weight: bold;">{{$data->price}}<i class="fa fa-dollar-sign"></i></span></p>
                            <a href="{{route('Supplier.Show.Myworks')}}" class="modern-button">Read more</a>
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
                                    <i class="fab fa-github"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Behance')
                                    <i class="fab fa-behance"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Dribbble')
                                    <i class="fab fa-dribbble"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'LinkedIn')
                                    <i class="fab fa-linkedin"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Instagram')
                                    <i class="fab fa-instagram"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'ArtStation')
                                    <i class="fas fa-palette"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Figma')
                                    <i class="fab fa-figma"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Sketchfab')
                                    <i class="fas fa-cube"></i> {{$data->platform}}
                                    @elseif ($data->platform === 'Pinterest')
                                    <i class="fab fa-pinterest"></i> {{$data->platform}}
                                    @else
                                    <i class="fas fa-globe"></i> {{$data->platform}}
                                    @endif
                                </p>
                                <a href="{{$data->link}}" class="modern-button">Visit</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                <script src="{{asset('js/supplier-dashboard.js')}}"></script>
            </main>
            <script src="{{asset('js/Loading.js')}}"></script>
            <script src="{{asset('js/supplier-dashboard.js')}}"></script>
            <script src="{{asset('js/portfolio.js')}}"></script>

            @if(session('Success_Create'))
            <script>
                Notiflix.Notify.success("{{ session('Success_Create') }}");
            </script>
            @endif
            @if(session('Success_Update'))
            <script>
                Notiflix.Notify.success("{{ session('Success_Update') }}");
            </script>
            @endif

    </body>

</html>