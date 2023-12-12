<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('dashboard.home') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img"
                    src="{{ asset('assets/dashboard/images/logos/logo.png') }}"
                    srcset="{{ asset('assets/dashboard/images/logos/logo2x.png') }} 2x"
                    alt="logo">
                <img class="logo-dark logo-img"
                    src="{{ asset('assets/dashboard/images/logos/logo-dark.png') }}"
                    srcset="{{ asset('assets/dashboard/images/logos/logo-dark2x.png') }} 2x"
                    alt="logo-dark">
                <img class="logo-small logo-img logo-img-small"
                    src="{{ asset('assets/dashboard/images/logos/logo-small.png') }}"
                    srcset="{{ asset('assets/dashboard/images/logos/logo-small2x.png') }} 2x"
                    alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li @class(['nk-menu-item'])>
                        @if(isMerchant())
                            <div class="nk-menu-text d-flex justify-center align-items-center gap-1 h-100 text-center overflow-hidden rounded-pill border border-secondary mx-auto mb-2 @can(config('models.shop.permissions.share')) py-0 ps-2 pe-0 @else py-1 px-3 @endcan" style="width: fit-content !important;">
                                <a class="text-secondary p-0 align-middle" href="{{ website()->routes()->vendor(\App\Models\Admin::find(authId())->getMerchantShop()) }}" target="_blank">
                                    <span class="nk-menu-text">
                                        @lang('global.visit_the_shop')
                                    </span>
                                    @if(locale()->current() === 'ar')
                                        <span class="nk-menu-icon w-auto ps-1">
                                            <em class="icon ni ni-chevron-right text-secondary fs-5"></em>
                                        </span>
                                        @else
                                        <span class="nk-menu-icon w-auto ps-1">
                                            <em class="icon ni ni-chevron-left text-secondary fs-5"></em>
                                        </span>
                                    @endif
                                </a>
                                @can(config('models.shop.permissions.share'))
                                    <span class="d-flex h-100 border-start border-1 border-secondary py-1 px-0">
                                        <a href="{{ route('dashboard.my-shop.qr-code') }}" title="@lang('global.generate_qr_code')">
                                            <span class="nk-menu-icon">
                                                <em class="icon ni ni-qr text-secondary"></em>
                                            </span>
                                        </a>
                                        <a href="#" id="share-btn" title="@lang('global.share_your_shop')">
                                            <span class="nk-menu-icon">
                                                <em class="icon ni ni-share text-secondary"></em>
                                            </span>
                                        </a>
                                    </span>
                                @endcan
                            </div>
                        @else
                        <div class="nk-menu-text d-flex justify-center align-items-center gap-1 h-100 text-center overflow-hidden rounded-pill border border-secondary mx-auto mb-2 py-1 px-3" style="width: fit-content !important;">
                            <a class="text-secondary p-0 align-middle" href="{{ route('website.home') }}" target="_blank">
                                <span class="nk-menu-text">
                                    @lang('global.visit_website')
                                </span>
                                @if(locale()->current() === 'ar')
                                    <span class="nk-menu-icon w-auto ps-1">
                                        <em class="icon ni ni-chevron-right text-secondary fs-5"></em>
                                    </span>
                                @else
                                    <span class="nk-menu-icon w-auto ps-1">
                                        <em class="icon ni ni-chevron-left text-secondary fs-5"></em>
                                    </span>
                                @endif
                            </a>
                        </div>
                        @endif
                    </li>
                    <li @class(['nk-menu-item','active current-page' => isCurrentPage('dashboard.home')])>
                        <a href="{{ route('dashboard.home') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-dashboard-fill"></em>
                            </span>
                            <span class="nk-menu-text">
                                @lang('panel.dashboard')
                            </span>
                        </a>
                    </li>

                    @include('dashboard.partials.admin-sidebar')
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        $('.sidebar-main-menu').on('click', function(e){
            e.stopPropagation();
            if(!this.classList.contains('active')) {
                this.querySelectorAll('.nk-menu-item .has-sub').forEach((menu) => {
                    menu.classList.remove('active')
                })
            }
        })
    </script>
@endpush
