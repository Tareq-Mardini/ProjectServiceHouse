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
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
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
                            <a href="{{route('ServiceHouse.Home.Supplier')}}" class="navbar-link" data-nav-link>Home</a>
                        </li>
                        <li class="navbar-item">
                            <a href="{{route('ServiceHouse.Home.Supplier')}}" class="navbar-link" data-nav-link>Benefits</a>
                        </li>
                        <li class="navbar-item">
                            <a href="{{route('ServiceHouse.Home.Supplier')}}" class="navbar-link" data-nav-link>About</a>
                        </li>
                        <li class="navbar-item">
                            <a href="{{route('ServiceHouse.Home.Supplier')}}" class="navbar-link" data-nav-link>Sections</a>
                        </li>
                        <li class="navbar-item">
                            <a href="{{route('ServiceHouse.Home.Supplier')}}" class="navbar-link" data-nav-link>Contact</a>
                        </li>
                        <li class="navbar-item">
                            <button class="option-btn" id="customerBtn">
                                <a href="{{route('ServiceHouse.Supplier.Dashboard')}}">Dashboard</a>
                                <i class='bx bxs-dashboard bx-spin'></i>
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
        <section style="margin-top: 170px;" id="content">
            <main>
                <h1  style="text-align: center; color:#ee4962"><i class="fas fa-sad-tear" style="color: gray; margin-right: 5px;"></i> He/she does not have a portfolio.</h1>
                <script src="{{asset('js/Loading.js')}}"></script>