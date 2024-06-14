<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>@yield("title", "LOGIN")</title>
</head>
<body>
  @yield("content")

    <div class="judul"><h1>Dashboard Visual AI Pothole Detection</h1></div>

    <div class="logo">
    <!-- <img src="{{ asset('img/logojsmr.png') }}" alt="Login Image"> -->
    </div>
    <div class="container">
        <div class="login">
            <form method="POST" action="{{route('login.post')}}">
                @csrf
              <h2>Sign In</h2>
              <label for="Username"></label>
              <input type="text" name="username" class="form-control"placeholder="Username" required autofocus>
              <label for="Password"></label>
              <input type="password" name="password" class="form-control" placeholder="Password"> 
              <button type="submit" href="/dashboard">Sign In</button>
              
              <div class="forgot">
                <p>
                    <a href="{{ route('forget.password') }}">Forgot Password</a>  
                </p>
              </div>
              <div class="create">
                <p>
                <a href="{{ route('register') }}">Create an account</a>
                </p>
              </div>
            </form>
        </div>
        <div class="right">
        <img src="{{ asset('img/login.jpg') }}" alt="Login Image">
        </div>
    </div>

</body>
</html>