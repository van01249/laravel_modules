<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $user->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="/admin/dashboard" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @foreach ($sidebars as $sidebar)
                    @if ($sidebar->is_child == 1)
                        <li class="nav-item">
                            <div class="nav-link" style="cursor: pointer">
                                <i class="nav-icon {{ $sidebar->icon }}"></i>
                                <p>
                                    {{ $sidebar->name }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </div>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ $sidebar->link }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách</p>
                                    </a>
                                </li>
                                @if ($sidebar->add)
                                    <li class="nav-item">
                                        <a href="{{ $sidebar->link }}/create" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Thêm mới</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ $sidebar->link }}" class="nav-link">
                                <i class="nav-icon {{ $sidebar->icon }}"></i>
                                <p>
                                    {{ $sidebar->name }}
                                </p>
                            </a>
                        </li>
                    @endif
                @endforeach

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
