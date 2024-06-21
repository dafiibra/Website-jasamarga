<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">Jasamarga</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="/dashboard" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="/validation" class="sidebar-link">
                <i class="lni lni-check-box"></i>
                <span>Validation</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-folder"></i>
                <span>History</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-users"></i>
                <span>User Management</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="{{ route('logout') }}" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>