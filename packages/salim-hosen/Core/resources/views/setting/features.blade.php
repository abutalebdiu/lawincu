@extends('core::layouts.admin')

@section("meta_tags")
<title>{{ __("Shipping Method List") }}</title>
    <meta name="description" content="Method List and Manage Method Details">
    <meta name="keywords" content="method,method_edit">
@endsection

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-center p-3">
                        <i class="fas fa-shipping-fast h2"></i>
                    </div>
                    {{-- <label for="">{{ __("Company Delivery Setting") }}</label> --}}
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="allow_company_to_ship" type="checkbox" v-model="form.allow_company_to_ship" @change="submitForm">
                        <label class="form-check-label" >{{ __("Allow Supplier to Ship") }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-center p-3">
                        <i class="fas fa-envelope h2"></i>
                    </div>
                    {{-- <label for="">{{ __("Company Delivery Setting") }}</label> --}}
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="user_must_verify_email" type="checkbox" v-model="form.user_must_verify_email" @change="submitForm">
                        <label class="form-check-label" >{{ __("User Must Verify Email") }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="mb-3">
                    <div class="text-center p-3">
                        <i class="fas fa-box-open h2"></i>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="apply_shipping_cost_on" id="product" value="product" v-model="form.apply_shipping_cost_on" @change="submitForm">
                        <label class="form-check-label" for="product">{{ __("Apply Shipping Cost Each Product") }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="apply_shipping_cost_on" id="cart" value="cart" v-model="form.apply_shipping_cost_on" @change="submitForm">
                        <label class="form-check-label" for="cart">{{ __("Apply Shipping Cost on Cart") }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@push('body_scripts')
    <script>
        vdata = {
            ...vdata,
            form: {
                allow_company_to_ship: @json($setting['allow_company_to_ship'] ?? "") == "true" ? true : false,
                user_must_verify_email: @json($setting['user_must_verify_email'] ?? "") == "true" ? true : false,
                apply_shipping_cost_on: @json($setting['apply_shipping_cost_on'] ?? ""),
                _method: "PUT"
            },
            errors: {},
            submitting: false,
            response: null,
        }

        vmethods = {
            ...vmethods,
            async submitForm() {

                try {

                    this.submitting = true;
                    this.errors = {};

                    const formData = new FormData();
                    Object.keys(this.form).forEach(key => {
                        formData.append(key, this.form[key]);
                    });

                    const res = await axios.post("{{ getAuthRole() == 'admin' ? route('api.settings.general') : route('api.company.settings.update') }}", formData, {
                        headers: {
                            "x-role": "{{ getAuthRole() }}"
                        }
                    });
                    this.submitting = false;
                    toastr.success("Updated Successfuly!");

                } catch (e) {

                    if (e.response && e.response.status == 422) {
                        for (const [key, value] of Object.entries(e.response.data.errors)) {
                            this.errors[key] = value[0];
                        }
                    } else {
                        toastr.error("Something Wen't Wrong!");
                    }

                    this.submitting = false;

                }

            },
        }

        vcreated = {
            ...vcreated
            // function key: function(){}
        }

        vmounted = {
            ...vmounted,
            // function key: function(){}
        }
    </script>
@endpush
