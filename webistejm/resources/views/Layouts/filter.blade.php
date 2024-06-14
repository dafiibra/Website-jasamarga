<!-- Filter -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="filter-container p-3 bg-white shadow-sm rounded">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="from_date" class="form-label fw-bold">Start Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="to_date" class="form-label fw-bold">End Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="area" class="form-label fw-bold">Area</label>
                            <select name="area" id="area" class="form-select">
                                <option value="">Choose</option>
                                <option value="All">All</option>
                                <option value="area">Area</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end mb-3">
                        <button type="button" name="refresh" id="refresh" class="me-2 btn w-100 text-white" style="background-color: #3f58b4;">
                            <i class="bi bi-x-lg mr-1"></i>Filter
                        </button>
                        <button type="button" name="refresh" id="refresh" class="btn w-100 text-white" style="background-color: #3f58b4;">
                            <i class="bi bi-x-lg mr-1"></i>Clear
                        </button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
