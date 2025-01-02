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
    <link rel="stylesheet" href="{{asset('css/UpdatePortfolio.css')}}">
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
        @php
        $count = 0;
        $count2 = 0;
        $count3 = 0;
        $count4 = 0;
        @endphp
        <!-- NAVBAR -->
        <!-- MAIN -->
        <main>
            <div class="container">

                <form action="{{ route('Supplier.Update.Portfolio') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="about_me"><i class='bx bx-user-voice'></i> About Me</label>
                        <textarea name="about_me" id="about_me" placeholder="Write something about yourself..." required>{{ old('about_me', $portfolio->about_me) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="language"><i class='bx bx-globe'></i> Language</label>
                        <input type="text" name="language" id="language" placeholder="Enter a language (e.g., English, Spanish)" value="{{ old('language', $portfolio->language) }}" required />
                    </div>
                    <hr>
                    <!-- Skills Section -->
                    <div id="skills">
                        <div class="form-group">
                            <label for="Skills"><i class='bx bx-shape-circle'></i> Skills</label>
                        </div>
                        @foreach ($portfolio->skills as $index => $skill)
                        <div class="skill">
                            <label for="skills_title_{{ $index }}">Title</label>
                            <input type="text" name="skills_title[]" id="skills_title_{{ $index }}" value="{{ $skill->title }}" placeholder="Skill title (e.g., Web Development)" required />
                            <label for="skills_description_{{ $index }}">Description</label>
                            <textarea name="skills_description[]" id="skills_description_{{ $index }}" placeholder="Brief description of the skill" required>{{ $skill->description }}</textarea>
                        </div>
                        @php
                        $count = $count + 1;
                        @endphp
                        <h2>{{$count}}</h2>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Education Section -->
                    <div id="educations">
                        <div class="form-group">
                            <label for="Education"><i class='bx bx-book'></i> Education</label>
                        </div>
                        @foreach ($portfolio->educations as $index => $education)
                        <div class="education">
                            <label for="educations_date_{{ $index }}">Date</label>
                            <input type="date" name="educations_date[]" id="educations_date_{{ $index }}" value="{{ $education->date }}" required />
                            <label for="educations_description_{{ $index }}">Description</label>
                            <textarea name="educations_description[]" id="educations_description_{{ $index }}" placeholder="Describe your education" required>{{ $education->description }}</textarea>
                        </div>
                        @php
                        $count2 = $count2 + 1;
                        @endphp
                        <h2>{{$count2}}</h2>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Experience Section -->
                    <div id="experiences">
                        <div class="form-group">
                            <label for="Experience"><i class='bx bx-briefcase'></i> Experience</label>
                        </div>
                        @foreach ($portfolio->experiences as $index => $experience)
                        <div class="experience">
                            <label for="experiences_date_{{ $index }}">Date</label>
                            <input type="date" name="experiences_date[]" id="experiences_date_{{ $index }}" value="{{ $experience->date }}" required />
                            <label for="experiences_description_{{ $index }}">Description</label>
                            <textarea name="experiences_description[]" id="experiences_description_{{ $index }}" placeholder="Describe your experience" required>{{ $experience->description }}</textarea>
                        </div>
                        @php
                        $count3 = $count3 + 1;
                        @endphp
                        <h2>{{$count3}}</h2>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Gallery Section -->
                    <div id="galleries">
                        <div class="form-group">
                            <label style="color: #1ab79d; font-size: 20px;" for="Gallery"><i class='bx bx-photo-album'></i> Gallery</label>
                        </div>
                        @foreach ($portfolio->galleries as $index => $gallery)
                        <div class="gallery">
                            <label for="galleries_title_{{ $index }}">Title</label>
                            <input type="text" name="galleries[{{ $index }}][title]" id="galleries_title_{{ $index }}" value="{{ $gallery->title }}" placeholder="Gallery title" required />
                            <label for="galleries_platform_{{ $index }}">Platform</label>
                            <select name="galleries[{{ $index }}][platform]" id="galleries_platform_{{ $index }}" required>
                                <option value="GitHub" {{ $gallery->platform == 'GitHub' ? 'selected' : '' }}>GitHub</option>
                                <option value="Behance" {{ $gallery->platform == 'Behance' ? 'selected' : '' }}>Behance</option>
                                <option value="Dribbble" {{ $gallery->platform == 'Dribbble' ? 'selected' : '' }}>Dribbble</option>
                                <option value="LinkedIn" {{ $gallery->platform == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                                <option value="Instagram" {{ $gallery->platform == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="ArtStation" {{ $gallery->platform == 'ArtStation' ? 'selected' : '' }}>ArtStation</option>
                                <option value="Figma" {{ $gallery->platform == 'Figma' ? 'selected' : '' }}>Figma</option>
                                <option value="Sketchfab" {{ $gallery->platform == 'Sketchfab' ? 'selected' : '' }}>Sketchfab</option>
                                <option value="Pinterest" {{ $gallery->platform == 'Pinterest' ? 'selected' : '' }}>Pinterest</option>
                            </select>
                            <label for="galleries_link_{{ $index }}">Link</label>
                            <input type="url" name="galleries[{{ $index }}][link]" id="galleries_link_{{ $index }}" value="{{ $gallery->link }}" placeholder="Gallery link" required />
                            <label for="galleries_thumbnail_{{ $index }}">Thumbnail</label>
                            <input type="file" name="galleries[{{ $index }}][thumbnail]" id="galleries_thumbnail_{{ $index }}" accept="image/*" />
                            <button type="button" class="remove-item" style="display:none;" disabled>Delete ✖</button>
                        </div>
                        @php
                        $count4 = $count4 + 1;
                        @endphp
                        <h2>{{$count4}}</h2>
                        @endforeach
                    </div>
                    <hr>
                    <button type="submit" class="submit-button">Submit Changes</button>
                </form>
            </div>
        </main>
        <script src="{{asset('js/supplier-dashboard.js')}}"></script>
        <script src="{{asset('js/portfolio.js')}}"></script>
</body>

</html>