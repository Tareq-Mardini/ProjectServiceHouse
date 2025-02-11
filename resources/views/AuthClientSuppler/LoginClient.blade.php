<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/StyleLoginClientSuppler.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
    <title>Document</title>
</head>
<body>
  <img class="wave" src="{{asset('images/wave.png')}}">
<div class="container">
    <div class="img">
        <img src="{{asset('images/cli1.svg')}}">
    </div>
    <div class="login-content">
        <form action="{{ route('LoginClient') }}" method="post">
            @csrf
            <img src="{{ asset('images/avatarr.svg') }}">
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
            @if($errors->has('email'))
                <span style="color: red; font-size:13px;">
                    {{ $errors->first('email') }}
                </span>
            @endif
            @if($errors->has('password'))
                <span style="color: red; font-size:13px">
                    {{ $errors->first('password') }}
                </span>
            @endif
            <a href="{{ route('register.client') }}">Create Account ?</a>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</div>
<script src="{{asset('js/Loading.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/LoginClientSuppler.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/AllAwsame.js')}}"></script>
</body>
</html>

