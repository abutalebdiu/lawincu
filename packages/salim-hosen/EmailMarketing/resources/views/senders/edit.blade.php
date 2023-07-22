@extends('core::layouts.admin')



@section("meta_tags")
<title>{{ __("Edit Sender") }}</title>
    <meta name="description" content="Sender Edit">
    <meta name="keywords" content="sender,sender_edit">
@endsection


@section('content')

<div class="card">

    <div class="card-header">
        {{ trans('Create Sender') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("senders.update", $sender['id']) }}">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label class="required" for="name">{{ __('Sender Name') }}</label>
                <input class="form-control @error('name') is-invalid @enderror" type="name" name="name" id="name" value="{{ old('name', $sender['name']) }}">
                @error("name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="email">{{ __('Email') }}</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="name" value="{{ old('email', $sender['email']) }}">
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
