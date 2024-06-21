@extends('layouts.validation_page')

@section('title', 'Pothole Detection List')

@section('content')
  <div class="container-fluid w-100">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="table-container m-0 p-3 bg-white shadow-sm rounded">
          <p class="table-title">Pothole Detection List</p>
          <div class="table-responsive">
            <table class="table table-bordered display" id="table">
              <thead>
                <tr class="table-row">
                  <th scope="col">No.</th>
                  <th scope="col">Image</th>
                  <th scope="col">ID</th>
                  <th scope="col">latlong</th>
                  <th scope="col">action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to perform this action?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Datatables Scripts -->
<script>
  $(document).ready(function(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    fetch_data('', '', 'All');

    $('#filter').click(function() {
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      var area = $('#area option:selected').val();
      fetch_data(from_date, to_date, area);
    });

    function fetch_data(from_date = '', to_date = '', area = '') {
      $('#table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: false,
        responsive: true,
        ajax: {
          url: '{{ route("validation.fetch_data") }}',
          data: {'from_date':from_date, 'to_date':to_date, 'area':area},
        },
        columns: [
          {
            data: null,
            render: function (data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          },
          {
            data:'image_url',
            name:'image_url',
            "render": function (data, type, row, meta) {
              return '<img src="' + data + '" alt="Image">';
            }
          },
          {
            data:'id_deteksi',
            name:'id_deteksi'
          },
          {
            data:'latlong',
            name:'latlong'
          },
          {
            data: null,
            render: function (data, type, row) {
              return '<button type="button" class="btn btn-primary btn-sm approve-btn m-2" data-id="' + row.id_deteksi + '"><i class="bi bi-check mr-1"></i>Approve</button>' +
                      '<button type="button" class="btn btn-danger btn-sm reject-btn m-2" data-id="' + row.id_deteksi + '"><i class="bi bi-x mr-1"></i>Reject</button>';
            }
          }
        ]
      });
    }

    $('#refresh').click(function(){
      $('#from_date').val('');
      $('#to_date').val('');
      $('#area').val('');
      fetch_data('', '', 'All');
    });

    $('#table').on('click', '.approve-btn, .reject-btn', function() {
      var resultId = $(this).data('id');
      var action = $(this).hasClass('approve-btn') ? 'approve' : 'reject';
      
      var clickedButton = $(this);

      $('#confirmationModal').modal('show').one('click', '#confirmButton', function() {
          $.ajax({
            url: '/validation/' + resultId + '/' + action,
            type: 'PATCH',
            dataType: 'json',
            headers: {
              'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
              if (response.success) {
                // Remove row from table
                $('#table').DataTable().row(clickedButton.closest('tr')).remove().draw();
                $('#confirmationModal').modal('hide');
              } else {
                alert('Failed to update result.');
              }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      });
    });

    $('.close, .btn-secondary').on('click', function() {
      $('#confirmationModal').modal('hide');
    });
  });
</script>
  
@endsection