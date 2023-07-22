<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Verify Email') }}</title>
    <meta name="description" content="Verify Email">
    <meta name="keywords" content="login,authentication,admin">


    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />

</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    <div class="c-app flex-row align-items-center" id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto  my-5">
                    <div class="card" v-cloak>
                        <div class="card-header">{{ __('verify') }}</div>
                        <div class="card-body">
                            <div class="alert" :class="success ? 'alert-success' : 'alert-danger'"
                                v-if="response">@{{ response }}</div>
                            <div class="text-center">
                                <a href="{{ route('admin.login') }}" class="btn btn-primary">{{ __('Login Now') }}</a>
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
                response: null,
                success: false
            },
            created() {
                this.verifyEmail();
            },
            methods: {
                async verifyEmail() {

                    try {

                        const response = await axios.post(
                            "{{ route('api.verification.verify', [request('user')]) }}" +
                            "?{!! http_build_query(request()->all()) !!}");
                        this.success = true;
                        this.response = "Email Verfied Successfully";
                    } catch (e) {
                        if (e.response.status == 422) {
                            this.success = false;
                            this.response = e.response.data.errors.message[0];
                        } else {
                            toastr.error("Something Wen't Wrong!");
                        }
                    }

                }
            },
        });
    </script>

    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }

        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
