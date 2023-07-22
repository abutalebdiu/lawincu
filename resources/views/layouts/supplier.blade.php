<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Scripts -->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container-fluid">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                        <li class="breadcrumb-item"><a href="{{ route("welcome") }}">{{ __("Home") }}</a></li>
                        <li class="breadcrumb-item active">{{ __("Account") }}</li>
                    </ol>
                    </nav>
                </div>
                <div class="row ">
                    <div class="col-md-3">
                        @php
                        $routename = request()->route()->getName();
                        @endphp

                        <div class="d-flex flex-column flex-shrink-0 p-3 bg-white mb-3">

                            <h6 class="ember-bold">{{ __("Account") }}</h6>

                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                    <a href="{{ route('home') }}" class="nav-link link-dark {{ $routename == 'home' ? 'active' : '' }}" aria-current="page">
                                    <i class="fas fa fa-tachometer-alt"></i>
                                        <span class="mx-1"></span>
                                        <span>{{ __("Dashboard") }}</span>
                                    </a>
                                </li>

                                <li>

                                    <a class="nav-link link-dark" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span class="mx-1"></span>
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-9">
                        @yield("content")
                    </div>
                </div>
            </div>
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
     {{-- ---------------------------------- VUE SCRIPTS --------------------------------------- --}}
   <script>
    let vdata = {
        cartCount: 0,
    };
    let vcreated = {};
    let vmounted = {};
    let vmethods = {};
    let vdestroyed = {};
</script>

@stack("body_scripts")


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
            this.fetchCartCount();
        },
        mounted() {
            Object.keys(vmounted).forEach(method => {
                vmounted[method]();
            });
        },
        destroyed(){
            Object.keys(vdestroyed).forEach(method => {
                vdestroyed[method]();
            });
        },
        methods: {
            ...vmethods,
            async fetchCartCount(){
                try{

                    const temporary_id = "{{ session("unique_id") }}";
                    const response = await axios.get(`/api/v1/cart-count?temporary_id=${temporary_id}`);
                    this.cartCount = response.data.data;

                }catch(err){
                    console.log(err);
                }
            }
        },
    });
</script>
{{-- ---------------------------------- End of VUE SCRIPTS --------------------------------------- --}}
</body>
</html>
