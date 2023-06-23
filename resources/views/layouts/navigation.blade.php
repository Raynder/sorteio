<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bar-chart-square"></i>
                    <div data-i18n="Dashboards">Dashboard</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <div data-i18n="Pages">Cadastros</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('colaboradores.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons fas fa-users"></i>
                            <div>Colaboradores</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    Utilitários
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('permissions.index') }}"
                            class="menu-link {{ Request::is('permissions*') ? 'active' : '' }}">
                            <i class="menu-icon tf-icons bx bx-door-open"></i>
                            <div>Permissões</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('roles.index') }}"
                            class="menu-link {{ Request::is('roles*') ? 'active' : '' }}">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div>Grupos</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('users.index') }}"
                            class="menu-link {{ Request::is('user*') ? 'active' : '' }}">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>Usuários</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
