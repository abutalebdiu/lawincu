@extends('web.layouts.app')
@section('title', __('homepage.aboutus'))
@section('content')

    <section class="pages-banner py-5" style="background-image: url({{ asset('web/img/Aboutus/about-banner.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5">
                    <h1> @lang('homepage.aboutus')</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="aboutus py-5 border-top">
        <div class="container">
            <div class="row no-gutters  position-relative">
                <div class="col-md-6 mb-md-0 p-md-4">
                    <img src="{{ asset('web/img/Aboutus/About-Us.png') }}" class="w-100" alt="...">
                </div>
                <div class="col-md-6 position-static p-4 pl-md-0">
                    <h3 class="mt-5 text-dark"> @lang('homepage.whoarewe')</h3>
                    <p> @lang('homepage.aboutus_p') </p>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h3 class="text-dark pb-4"> @lang('homepage.ourservices') </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-md-5 mx-auto">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/Commercial.png') }}" alt="" class="w-100">
                        <h5 class="my-3 text-dark"> @lang('homepage.commercial')</h5>
                        <p class="text-muted">@lang('homepage.commercial_p')</p>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-md-5 mx-auto">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/Social-investment.png') }}" alt="" class="w-100">
                        <h5 class="my-3 text-dark">@lang('homepage.socialinvestment')</h5>
                        <p class="text-muted">@lang('homepage.socialinvestment_p')</p>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-md-5 mx-auto">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/Real-estate-finance.png') }}" alt=""
                            class="w-100">
                        <h5 class="my-3 text-dark">@lang('homepage.realestatefinance')</h5>
                        <p class="text-muted">@lang('homepage.realestatefinance_p')</p>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-md-5 mx-auto">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/Real-estate-appraisal-and-real estate-studies.png') }}"
                            alt="" class="w-100">
                        <h5 class="my-3 text-dark">@lang('homepage.appraisal')</h5>
                        <p class="text-muted"> @lang('homepage.appraisal_p')</p>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-md-5 mx-auto">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/Real-estate-appraisal-and-real estate-studies.png') }}"
                            alt="" class="w-100">
                        <h5 class="my-3 text-dark">@lang('homepage.estatestudies')</h5>
                        <p class="text-muted"> @lang('homepage.estatestudies_p')</p>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-md-5 mx-auto">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/Real-estate-auctions.png') }}" alt=""
                            class="w-100">
                        <h5 class="my-3 text-dark"> @lang('homepage.estateauction')</h5>
                        <p class="text-muted"> @lang('homepage.estateauction_p')</p>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-md-5  ">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/3D-Real-Estate-imaging.png') }}" alt=""
                            class="w-100">
                        <h5 class="my-3 text-dark">@lang('homepage.marketing')</h5>
                        <p class="text-muted">@lang('homepage.marketing_p')</p>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-md-5 ">
                    <div class="card aboutservice">
                        <img src="{{ asset('web/img/Our-services/3D-Real-Estate-imaging.png') }}" alt=""
                            class="w-100">
                        <h5 class="my-3 text-dark">@lang('homepage.photographyvideo')</h5>
                        <a href="{{ route('send.request') }}" class="apply-btn"> @lang('homepage.requestservice') </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.component.addrentsell')
    @include('web.component.buyinvestsell')


@endsection
