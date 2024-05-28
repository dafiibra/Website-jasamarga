<!DOCTYPE html>
<html>
<div class="d-flex flex-column flex-shrink-0 p-3" style="width: 280px; height: 100vh; background-color: #3F58B4; position: sticky; top: 0;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="{{ asset('img/logo.png') }}" alt="My Image">
    </a>
    <hr style="border-color: white;">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link text-dark active" aria-current="page"
                style="background-color: white; color: #3F58B4;">
                <i class="fas fa-home"></i>
                <h5>Home</h5>
            </a>
        </li>
        <li>
            <a href="/validation" class="nav-link text-dark">
                <i class="fas fa-tachometer-alt"></i>
                <h5>Validation</h5>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-dark">
                <i class="fas fa-chart-line"></i>
                <h5>History</h5>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-dark">
                <i class="fas fa-chart-line"></i>
                <h5>User Management</h5>
            </a>
        </li>
    </ul>
    <hr style="border-color: white;">
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>User</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1"
            style="background-color: #3F58B4;">
            <li><a class="dropdown-item dark-white" href="#">Sign out</a></li>
        </ul>
    </div>
</div>

</html>
