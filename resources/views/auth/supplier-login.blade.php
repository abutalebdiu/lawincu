@extends('layouts.app')

@section("meta_tags")
    <x-website-meta-tags></x-website-meta-tags>
@endsection

@section('content')


    <!-- BANNER SECTION -->
    <section class="banner-section py-4" style="background-image: url('{{ asset("asougexpress/images/banner-image.png") }}');">
        <div class="container p-3">
           <div class="row align-items-center">
            <div class="col-12 col-lg-8">
                <div class="banner-content">
                    <h1>AsougExpress <br> it’s arabian marketplace</h1>
                    <p>
                        Create a Asougexpress seller account within just 5 minutes and reach millions of customers today!
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="banner-form mt-3 mt-lg-0">
                    <div class="card my-5 rounded border-0" v-cloak>


                        <div class="card-body p-4">

                            <h5 class="mb-4 ember-bold">{{ __("Supplier Login") }}</h5>


                            <form action="{{ route('login') }}" method="post" @submit.prevent="submitForm">

                                @csrf

                                <div class="mb-4">
                                    <label class="required" for="email">{{ __('Email') }}</label>

                                    <input class="form-control form-round" type="email" name="email" id="email"
                                        :class="{ 'is-invalid': errors.email }" v-model="form.email" autocomplete="new-password">
                                    <div class="invalid-feedback">@{{ errors.email }}</div>
                                </div>

                                <div class="mb-4">
                                    <label class="required" for="password">{{ __('Password') }}</label>
                                    <div class="position-relative">
                                        <input class="form-control form-round " :type="show_password == true ? 'text' : 'password'" name="password" id="password"
                                        autocomplete="new-password" :class="{ 'is-invalid': errors.password }"
                                        v-model="form.password">
                                        <div class="password-eye">
                                            <i :class="`fas ${show_password == true ? 'fa-eye' : 'fa-eye-slash'}`" role="button" @click="show_password=!show_password"></i>
                                        </div>
                                    </div>
                                    <div class="text-danger text-small">@{{ errors.password }}</div>
                                </div>

                                {{-- <div class="mb-4">
                                    <div class="d-flex">
                                        <div class="login-selector" :class="{lsactive: form.role == 'buyer'}" @click.prevent="form.role = 'buyer'">{{ __("Buyer") }}</div>
                                        <div class="login-selector" :class="{lsactive: form.role == 'supplier'}" @click.prevent="form.role = 'supplier'">{{ __("Supplier") }}</div>
                                    </div>
                                </div> --}}



                                <div class="text text-danger mb-3" v-show="errors.message">@{{ errors.message }} <a
                                        href="{{ route('verification.resend') }}"
                                        v-show="errors.verification">{{ __('Resend Verification Link') }}</a></div>

                                <div class="mb-3 d-flex justify-content-between">

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" v-model="form.remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    <a href="{{ route('password.request') }}"
                                        class="text text-danger">{{ __('Forgot Password?') }}</a>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100" :disabled="loading">
                                        <i class="fas fa-spinner fa-spin" v-show="loading"></i>
                                        <span>{{ __('Login') }}</span>
                                    </button>
                                </div>

                            </form>
                            <p class="text-center">{{ __('Dont have an account') }}? <a href="{{ route('register') }}"
                                    class="text text-primary font-weight-bold">{{ __('Register') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
           </div>

        </div>
    </section>
    <!-- BANNER SECTION -->

    <!-- WHY SECTION -->
    <section class="why-section py-5">
        <div class="container">
            <div class="section-title">
                <h4>Why AsougExpress?</h4>
                <p>AsougExpress is the best place for the selling your product with less selling commission and fasted payout</p>
            </div>

            <div class="row mt-5">
                <div class="col-12 col-md-6 col-lg-4 pb-4">
                    <div class="why-box d-flex align-items-center">
                        <div>
                            <img class="" src="{{ asset("asougexpress/images/why-image.png") }}" alt="">
                        </div>
                        <div>
                            <h6>Largest Market in Saudi</h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur. Nisl vitae cras metus platea maecenas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 pb-4">
                    <div class="why-box d-flex align-items-center">
                        <div>
                            <img class="" src="{{ asset("asougexpress/images/why-image.png") }}" alt="">
                        </div>
                        <div>
                            <h6>Free Registration</h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur. Nisl vitae cras metus platea maecenas.
                            </p>
                        </div>
                    </div>
                </div><div class="col-12 col-md-6 col-lg-4 pb-4">
                    <div class="why-box d-flex align-items-center">
                        <div>
                            <img class="" src="{{ asset("asougexpress/images/why-image.png") }}" alt="">
                        </div>
                        <div>
                            <h6>Easy Product selling</h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur. Nisl vitae cras metus platea maecenas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 pb-4">
                    <div class="why-box d-flex align-items-center">
                        <div>
                            <img class="" src="{{ asset("asougexpress/images/why-image.png") }}" alt="">
                        </div>
                        <div>
                            <h6>Fasted Delivery</h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur. Nisl vitae cras metus platea maecenas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 pb-4">
                    <div class="why-box d-flex align-items-center">
                        <div>
                            <img class="" src="{{ asset("asougexpress/images/why-image.png") }}" alt="">
                        </div>
                        <div>
                            <h6>Free Marketing</h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur. Nisl vitae cras metus platea maecenas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 pb-4">
                    <div class="why-box d-flex align-items-center">
                        <div>
                            <img class="" src="{{ asset("asougexpress/images/why-image.png") }}" alt="">
                        </div>
                        <div>
                            <h6>24/7 Support & Training</h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur. Nisl vitae cras metus platea maecenas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- WHY SECTION -->

    <!-- PRODUCT VIDEO SECTION -->
    <section class="product-video-section" >
        <div class="container h-100">
            <div class="product-video-content" style="background-image: url('{{ asset("asougexpress/images/product-video.png") }}');">
                <div class="product-video-text ms-4">
                    <h4 class="text-white">Sell Your Product</h4>
                    <p class="text-white">
                        Lorem ipsum dolor sit amet consectetur. Feugiat proin facilisis fermentum faucibus mattis sed morbi .
                    </p>
                </div>
                <div class="product-video-icons">
                    <img class="img-fluid" src="{{ asset("asougexpress/images/video-icons.png") }}">
                </div>
            </div>

        </div>
    </section>
    <!-- PRODUCT VIDEO SECTION -->

    <!-- SELL PRODUCT SECTON -->
    <section class="sell-product-section pb-4 pb-lg-5 pt-0 pt-lg-5">
        <div class="container">
            <div class="section-title">
                <h4>How to start selling <br> your product?</h4>
            </div>

            <div class="row mt-4 mt-lg-4">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-4">
                    <div class="sell-product-box">
                        <div class="sell-product-img mx-auto">
                            <img class="img-fluid" src="{{ asset("asougexpress/images/sell-product.png") }}" alt="">
                        </div>
                        <h6>Sign up</h6>
                        <p>
                            Lorem ipsum dolor sit amet consectetur. Quis malesuada interdum amet a enim.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-4">
                    <div class="sell-product-box">
                        <div class="sell-product-img mx-auto">
                            <img class="img-fluid" src="{{ asset("asougexpress/images/sell-product.png") }}" alt="">
                        </div>
                        <h6>Complete Your Profile</h6>
                        <p>
                            Lorem ipsum dolor sit amet consectetur. Quis malesuada interdum amet a enim.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-4">
                    <div class="sell-product-box">
                        <div class="sell-product-img mx-auto">
                            <img class="img-fluid" src="{{ asset("asougexpress/images/sell-product.png") }}" alt="">
                        </div>
                        <h6>Add Bank Information</h6>
                        <p>
                            Lorem ipsum dolor sit amet consectetur. Quis malesuada interdum amet a enim.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-4">
                    <div class="sell-product-box">
                        <div class="sell-product-img mx-auto">
                            <img class="img-fluid" src="{{ asset("asougexpress/images/sell-product.png") }}" alt="">
                        </div>
                        <h6>List your Product</h6>
                        <p>
                            Lorem ipsum dolor sit amet consectetur. Quis malesuada interdum amet a enim.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- SELL PRODUCT SECTON -->

    <!-- FAQ SECTION START -->
    <section class="faq-part pb-4 pb-lg-5">
        <div class="container mb-lg-4">
            <div class="section-title mb-3 mb-lg-4">
                <h4>FAQ’s</h4>
            </div>
            <div class="faq my-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <h3 class="text-white">01</h3>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="my-0 py-0">How AsougExpress Commission?</h5>
                        <p>Lorem ipsum dolor sit amet consectetur. Aliquam erat nec sed fringilla ultrices interdum. Eget ac faucibus orci sed odio in bibendum. Est nisl nunc nisi urna tellus tortor.</p>
                    </div>
                </div>
            </div>
            <div class="faq my-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <h3 class="text-white">02</h3>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="my-0 py-0">What documents are need to create seller account?</h5>
                        <p>Lorem ipsum dolor sit amet consectetur. Aliquam erat nec sed fringilla ultrices interdum. Eget ac faucibus orci sed odio in bibendum. Est nisl nunc nisi urna tellus tortor.</p>
                    </div>
                </div>
            </div>
            <div class="faq my-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <h3 class="text-white">03</h3>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="my-0 py-0">What documents are need to create seller account?</h5>
                        <p>Lorem ipsum dolor sit amet consectetur. Aliquam erat nec sed fringilla ultrices interdum. Eget ac faucibus orci sed odio in bibendum. Est nisl nunc nisi urna tellus tortor.</p>
                    </div>
                </div>
            </div>
            <div class="faq my-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <h3 class="text-white">04</h3>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="my-0 py-0">What documents are need to create seller account?</h5>
                        <p>Lorem ipsum dolor sit amet consectetur. Aliquam erat nec sed fringilla ultrices interdum. Eget ac faucibus orci sed odio in bibendum. Est nisl nunc nisi urna tellus tortor. </p>
                    </div>
                </div>
            </div>
            <div class="faq my-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <h3 class="text-white">05</h3>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="my-0 py-0">What documents are need to create seller account?</h5>
                        <p>Lorem ipsum dolor sit amet consectetur. Aliquam erat nec sed fringilla ultrices interdum. Eget ac faucibus orci sed odio in bibendum. Est nisl nunc nisi urna tellus tortor. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ SECTION END -->


@endsection


@push('body_scripts')
    <script>
        vdata = {
            ...vdata,
            form: {
                email: '',
                password: '',
                role: "supplier"
            },
            errors: {},
            loading: false,
            show_password: false,
            response: null
        }

        vmethods = {
            ...vmethods,
            async submitForm() {

                try {

                    this.loading = true;
                    this.errors = {};
                    this.response = "";
                    const res = await axios.post("{{ route('login') }}", this.form);
                    window.location.reload();

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
            ...vcreated
            // function key: function(){}
        }

        vmounted = {
            ...vmounted,
            // function key: function(){}
        }
    </script>
@endpush
