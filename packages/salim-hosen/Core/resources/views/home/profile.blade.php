@extends(getLayout())

@section('meta_tags')
    <title>{{ __("Edit Profile") }}</title>
    <meta name="description" content="Edit Profile and Manage Profile Details">
    <meta name="keywords" content="profile,profile_edit">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card border-0 mb-3">
                <div class="card-body">
                    <div class="round-div">
                        <img width="120"
                            src="{{ asset($user->avatar ? "uploads/user/$user->avatar" : 'images/avatar.png') }}"
                            alt="profile avatar" class="rounded-circle img-fluid mx-auto d-block">
                    </div>
                    <div class="text-center mt-2">
                        <label for="imgupload" class="btn btn-sm btn-primary">
                            <input @change.prevent="handleImage" type="file" id="imgupload" hidden="hidden" name="avatar">
                            {{ __('Upload New') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <form @submit.prevent="updatePassword">

                        <h4>{{ __('Change Password') }}</h4>
                        <hr>

                        <div class="mb-3">
                            <label class="required" for="current_password">{{ __('Current Password') }}</label>
                            <input type="password" class="form-control"
                                :class="{ 'is-invalid': errors.current_password }"
                                type="password" name="current_password" id="password" v-model="password_form.current_password">
                                <div class="invalid-feedback">@{{ errors.current_password }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="required" for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control"
                                :class="{ 'is-invalid': errors.password }"
                                type="password" name="password" id="password" v-model="password_form.password">
                                <div class="invalid-feedback">@{{ errors.password }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="required"
                                for="password_confirmation">{{ __('Password Confirmation') }}</label>
                            <input type="password"
                                class="form-control"
                                :class="{ 'is-invalid': errors.password_confirmation }"
                                type="text" name="password_confirmation" id="password_confirmation"
                                value="{{ old('password_confirmation') }}" v-model="password_form.password_confirmation">
                                <div class="invalid-feedback">@{{ errors.name }}</div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" :disabled="updating_password">
                                <i class="fas fa-spinner fa-spin" v-show="updating_password"></i>
                                <span>{{ __('Update Password') }}</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card border-0">
                <div class="card-body">
                    <form  @submit.prevent="submitProfileForm">

                        <div class="mb-3">
                            <label class="required" for="name">{{ __('Name') }}</label>
                            <input class="form-control" :class="{ 'is-invalid': errors.name }" type="text"
                                name="name" id="name" v-model="profile_form.name">
                            <div class="invalid-feedback">@{{ errors.name }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="required" for="email">{{ __('Email') }}</label>
                            <input class="form-control" :class="{ 'is-invalid': errors.email }" type="text"
                                name="email" id="email" v-model="profile_form.email">
                            <div class="invalid-feedback">@{{ errors.email }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="required" for="phone">{{ __('Phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone"
                                :class="{ 'is-invalid': errors.phone }" v-model="profile_form.phone">
                            <div class="invalid-feedback">@{{ errors.phone }}</div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" :disabled="updating_profile">
                                <i class="fas fa-spinner fa-spin" v-show="updating_profile"></i>
                                <span>{{ __('Update Profile') }}</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('body_scripts')
    <script>
        vdata = {
            ...vdata,
            updating_profile: false,
            errors: {},
            states: [],
            profile_form: {
                name: @json($user->name),
                email: @json($user->email),
                phone: @json($user->phone),
            },
            updating_password: false,
            password_form: {
                current_password: '',
                password: '',
                password_confirmation: '',
            }
        }

        vmethods = {
            ...vmethods,
            async handleImage(event) {
                const file = event.target.files[0];
                let formData = new FormData();
                formData.append("avatar", file);
                formData.append("_method", "PUT");
                try {
                    const response = await axios.post("{{ route('api.avatar.update') }}", formData);
                    toastr.success('Image Uploaded');
                    window.location.reload();
                } catch (err) {
                    toastr.error('Something wen\'t Wrong');
                }
            },
            async submitProfileForm(){
                try {
                    this.errors={};
                    this.updating_profile = true;
                    const response = await axios.put("{{ route('api.profile') }}", this.profile_form);
                    this.updating_profile = false;
                    this.errors={};
                    toastr.success('Profile Updated');
                } catch (e) {
                    if (e.response && e.response.status == 422) {
                        for (const [key, value] of Object.entries(e.response.data.errors)) {
                            this.errors[key] = value[0];
                        }
                    } else {
                        toastr.error("Something Wen't Wrong!");
                    }

                    this.updating_profile = false;
                }
            },
            async updatePassword(){
                try {
                    this.updating_password = true;
                    const response = await axios.put("{{ route('api.password.update') }}", this.password_form);
                    this.updating_password = false;
                    this.errors={};
                    toastr.success('Password Updated');
                } catch (e) {
                    if (e.response && e.response.status == 422) {
                        for (const [key, value] of Object.entries(e.response.data.errors)) {
                            this.errors[key] = value[0];
                        }
                    } else {
                        toastr.error("Something Wen't Wrong!");
                    }

                    this.updating_password = false;
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
