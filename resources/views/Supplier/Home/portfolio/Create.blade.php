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
    <link rel="stylesheet" href="{{asset('css/CreateWork.css')}}">
  <link rel="stylesheet" href="{{asset('css/MyWorks.css')}}">
  <link rel="stylesheet" href="{{asset('css/portfolio.css')}}">
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
      <form action="{{ route('Supplier.Store.Portfolio') }}" method="POST" enctype="multipart/form-data" id="portfolio-form">
        @csrf
        <div id="educationss" class="form-section">
          <h5><i class='bx bx-user-voice'></i> About Me</h5>
        </div>
        <!-- Portfolio Details -->
        <div class="form-group">
          <textarea name="about_me" id="about_me" placeholder="Write something about yourself..." required>{{ old('about_me') }}</textarea>
          @error('about_me')
          <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
        <div id="educationss" class="form-section">
          <h5><i class='bx bx-globe'></i> Language</h5>
        </div>
        <div class="form-group">
          <input type="text" name="language" id="language" placeholder="Enter a language (e.g., English, Spanish)" value="{{ old('language') }}" required />
          @error('language')
          <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
        <hr>
        <!-- Skills -->
        <div id="skills" class="form-section">
          <h5><i class='bx bx-shape-circle'></i> Skills</h5>
          <div class="skill">
            <label for="skills_title_1">Title</label>
            <input type="text" name="skills_title[]" id="skills_title_1" placeholder="Skill title (e.g., Web Development)" value="{{ old('skills_title.0') }}" />
            @error('skills_title.*')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="skills_description_1">Description</label>
            <textarea name="skills_description[]" id="skills_description_1" placeholder="Brief description of the skill">{{ old('skills_description.0') }}</textarea>
            @error('skills_description.*')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <button type="button" class="add-button" id="add-skill"><i class='bx bx-add-to-queue'></i> Add More Skill</button>
        <hr>
        <!-- Experiences -->
        <div id="experiences" class="form-section">
          <h5><i class='bx bx-briefcase'></i> Experiences</h5>
          <div class="experience">
            <label for="experiences_date_1">Date</label>
            <input type="date" name="experiences_date[]" id="experiences_date_1" value="{{ old('experiences_date.0') }}" />
            @error('experiences_date.*')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="experiences_description_1">Description</label>
            <textarea name="experiences_description[]" id="experiences_description_1" placeholder="Describe your experience">{{ old('experiences_description.0') }}</textarea>
            @error('experiences_description.*')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <button type="button" class="add-button" id="add-experience"><i class='bx bx-add-to-queue'></i> Add More Experience</button>
        <hr>
        <!-- Educations -->
        <div id="educations" class="form-section">
          <h5><i class='bx bx-book'></i> Educations</h5>
          <div class="education">
            <label for="educations_date_1">Date</label>
            <input type="date" name="educations_date[]" id="educations_date_1" value="{{ old('educations_date.0') }}" />
            @error('educations_date.*')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="educations_description_1">Description</label>
            <textarea name="educations_description[]" id="educations_description_1" placeholder="Describe your education">{{ old('educations_description.0') }}</textarea>
            @error('educations_description.*')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <button type="button" class="add-button" id="add-education"><i class='bx bx-add-to-queue'></i> Add More Education</button>
        <hr>
        <!-- Portfolio Gallery -->
        <div id="galleries" class="form-section">
          <h5><i class='bx bx-photo-album'></i> Galleries</h5>
          <div class="gallery">
            <label for="galleries_title_1">Title</label>
            <input type="text" name="galleries[0][title]" id="galleries_title_1" value="{{ old('galleries.0.title') }}" placeholder="Gallery title" />
            @error('galleries.*.title')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="galleries_platform_1">Platform</label>
            <div class="form-group">
              <select name="galleries[0][platform]" id="galleries_platform_1">
                <option value="" disabled selected>Select Platform</option>
                <option value="GitHub" {{ old('galleries.0.platform') == 'GitHub' ? 'selected' : '' }}>GitHub</option>
                <option value="Behance" {{ old('galleries.0.platform') == 'Behance' ? 'selected' : '' }}>Behance</option>
                <option value="Dribbble" {{ old('galleries.0.platform') == 'Dribbble' ? 'selected' : '' }}>Dribbble</option>
                <option value="LinkedIn" {{ old('galleries.0.platform') == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                <option value="Instagram" {{ old('galleries.0.platform') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                <option value="ArtStation" {{ old('galleries.0.platform') == 'ArtStation' ? 'selected' : '' }}>ArtStation</option>
                <option value="Figma" {{ old('galleries.0.platform') == 'Figma' ? 'selected' : '' }}>Figma</option>
                <option value="Sketchfab" {{ old('galleries.0.platform') == 'Sketchfab' ? 'selected' : '' }}>Sketchfab</option>
                <option value="Pinterest" {{ old('galleries.0.platform') == 'Pinterest' ? 'selected' : '' }}>Pinterest</option>
              </select>
              @error('galleries.*.platform')
              <span class="error-message">{{ $message }}</span>
              @enderror
            </div>
            <label for="galleries_link_1">Link</label>
            <input type="url" name="galleries[0][link]" id="galleries_link_1" value="{{ old('galleries.0.link') }}" placeholder="Gallery link" />
            @error('galleries.*.link')
            <span class="error-message">{{ $message }}</span>
            @enderror
            <label for="galleries_thumbnail_1">Thumbnail</label>
            <input type="file" name="galleries[0][thumbnail]" id="galleries_thumbnail_1" accept="image/*" />
            @error('galleries.*.thumbnail')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <button type="button" class="add-button" id="add-gallery"><i class='bx bx-add-to-queue'></i> Add More Gallery</button>
        <hr>
        <!-- Submit -->
        <button type="submit" class="submit-button">Submit</button>
      </form>
    </main>
    <div class="modal-overlay" id="modal-overlay">
      <div class="modal">
        <div class="modal-header">
          <div style="color: #1ab79d;" class="modal-title"> <i class='bx bx-error-alt bx-tada' style='color:#1ab79d ;margin-right: 8px;'></i>Form Entry Instructions</div>
          <span class="modal-close" onclick="closeModal()">×</span>
        </div>
        <div class="modal-content">
          <p><span>1-</span> Enter information about yourself that does not exceed three lines.</p>
          <p><span>2-</span> Enter the languages ​​you are proficient in and speak.</p>
          <p><span>3-</span> Enter the skills you know, such as programming languages ​​or any skill you have. This field is optional.</p>
          <p><span>4-</span> Enter the experience that you have, enter the date it was obtained and what it is.</p>
          <p><span>5-</span> Enter the academic certificates you obtained, whether baccalaureate, university, etc.</p>
          <p><span>6-</span> Enter the business exhibition information, including the name, platform link, and thumbnail of the exhibition.</p>
        </div>
        <div class="modal-footer">
          <button class="modal-button" onclick="closeModal()">Close</button>
        </div>
      </div>
    </div>
    <script>
      window.onload = function() {
        setTimeout(function() {
          document.getElementById('modal-overlay').classList.add('show');
        }, 1000);
      };

      function closeModal() {
        document.getElementById('modal-overlay').classList.remove('show');
      }
    </script>
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
    <script src="{{asset('js/portfolio.js')}}"></script>
</body>

</html>