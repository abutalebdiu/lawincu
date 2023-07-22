@extends(getLayout())


@section("meta_tags")
<title>{{ __("Reply Query") }}</title>
    <meta name="description" content="Ticket Reply and Manage Ticket Reply Details">
    <meta name="keywords" content="ticket,ticket_reply">
@endsection

@section('content')

<div class="card">

<div class="card-header">
    {{ __("Reply to") }} #{{ $ticket->ticket }}
</div>

<div class="card-body">
    <form method="POST" action="{{ route("ticket-reply.store", ['ticket_id' => $ticket->id]) }}" enctype="multipart/form-data">

        @csrf

        <div class="d-flex">
            <strong>{{ __("Issue") }} </strong>
            <span class="mx-1"></span>
            <span>{{ $ticket->issue }} </span>
        </div>

        <div class="my-3">
            <label class="required" for="issue">{{ __("Reply Message") }}</label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
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


        <div class="mb-3">
            <button class="btn btn-primary" type="submit">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
</div>



@endsection
