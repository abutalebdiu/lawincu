

@extends(getLayout())


@section("meta_tags")
<title>{{ __("Ticket Details") }}</title>
    <meta name="description" content="Ticket Details">
    <meta name="keywords" content="ticket,ticket_show">
@endsection


@section('content')

<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>{{ __("Support Details") }}</span>
        <div class="mb-3 d-flex align-items-center">
            @if (Auth::user()->hasRole("admin") && $supportTicket->status != "close")
                <div>
                    <form action="{{ route("support-tickets.update", $supportTicket->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="status" value="close">
                        <button type="submit" class="btn btn-danger" name="close">{{ __("Close Ticket") }}</button>
                    </form>
                </div>
                <span class="mx-1"></span>
            @endif

        </div>
    </div>

    <div class="card-body">
        <div class="d-flex">
            <strong>{{ __("Ticket") }} </strong>
            <span class="mx-1"></span>
            <span>#{{ $supportTicket->ticket }} </span>
        </div>
        <div class="d-flex">
            <strong>{{ __("Issue") }} </strong>
            <span class="mx-1"></span>
            <span>{{ $supportTicket->issue }} </span>
        </div>
        @if ($supportTicket->attachment)
            <div class="d-flex">
                <strong>{{ __("Attachment") }} </strong>
                <span class="mx-1"></span>
                <a href="{{ asset("documents/support/$supportTicket->attachment") }}" download="download">{{ __("Download Attachment") }}</a>
            </div>
        @endif
        <div class="d-flex">
            <strong>{{ __("Description") }} </strong>
            <span class="mx-1"></span>
            <span>{{ $supportTicket->description }} </span>
        </div>
    </div>
</div>

@foreach ($replies as $reply)

@if (Auth::user()->id == $reply->user_id)
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
                    @if ($reply->attachment)
                        <a href="{{ asset('documents/support/'.$reply->attachment) }}" download="download">
                            <i class="fas fa-download"></i>
                            {{ __("Attachment") }}
                        </a>
                    @endif
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
                        <p class="my-0">{{ $reply->created_at->format("d-M-Y") }} <strong>{{ $reply->user->name }}</strong> {{ __("Says") }}:</p>

                    </div>
                    <hr>
                    <p>{{ $reply->description }}</p>
                    @if ($reply->attachment)
                        <a href="{{ asset('documents/support/'.$reply->attachment) }}" download="download">
                            <i class="fas fa-download"></i>
                            {{ __("Attachment") }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <img width="60" src="{{ asset( Auth::user()->photo ? "images/profile/".Auth::user()->photo : "images/avatar.png") }}" alt="" class="img-fluid rounded-circle bg-white">
        </div>
    </div>
@endif
@endforeach

@if ($supportTicket->status != "close")
    <form class="pt-4" action="{{ route("support-tickets.update", $supportTicket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="my-3">
            <label class="required" for="issue">{{ __("Reply Message") }}</label>
            <textarea name="description" id="" cols="30" rows="4" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
            @if($errors->has('description'))
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="required" for="attachment">{{ __("Attachment") }}</label>
            <input type="file" name="attachment" class="form-control">
            @if($errors->has('attachment'))
                <div class="invalid-feedback">
                    {{ $errors->first('attachment') }}
                </div>
            @endif
        </div>

        <div class="mb-3 mb-0 text-right">
            <button type="submit" class="btn btn-primary">{{ __("Send") }}</button>
        </div>
    </form>
@endif

@endsection
