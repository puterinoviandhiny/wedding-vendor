<aside id="adminSidebar" class="admin-sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">♡</div>
        <div class="brand-title">Wedding Manager</div>
        <div class="brand-subtitle">Vendor Business Suite</div>
    </div>

    <nav class="sidebar-menu">
        <div class="menu-label">Overview</div>

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="menu-icon">◇</span>
            <span>Dashboard</span>
        </a>

        <div class="menu-label">Wedding</div>
        
        <a
            href="{{ route('clients.index') }}"
            class="sidebar-link {{ request()->routeIs('clients.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <x-icon name="users" size="18" />
            </span>
            <span>Clients</span>
        </a>

        <a
            href="{{ route('packages.index') }}"
            class="sidebar-link {{ request()->routeIs('packages.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <x-icon name="file" size="18" />
            </span>
            <span>Wedding Packages</span>
        </a>
        
        <a href="#" class="sidebar-link">
            <span class="menu-icon">◷</span>
            <span>Bookings</span>
        </a>

        <div class="menu-label">Finance</div>
        <a href="#" class="sidebar-link">
            <span class="menu-icon">Rp</span>
            <span>Invoices</span>
        </a>

        <a href="#" class="sidebar-link">
            <span class="menu-icon">−</span>
            <span>Expenses</span>
        </a>

        <div class="menu-label">Settings</div>
        <a href="{{ route('business.profile') }}" class="sidebar-link">
            <span class="menu-icon">⚙</span>
            <span>Business Profile</span>
        </a>

        <a href="{{ route('users.index') }}" class="sidebar-link">
            <span class="menu-icon">◎</span>
            <span>Team Members</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div>{{ auth()->user()->business?->name ?? 'Wedding Vendor Manager' }}</div>
    </div>
</aside>