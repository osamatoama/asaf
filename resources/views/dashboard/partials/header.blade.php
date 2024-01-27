<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="{{ route('website.perfume-quiz') }}" class="logo-link">
                    <img class="logo-light logo-img"
                         src="{{ assetCustom('assets/dashboard/images/logos/logo.png') }}"
                         srcset="{{ assetCustom('assets/dashboard/images/logos/logo2x.png') }} 2x"
                         alt="logo">
                    <img class="logo-dark logo-img"
                         src="{{ assetCustom('assets/dashboard/images/logos/logo-dark.png') }}"
                         srcset="{{ assetCustom('assets/dashboard/images/logos/logo-dark2x.png') }} 2x"
                         alt="logo-dark">
                </a>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                    <div class="status dot dot-lg dot-success"></div>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    <div class="user-status user-status-active">
                                        {{ authUser()->roles()->first()->title }}
                                    </div>
                                    <div class="user-name dropdown-indicator">
                                        {{ authUser()?->name }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ authUser()?->name }}</span>
                                        <span class="sub-text">{{ authUser()?->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="{{ route('dashboard.profile.edit') }}">
                                            <em class="icon ni ni-user-alt"></em>
                                            <span>
                                                @lang('global.my_profile')
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dark-switch" href="#">
                                            <em class="icon ni ni-moon"></em>
                                            <span>
                                                @lang('global.Dark Mode')
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="#" class="logout-btn">
                                            <em class="icon ni ni-signout"></em>
                                            <span>
                                                @lang('global.logout')
                                            </span>
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.dark-switch').on('click', function () {
            axios.put('{{ route('dashboard.profile.toggle-dark-mode') }}')
        })

        $('.logout-btn').on('click', function (e) {
            e.preventDefault()

            $('#logout-form').submit()
        })
    </script>
@endpush
