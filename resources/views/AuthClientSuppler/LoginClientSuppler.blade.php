<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/StyleLoginClientSuppler.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <title>Document</title>
</head>
<body>
  <img class="wave" src="{{asset('images/wave.png')}}">
<div class="container">
    <div class="img">
        <img src="{{asset('images/bg.svg')}}">
    </div>
    <div class="login-content">



    
        <form action="{{route('LoginClient')}}" method="post">
            @csrf
            <img src="{{asset('images/avatarr.svg')}}">
            <h3 style="margin: 9px 0px 9px 0px; color: #36cc9a;" class="title">Login Client</h3>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Email</h5>
                    <input type="email" class="input" name="email" id="email" required>
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Password</h5>
                    <input type="password" class="input" name="password" id="password" required>
                </div>
            </div>
            <a href="#">Forgot Password?</a>
            <button type="submit" class="btn">Login</button>
        </form>






        <form action="{{route('LoginSupplier')}}" method="put">
            
            <img src="{{asset('images/avatarr.svg')}}">
            <h3 style="margin: 9px 0px 9px 0px; color: #36cc9a;" class="title">Login Supplier</h3>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Email</h5>
                    <input type="email" class="input" name="email" id="email" required>
                </div>
            </div>
            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Password</h5>
                    <input type="password" class="input" name="password" id="password" required>
                </div>
            </div>
            <a href="#">Forgot Password?</a>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</div>
  <script type="text/javascript" src="{{asset('js/LoginClientSuppler.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/AllAwsame.js')}}"></script>
</body>
</html>

