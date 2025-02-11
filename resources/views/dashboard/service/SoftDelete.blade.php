<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard </title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/toster.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
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
                    <a href="{{ route('admin.setting')}}">
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
            <table class="table table-view-section">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($services as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td class="description">{{$data->description}}</td>
                            <td><img src="{{ asset($data->image) }}" alt="" style="width: 120px; height: 80px;border-radius: 5px;"></td>
                            <td><a style="margin-left: 0; margin-right:0;" href="{{ route('admin.service.Archive.Restore', $data->id) }}" class="btn1 btn custom-btn-primary">Restore</a>
                                <a style="background-color: red; margin-left: 0; margin-right:0;" href="{{ route('admin.service.Archive.ForceDelete', $data->id) }}" class="btn1 btn custom-btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{asset('js/Loading.js')}}"></script>
    <script src="{{asset('js/jqure.js')}}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('js/toster.js')}}"></script>

    @if(session('success_delete_service'))
        <script>
            show_delete_service();
        </script>
    @endif

    @if(session('fail_restore_service'))
        <script>
            show_fail_restore_service();
        </script>
    @endif

    @if(session('success_restore_service'))
        <script>
            show_restore_service();
        </script>
    @endif
</body>
</html>