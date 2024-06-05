<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"  href='{{asset("css/dashboard.css")}}'>
</head>
<body>
    <div class="wrapper">
    @include('layouts.sidebar')
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3 d-flex bg-white">
                <div class="navbar-collapse collapse">
                <h3 class="fw-bold">Dashboard Visual AI Pothole Detection</h3>
                </div>
                <img src="{{ asset('img/logo.png') }}" alt="My Image" style="width: 50px; height: auto; float: right;">
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="row mb-3">
                        @include('layouts.filter')
                        </div>
                        <div class="row">
                        @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="{{asset('dashboard.js')}}"></script>
</body>
</html>