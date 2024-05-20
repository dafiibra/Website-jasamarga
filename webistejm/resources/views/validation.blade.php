<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pothole Detection List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker3.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
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
            <div class="row">
              <div class="col">
                <div class="form-group input-daterange">
                  <label for="from_date" class="input-group input-group-addon">Start Date</label>
                  <input type="text" name="from_date" id="from_date" readonly class="form-control"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group input-daterange">
                  <label for="to_date" class="input-group input-group-addon">End Date</label>
                  <input type="text" name="to_date" id="to_date" readonly class="form-control"/>
                </div>
              </div>
              <div class="col">
                <label for="area" class="input-group input-group-addon form-label">Area</label>
                <select name="area" id="area" class="form-select">
                  <option value="">Choose</option>
                  <option value="All">All</option>
                  @foreach($areas as $key => $area)
                  <option value="{{$area}}">{{$area}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-auto btn-bottom">
                <button type="button" name="refresh" id="refresh" class="btn btn-link btn-sm" >Refresh</button>
              </div>
            </div> 
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
                      <td>
                        <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-check mr-1"></i>Approve</button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-x mr-1"></i>Reject</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<script>
$(document).ready(function(){

  var date = new Date();

  $('.input-daterange').datepicker({
    todayBtn: 'linked',
    format: 'yyyy-mm-dd',
    autoclose: true
  });
  
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $('#area').on('change', function() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var area = $('#area option:selected').val();
    fetch_data(from_date, to_date, area);
  });

  function fetch_data(from_date = '', to_date = '', area = '') {
    console.log(from_date)
    $.ajax({
      url:"{{ route('validation.fetch_data') }}",
      method:"POST",
      data:{'from_date':from_date, 'to_date':to_date, 'area':area},
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      dataType:"json",
      success:function(data){
        var output = '';
        var num = 0;
        $('#total_records').text(data.length);
        for(var count = 0; count < data.length; count++){
          output += '<tr>';
          output += '<td>' + (num+1) + '</td>';
          output += '<td><img src="' +  data[count].image_url + '" alt="Image"></td>';
          output += '<td>' + data[count].id_deteksi + '</td>';
          output += '<td>' + data[count].latlong + '</td>';
          output += '<td><button type="button" class="btn btn-primary btn-sm"><i class="bi bi-check mr-1"></i>Approve</button> <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-x mr-1"></i>Reject</button></td></tr>';
          num+=1;
        }
        $('tbody').html(output);
      }
    })
  }

  $('#refresh').click(function(){
    fetch_data('', '', 'All');
  });
});
</script>  