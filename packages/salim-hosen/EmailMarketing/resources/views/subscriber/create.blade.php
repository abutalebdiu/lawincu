@extends('core::layouts.admin')

@section("title", "Subscriber Created")

@section("meta_tags")
<title>{{ __("Create Subscriber") }}</title>
    <meta name="description" content="Create Subscriber and Manage Subscriber Details">
    <meta name="keywords" content="subscriber,subscriber_create">
@endsection


@section('content')

<div class="card">

    <div class="card-header">
        {{ trans('Create Subscriber') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("subscribers.store") }}">
            @csrf

            <div class="mb-3">
                <label class="required" for="email">{{ __('Email') }}</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email', '') }}">
                @error("email")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

</div>



@endsection
