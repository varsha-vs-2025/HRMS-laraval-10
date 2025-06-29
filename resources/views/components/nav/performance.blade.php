<li class="nav-item">
    <a href="#performanceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
        <i class="fas fa-chart-line mr-2"></i> Performance
    </a>
    <ul class="collapse list-unstyled" id="performanceSubmenu">
        <li class="nav-item">
            <a href="{{ route('employees-performance-score.index') }}" class="nav-link">
                Employee Scores
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('score-categories.index') }}" class="nav-link">
                Score Categories
            </a>
        </li>
    </ul>
</li>
