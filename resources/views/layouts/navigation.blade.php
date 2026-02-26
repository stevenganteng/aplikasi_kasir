<nav class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            {{-- Brand --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-slate-900 font-semibold no-underline">
                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-sm">
                    <i class="fas fa-parking text-lg"></i>
                </div>
                <div class="leading-tight">
                    <div class="text-sm uppercase tracking-wide text-slate-400">GrandBatam</div>
                    <div class="text-sm sm:text-base">Parking System</div>
                </div>
            </a>

            {{-- Navigation --}}
            <div class="hidden md:flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                          {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                    <i class="fas fa-home text-xs"></i>
                    <span>Dashboard</span>
                </a>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fas fa-users text-xs"></i>
                            <span>Users</span>
                        </a>
                        <a href="{{ route('admin.tariffs.index') }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('admin.tariffs.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fas fa-tags text-xs"></i>
                            <span>Tariffs</span>
                        </a>
                        <a href="{{ route('admin.parking-areas.index') }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('admin.parking-areas.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fas fa-map-marker-alt text-xs"></i>
                            <span>Areas</span>
                        </a>
                        <a href="{{ route('admin.vehicles.index') }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('admin.vehicles.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fas fa-car text-xs"></i>
                            <span>Vehicles</span>
                        </a>
                        <a href="{{ route('admin.activity-logs.index') }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('admin.activity-logs.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fas fa-history text-xs"></i>
                            <span>Logs</span>
                        </a>
                    @elseif(Auth::user()->role === 'petugas')
                        <a href="{{ route('petugas.parking.active') }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('petugas.parking.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fas fa-parking text-xs"></i>
                            <span>Parking</span>
                        </a>
                    @elseif(Auth::user()->role === 'owner')
                        <a href="{{ route('owner.dashboard') }}"
                           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition
                                  {{ request()->routeIs('owner.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fas fa-chart-bar text-xs"></i>
                            <span>Reports</span>
                        </a>
                    @endif
                @endauth
            </div>

            {{-- User info & logout --}}
            @auth
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex flex-col items-end leading-tight">
                        <span class="text-sm font-medium text-slate-800">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-slate-500">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium rounded-lg
                                       bg-red-50 text-red-600 hover:bg-red-100 transition">
                            <i class="fas fa-sign-out-alt text-xs"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
