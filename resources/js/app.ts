import './bootstrap';
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';
import '../css/app.css';

function initSidebarToggle(): void {
    const sidebar = document.getElementById('adminSidebar');
    const toggle = document.getElementById('sidebarToggle')
        ?? document.querySelector<HTMLElement>('.sidebar-toggle');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !toggle) {
        console.error('[Sidebar] Elemen sidebar atau tombol toggle tidak ditemukan.', {
            sidebarFound: Boolean(sidebar),
            toggleFound: Boolean(toggle),
        });
        return;
    }

    const isMobile = (): boolean => window.innerWidth < 992;

    function openSidebar(): void {
        if (isMobile()) {
            sidebar.classList.add('show');
            overlay?.classList.add('show');
            document.body.classList.add('sidebar-open');
        } else {
            sidebar.classList.remove('sidebar-collapsed');
            document.body.classList.remove('sidebar-is-collapsed');
        }

        toggle.setAttribute('aria-expanded', 'true');
    }

    function closeSidebar(): void {
        if (isMobile()) {
            sidebar.classList.remove('show');
            overlay?.classList.remove('show');
            document.body.classList.remove('sidebar-open');
        } else {
            sidebar.classList.add('sidebar-collapsed');
            document.body.classList.add('sidebar-is-collapsed');
        }

        toggle.setAttribute('aria-expanded', 'false');
    }

    toggle.addEventListener('click', (event: MouseEvent) => {
        event.preventDefault();
        event.stopPropagation();

        const opened = isMobile()
            ? sidebar.classList.contains('show')
            : !sidebar.classList.contains('sidebar-collapsed');

        if (opened) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    overlay?.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', (event: KeyboardEvent) => {
        if (event.key === 'Escape' && isMobile()) {
            closeSidebar();
        }
    });

    window.addEventListener('resize', () => {
        if (isMobile()) {
            sidebar.classList.remove('sidebar-collapsed');
            document.body.classList.remove('sidebar-is-collapsed');
        } else {
            sidebar.classList.remove('show');
            overlay?.classList.remove('show');
            document.body.classList.remove('sidebar-open');
            overlay?.removeAttribute('style');
        }
    });

    console.info('[Sidebar] Toggle berhasil diinisialisasi.');
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSidebarToggle, {
        once: true,
    });
} else {
    initSidebarToggle();
}

document.addEventListener('DOMContentLoaded', (): void => {
    console.log('Wedding Vendor Manager initialized');

    const tooltips = document.querySelectorAll<HTMLElement>(
        '[data-bs-toggle="tooltip"]'
    );

    tooltips.forEach((element: HTMLElement): void => {
        new bootstrap.Tooltip(element);
    });
});