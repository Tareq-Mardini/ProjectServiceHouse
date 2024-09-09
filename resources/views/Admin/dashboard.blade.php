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
    <link rel="stylesheet" href="{{asset('css/toster.css')}}">
</head>
<body>
    <l1>test</l1>
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
        </div>
    </div>
    <script src="{{asset('js/jqure.js')}}"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/toster.js')}}"></script>

    @if(session('success_login'))
        <script>
            success_login();
        </script>
    @endif
</body>
</html>