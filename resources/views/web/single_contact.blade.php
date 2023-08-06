@php
    $locale = app()->getLocale();
@endphp
@extends('web.layouts.app')
@section('title', __('homepage.homepage'))
@section('content')

    <section class="py-5 pages-banner" style="background-image: url({{ asset('uploads/banner/service-banner.png') }})">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="single-agency d-flex">
                        <div class="agency-logo">
                            <img src="{{ asset('web/img/flags/invest_01.jpg') }}" class="rounded" alt="">
                        </div>
                        <div class="agency-text text-start py-4">
                            <h4>Devon Lane</h4>
                            <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="getschedule text-end py-5">
                        <a href="" class="btn btn-info text-white">Get Schedule</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5 contactformbg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="contact-form">
                        <h4 class="mb-5 border-bottom pb-3">Submit your Project Brief to get early response</h4>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Type of Service">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <textarea name="" id="" rows="10" class="form-control" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
