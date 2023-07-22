@extends(getLayout())


@section("meta_tags")
<title>{{ __("Query Details") }}</title>
    <meta name="description" content="Ticket Details">
    <meta name="keywords" content="ticket,ticket_show">
@endsection


@section('content')

<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>{{ __("Query Details") }}</span>
    </div>

    <div class="card-body">
        <div class="d-flex">
            <strong>{{ __("Query:") }} </strong>
            <span class="mx-1"></span>
            <span>{{ $customerQuery->customer_query }} </span>
        </div>

        <div class="d-flex">
            <strong>{{ __("Description:") }} </strong>
            <span class="mx-1"></span>
            <span>{{ $customerQuery->description }} </span>
        </div>
    </div>
</div>

@foreach ($replies as $reply)

@if (getAuthRole() == $reply->message_for)
    <div class="row mb-3">
        <div class="col-md-1">
            <img width="60" src="{{ asset( Auth::user()->photo ? "images/profile/".Auth::user()->photo : "images/avatar.png") }}" alt="" class="img-fluid rounded-circle bg-white">
        </div>
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="my-0">{{ $reply->created_at->format("d-M-Y") }} <strong>{{ __("You") }}</strong> {{ __("said") }}:</p>
                    </div>
                    <hr>
                    <p>{{ $reply->description }}</p>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row mb-3">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="my-0">{{ $reply->created_at->format("d-M-Y") }} <strong>{{ $reply->customer_query->company->name ?? "" }}</strong> {{ __("Says") }}:</p>
                    </div>
                    <hr>
                    <p>{{ $reply->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <img width="60" src="{{ asset( Auth::user()->photo ? "images/profile/".Auth::user()->photo : "images/avatar.png") }}" alt="" class="img-fluid rounded-circle bg-white">
        </div>
    </div>
@endif
@endforeach

<form class="pt-4" action="{{ route("customer-queries.update", $customerQuery->id) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="mb-3 mb-2">
        <textarea class="form-control @error('message') is-invalid @enderror" rows="4" name="message" placeholder="{{ __("Type your reply") }}" required></textarea>
        @error("message")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 mb-0 text-right">
        <button type="submit" class="btn btn-primary">{{ __("Send") }}</button>
    </div>
</form>

@endsection
