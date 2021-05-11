<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        {{-- <img src="#" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">
            <i class="fas fa-book-open mr-2"></i>
            {{ config('app.name') }}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <x-nav-link :href="route('admin.home')" :active="request()->routeIs('admin.home')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </x-nav-link>
                </li>

                <li class="nav-item">
                    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                        <i class="nav-icon far fa-chart-bar"></i>
                        <p> Category </p>
                    </x-nav-link>
                </li>

                <li class="nav-item">
                    <x-nav-link :href="route('admin.notebooks.index')" :active="request()->routeIs('admin.notebooks.*')">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p> Notebook </p>
                    </x-nav-link>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>