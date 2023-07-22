<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('lang_dir') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta_tags')

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.scrollbar.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />

    @stack('head_tags')

    @if (session('lang_dir') == 'rtl')
        <style>
            @media (min-width: 768px){
                #main-sidebar{
                    right: 0;
                }

                #top-header, #main-content{
                    margin-right: 250px;
                    margin-left: 0;
                }
            }

            #rtl .dropdown-menu-end{
                left: 0;
                right: auto;
            }

            #rtl .notification-counter{
                right: 0;
            }
        </style>
    @endif
</head>

<body id="{{ session('lang_dir') }}">

    <div id="app">
        <header class="bg-white sticky-top shadow-sm" id="top-header">
            <div class="container-fluid">
                <nav class="navbar">
                    <div>
                        <button type="button" class="btn btn-light" onclick="toggleSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div>
                        <ul class="nav ml-auto">

                            <li class="nav-item dropdown nav-menu">
                                <a class="nav-link btn border mx-3 btn-sm rounded-pill" target="_blank" href="{{ route('welcome') }}">{{ __("Visit Website") }}</a>
                            </li>

                            <x-core-query-lang-selector></x-core-query-lang-selector>

                            <x-core-notification></x-core-notification>

                            <li class="nav-item dropdown nav-menu">
                                <a class="nav-link p-0" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" class="img-fluid"
                                             src="{{ asset(Auth::check() && Auth::user()->avatar ? 'uploads/user/' . Auth::user()->avatar : 'images/avatar.png') }}"
                                             width="40" height="40">
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="far fa-user"></i>
                                            <span class="mx-1"></span>
                                            {{ __('Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt">

                                            </i>
                                            <span class="mx-1"></span>
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <aside id="main-sidebar">
                @php
                    $currentRoute = request()
                        ->route()
                        ->getName();
                @endphp
                <div class="scrollbar-inner">
                    <div class="text-center p-2">
                        <h2>
                            <a href="{{ route("home") }}" class="text-white">
                                <img src="{{ asset(config('settings.logo') ?? env("THEME").'/images/logo-white.png') }}" style="height: 60px;" alt=""
                                     class="img-fluid">
                            </a>
                        </h2>
                    </div>
                    <div class="hr-line"></div>
                    <ul class="nav flex-column px-2">

                        <li class="nav-item px-3 nav-category-divider text-white mb-2">{{ __('MAIN') }}</li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('home') }}" id="home-menu">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>{{ __('Dashboard') }}</span>
                            </a>
                        </li>



                        @can(['access_permission', 'access_role', 'access_subrole', 'access_user'])
                            <li class="nav-item">
                                <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseUserManagement" role="button"
                                   aria-expanded="false" aria-controls="collapseUserManagement">
                                    <i class="fas fa-users"></i>
                                    <span>{{ __('User Management') }}</span>
                                </a>

                                <ul class="list-group collapse" id="collapseUserManagement">

                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('permissions.index') }}" id="permissions-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Permissions') }}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('roles.index') }}" id="roles-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Roles') }}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('subroles.index') }}" id="subroles-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Sub Roles') }}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('users.index') }}" id="users-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('All Users') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endcan

                        @can(['access_company'])
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('companies.index') }}" id="companies-menu">
                                    <i class="fas fa-building"></i>
                                    <span>{{ __('Companies') }}</span>
                                </a>
                            </li>
                        @endcan

                        @canany(['access_contact', 'access_account'])
                            <li class="nav-item">
                                <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseContactsAccounts"
                                   role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-address-book"></i>
                                    <span>{{ __('Contacts & Accounts') }}</span>
                                </a>
                                <ul class="list-group collapse" id="collapseContactsAccounts">
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('contacts.index') }}" id="contacts-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Contacts') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('accounts.index') }}" id="accounts-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Accounts') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('media-library.index') }}" id="media-library-menu">
                                <i class="fas fa-photo-video"></i>
                                <span>{{ __('Media Library') }}</span>
                            </a>
                        </li>


                        @includeIf('emailmarketing::menu')
                        @includeIf('crm::menu')
                        @includeIf('mailbox::menu')
                        @includeIf('support::menu')
                        @includeIf('website::menu')
                        @includeIf('blog::menu')


                        {{-- @include("event::menu") --}}
                        {{-- @include("chat::menu") --}}

                        @can(['manage_location'])
                            <li class="nav-item">
                                <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseLocations" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ __('Locations') }}</span>
                                </a>
                                <ul class="list-group collapse" id="collapseLocations">
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('countries.index') }}" id="countries-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Countries') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('states.index') }}" id="states-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('States') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('cities.index') }}" id="cities-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Cities') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('zones.index') }}" id="zones-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Zones') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @canany(['manage_setting'])
                            <li class="nav-item">
                                <a class="nav-link text-white" data-bs-toggle="collapse" href="#collapseSettings" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-cogs"></i>
                                    <span>{{ __('Settings') }}</span>
                                </a>
                                <ul class="list-group collapse" id="collapseSettings">
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('settings.general') }}" id="settings-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('General Settings') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('commission.settings') }}" id="settings-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Commission Settings') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('withdraw.settings') }}" id="settings-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Withdraw Settings') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('features.settings') }}" id="features-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Features') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('currencies.index') }}"
                                           id="currencies-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Currencies') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('languages.index') }}" id="languages-menu">
                                            <i class="fas fa-circle invisible"></i>
                                            <span>{{ __('Languages') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany
                    </ul>
                </div>
            </aside>
            <section id="main-content">
                <div class="container-fluid my-3">
                    @yield('content')
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {

            const route = @json(request()->route()->getName()).split(".")[0];
            $(`#${route}-menu`).addClass("active");
            $(`#${route}-menu`).parent().parent().addClass("show");
            $(`#${route}-menu`).parent().parent().prev().attr("aria-expanded", true);

            const mainSidebar = $("#main-sidebar");
            const activeMenu = mainSidebar.find(".active");
            document.getElementById(activeMenu.attr('id')).scrollIntoView();

        });
    </script>

    @include('core::partials.toastr')

    {{-- ---------------------------------- VUE SCRIPTS --------------------------------------- --}}
    <script>
        let vdata = {};
        let vcreated = {};
        let vmounted = {};
        let vmethods = {};
        let vdestroyed = {};
    </script>

    @stack('body_scripts')


    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script type="text/javascript">
        const app = new Vue({
            el: '#app',
            data: vdata,
            created() {
                Object.keys(vcreated).forEach(method => {
                    vcreated[method]();
                });
            },
            mounted() {
                Object.keys(vmounted).forEach(method => {
                    vmounted[method]();
                });
            },
            destroyed() {
                Object.keys(vdestroyed).forEach(method => {
                    vdestroyed[method]();
                });
            },
            methods: {
                ...vmethods,
            },
        });
    </script>
    {{-- ---------------------------------- End of VUE SCRIPTS --------------------------------------- --}}

</body>

</html>
