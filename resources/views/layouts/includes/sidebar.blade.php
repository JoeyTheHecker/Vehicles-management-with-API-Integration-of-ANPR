<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li class="{{ request()->is('dashboard') ? 'mm-active' : null }}">
                    <a href="{{ route('dashboard') }}"" class="waves-effect">
                        <i class="bx bxs-dashboard font-size-24"></i>
                        <span key="t-calendar">Dashboard</span>
                    </a>
                </li>
                @if (strtolower(auth()->user()->role->name) !== "administrator")
                <li class="{{ request()->is('identify-vehicles*') ? 'mm-active' : null }}">
                    <a href="{{ route('identify-vehicles.index') }}"" class="waves-effect">
                        <i class="bx bx-search-alt font-size-24"></i>
                        <span key="t-calendar">Identify Vehicles</span>
                    </a>
                </li>
                @endif
                @if (strtolower(auth()->user()->role->name) === "administrator")
                    <li class="{{ request()->is('owners*') ? 'mm-active' : null }}">
                        <a href="{{ route('owners.index') }}"" class="waves-effect">
                            <i class="bx bx-user-pin font-size-24"></i>
                            <span key="t-calendar">Owners</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('vehicles*') ? 'mm-active' : null }}">
                        <a href="{{ route('vehicles.index') }}"" class="waves-effect">
                            <i class="bx bxs-car font-size-24"></i>
                            <span key="t-calendar">Vehicles</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('brands*') ? 'mm-active' : null }}">
                        <a href="{{ route('brands.index') }}"" class="waves-effect">
                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                            <span key="t-calendar">Brands</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('users*') ? 'mm-active' : null }}">
                        <a href="{{ route('users.index') }}"" class="waves-effect">
                            <i class="bx bxs-user-plus font-size-24"></i>
                            <span key="t-calendar">Users</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('activities*') ? 'mm-active' : null }}">
                        <a href="{{ route('activities.index') }}"" class="waves-effect">
                            <i class="bx bx-list-check font-size-24"></i>
                            <span key="t-calendar">Activities</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
