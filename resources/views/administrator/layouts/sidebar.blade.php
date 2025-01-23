<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('administrator.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('administrator.reporttodo.list') }}">
                <i class="bi bi-grid"></i>
                <span>Report To Do</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('administrator.pengguna.list') }}">
                <i class="bi bi-person-video3"></i>
                <span>Pengguna</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->