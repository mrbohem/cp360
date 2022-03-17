<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @role('admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.create_form')}}">
                <span class="menu-title">Create Form</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @endrole
    </ul>
</nav>