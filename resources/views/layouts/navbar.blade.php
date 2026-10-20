<header class="admin-navbar">

    <div class="navbar-left">

        
    <button
        type="button"
        id="sidebarToggle"
        class="sidebar-toggle"
        aria-label="Sembunyikan sidebar"
        aria-controls="adminSidebar"
        aria-expanded="true"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="22"
            height="22"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            aria-hidden="true"
        >
            <path d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>


        <div>

            <div class="small text-muted">
                Welcome back
            </div>

            <strong>
                {{ auth()->user()->name }}
            </strong>

        </div>

    </div>

    <div class="navbar-right">

        <div
            class="user-avatar"
            data-bs-toggle="tooltip"
            title="{{ auth()->user()->name }}"
        >
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="btn btn-light"
            >
                Logout
            </button>

        </form>

    </div>

</header>