<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __("Reset Password") }}</title>
        <meta name="description" content="Reset Password">
        <meta name="keywords" content="login,authentication,admin">


        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />

    </head>

    <body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
        <div class="c-app flex-row align-items-center" id="app">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">

                        <div class="card my-5" v-cloak>

                            <h4 class="mt-4 text-center">{{ __('Password Reset') }}</h4>

                            <div class="card-body">
                                <form method="post" @submit.prevent="submitForm">

                                    @csrf

                                    <div class="mb-3">
                                        <label class="required" for="email">{{ __('Email') }}</label>
                                        <input class="form-control" type="email" name="email" id="email" readonly
                                            :class="{ 'is-invalid': errors.email }" v-model="form.email">
                                        <div class="invalid-feedback">@{{ errors.email }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="required" for="password">{{ __('Password') }}</label>
                                        <input class="form-control " type="password" name="password" id="password"
                                            autocomplete="new-password" :class="{ 'is-invalid': errors.password }"
                                            v-model="form.password">
                                        <div class="invalid-feedback">@{{ errors.password }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="required"
                                            for="password_confirmation">{{ __('Password Confirmation') }}</label>
                                        <input class="form-control " type="password" name="password_confirmation"
                                            id="password_confirmation" autocomplete="new-password"
                                            :class="{ 'is-invalid': errors.password_confirmation }"
                                            v-model="form.password_confirmation">
                                        <div class="invalid-feedback">@{{ errors.password_confirmation }}</div>
                                    </div>

                                    <div class="text text-success mb-3" v-if="response">@{{ response }}</div>

                                    <div class="text text-danger mb-3" v-if="errors.message">@{{ errors.message }}</div>
                                    <div class="text text-danger mb-3" v-if="errors.token">@{{ errors.token }}</div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary" :disabled="loading">
                                            <i v-if="loading" class="fas fa-spinner fa-spin"></i>
                                            <span>{{ __('Reset Password') }}</span>
                                        </button>
                                    </div>

                                </form>

                                <div class="text-center mt-3">
                                    <a href="{{ route("admin.login") }}" class="text-primary">{{ __("Back to Login") }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript">
    const app = new Vue({
        el: '#app',
        data: {
            form: {
                email: "{{ request('email') }}",
                password: '',
                password_confirmation: '',
                token: "{{ request('token') }}"
            },
            errors: {},
            loading: false,
            response: null
        },
        methods : {
            async submitForm() {

try {

    this.loading = true;
    this.errors = {};
    this.response = "";
    const res = await axios.post("{{ route('api.password.reset') }}", this.form);
    this.loading = false;
    this.response = "Password Reset Successfully";

} catch (e) {

    if (e.response && e.response.status == 422) {
        for (const [key, value] of Object.entries(e.response.data.errors)) {
            this.errors[key] = value[0];
        }
    } else {
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

