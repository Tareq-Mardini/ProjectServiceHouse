<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/SupplierAccount.css')}}">
  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <!-- My CSS -->
  <link rel="stylesheet" href="{{asset('css/supplier-dashboard.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    @include('Client.Settings.sidebar')

  </section>
  <!-- SIDEBAR -->
  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <div>
        <a style="color: white;" class="home-page" href="{{route('ServiceHouse.Home.Client')}}">Home Page <i class='bx bx-right-arrow-alt'></i> </a>
      </div>


      <div>
        <!-- الزر الذي يظهر الـ Modal -->
        <div>
          <a
            style="color: white; background-color: red; padding: 10px 10px; border-radius: 5px; text-decoration: none; display: inline-block;"
            class="home-page"
            href="javascript:void(0)"
            id="deleteAccountBtn">
            Delete Account <i class="fa fa-trash"></i>
          </a>
        </div>

        <!-- Modal -->
        <div id="deleteAccountModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <div style="color: red ;  font-size:18px" class="modal-header"><i class='bx bx-error-alt bx-tada' style='color:red ;margin-right: 3px;'></i>
              Are you sure you want to delete your account?</div>
            <div style="margin-top: 10px;" class="modal-body">
              <p>This action cannot be undone. Please enter your password to confirm.</p>

              <!-- نموذج الحذف -->
              <form action="{{ route('Client.Delete.Account') }}" method="POST">
                @csrf
                <input style="width: 100%;" type="password" name="current_password" id="current_password" placeholder="Enter your password" required>
            </div>
            <div class="modal-footer">
              <button class="btn-danger" type="submit">Confirm Delete</button>
              <button class="btn-secondary" id="cancelBtn" type="button">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
    </nav>
    <!-- NAVBAR -->
    <!-- MAIN -->
    <main style="padding-top: 15px;">
      <div class="card">
        <div class="card-header">
          <img src="{{ Storage::url($Client->image) }}" alt="Client Image">
          <br><br><br><br><br>
        </div>
        <div class="card-body">
          <div class="info-item">
            <i class="fa fa-user"></i>
            <div class="info-text"><span>Name:</span> {{$Client->name}}</div>
          </div>
          <div class="info-item">
            <i class="fa fa-envelope"></i>
            <div class="info-text"><span>Email:</span> {{$Client->email}}</div>
          </div>
          <div class="info-item">
            <i class="fa fa-phone"></i>
            <div class="info-text"><span>Phone:</span> {{$Client->phone_number}}</div>
          </div>
          <div class="info-item">
            <i class="fa fa-map-marker-alt"></i>
            <div class="info-text"><span>Address:</span> {{$Client->address}} </div>
          </div>
          <div class="info-item">
            <i class="fa fa-venus-mars"></i>
            <div class="info-text"><span>Gender:</span> {{$Client->gender}} </div>
          </div>
          <div class="info-item">
            <i class="fa fa-calendar"></i>
            <div class="info-text"><span>Date of Birth:</span> {{ \Carbon\Carbon::parse($Client->date_of_birth)->format('Y-m-d') }}</div>
          </div>
        </div>
        <div class="card-footer">
          <button class="update-btn"><a href="{{route('Client.Update.Account')}}" style="color: white;">Update Account</a></button>
        </div>
      </div>
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
  <script src="{{asset('js/Loading.js')}}"></script>
  <script src="{{asset('js/SupplierAccount.js')}}"></script>
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>
  @if(session('Success_Update'))
  <script>
    Notiflix.Notify.success("{{ session('Success_Update') }}");
  </script>
  @endif
  @if(session('wrong_delete_wallet'))
  <script>
    Notiflix.Notify.warning("{{ session('wrong_delete_wallet') }}");
  </script>
  @endif
  @if(session('wrong_delete_order'))
  <script>
    Notiflix.Notify.warning("{{ session('wrong_delete_order') }}");
  </script>
  @endif
</body>

</html>