
@extends("layouts.app")

@section("content")
<div class="c-app flex-row align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto my-5">
                <div class="card" v-cloak>
                    <div class="card-header">{{ __('Resend') }}</div>

                    <div class="card-body">

                        <form @submit.prevent="submitForm">

                            <div class="mb-3">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input class="form-control" type="email" name="email" id="email"
                                    :class="{ 'is-invalid': errors.email }" v-model="form.email" @if(Auth::user()?->email) readonly @endif>
                                <div class="invalid-feedback">@{{ errors.email }}</div>
                            </div>

                            <div class="text text-success mb-3" v-if="response">@{{ response }}</div>

                            <div class="text-center">

                                <button type="submit" class="btn btn-primary" :disabled="loading">
                                    <i v-if="loading" class="fas fa-spinner fa-spin"></i>
                                    <span>{{ __('Resend Verification Mail') }}</span>
                                </button>

                            </div>
                        </form>
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
            email: @json(Auth::user()->email ?? ""),
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
                const res = await axios.post("{{ route('api.verification.resend') }}", this.form);
                this.response = "Verification code resent";
                this.loading = false;

            } catch (e) {

                if (e.response.status == 422) {
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
