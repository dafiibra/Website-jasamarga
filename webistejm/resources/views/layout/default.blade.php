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

    <div class="container">
        <div class="login">
            <form method="post" action="{{route("login.post")}}">
                @csrf
              <h2>Sign In</h2>
              <label for="Username"></label>
              <input type="text" name="text" class="form-control"placeholder="Username">
              <label for="Password"></label>
              <input type="password" name="password" class="form-control" placeholder="Password"> 
             
              <div class="check"><input type="checkbox"> <label>Remember me</label></div>
              <button>Sign In</button>
              
              <div class="forgot">
                <p>
                    <a href="">Forgot Password</a>
                </p>
              </div>
              <div class="create">
                <p>
                    <a href="">Create an account</a>
                </p>
              </div>
            </form>
        </div>

        <div class="right">
            <img src="login.jpg" alt="">
        </div>
    </div>

</body>
</html>