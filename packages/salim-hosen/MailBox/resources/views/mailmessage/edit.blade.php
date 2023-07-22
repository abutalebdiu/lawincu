@extends("core::layouts.admin")

@section('title', '')

@section('meta_tags')
    <title>{{ __("Edit Mailmessage") }}</title>
    <meta name="description" content="Mailmessage Edit">
    <meta name="keywords" content="mailmessage,mailmessage_edit">
@endsection

@section('content')

    <div class="card">
        <div class="card-body">

            <form @submit.prevent="submitForm" action="{{ route('companies.store') }}" method="POST">
                @csrf

                <div>
                    <div class="text-center mb-3">
                        <div>
                            <img width="80" :src="logo_url" alt="" class="img-fluid" v-if="logo_url" />
                            <div class="border p-4" style="width: 100px; margin: 0 auto;" v-else>
                                <i class="fas fa-image display-6"></i>
                            </div>
                        </div>
                        <label for="imgupload" class="btn btn-sm btn-primary mt-3">
                            <input @change.prevent="handleImage" type="file" id="imgupload" hidden="hidden" name="photo">
                            {{ __('Upload Logo') }}
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="required" for="name">{{ __('Company Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control"
                            :class="{ 'is-invalid': errors.name }" v-model="form.name">
                        <div v-cloak class="invalid-feedback">@{{ errors.name }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="required" for="email">{{ __('Email') }}</label>
                        <input type="text" name="email" id="email" class="form-control "
                            :class="{ 'is-invalid': errors.email }" v-model="form.email">
                        <div v-cloak class="invalid-feedback">@{{ errors.email }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="required" for="phone">{{ __('Phone') }}</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            :class="{ 'is-invalid': errors.phone }" v-model="form.phone">
                        <div v-cloak class="invalid-feedback">@{{ errors.phone }}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="required">{{ __('Country') }}</label>
                                <select name="country" id="country" class="form-control"
                                    :class="{ 'is-invalid': errors.country }" v-model="form.country"
                                    @change.prevent="fetchStates">
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <div v-cloak class="invalid-feedback">@{{ errors.country }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="mb-3">
                                <label class="required">{{ __('State') }}</label>
                                <select name="state" id="state" class="form-control"
                                    :class="{ 'is-invalid': errors.state }" v-model="form.state">
                                    <option value="">{{ __('Select State') }}</option>
                                    <option v-for="state in states" :key="state.id" :value="state.id">@{{ state.name }}
                                    </option>
                                </select>
                                <div v-cloak class="invalid-feedback">@{{ errors.state }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="mb-3">
                                <label class="required">{{ __('City') }}</label>
                                <input type="text" name="city" id="city" class="form-control"
                                    :class="{ 'is-invalid': errors.city }" v-model="form.city">
                                <div v-cloak class="invalid-feedback">@{{ errors.city }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="mb-3">
                                <label class="required">{{ __('Zip Code') }}</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control"
                                    :class="{ 'is-invalid': errors.zip_code }" v-model="form.zip_code">
                                <div v-cloak class="invalid-feedback">@{{ errors.zip_code }}</div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="required" for="address">{{ __('Address') }}</label>
                        <textarea name="address" id="" cols="30" rows="3" class="form-control" :class="{ 'is-invalid': errors.address }"
                            v-model="form.address"></textarea>
                        <div v-cloak class="invalid-feedback">@{{ errors.address }}</div>
                    </div>

                    <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-primary" :disabled="creating">
                            <i v-cloak v-if="creating" class="fas fa-spinner fa-spin"></i>
                            <span>{{ __('Update') }}</span>
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


@push('body_scripts')
    <script>
        vdata = {
            ...vdata,
            form: {
                id: @json($company->id),
                _method: "PUT",
                logo: '',
                name: @json($company->name),
                email: @json($company->email),
                phone: @json($company->phone),
                country: @json($company->country_id),
                state: @json($company->state_id),
                address: @json($company->address),

                main_products: @json($company->main_products),
                business_type: @json($company->business_type),
                number_of_employees: @json($company->number_of_employees),
                year_of_establishment: @json($company->year_of_establishment),
                average_lead_time: @json($company->average_lead_time),
                company_size: @json($company->company_size),
                description: @json($company->company_description),

                trade_license: @json($company->trade_license),
                nid: @json($company->nid),

            },
            errors: {},
            updating: false,
            response: null,
            states: @json($states)
        }

        vmethods = {
            ...vmethods,
            async submitForm() {

                try {

                    this.updating = true;
                    this.errors = {};

                    const formData = new FormData();
                    Object.keys(this.form).forEach(key => {
                        formData.append(key, this.form[key]);
                    });

                    const res = await axios.post("{{ route('companies.update', $company->id) }}", formData);
                    this.updating = false;
                    window.location.href = "{{ route('companies.index') }}";

                } catch (e) {

                    if (e.response && e.response.status == 422) {
                        for (const [key, value] of Object.entries(e.response.data.errors)) {
                            this.errors[key] = value[0];
                        }
                    } else {
                        toastr.error("Something Wen't Wrong!");
                    }

                    this.updating = false;

                }

            },
            async fetchStates(e) {
                try {
                    const response = await axios.get("/api/v1/{{ app()->getLocale() }}/states?country_id=" + e
                        .target.value);
                    this.states = response.data.data;
                } catch (err) {
                    console.log(err);
                    // this.toast("Something Wen't Wrong!", "error");
                }
            }
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
