<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>'LoginClient'
    <form action="{{route('LoginClient')}}" method="post">
        @csrf
        <label for="email"  >email</label>
        <input type="email" name="email" id="email" required>
        <label for="password">password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>