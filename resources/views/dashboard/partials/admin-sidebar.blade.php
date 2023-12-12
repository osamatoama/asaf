@can(config('models.product.permissions.access'))

    <li @class(['nk-menu-item has-sub sidebar-main-menu', 'active current-page' => isMenuOpened([
        'products'
    ])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-package"></em>
            </span>
            <span class="nk-menu-text">
                المنتجات
            </span>
        </a>
        <ul class="nk-menu-sub">
            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.products.index')])>
                <a href="{{ route('dashboard.products.index') }}" class="nk-menu-link">
                                <span class="nk-menu-text">
                                    قائمة المنتجات
                                </span>
                    <span class="nk-menu-badge bg-info text-white">
                        {{ \App\Models\Product::count() }}
                    </span>
                </a>
            </li>
        </ul>
    </li>

@endcan

@canany([
    config('models.banner.permissions.access'),
    config('models.coupon.permissions.access'),
    config('models.free-shipping.permissions.access')
])

    <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened([
        'banners',
        'coupons',
        'free-shippings',
    ])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-monitor"></em>
            </span>
            <span class="nk-menu-text">
                @lang('cruds.preview_management.title')
            </span>
        </a>
        <ul class="nk-menu-sub">
            @can(config('models.banner.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.banners.*')])>
                    <a href="{{ route('dashboard.banners.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.banner.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can( config('models.coupon.permissions.access') )
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.coupons.*')])>
                    <a href="{{ route('dashboard.coupons.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.coupon.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can( config('models.free-shipping.permissions.access') )
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.free-shippings.*')])>
                    <a href="{{ route('dashboard.free-shippings.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.free_shipping.title')
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>

@endcanany

@canany([
    config('models.contact-subject.permissions.access'),
    config('models.faq.permissions.access'),
])

    <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened([
        'contact-subjects',
        'faqs',
    ])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-msg-circle"></em>
            </span>
            <span class="nk-menu-text">
                @lang('cruds.support_management.title')
            </span>
        </a>
        <ul class="nk-menu-sub">
            @can(config('models.contact-subject.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.contact-subjects.*')])>
                    <a href="{{ route('dashboard.contact-subjects.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.contact_subject.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.faq.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.faqs.*')])>
                    <a href="{{ route('dashboard.faqs.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.faq.title')
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>

@endcanany

@canany([
    config('models.merchant-due.permissions.access'),
    config('models.merchant-payment.permissions.access')
])

    <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened([
        'dues',
        'merchant-payments',
    ])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-report-profit"></em>
            </span>
            <span class="nk-menu-text">
                @lang('cruds.financial_reports.title')
            </span>
        </a>
        <ul class="nk-menu-sub">
            @can(config('models.merchant-due.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.dues.*')])>
                    <a href="{{ route('dashboard.dues.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            {{__('cruds.dues.title')}}
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.merchant-payment.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.merchant-payments.*')])>
                    <a href="{{ route('dashboard.merchant-payments.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            {{__('cruds.merchant_payments.title')}}
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>

@endcanany

@canany([
    config('models.address.permissions.access'),
    config('models.user.permissions.access'),
    config('models.role.permissions.access'),
    config('models.audit-log.permissions.access')
])

    <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened(['addresses', 'roles', 'users', 'audit-logs'])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-users"></em>
            </span>
            <span class="nk-menu-text">
                @lang('cruds.userManagement.title')
            </span>
        </a>
        <ul class="nk-menu-sub">
            @can(config('models.address.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.addresses.*')])>
                    <a href="{{ route('dashboard.addresses.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.address.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.user.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.users.*')])>
                    <a href="{{ route('dashboard.users.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.user.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.role.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.roles.*')])>
                    <a href="{{ route('dashboard.roles.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.role.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.audit-log.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.audit-logs.*')])>
                    <a href="{{ route('dashboard.audit-logs.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.auditLog.title')
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>

@endcanany

@canany([
    config('models.payment-method.permissions.access'),
    config('models.cash-on-delivery-request.permissions.access'),
    config('models.bank-account.permissions.access'),
    config('models.shipping-method.permissions.access'),
    config('models.country.permissions.access'),
    config('models.city.permissions.access'),
    config('models.package.permissions.access'),
    config('models.feature.permissions.access'),
    config('models.package-feature.permissions.access'),
    config('models.frontend-page.permissions.access'),
    config('models.category.permissions.access'),
    config('models.sitemap.permissions.access'),
    config('models.robot.permissions.access'),
    config('models.access-log.permissions.access'),
    config('models.merchant.permissions.access'),
    config('models.shop.permissions.access'),
    config('models.content-page.permissions.access'),
    config('models.user-alert.permissions.access'),
    config('models.status.permissions.access'),
    config('models.setting.permissions.access'),
])
    <li @class(['nk-menu-item has-sub sidebar-main-menu', 'active current-page' => isMenuOpened([
        'payments',
        'payment-methods',
        'shop-payment-methods',
        'cash-on-delivery-requests',
        'bank-accounts',
        'shipping-methods',
        'countries',
        'cities',
        'packages',
        'features',
        'package-features',
        'frontend-pages',
        'navbar-categories',
        'sitemap',
        'robots',
        'access-log',
        'merchants',
        'shops',
        'content-pages',
        'user-alerts',
        'statuses',
        'settings',
        'services',
        'service-providers',
    ])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-setting-alt"></em>
            </span>
            <span class="nk-menu-text">
                @lang('cruds.system_settings.title')
            </span>
        </a>
        <ul class="nk-menu-sub">
            @canany([
                config('models.payment-method.permissions.access'),
                config('models.cash-on-delivery-request.permissions.access'),
                config('models.bank-account.permissions.access')
            ])
                <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened([
                    'payments',
                    'payment-methods',
                    'shop-payment-methods',
                    'cash-on-delivery-requests',
                    'bank-accounts',
                ])])>
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-money"></em>
                        </span>
                        <span class="nk-menu-text">
                            @lang('cruds.paymentsAndBank.title')
                        </span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can(config('models.payment-method.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.payment-methods.*')])>
                                <a href="{{ route('dashboard.payment-methods.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.paymentMethod.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.cash-on-delivery-request.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.cash-on-delivery-requests.*')])>
                                <a href="{{ route('dashboard.cash-on-delivery-requests.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.cashOnDeliveryRequests.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.bank-account.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.bank-accounts.*')])>
                                <a href="{{ route('dashboard.bank-accounts.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.bankAccount.title')
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany([
                config('models.shipping-method.permissions.access'),
                config('models.country.permissions.access'),
                config('models.city.permissions.access')
            ])
                <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened([
                    'shipping-methods',
                    'countries',
                    'cities',
                ])])>
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-truck"></em>
                        </span>
                        <span class="nk-menu-text">
                            @lang('cruds.shippingMethod.sidebar_title')
                        </span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can(config('models.shipping-method.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.shipping-methods.*')])>
                                <a href="{{ route('dashboard.shipping-methods.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.shippingMethod.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.country.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.countries.*')])>
                                <a href="{{ route('dashboard.countries.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.country.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.city.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.cities.*')])>
                                <a href="{{ route('dashboard.cities.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.city.title')
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany([
                config('models.package.permissions.access'),
                config('models.feature.permissions.access'),
                config('models.package-feature.permissions.access')
            ])
                <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened(['packages', 'features', 'package-features'])])>
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-bookmark"></em>
                        </span>
                        <span class="nk-menu-text">
                            @lang('cruds.generalPackage.title')
                        </span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can(config('models.package.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.packages.*')])>
                                <a href="{{ route('dashboard.packages.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.package.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.feature.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.features.*')])>
                                <a href="{{ route('dashboard.features.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.feature.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.package-feature.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.package-features.*')])>
                                <a href="{{ route('dashboard.package-features.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.packageFeature.title')
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany([
                config('models.frontend-page.permissions.access'),
                config('models.category.permissions.access'),
                config('models.sitemap.permissions.access'),
                config('models.robot.permissions.access'),
                config('models.access-log.permissions.access')
            ])
                <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened(['frontend-pages','navbar-categories' ,'sitemap', 'robots', 'access-log'])])>
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon">
                            <em class="icon ni ni-b-chrome"></em>
                        </span>
                        <span class="nk-menu-text">
                            @lang('cruds.seo_tools.title')
                        </span>
                    </a>
                    <ul class="nk-menu-sub">
                        @can(config('models.frontend-page.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.frontend-pages.*')])>
                                <a href="{{ route('dashboard.frontend-pages.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.frontend_pages.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.category.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.navbar-categories.*')])>
                                <a href="{{ route('dashboard.navbar-categories.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.category.seo_title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.sitemap.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.sitemap.*')])>
                                <a href="{{ route('dashboard.sitemap.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.sitemap.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.robot.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.robots.*')])>
                                <a href="{{ route('dashboard.robots.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">
                                        @lang('cruds.robots.title')
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can(config('models.access-log.permissions.access'))
                            <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.access-log.index')])>
                                <a href="{{ route('dashboard.access-log.index') }}" class="nk-menu-link">
                                    <span class="nk-menu-text">@lang('cruds.access-log.title')</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @can(config('models.merchant.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.merchants.index')])>
                    <a href="{{ route('dashboard.merchants.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('global.merchants')
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.shop.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.shops.*')])>
                    <a href="{{ route('dashboard.shops.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.shop.title')
                        </span>
                    </a>
                </li>
            @endcan

            {{-- @can(config('models.content-page.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.content-pages.*')])>
                    <a href="{{ route('dashboard.content-pages.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.contentPage.title')
                        </span>
                    </a>
                </li>
            @endcan --}}

            @can(config('models.user-alert.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.user-alerts.*')])>
                    <a href="{{ route('dashboard.user-alerts.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.userAlert.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.status.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.statuses.*')])>
                    <a href="{{ route('dashboard.statuses.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.status.title')
                        </span>
                    </a>
                </li>
            @endcan

            @can(config('models.setting.permissions.access'))
                <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.settings.*')])>
                    <a href="{{ route('dashboard.settings.index') }}" class="nk-menu-link">
                        <span class="nk-menu-text">
                            @lang('cruds.setting.title')
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@canany([
    'blog_dynamic_frame_access',
    'blog_static_frame_access',
])

    <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened([
        'blog',
    ])])>
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon">
                <em class="icon ni ni-notes-alt"></em>
            </span>
            <span class="nk-menu-text">
               @lang('cruds.blog.blog')
            </span>
        </a>
        <ul class="nk-menu-sub">
            <li @class(['nk-menu-item has-sub', 'active current-page' => isMenuOpened([
                 'blog',
            ])])>
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-list-round"></em>
                    </span>
                    <span class="nk-menu-text">
                        @lang('cruds.blog.frames')
                    </span>
                </a>
                <ul class="nk-menu-sub">
                    @can('blog_static_frame_access')
                        <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.blog.static-frames.*')])>
                            <a href="{{ route('dashboard.blog.static-frames.index') }}" class="nk-menu-link">
                                <span class="nk-menu-text">
                                   @lang('cruds.blog.static_frames.title')
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can(config('models.blog-static-frames.permissions.access'))
                        <li @class(['nk-menu-item','active' => isCurrentPage('dashboard.blog.dynamic-frames.*')])>
                            <a href="{{ route('dashboard.blog.dynamic-frames.index') }}" class="nk-menu-link">
                                <span class="nk-menu-text">
                                   @lang('cruds.blog.dynamic_frames.title')
                                </span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </li>

@endcanany
