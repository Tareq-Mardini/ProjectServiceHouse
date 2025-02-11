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
                <a style="color: white; margin-left:15px; background-color:#007c92" class="home-page" href="{{route('Works.Create.Supplier')}}">Create Work <i class='bx bx-add-to-queue' style='color:#ffffff'></i> </a>
            </div>
        </nav>
        <!-- NAVBAR -->
        <!-- MAIN -->
        <main>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($works as $work)
                    <tr>
                        <td>{{ $work->title }}</td>

                        <td><img src="{{ Storage::url($work->thumbnail) }}" alt="Work Image" class="thumbnail-image"></td>
                        <td>{{ $work->price }}$</td>
                        <td>
                            <a href="{{ route('Supplier.Work.Info',$work->id) }}" style="margin-left: 5px;">
                                <button class="btn btn-secondary"><i class='bx bx-show' style='color:#ffffff'  ></i> View</button>
                            </a>
                            <form action="{{ route('Supplier.Edite.Myworks') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $work->id }}">
                                <button type="submit" class="btn btn-primary"><i class='bx bx-edit-alt'></i> Update</button>
                            </form>
                            <form action="{{ route('Supplier.Delete.Work', $work->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="margin-left: 5px;"><i class='bx bx-trash'></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </main>
        <!-- MAIN -->
    </section>
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/supplier-dashboard.js')}}"></script>
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
    @if(session('Success_Delete'))
    <script>
      Notiflix.Notify.success("{{ session('Success_Delete') }}");
    </script>
    @endif
</body>
</html>