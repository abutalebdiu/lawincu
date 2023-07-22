@extends('core::layouts.admin')


@section('meta_tags')
    <title>{{ __("General Setting") }}</title>
    <meta name="description" content="General List and Manage Currency Details">
    <meta name="keywords" content="general,general_list">
@endsection


@section('content')

    <div class="card">

        <div class="card-header">
            {{ __('Edit Settings') }}
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">

                <div class="row">
                    <div class="col-md-12 py-4">

                        <div class="text-center">
                            <div>
                                <img width="120" :src="logo_url" alt="" class="img-fluid img-thumbnail" />
                            </div>
                            <label for="imgupload" class="btn btn-sm btn-primary mt-3">
                                <input @change.prevent="handleImage" type="file" id="imgupload" hidden="hidden"
                                    name="photo">
                                {{ __('Change Logo') }}
                            </label>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="phone">{{ __('Phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone"
                                :class="{ 'is-invalid': errors.phone }" v-model="form.phone">
                            <div v-cloak class="invalid-feedback">@{{ errors.phone }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="email">{{ __('Email') }}</label>
                            <input class="form-control" type="email" name="email" id="email"
                                :class="{ 'is-invalid': errors.email }" v-model="form.email">
                            <div v-cloak class="invalid-feedback">@{{ errors.email }}</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="required" for="title">{{ __('Title') }}</label>
                            <input class="form-control" type="text" name="title" id="title"
                                :class="{ 'is-invalid': errors.title }" v-model="form.title">
                            <div v-cloak class="invalid-feedback">@{{ errors.title }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="description">{{ __('Description') }}</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control"
                                :class="{ 'is-invalid': errors.description }" v-model="form.description"></textarea>
                            <div v-cloak class="invalid-feedback">@{{ errors.description }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="address">{{ __('Address') }}</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"
                                :class="{ 'is-invalid': errors.address }" v-model="form.address"></textarea>
                            <div v-cloak class="invalid-feedback">@{{ errors.address }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="facebook">{{ __('Facebook') }}</label>
                            <input class="form-control" type="text" name="facebook" id="facebook"
                                :class="{ 'is-invalid': errors.facebook }" v-model="form.facebook">
                            <div v-cloak class="invalid-feedback">@{{ errors.facebook }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="twitter">{{ __('Twitter') }}</label>
                            <input class="form-control" type="text" name="twitter" id="twitter"
                                :class="{ 'is-invalid': errors.twitter }" v-model="form.twitter">
                            <div v-cloak class="invalid-feedback">@{{ errors.twitter }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="linkedin">{{ __('Linkedin') }}</label>
                            <input class="form-control" type="text" name="linkedin" id="linkedin"
                                :class="{ 'is-invalid': errors.linkedin }" v-model="form.linkedin">
                            <div v-cloak class="invalid-feedback">@{{ errors.linkedin }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="pinterest">{{ __('Pinterest') }}</label>
                            <input class="form-control" type="text" name="pinterest" id="pinterest"
                                :class="{ 'is-invalid': errors.pinterest }" v-model="form.pinterest">
                            <div v-cloak class="invalid-feedback">@{{ errors.pinterest }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="android_app_url">{{ __('Android App URL') }}</label>
                            <input class="form-control" type="text" name="android_app_url" id="android_app_url"
                                :class="{ 'is-invalid': errors.android_app_url }" v-model="form.android_app_url">
                            <div v-cloak class="invalid-feedback">@{{ errors.android_app_url }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="ios_app_url">{{ __('IOS App URL') }}</label>
                            <input class="form-control" type="text" name="ios_app_url" id="ios_app_url"
                                :class="{ 'is-invalid': errors.ios_app_url }" v-model="form.ios_app_url">
                            <div v-cloak class="invalid-feedback">@{{ errors.ios_app_url }}</div>
                        </div>
                    </div>

                    {{-- <div class="col-md-6">
                        <div class="mb-3">
                            <label class="required" for="theme">{{ __('Theme') }}</label>
                            <select name="theme" id="theme" class="form-select" v-model="form.theme">
                                <option @if(config('settings.theme') == 'basic') selected @endif value="basic">{{ __("Basic") }}</option>
                                <option @if(config('settings.theme') == 'asoug') selected @endif value="asoug">{{ __("Asoug") }}</option>
                                <option @if(config('settings.theme') == 'asougexpress') selected @endif value="asougexpress">{{ __("Asoug Express") }}</option>
                                <option @if(config('settings.theme') == 'asouggreen') selected @endif value="asouggreen">{{ __("Asoug Green") }}</option>
                                <option @if(config('settings.theme') == 'basariat') selected @endif value="basariat">{{ __("Basariat") }}</option>
                                <option @if(config('settings.theme') == 'beautyincu') selected @endif value="beautyincu">{{ __("Beautyincu") }}</option>
                                <option @if(config('settings.theme') == 'bookincu') selected @endif value="bookincu">{{ __("Bookincu") }}</option>
                                <option @if(config('settings.theme') == 'caincu') selected @endif value="caincu">{{ __("Caincu") }}</option>
                                <option @if(config('settings.theme') == 'coffeeincu') selected @endif value="coffeeincu">{{ __("Coffeeincu") }}</option>
                                <option @if(config('settings.theme') == 'einayh') selected @endif value="einayh">{{ __("Einayh") }}</option>
                                <option @if(config('settings.theme') == 'enrincu') selected @endif value="enrincu">{{ __("Enrincu") }}</option>
                                <option @if(config('settings.theme') == 'eventincu') selected @endif value="eventincu">{{ __("Eventincu") }}</option>
                                <option @if(config('settings.theme') == 'faincu') selected @endif value="faincu">{{ __("Faincu") }}</option>
                                <option @if(config('settings.theme') == 'gnincu') selected @endif value="gnincu">{{ __("Gnincu") }}</option>
                                <option @if(config('settings.theme') == 'healthincu') selected @endif value="healthincu">{{ __("Healthincu") }}</option>
                                <option @if(config('settings.theme') == 'mhams') selected @endif value="mhams">{{ __("Mhams") }}</option>
                                <option @if(config('settings.theme') == 'miningincu') selected @endif value="miningincu">{{ __("Miningincu") }}</option>
                                <option @if(config('settings.theme') == 'nsseb') selected @endif value="nsseb">{{ __("Nsseb") }}</option>
                                <option @if(config('settings.theme') == 'safincu') selected @endif value="safincu">{{ __("Safincu") }}</option>
                                <option @if(config('settings.theme') == 'spincu') selected @endif value="spincu">{{ __("Spincu") }}</option>
                                <option @if(config('settings.theme') == 'tejmel') selected @endif value="tejmel">{{ __("Tejmel") }}</option>
                            </select>
                        </div>
                    </div> --}}

                </div>

                <div class="mb-3 text-center mt-3">
                    <button type="submit" class="btn btn-primary w-25" :disabled="submitting">
                        <i v-cloak v-if="submitting" class="fas fa-spinner fa-spin"></i>
                        <span>{{ __('Submit') }}</span>
                    </button>
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
                logo: '',
                phone: @json($setting['phone']),
                email: @json($setting['email']),
                title: @json($setting['title']),
                description: @json($setting['description']),
                address: @json($setting['address']),
                facebook: @json($setting['facebook']),
                twitter: @json($setting['twitter']),
                linkedin: @json($setting['linkedin']),
                pinterest: @json($setting['pinterest']),
                android_app_url: @json($setting['android_app_url']),
                ios_app_url: @json($setting['ios_app_url']),
                theme: @json($setting['theme']),
                _method: "PUT"
            },
            errors: {},
            submitting: false,
            response: null,
            logo_url: @json(asset($setting['logo'] ?? env("THEME").'/images/logo.png'))
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

                    const res = await axios.post("{{ route('api.settings.general') }}", formData, {
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
            async handleImage(event) {
                const file = event.target.files[0];
                this.form.logo = file;
                this.logo_url = URL.createObjectURL(file);
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
