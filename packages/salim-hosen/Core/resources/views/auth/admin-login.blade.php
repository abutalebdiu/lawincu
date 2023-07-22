<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('lang_dir') }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __("Admin Login") }}</title>
        <meta name="description" content="Admin Login">
        <meta name="keywords" content="login,authentication,admin">


        <link href="{{ asset("css/bootstrap.css") }}" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />

        <style>
            html, body{
                height: 100%;
            }
            body{
                background-color: #F8FAFC;
                /* font-family: 'Inter', sans-serif; */
            }
        </style>
    </head>

    <body class="{{ session('lang_dir') }}">
        <div class="position-relative ps-5">
            <div class="position-absolute right-0">
                <x-core-query-lang-selector></x-core-query-lang-selector>
            </div>
        </div>
        <div id="app" class="h-100">
            <div class="container h-100">
                <div class="row h-100 d-flex align-items-center justify-content-center">

                    <div class="col-md-4 mx-auto" v-cloak>
                        <h2 class="text-center">{{ __("Login") }}</h2>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.login') }}" @submit.prevent="submitForm">
                                    @csrf
                                <div class="mb-3">
                                    <label for="">{{ __("Email") }}</label>
                                    <input class="form-control" type="email" name="email" id="email" placeholder="{{ __('Email Address') }}" :class="{ 'is-invalid': errors.email }" v-model="form.email">
                                    <div class="invalid-feedback">@{{ errors.email }}</div>
                                </div>
                                <div class="mb-3">
                                    <label for="">{{ __("Password") }}</label>
                                    <div class="position-relative">
                                        <input class="form-control" :type="show_password == true ? 'text' : 'password'" name="password" id="password" placeholder="{{ __("Password") }}"  autocomplete="new-password" :class="{ 'is-invalid': errors.password }" v-model="form.password">
                                        <div class="password-eye">
                                            <i :class="`fas ${show_password == true ? 'fa-eye' : 'fa-eye-slash'}`" role="button" @click="show_password=!show_password"></i>
                                        </div>
                                    </div>
                                    <div class="text-danger text-small">@{{ errors.password }}</div>
                                </div>
                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="form.remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <a href="{{ route('admin.password.request') }}" class="text text-danger">{{ __("Forgot Password") }}</a>
                                </div>

                                <div class="text text-danger mb-3" v-if="errors.message">@{{ errors.message }} <a href="{{ route('admin.verification.resend') }}" v-if="errors.verification">{{ __("Resend Verification Link") }}</a></div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100" :disabled="loading">
                                        <i v-if="loading" class="fas fa-spinner fa-spin"></i>
                                        <span>{{ __("Sign In") }}</span>
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script type="text/javascript">
            const app = new Vue({
                el: '#app',
                data: {
                    form: {
                        email : '',
                        password : '',
                        role: "admin",
                    },
                    errors: {},
                    loading: false,
                    show_password: false,
                    response: null
                },
                methods : {
                    async submitForm() {

                        try{

                            this.loading = true;
                            this.errors = {};
                            this.response = "";
                            const res = await axios.post("{{ route('login') }}", this.form);
                            window.location.reload();

                        }catch(e){

                            if(e.response && e.response.status == 422){
                                for (const [key, value] of Object.entries(e.response.data.errors)) {
                                    this.errors[key] = value[0];
                                }
                            }else{
                                toastr.error("Something Wen't Wrong!");
                            }

                            this.loading = false;

                        }

                    }
                },
            });
        </script>

        <script>

                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }

                @if(Session::has('success'))
                        toastr.success("{{ session('success') }}");
                @endif

                @if(Session::has('error'))
                    toastr.error("{{ session('error') }}");
                @endif

                @if(Session::has('info'))
                    toastr.info("{{ session('info') }}");
                @endif

                @if(Session::has('warning'))
                    toastr.warning("{{ session('warning') }}");
                @endif


        </script>
    </body>
</html>

