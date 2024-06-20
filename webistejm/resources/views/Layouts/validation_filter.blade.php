<!DOCTYPE html>
<html lang="en">

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
                  <input type="text" name="from_date" id="from_date" readonly class="form-control" placeholder="YYYY-MM-DD"/>
              </div>
              </div>
              <div class="col">
              <div class="form-group input-daterange">
                  <label for="to_date" class="input-group input-group-addon">End Date</label>
                  <input type="text" name="to_date" id="to_date" readonly class="form-control" placeholder="YYYY-MM-DD"/>
              </div>
              </div>
              <div class="col" style="padding-top: 8px;">
              <label for="area" class="input-group input-group-addon form-label">Area</label>
              <select name="area" id="area" class="form-select">
                  <option value="">Choose</option>
                  <option value="All">All</option>
                  @foreach(\App\Constants\GlobalConstants::AREAS as $area)
                  <option value="{{$area}}">{{$area}}</option>
                  @endforeach
              </select>
              </div>
              <div class="col-auto btn-bottom">
              <button type="button" name="refresh" id="refresh" class="btn btn-link btn-sm" style="color: #283978;"><i class="bi bi-x mr-1" style="padding-right:0px; margin-bottom: 0px;"></i>Clear</button>
              </div>
          </div> 
        </div>
      </div>
    </div>
</div>

</html>