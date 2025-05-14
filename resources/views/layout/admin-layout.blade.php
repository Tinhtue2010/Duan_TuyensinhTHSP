@extends('layout/main-layout')

@section('content')
    <div id="sidebar" class="sidebar">
        <ul class="nav-list">
            <a href="/danh-sach-ho-so" class="a-no-style">
                <li class="nav-item {{ request()->routeIs('ho-so.*') ? 'active' : '' }}">
                    Quản lý hồ sơ
                </li>
            </a>
            <a href="/danh-sach-tai-khoan" class="a-no-style">
                <li class="nav-item {{ request()->routeIs('tai-khoan.*') ? 'active' : '' }}">
                    Quản lý tài khoản
                </li>
            </a>
            <a href="/danh-sach-bao-cao" class="a-no-style">
                <li class="nav-item {{ request()->routeIs('bao-cao.*') ? 'active' : '' }}">
                    Báo cáo
                </li>
            </a>

        </ul>
    </div>

    <!-- Toggle Button -->
    <button id="menuToggle" class="menu-toggle">☰</button>

    <div id="mainContent" class="main-content" style="min-height: 100vh">

        @yield('content2')
    </div>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        const isMobile = window.innerWidth <= 768;

        let sidebarOpen = !isMobile;

        if (isMobile) {
            sidebar.classList.add('sidebar-collapsed');
            mainContent.classList.add('main-content-expanded');
        } else {
            menuToggle.classList.add('menu-toggle-moved');
        }

        menuToggle.addEventListener('click', () => {
            sidebarOpen = !sidebarOpen;

            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');
            mainContent.classList.toggle('main-content-expanded');
            menuToggle.classList.toggle('menu-toggle-moved');
        });

        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                navItems.forEach(navItem => navItem.classList.remove('active'));
                item.classList.add('active');

                if (isMobile && sidebarOpen) {
                    sidebarOpen = false;
                    sidebar.classList.add('sidebar-collapsed');
                    sidebar.classList.remove('sidebar-expanded');
                    mainContent.classList.add('main-content-expanded');
                    menuToggle.classList.remove('menu-toggle-moved');
                }
            });
        });

        window.addEventListener('resize', () => {
            const newIsMobile = window.innerWidth <= 768;

            if (newIsMobile !== isMobile) {
                location.reload();
            }
        });
    </script>
@endsection
