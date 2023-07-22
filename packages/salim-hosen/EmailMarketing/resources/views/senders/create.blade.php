@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Create Sender") }}</title>
    <meta name="description" content="Create Sender and Manage Sender Details">
    <meta name="keywords" content="sender,sender_create">
@endsection


@section('content')

<div class="card">

    <div class="card-header">
        {{ trans('Create Sender') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("senders.store") }}">
            @csrf

            <div class="mb-3">
                <label class="required" for="name">{{ __('Sender Name') }}</label>
                <input class="form-control @error('name') is-invalid @enderror" type="name" name="name" id="name" value="{{ old('name', '') }}">
                @error("name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="email">{{ __('Email') }}</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="name" value="{{ old('email', '') }}">
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
