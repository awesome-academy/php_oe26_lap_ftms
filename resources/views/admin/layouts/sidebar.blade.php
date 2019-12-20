<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i> |
            <span>{{ trans('setting.dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-user-friends"></i> |
            <span>{{ trans('setting.users') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-tasks"></i> |
            <span>{{ trans('setting.categories') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.courses.index') }}">
            <i class="fas fa-chalkboard-teacher"></i> |
            <span>{{ trans('setting.courses') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.subjects.index') }}">
            <i class="fas fa-atom"></i> |
            <span>{{ trans('setting.subjects') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tasks.index') }}">
            <i class="fas fa-book-open"></i> |
            <span>{{ trans('setting.tasks') }}</span></a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>{{ trans('setting.pages') }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>{{ trans('setting.charts') }}</span>
        </a>
    </li>
</ul>
