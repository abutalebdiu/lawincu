
@extends("layouts.app")

@section("content")
<div class="c-app flex-row align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto  my-5">
                <div class="card" v-cloak>
                    <div class="card-header">{{ __('Email Verification') }}</div>
                    <div class="card-body">
                        {{-- <form @submit.prevent="verifyEmail">
                            <div class="mb-3">
                                <label for="verification_code">{{ __('Verification Code') }}</label>
                                <input class="form-control" type="text" name="verification_code" id="verification_code"
                                    :class="{ 'is-invalid': errors.verification_code }" v-model="form.verification_code">
                                <div class="invalid-feedback">@{{ errors.verification_code }}</div>
                            </div>

                            <div class="text text-success mb-3" v-if="response">@{{ response }}</div>

                            <div class="text-center">

                                <button type="submit" class="btn btn-primary px-3" :disabled="loading">
                                    <i v-if="loading" class="fas fa-spinner fa-spin"></i>
                                    <span>{{ __('Verify') }}</span>
                                </button>

                            </div>
                        </form> --}}
                        <div v-if="loading" class="text-center">
                            <i class="fas fa-spinner fa-spin" style="font-size: 22px;"></i>
                        </div>
                        <div v-else>
                            <div class="alert alert-success" v-if="response">@{{ response }}</div>
                            <div v-else class="text-center">
                                {{ __("An Verification mail has been sent to your email address. Please check your Inbox.") }}
                            </div>
                            @if (request("signature"))
                                <p v-if="errors.message" class="text-center text-danger">@{{ errors.message }}</p>
                            @endif
                        </div>
                        <div class="text-center">
                            {{-- <a href="{{ route('login') }}" class="btn btn-outline-primary">{{ __('Wholesaler Login') }}</a>
                            <a href="{{ route('supplier.login') }}" class="btn btn-outline-primary">{{ __('Factory Login') }}</a> --}}
                            <a href="{{ route("verification.resend") }}" class="btn btn-outline-primary mt-3" :class="loading ? 'disabled' : ''">{{ __("Resend Verification Mail") }}</a>
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
        errors: {},
        response: null,
        loading: false,
    }


    vmethods = {
        ...vmethods,
        async verifyEmail() {

            try {

                vdata.loading = true;
                const response = await axios.post(
                    "{{ route('api.verification.verify', [request('user')]) }}" +
                    "?{!! http_build_query(request()->all()) !!}", {
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        }
                    });

                window.location.reload();
                // console.log(response.data);
                // vdata.response = "Email Verfied Successfully";
                // vdata.loading = false;
            } catch (e) {

                if (e.response.status == 422) {
                    for (const [key, value] of Object.entries(e.response.data.errors)) {
                        vdata.errors[key] = value[0];
                    }
                } else {
                    toastr.error("Something Wen't Wrong!");
                }
                vdata.loading = false;
            }

        }


    }

    vcreated = {
        ...vcreated,
        run: function(){
            vmethods.verifyEmail();
        }
        // function key: function(){}

    }

    vmounted = {
        ...vmounted,
        // function key: function(){}
    }
</script>


@endpush
