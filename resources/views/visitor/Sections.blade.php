<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{asset('css/visitor.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/visitor-sections.css')}}">
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
            <a href="#home" class="navbar-link" data-nav-link>Home</a>
          </li>
          <li class="navbar-item">
            <a href="#Benefit" class="navbar-link" data-nav-link>Benefits</a>
          </li>
          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-link>About</a>
          </li>
          <li class="navbar-item">
            <a href="#footer" class="navbar-link" data-nav-link>Contact</a>
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
        <a href="#" class="btn register-btn" id="openRegisterModal">
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
  <div class="container" style="margin-top: 160px;">
  <h2 class="h2 section-title"><span class="span">Sections </span></h2>
    <div class="Section">
      @foreach ($data as $section)
      <div class="content-section">
        <img src="{{ asset($section->image) }}" alt="" >
        <div class="text">
          <h3>{{$section->name}}</h3>
          <p>{{$section->description}}
          </p>
          <a href="{{ route('ViewServices', ['id' => $section->id]) }}" >
        <button>View Services</button>
      </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>
  <script src="{{asset('js/visitor.js')}}" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>