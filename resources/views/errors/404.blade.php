@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row my-4">
            <div class="col-md-6 mt-5 mx-auto">
                <div class="text-center">
                    <h1 class="fw-bold" style="font-size: 70px">404</h1>
                    <p class="fs-3"> <span class="text-danger">{{ __("Opps") }}!</span> {{ __("Page not found") }}.</p>
                    <p class="lead">
                        {{ __("The page you’re looking for doesn’t exist") }}.
                    </p>
                    <a href="{{ route("welcome") }}" class="btn btn-primary">{{ __("Go Home") }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
