@canany([
    config('models.product.permissions.access'),
    config('models.gender.permissions.access')
])

    <li @class(['nk-menu-item has-sub sidebar-main-menu', 'active current-page' => isMenuOpened([
        'products',
        'genders'
    ])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-package"></em>
            </span>
            <span class="nk-menu-text">
                إدارة المنتجات
            </span>
        </a>
        <ul class="nk-menu-sub">
            @can(config('models.product.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.products.index')])>
                    <a href="{{ route('dashboard.products.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        المنتجات
                                    </span>
                        <span class="nk-menu-badge bg-info text-white">
                            {{ \App\Models\Product::count() }}
                        </span>
                    </a>
                </li>
            @endcan
            @can(config('models.gender.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.genders.index')])>
                    <a href="{{ route('dashboard.genders.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            الأنواع
                        </span>
                        <span class="nk-menu-badge bg-info text-white">
                            {{ \App\Models\Gender::count() }}
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>

@endcanany

@canany([
    config('models.user.permissions.access'),
    config('models.role.permissions.access'),
    config('models.audit-log.permissions.access')
])

    <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened(['roles', 'users', 'audit-logs'])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-users"></em>
            </span>
            <span class="nk-menu-text">
                إدارة المستخدمين
            </span>
        </a>
        <ul class="nk-menu-sub">
            @can(config('models.role.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.roles.*')])>
                    <a href="{{ route('dashboard.roles.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            الأذونات
                        </span>
                        <span class="nk-menu-badge bg-info text-white">
                            {{ \App\Models\Role::whereNotNull('related_user_id')->count() }}
                        </span>
                    </a>
                </li>
            @endcan
            @can(config('models.user.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.users.*')])>
                    <a href="{{ route('dashboard.users.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            موظفين لوحة التحكم
                        </span>
                        <span class="nk-menu-badge bg-info text-white">
                            {{ \App\Models\Admin::whereNotNull('parent_id')->count() }}
                        </span>
                    </a>
                </li>
            @endcan
            @can(config('models.audit-log.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.audit-logs.*')])>
                    <a href="{{ route('dashboard.audit-logs.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            سجلات النشاط
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>

@endcanany
