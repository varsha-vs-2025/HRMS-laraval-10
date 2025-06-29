{{-- resources/views/components/sidebar.blade.php --}}
<div class="sidebar">
    <div class="sidebar-header">
        <h4>HRMS</h4>
    </div>

    <ul class="list-unstyled components">

        <li>
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('announcements.index') }}" class="nav-link">
                <i class="fas fa-bullhorn mr-2"></i> Announcements
            </a>
        </li>

        @if(auth()->user()->role_id == 1) {{-- Admin-only --}}
            <li>
                <a href="{{ route('score-categories.index') }}" class="nav-link">
                    <i class="fas fa-star mr-2"></i> Score Categories
                </a>
            </li>

            <li>
                <a href="{{ route('logs') }}" class="nav-link">
                    <i class="fas fa-history mr-2"></i> Logs
                </a>
            </li>

            <li>
                <a href="#accountSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="fas fa-users mr-2"></i> Accounts
                </a>
                <ul class="collapse list-unstyled" id="accountSubmenu">
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link">Roles</a>
                    </li>
                </ul>
            </li>
        @endif

        <li>
            <a href="{{ route('profile') }}" class="nav-link">
                <i class="fas fa-user-circle mr-2"></i> Profile
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</div>
