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
                        <div class="nk-menu-text d-flex justify-center align-items-center gap-1 h-100 text-center overflow-hidden rounded-pill border border-secondary mx-auto mb-2 py-1 px-3" style="width: fit-content !important;">
                            <a class="text-secondary p-0 align-middle" href="{{ route('website.perfume-quiz') }}" target="_blank">
                                <span class="nk-menu-text">
                                    @lang('global.visit_website')
                                </span>
                                <span class="nk-menu-icon w-auto ps-1">
                                    <em class="icon ni ni-chevron-right text-secondary fs-5"></em>
                                </span>
                            </a>
                        </div>
                    </li>
                    <li @class(['nk-menu-item','active current-page' => isCurrentPage('dashboard.home')])>
                        <a href="{{ route('dashboard.home') }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <em class="icon ni ni-dashboard-fill"></em>
                            </span>
                            <span class="nk-menu-text">
                                لوحة التحكم
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
