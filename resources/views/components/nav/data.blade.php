<a href="#dataSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
    <i class="fas fa-database mr-2"></i>
    Data
</a>
<ul class="collapse list-unstyled" id="dataSubmenu">
    <li class="nav-item">
        <a href="{{ route('employees-data.index') }}" class="nav-link">Employees</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('departments-data.index') }}" class="nav-link">Departments</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('positions-data.index') }}" class="nav-link">Positions</a>
    </li>
</ul>
