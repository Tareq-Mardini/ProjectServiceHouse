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
</head>

<body>
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="logo">
      <img src="{{asset('images/visitor/logo-3.png')}}" width="150" height="100" alt="EduWeb logo" style="margin-left: 70px; margin-top:20px">
    </a>
    <ul style="margin-top:0px" class="side-menu top">
      <li class="active">
        <a href="#">
          <i class='bx bxs-dashboard'></i>
          <span class="text">My Profile</span>
        </a>
      </li>
      <li>
        <a href="{{route('Supplier.Show.Myworks')}}">
          <i class='bx bxs-shopping-bag-alt'></i>
          <span class="text">My works</span>
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
        <a href="#" class="logout">
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
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->
  <script src="{{asset('js/supplier-dashboard.js')}}"></script>

  <table class="table table-view-section">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Service</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Description</th>
                        <th scope="col">price</th>
                        <th scope="col">IMG</th>
                        <th scope="col">Attachment</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            <tbody class="table-group-divider">
            @foreach ($data as $datas)
                <tr>
                    <td>{{$datas->title}}</td>
                    <td>{{$datas->service->name}}</td>
                    <td>{{$datas->Supplier->id}}</td>
                    <td class="description">{{$datas->description}}</td>
                    <td class="description">{{$datas->price}}</td>
                    <td><img src="{{ asset($datas->attachment) }}" alt="" style="width: 120px; height: 80px;border-radius: 5px;"></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('#', $datas->id)}}" class="btn1 btn custom-btn-primary">Update</a>
                            <button type="button" class="btn-delete btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $datas->id }}">delete</button>
                            <div class="modal fade" id="exampleModal{{ $datas->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete </h5>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('#', $datas->id) }}">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="btn btn-yes custom-btn-primary">yes</button>
                                                <button type="button" class=" btn btn-secondary" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
</body>

</html>
