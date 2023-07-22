@extends("core::layouts.admin")


@section("meta_tags")
    <title>{{ __("Edit Contact Message") }}</title>
    <meta name="description" content="Edit Contact Message and Manage Contact Message Details">
    <meta name="keywords" content="contact_message,contact_message_edit">
@endsection


@section('content')

<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex">
            <strong>{{ __("Name") }}: </strong>
            <span class="mx-2"></span>
            <p>{{ $contactMessage->first_name }} {{ $contactMessage->last_name }}</p>
        </div>
        <div class="d-flex">
            <strong>{{ __("Email") }}: </strong>
            <span class="mx-2"></span>
            <p>{{ $contactMessage->email }} </p>
        </div>
        <div class="d-flex">
            <strong>{{ __("Name") }}: </strong>
            <span class="mx-2"></span>
            <p>{{ $contactMessage->message }}</p>
        </div>
        <div class="d-flex">
            <strong>{{ __("Last Reply Message") }}: </strong>
            <span class="mx-2"></span>
            <p>{{ $contactMessage->reply_message ?? "Not Replied Yet" }} </p>
        </div>
    </div>
</div>


<div class="card">


<div class="card-body">
    <form method="POST" action="{{ route('contact-messages.update', $contactMessage->id) }}" enctype="multipart/form-data">

        @csrf
        @method("PUT")

        <div class="my-3">
            <label class="required" for="issue">{{ __("Reply Message") }}</label>
            <textarea name="reply_message" id="" cols="30" rows="10" class="form-control {{ $errors->has('reply_message') ? 'is-invalid' : '' }}" required>
                {{ old('description') }}
            </textarea>
            @if($errors->has('reply_message'))
                <div class="invalid-feedback">
                    {{ $errors->first('reply_message') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <input type="hidden" name="email" value="{{ $contactMessage->email }}">
            <button class="btn btn-primary" type="submit">
                {{ __('Reply') }}
            </button>
        </div>
    </form>
</div>
</div>



@endsection
