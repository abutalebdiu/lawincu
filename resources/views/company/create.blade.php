<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('lang_dir') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Asoug - Create Company') }}</title>
    <meta name="description" content="User can become supplier by creating company">
    <meta name="keywords" content="create,compnay, company create">

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .upload-button {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 2px dashed #bbb;
            padding: 10px;
            cursor: pointer;
        }

        .upload-button i{
            font-size: 2rem;
            color: #ddd
        }

        .upload-button p{
            color: #888;
        }
        .pointer{
            cursor: pointer;
        }
    </style>
</head>

<body class="antialiased">

    <div id="app" style="overflow: hidden; background: #eee">


        <header class="header-area">

            <div class="navbar-area bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <div class="logo">
                                    <a href="{{ route('welcome') }}">
                                        <img width="100"
                                            src="{{ asset(config('settings.logo') ? 'asougexpress/images/' . config('settings.logo') : 'asougexpress/images/logo-primary.png') }}"
                                            alt="Site Logo">
                                    </a>
                                </div>
                                <div>
                                    <a class="btn btn-outline-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">

                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto my-5">

                    @if ($company)
                        <div class="card text-center">
                            <div class="card-body">
                                <h2>{{ __("Waiting for Admin Approval") }}</h2>
                                <p>{{ __("Your account is reviewing by an Admin. It will be activated soon.") }}</p>
                                <a class="btn btn-outline-primary" href="{{ route("welcome") }}">{{ __("Back to Home page") }}</a>
                            </div>
                        </div>
                    @else

                        <div class="card mb-3">
                            <div class="card-body p-2">
                                <div >
                                    @php
                                        $step = request('step') ?: 1;
                                    @endphp
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                        <a class="nav-link" :class="{'active': form.step == 1}" aria-current="page" href="#">{{ __("Basic Info") }}</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" :class="{'active': form.step == 2}" href="#">{{ __('More Details') }}</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" :class="{'active': form.step == 3}" href="#">{{ __("Documents") }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">

                                <form @submit.prevent="submitForm" action="{{ route('companies.store') }}" method="POST">
                                    @csrf

                                    <div v-show="form.step == 1">
                                        <div class="text-center mb-3">
                                            <div v-if="logo_url">
                                                <label for="imgupload">
                                                    <input @change.prevent="handleImage" type="file" id="imgupload" hidden="hidden" name="photo">
                                                    <img width="140" :src="logo_url" alt="" class="img-fluid pointer"/>
                                                </label>
                                            </div>
                                            {{-- <label for="imgupload" class="btn btn-sm btn-primary mt-3">
                                                <input @change.prevent="handleImage" type="file" id="imgupload" hidden="hidden" name="photo">
                                                {{ __('Upload Logo') }}
                                            </label> --}}
                                            <div class="mb-3" v-else>
                                                <label class="upload-button" for="imgupload" data-bs-toggle="modal" data-bs-target="#fileUploaderModal">
                                                    <input @change.prevent="handleImage" type="file" id="imgupload" hidden="hidden" name="photo">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <p class="mt-2">{{ __('Upload Logo') }}</p>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="name">{{ __('Company Name') }}</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                :class="{ 'is-invalid': errors.name }" v-model="form.name" @blur="convertToSlug">
                                            <div v-cloak class="invalid-feedback">@{{ errors.name }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="company_url" class="form-label">{{ __("Company URL") }}</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="app-url">{{ config("app.url") }}/company/</span>
                                                <input type="text" name="company_url" id="company_url" class="form-control"
                                                :class="{ 'is-invalid': errors.company_url }" v-model="form.company_url">
                                                <div v-cloak class="invalid-feedback">@{{ errors.company_url }}</div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="email">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="email" class="form-control "
                                                :class="{ 'is-invalid': errors.email }" v-model="form.email">
                                            <div v-cloak class="invalid-feedback">@{{ errors.email }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="mobile_number">{{ __('Mobile Number') }}</label>
                                            <input type="text" name="mobile_number" id="mobile_number" class="form-control" :class="{ 'is-invalid': errors.mobile_number }" v-model="form.mobile_number">
                                            <div v-cloak class="invalid-feedback">@{{ errors.mobile_number }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="phone">{{ __('Phone') }}</label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                :class="{ 'is-invalid': errors.phone }" v-model="form.phone">
                                            <div v-cloak class="invalid-feedback">@{{ errors.phone }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="required">{{ __('Country') }}</label>
                                                    <select name="country" id="country" class="form-control"
                                                        :class="{ 'is-invalid': errors.country }" v-model="form.country"
                                                        @change.prevent="fetchStates">
                                                        <option value="">{{ __('Select Country') }}</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div v-cloak class="invalid-feedback">@{{ errors.country }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label class="required">{{ __('State') }}</label>
                                                    <select name="state" id="state" class="form-control"
                                                        :class="{ 'is-invalid': errors.state }" v-model="form.state">
                                                        <option value="">{{ __('Select State') }}</option>
                                                        <option v-for="state in states" :key="state.id"
                                                            :value="state.id">@{{ state.name }}</option>
                                                    </select>
                                                    <div v-cloak class="invalid-feedback">@{{ errors.state }}</div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label class="required" for="address">{{ __('Address') }}</label>
                                            <textarea name="address" id="" cols="30" rows="3" class="form-control" :class="{ 'is-invalid': errors.address }"
                                                v-model="form.address"></textarea>
                                            <div v-cloak class="invalid-feedback">@{{ errors.address }}</div>
                                        </div>

                                        <small class="text-danger" v-if="errors.logo">@{{ errors.logo }}</small>

                                        <div class="mb-3 mt-3">
                                            <div class="d-flex justify-content-between">
                                                <div></div>
                                                <button type="submit" class="btn btn-primary" :disabled="creating">
                                                    <i v-cloak v-if="creating" class="fas fa-spinner fa-spin"></i>
                                                    <span>{{ __('Next') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-show="form.step == 2">
                                        <div class="mb-3">
                                            <label class="required"
                                                for="main_products">{{ __('Main Products') }}</label>
                                            <input class="form-control" type="text" name="main_products" id="main_products"
                                                :class="{ 'is-invalid': errors.main_products }" v-model="form.main_products">
                                            <div v-cloak class="invalid-feedback">@{{ errors.main_products }}</div>
                                        </div>

                                        <div class="mb-3 mb-3">
                                            <label for="business_type">{{ __('Business Type') }}</label>
                                            <select name="business_type" class="form-select" id="business_type"
                                                :class="{ 'is-invalid': errors.business_type }" v-model="form.business_type">
                                                <option value="">{{ __('Select Business Type') }}</option>
                                                <option value="Factory">{{ __('Factory') }}</option>
                                                <option value="Wholesaler">{{ __('Wholesaler') }}</option>
                                                <option value="Trading Company">{{ __('Trading Company') }}</option>
                                            </select>
                                            <div v-cloak class="invalid-feedback">@{{ errors.business_type }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="required"
                                                        for="email">{{ __('Number of Employees') }}</label>
                                                    <input class="form-control" type="text" name="number_of_employees"
                                                        id="number_of_employees"
                                                        :class="{ 'is-invalid': errors.number_of_employees }"
                                                        v-model="form.number_of_employees">
                                                    <div v-cloak class="invalid-feedback">@{{ errors.number_of_employees }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="required"
                                                        for="year_of_establishment">{{ __('Year of Establishment') }}</label>
                                                    <input class="form-control" type="text" name="year_of_establishment"
                                                        id="year_of_establishment"
                                                        :class="{ 'is-invalid': errors.year_of_establishment }"
                                                        v-model="form.year_of_establishment">
                                                    <div v-cloak class="invalid-feedback">@{{ errors.year_of_establishment }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label class="required"
                                                for="average_lead_time">{{ __('Average Lead Time') }}</label>
                                            <input class="form-control" type="text" name="average_lead_time"
                                                id="average_lead_time" :class="{ 'is-invalid': errors.average_lead_time }"
                                                v-model="form.average_lead_time">
                                            <div v-cloak class="invalid-feedback">@{{ errors.average_lead_time }}</div>
                                        </div> --}}

                                        <div class="mb-3">
                                            <label class="required" for="company_size">{{ __('Company Size') }}</label>
                                            <input class="form-control" type="text" name="company_size" id="company_size"
                                                :class="{ 'is-invalid': errors.company_size }" v-model="form.company_size">
                                            <div v-cloak class="invalid-feedback">@{{ errors.company_size }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="commercial_registration_number">{{ __('Commercial Registration Number') }}</label>
                                            <input class="form-control" type="text" name="commercial_registration_number" id="commercial_registration_number"
                                                :class="{ 'is-invalid': errors.commercial_registration_number }" v-model="form.commercial_registration_number">
                                            <div class="invalid-feedback">@{{ errors.commercial_registration_number }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="tax_number">{{ __('Tax Number') }}</label>
                                            <input class="form-control" type="text" name="tax_number" id="tax_number"
                                                :class="{ 'is-invalid': errors.tax_number }" v-model="form.tax_number">
                                            <div class="invalid-feedback">@{{ errors.tax_number }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="description">{{ __('Description') }}</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="5"
                                                :class="{ 'is-invalid': errors.description }"
                                                v-model="form.description"></textarea>
                                            <div v-cloak class="invalid-feedback">@{{ errors.description }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="text text-primary"
                                                    @click.prevent="form.step=1">{{ __('Back') }}</a>
                                                <button type="submit" class="btn btn-primary" :disabled="creating">
                                                    <i v-cloak v-if="creating" class="fas fa-spinner fa-spin"></i>
                                                    <span>{{ __('Next') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-show="form.step == 3">
                                        {{-- <div class="mb-3">
                                            <label class="required">{{ __('Trade License') }}</label>
                                            <input @change.prevent="e => form.trade_license = e.target.files[0]"
                                                class="form-control" type="file" id="trade_license"
                                                :class="{ 'is-invalid': errors.trade_license }">
                                            <div v-cloak class="invalid-feedback">@{{ errors.trade_license }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required" for="nid">{{ __('NID or Passport') }}</label>
                                            <input @change.prevent="e => form.nid = e.target.files[0]" class="form-control"
                                                type="file" id="nid" :class="{ 'is-invalid': errors.nid }">
                                            <div v-cloak class="invalid-feedback">@{{ errors.nid }}</div>
                                        </div> --}}

                                        <div class="mb-3">
                                            <label class="required" >{{ __('Commercial Register Document') }}</label>
                                            <input @change.prevent="e => form.commercial_register_document = e.target.files[0]" class="form-control" type="file" id="commercial_register_document" :class="{ 'is-invalid': errors.commercial_register_document }" >
                                            <div v-cloak class="invalid-feedback">@{{ errors.commercial_register_document }}</div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="text text-primary"
                                                @click.prevent="form.step=2">{{ __('Back') }}</a>
                                            <button type="submit" class="btn btn-primary" :disabled="creating">
                                                <i v-cloak v-if="creating" class="fas fa-spinner fa-spin"></i>
                                                <span>{{ __('Next') }}</span>
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script type="text/javascript">
        const app = new Vue({
            el: '#app',
            data: {
                form: {
                    step: 1,
                    logo: '',
                    name: '',
                    company_url: '',
                    email: '',
                    phone: '',
                    mobile_number: '',
                    country: '',
                    state: '',
                    address: '',

                    main_products: '',
                    business_type: @json(Auth::user()->business_type ?? ""),
                    number_of_employees: '',
                    year_of_establishment: '',
                    // average_lead_time: '',
                    company_size: '',
                    description: '',
                    commercial_registration_number: @json(Auth::user()->commercial_registration_number),
                    tax_number: @json(Auth::user()->tax_number),

                    // trade_license: '',
                    // nid: '',
                    commercial_register_document: ''

                },
                errors: {},
                creating: false,
                response: null,
                states: [],
                logo_url: null
            },
            methods: {
                async submitForm() {

                    try {

                        this.creating = true;
                        this.errors = {};

                        this.form.description = tinymce.activeEditor.getContent();
                        const formData = new FormData();
                        Object.keys(this.form).forEach(key => {
                            formData.append(key, this.form[key]);
                        });
                        const res = await axios.post("{{ route('company-setup.store') }}", formData);

                        if (res.data.step)
                            this.form.step = parseInt(res.data.step);
                        else if (res.data.success)
                            window.location.href="{{ route('home.supplier') }}";

                        this.creating = false;

                    } catch (e) {

                        if (e.response && e.response.status == 422) {
                            for (const [key, value] of Object.entries(e.response.data.errors)) {
                                this.errors[key] = value[0];
                            }
                        } else {
                            toastr.error("error", "Something Wen't Wrong!");
                        }

                        this.creating = false;

                    }

                },
                async fetchStates(e) {
                    try {
                        const response = await axios.get("/states?country_id=" + e.target.value);
                        this.states = response.data.data;
                    } catch (err) {
                        console.log(err);
                        // this.toast("Something Wen't Wrong!", "error");
                    }
                },
                async handleImage(event) {
                    const file = event.target.files[0];
                    this.form.logo = file;
                    this.logo_url = URL.createObjectURL(file);
                },
                convertToSlug() {
                    const slug = this.form.name.toLowerCase()
                            .replace(/ /g, '-')
                            .replace(/[^\w-]+/g, '');
                    this.form.company_url = slug;
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

<script src="https://cdn.tiny.cloud/1/uk57kx8225bu90dgs5yav45m4xtqeohx6okmiaiiukd893pr/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>

<script>
tinymce.init({
    selector: '#description',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
});
</script>

    @yield('scripts')

</body>

</html>
