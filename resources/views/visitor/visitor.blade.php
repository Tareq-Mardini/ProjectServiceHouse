<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">



  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="{{asset('css/visitor.css')}}">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-bg.svg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-shape-1.svg">
  <link rel="preload" as="image" href="./assets/images/hero-shape-2.png">

</head>

<body id="top">
  <!-- 
    - #HEADER
  -->
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
            <a href="#about" class="navbar-link" data-nav-link>Benefits</a>
          </li>
          <li class="navbar-item">
            <a href="#courses" class="navbar-link" data-nav-link>About</a>
          </li>
          <li class="navbar-item">
            <a href="#blog" class="navbar-link" data-nav-link>Sections</a>
          </li>
          <li class="navbar-item">
            <a href="#" class="navbar-link" data-nav-link>Contact</a>
          </li>
        </ul>
      </nav>
      <div class="header-actions">
        <a href="#" class="btn has-before">
          <span class="span">Login</span>
          <ion-icon name="log-in-outline" aria-hidden="true" style="height: 32px; width:22px"></ion-icon>
        </a>

        <a href="#" class="btn has-before" >
          <span class="span">Register</span>
          <ion-icon name="create-outline" aria-hidden="true" style="height: 32px; width:22px"></ion-icon>
        </a>
        <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
          <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
        </button>
      </div>
      <div class="overlay" data-nav-toggler data-overlay></div>
    </div>
  </header>
  <main>
    <article>
      <section class="section hero has-bg-image" id="home" aria-label="home"
        style="background-image: url('./assets/images/hero-bg.svg')">
        <div class="container">
          <div class="hero-content">
            <h1 class="h1 section-title">
              Platform to Join for <span class="span">Freelancers</span>
            </h1>
            <p class="hero-text">
              Freelancing Empowering your passion, driving your success.
            </p>
            <a href="#" class="btn has-before">
              <span class="span">Read More</span>
              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>
          </div>
          <figure class="hero-banner">
            <div class="img-holder one" style="--width: 270; --height: 300;">
              <img src="./assets/images/hero-banner-3.webp" width="270" height="300" alt="hero banner" class="img-cover">
            </div>
            <div class="img-holder two" style="--width: 240; --height: 370;">
              <img src="./assets/images/hero-banner-4.jpg" width="240" height="370" alt="hero banner" class="img-cover">
            </div>
            <img src="./assets/images/hero-shape-2.png" width="622" height="551" alt="" class="shape hero-shape-2">
          </figure>
        </div>
      </section>
      <section class="section category" aria-label="category">
        <div class="container">
          <p class="section-subtitle">Benefits</p>
          <h2 style="margin-bottom: 25px;" class="h2 section-title">
            Unlimited <span class="span">Earning</span> Potential with Global Clients.
          </h2>
          <ul class="grid-list">
            <li>
              <div class="category-card" style="--color: 170, 75%, 41%">
                <div class="card-icon">
                  <img src="./assets/images/category-1.svg" width="40" height="40" loading="lazy"
                    alt="Online Degree Programs" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Skill Development</a>
                </h3>
                <p class="card-text">
                  Continuously improve and expand your skillset with diverse challenges.
                </p>
              </div>
            </li>
            <li>
              <div class="category-card" style="--color: 351, 83%, 61%">
                <div class="card-icon">
                  <img src="./assets/images/category-2.svg" width="40" height="40" loading="lazy"
                    alt="Non-Degree Programs" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Creative Freedom</a>
                </h3>
                <p class="card-text">
                  Choose projects that align with your interests and passions.
                </p>
              </div>
            </li>
            <li>
              <div class="category-card" style="--color: 229, 75%, 58%">
                <div class="card-icon">
                  <img src="./assets/images/category-3.svg" width="40" height="40" loading="lazy"
                    alt="Off-Campus Programs" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Diverse Projects</a>
                </h3>
                <p class="card-text">
                  Work on a variety of projects across different industries.
                </p>
              </div>
            </li>
            <li>
              <div class="category-card" style="--color: 42, 94%, 55%">
                <div class="card-icon">
                  <img src="./assets/images/category-5.png" width="40" height="40" loading="lazy"
                    alt="Hybrid Distance Programs" class="img">
                </div>
                <h3 class="h3">
                  <a href="#" class="card-title">Independence</a>
                </h3>
                <p class="card-text">
                  Be your own boss and make decisions that suit your style.
                </p>
              </div>
            </li>
          </ul>
        </div>
      </section>
      <section class="section about" id="about" aria-label="about">
        <div class="container">
          <figure class="about-banner">
            <div class="img-holder" style="--width: 520; --height: 370;">
              <img src="./assets/images/about-banner33.jpg" width="520" height="370" loading="lazy" alt="about banner"
                class="img-cover">
            </div>
            <img src="./assets/images/about-shape-3.png" width="722" height="528" loading="lazy" alt=""
              class="shape about-shape-3">
          </figure>
          <div class="about-content">
            <p class="section-subtitle">About Us</p>
            <h2 class="h2 section-title">
              Fifth year <span class="span">students</span> at the College of Informatics
            </h2>
            <p class="section-text">
              Students from the Syrian Private University prepared this website as our graduation project
            </p>
            <ul class="about-list">
              <li class="about-item">
<<<<<<< HEAD
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
=======
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon
>>>>>>> 70cc37ff999927d17c4b9f0cf95447df44ea9be6
                <span class="span">Connect Freelancers with High-Quality Clients</span>
              </li>
              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                <span class="span">Streamline Project Management and Communication</span>
              </li>
              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>
                <span class="span">Support Skill Development and Growth</span>
              </li>
            </ul>
          </div>
        </div>
      </section>
      <section class="section blog has-bg-image" id="blog" aria-label="blog"
        style="background-image: url('./assets/images/blog-bg.svg')">
        <div class="container">
          <p class="section-subtitle">Sections</p>
          <h2 class="h2 section-title">The most <span class="span">important </span> sections on the site</h2>
          <ul class="grid-list">
            <li>
              <div class="blog-card">
                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                  <img src="./assets/images/blog-4.jpg" width="370" height="370" loading="lazy"
                    alt="Become A Better Blogger: Content Planning" class="img-cover">
                </figure>
                <div class="card-content">
                  <h3 class="h3">
                    <a style="text-align: center;" href="#" class="card-title">Programming and development</a>
                  </h3>
                  <p class="card-text">
                    Services such as website development
                  </p>
                </div>
              </div>
            </li>
            <li>
              <div class="blog-card">
                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                  <img src="./assets/images/blog-5.jpg" width="370" height="370" loading="lazy"
                    alt="Become A Better Blogger: Content Planning" class="img-cover">
                </figure>
                <div class="card-content">
                  <h3 class="h3">
                    <a style="text-align: center;" href="#" class="card-title">Design</a>
                  </h3>
                  <p class="card-text">
                    Services such as logo design and advertising banner design
                  </p>
                </div>
              </div>
            </li>
            <li>
              <div class="blog-card">
                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                  <img src="./assets/images/blog-6.jpg" width="370" height="370" loading="lazy"
                    alt="Become A Better Blogger: Content Planning" class="img-cover">
                </figure>
                <div class="card-content">
                  <h3 class="h3">
                    <a style="text-align: center;" href="#" class="card-title">Writing</a>
                  </h3>
                  <p class="card-text">
                    Services such as translation and writing a CV
                  </p>
                </div>
              </div>
            </li>
          </ul>
          <img src="./assets/images/blog-shape.png" width="186" height="186" loading="lazy" alt=""
            class="shape blog-shape">
          <div>
            <a style="margin: auto; margin-top:20px" href="#" class="btn has-before"><span class="span">More Sections</span>
              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon></a>
          </div>
        </div>
      </section>
    </article>
  </main>
  <footer class="footer" style="background-image: url('./assets/images/footer-bg.png');  ">
    <div class="container">
      <div style="padding: 30px;" class="footer-top section">
        <div style="margin: auto;" class="footer-brand">
          <a href="#" class="logo">
            <img style="margin: auto;" src="images/visitor/logo-2.png" width="162" height="50" alt="EduWeb logo">
          </a>
          <p class="footer-brand-text">
          <h2>Some details available for contact.</h2>
          </p>
          <div class="wrapper">
            <span class="span">Add:</span>
            <address class="address">Syria Damascus & Suwayda </address>
          </div>
          <div class="wrapper">
            <span class="span">Call:</span>
            <a href="tel:+011234567890" class="footer-link">+963997090496</a>
          </div>
          <div class="wrapper">
            <span class="span">Email:</span>
            <a href="mailto:info@eduweb.com" class="footer-link">tareqmardini25@gmail.com</a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <p class="copyright">
            Created By <a href="#" class="copyright-link">Tareq Mardini & Haneen Mezher</a>
          </p>
        </div>
      </div>
  </footer>
  <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>
  <script src="{{asset('js/visitor.js')}}" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>