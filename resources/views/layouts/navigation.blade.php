<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="navbar-brand">
        <i class="fas fa-parking"></i>
        GrandBatam Parking
    </a>
    
    <div class="navbar-menu">
        <a href="{{ route('dashboard') }}" class="navbar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="navbar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Users
                </a>
                <a href="{{ route('admin.tariffs.index') }}" class="navbar-item {{ request()->routeIs('admin.tariffs.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Tariffs
                </a>
                <a href="{{ route('admin.parking-areas.index') }}" class="navbar-item {{ request()->routeIs('admin.parking-areas.*') ? 'active' : '' }}">
                    <i class="fas fa-map-marker-alt"></i> Areas
                </a>
                <a href="{{ route('admin.vehicles.index') }}" class="navbar-item {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                    <i class="fas fa-car"></i> Vehicles
                </a>
                <a href="{{ route('admin.activity-logs.index') }}" class="navbar-item {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                    <i class="fas fa-history"></i> Logs
                </a>
            @elseif(Auth::user()->role === 'petugas')
                <a href="{{ route('petugas.parking.active') }}" class="navbar-item {{ request()->routeIs('petugas.parking.*') ? 'active' : '' }}">
                    <i class="fas fa-parking"></i> Parking
                </a>
            @elseif(Auth::user()->role === 'owner')
                <a href="{{ route('owner.dashboard') }}" class="navbar-item {{ request()->routeIs('owner.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
            @endif
        @endauth
    </div>
    
    @auth
    <div class="navbar-user">
        <div class="navbar-user-info">
            <div class="navbar-user-name">{{ Auth::user()->name }}</div>
            <div class="navbar-user-role">{{ ucfirst(Auth::user()->role) }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
    @endauth
</nav>
