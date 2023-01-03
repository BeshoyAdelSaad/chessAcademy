<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

    <h1>{{ $token ?? 'You aren\'t login' }}</h1>

<div>
    <h1>Login</h1>
<form action="{{ route('authenticate') }}" method="POST">
    @csrf
Enter your email: <input type="text" name="email" value="{{ old('email') }}">
Enter your password: <input type="password" name="password">
<input type="submit" value="Login">
</form>
</div>

<div>
    <h1>Logout</h1>
<form action="{{ route('userLogout') }}" method="POST">
    @csrf
Enter your email: <input type="text" name="email" value="{{ old('name') }}">
Enter your password: <input type="password" name="password">
Enter your token: <input type="text" name="token">
<input type="submit" value="Logout">
</form>
</div>

<div>
    <h1>Register</h1>
<form action="{{ route('userRegister', ) }}" method="POST">
    @csrf
Enter your name: <input type="text" name="name" value="">
Enter your email: <input type="text" name="email" value="">
Enter your password: <input type="password" name="password">
<input type="submit" value="Register">
</form>
</div>

<div>
    <h1>Play</h1>
    <form action="{{ route( 'playwithfriend') }}" method="POST">
@csrf

        Color: <select name="color" id="color">
            <option value="white">White</option>
            <option value="black">Black</option>
        </select>

        Play With What: <select name="play_with" id="play_with">
            <option value="computer">Computer</option>
            <option value="mySelf">My Self</option>
            <option value="friend">Friend</option>
            <option value="online">Online</option>
        </select>

        Time: <select name="time" id="time">
            <option value="1 Minute">1 Minute</option>
            <option value="3 Minutes">3 Minute</option>
            <option value="5 Minutes">5 Minute</option>
            <option value="10 Minutes">10 Minute</option>
            <option value="30 Minutes">30 Minute</option>
            <option value="90 Minutes">90 Minute</option>
        </select>


       Level: <select name="level" id="level" style="display: none">
            <option value="easy">Easy</option>
            <option value="moderate">Moderate</option>
            <option value="difficult">Difficult</option>
            <option value="master">Master</option>
        </select>
        Token <input type="text" name="token" value="{{ $token ?? "" }}">

        <input type="submit" value="Play With friend"/>
    </form>
</div>

@if (isset($url))
<div>

    <form action="{{ route('gameroom') }}" method="post">
            @csrf

            <input type="text" name="id" value="{{ $id }}">
            <input type="text" name="token" value="{{ $token }}">
            <input type="submit" value="Go to play">

    </form>

        <h1>{{ route('gameroom', $id) }}</h1>
</div>
@endif
</body>
</html>
