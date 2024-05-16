<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pothole Detection List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky">
      <h2 class="title">Dashboard Visual AI Pothole Detection</h2>
  </nav>

  <!-- Filter -->
  <div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="filter-container">
              <p class="filter-title">Filter:</p>
            </div>
        </div>
    </div>
  </div>

  <!-- Table -->
  <div class="container-fluid mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="table-container">
          <p class="table-title">Pothole Detection List</p>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Image</th>
                    <th scope="col">ID</th>
                    <th scope="col">latlong</th>
                    <th scope="col">action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($results as $key => $result)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td><img src="{{$result->image_url}}" alt="Image"></td>
                    <td>{{$result['id_deteksi']}}</td>
                    <td>{{$result['latlong']}}</td>
                    <td>{{$result['action']}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>