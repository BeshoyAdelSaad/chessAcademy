<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div>

        <h1>Login</h1>

    <form action="{{ route('authenticate') }}" method="POST">
        @csrf

    Enter your email: <input type="text" name="email" value="{{ old('email') }}">
    Enter your password: <input type="password" name="password">

    <input type="submit" value="Login">
    </form>

    </div>

</body>
</html>
