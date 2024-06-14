<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/forgetpass.css') }}">
    <title>@yield("title", "forget password")</title>
</head>
<body>
  
    <div class="judul"><h1>Dashboard Visual AI Pothole Detection</h1></div>

    <div class="logo">
    <!-- <img src="{{ asset('/logojsmr.png') }}" alt="Login Image"> -->
    </div>
    <div class="container">
        <div class="forget">
            <form method="POST" action="{{route('forget.password.post')}}">
                @csrf
              <h2>Forget Password</h2>
              <label for="email"></label>
              <input type="text" name="email" class="form-control"placeholder="Email" required autofocus>
              <button>Send an Email</button>
            </form>
            <div class="right">
            <img src="{{ asset('img/login.jpg') }}" alt="">
        </div>
        </div>
    </div>

</body>
</html>