<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard </title>
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.setting.css')}}">
    <link rel="stylesheet" href="{{asset('css/toster.css')}}">
</head>
<body>
    <div class="containerr">
        <div class="navigation">
            <ul>
                <li>
                    <a href="Dashboard.html">
                        <span class="icon">
                            <img class="Logo-website" src="{{asset('images/Capturee-removebg-preview (1).png')}}" alt="">
                        </span>
                        
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Mange Client</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Mange Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers services</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('section.index')}}">
                        <span class="icon">
                            <ion-icon name="copy-outline"></ion-icon>
                        </span>
                        <span class="title">Sections</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.view.service')}}">
                        <span class="icon">
                            <ion-icon name="construct-outline"></ion-icon>
                        </span>
                        <span class="title">Services</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('adminlogout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('adminlogout') }}" method="get" style="display: none;">
                    @csrf
                    </form>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
            <div>
                <div class="form">
                    <div class="avatar"><img src="{{asset('images/avatar.png')}}" alt=""></div>
                    <div class="content-box">
                        <div class="box-account" style="display: flex; align-items: center;">
                            <ion-icon name="mail-outline" style="margin-right: 10px;"></ion-icon>
                            <h4 style="margin-right: auto;">Email: {{ $data->email }}</h4>
                        </div>
                        <div class="box-account" style="display: flex; align-items: center;">
                        <ion-icon name="person-outline" style="margin-right: 10px;"></ion-icon>
                            <h4 style="margin-right: auto;">Name: {{ $data->name }}</h4>
                        </div>
                        <div class="box-account" style="display: flex; align-items: center;">
                            <ion-icon name="call-outline" style="margin-right: 10px;"></ion-icon>
                            <h4 style="margin-right: auto;">phone Number: {{ $data->ph_number }}</h4>
                        </div>
                        <button type="button" class="btn-edit btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Update account
                        </button>
                    </div>
                </div>
                    <div class="modal fade form-2" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title label-edit" id="exampleModalLongTitle">update account</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('admin.edit.account') }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label " >Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                                <div class="mb-3">
                                    <label for="description" class="form-label ll">Email</label>
                                    <input type="text" class="form-control" id="name" name="email"value="{{ $data->email }}" rows="5" required ></input>
                                </div>
                                <div class="mb-3">
                                    <label  for="description" class="form-label ll">Phone Number</label>
                                    <input type="text" class="form-control" id="name" name="ph_number"value="{{ $data->ph_number }}" rows="5" required ></input>
                                </div>
                                <div class="mb-3">
                                    <label  for="description" class="form-label ll">password new</label>
                                    <input type="text" class="form-control" id="name" name="password"value="" rows="5" placeholder="*********************" ></input>
                                </div>
                                <div class="mb-3">
                                    <label  for="description" class="form-label ll">password old To continue</label>
                                    <input type="text" class="form-control" id="name" name="current" value="" rows="5" required ></input>
                                </div>
                                <button type="submit" class="btn1 btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jqure.js')}}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('js/toster.js')}}"></script>
    
    @if(session('success_update_account'))
        <script>
            show_update_account();
        </script>
    @endif

    @if(session('failed'))
        <script>
            fail_update_account();
        </script>
    @endif

</html>