<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LoginAdmin</title>
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('css/styleLogin.css')}}">
</head>
  <body>
    <div class="login-box">
      <img src="{{asset('images/avatar.png')}}" class="avatar">
      <h1>Login Admin</h1>
        <form method="POST"  action="{{route('admin.check')}}" >
            @csrf
          <p>Email</p>
          <input type="text" name="email" placeholder="Enter Email" required>
          <p>Password</p>
          <input type="password" name="password" placeholder="Enter Password"required>
          <input type="submit" name="submit" value="Login">
          @if($errors->any())
            <div style="color: red;" class="alert alert-danger aler">
              {{ $errors->first('loginError') }}
            </div>
          @endif
        </form>
      </div>
    </body>
</html>