<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">DAILY PLANT PARAMETER</li>
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('reports.index') }}"
            class="nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Report
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('wells.index') }}" class="nav-link {{ request()->routeIs('wells.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Description Wells
                {{-- <span class="right badge badge-danger">New</span> --}}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('readings.index') }}"
            class="nav-link {{ request()->routeIs('readings.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
                Well Readings
            </p>
        </a>
    </li>



    {{-- <li class="nav-item">
        <a href="{{ route('well_readings.index', ['well' => $well->id]) }}"
            class="nav-link {{ request()->routeIs('well_readings.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Well Readings
                <span class="right badge badge-danger">New</span>
            </p>
        </a>
    </li> --}}



    {{-- <li class="nav-header">DAILY PLANT PARAMETER</li> --}}
</ul>
