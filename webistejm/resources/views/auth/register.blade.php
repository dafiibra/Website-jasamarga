<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>@yield("title", "register")</title>
</head>
<body>
  @yield("content")
    <div class="judul"><h1>Dashboard Visual AI Pothole Detection</h1></div>

    <div class="container">
        <div class="login">
            <form method="post" action="{{route('register.post')}}">
                @csrf
              <h2>Hi Roadster!</h2>
              <label for="Username"></label>
              <input type="text" name="text" class="form-control"placeholder="Username" autofocus>
              <label for="Fullname"></label>
              <input type="text" name="fullname"class="form-control" placeholder="Fullname">
              <label for="Division"></label>
              <input type="text" name="division" class="form-control" placeholder="Division">
              <label for="Email"></label>
              <input type="email" name="email" class="form-control"placeholder="Email">
              <label for="Password"></label>
              <input type="password" name="password" class="form-control" placeholder="Password"> 
              <button>Create an Account</button>
              
            
            </form>
        </div>

        <div class="right">
            <!-- <img src="{{ asset('login.jpg') }}" alt=""> -->
        </div>
    </div>

</body>
</html>