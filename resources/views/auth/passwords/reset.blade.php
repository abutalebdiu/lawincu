
@extends("layouts.app")

@section("content")
<div class="c-app flex-row align-items-center" >
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">

                <div class="card my-5" v-cloak>

                    <h4 class="mt-4 text-center">{{ __('Password Reset') }}</h4>

                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post" @submit.prevent="submitForm">

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
                            <a href="{{ route('login') }}" class="text-primary">{{ __('Back to Login') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push("body_scripts")

<script>
    vdata = {
        ...vdata,
        form: {
            email: "{{ request('email') }}",
            password: '',
            password_confirmation: '',
            token: "{{ request('token') }}"
        },
        errors: {},
        loading: false,
        response: null
    }


    vmethods = {
        ...vmethods,
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


    }

    vcreated = {
        ...vcreated,
        // function key: function(){}

    }

    vmounted = {
        ...vmounted,
        // function key: function(){}
    }
</script>


@endpush
