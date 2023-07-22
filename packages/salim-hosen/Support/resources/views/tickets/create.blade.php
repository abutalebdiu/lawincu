@extends(getLayout())


@section("meta_tags")
<title>{{ __("Create Ticket") }}</title>
    <meta name="description" content="Create Ticket and Manage Ticket Details">
    <meta name="keywords" content="ticket,ticket_create">
@endsection

@section('content')

<div class="card border-0 mb-3">

    <div class="card-header bg-white">
        {{ __("Create Ticket") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("support-tickets.store") }}" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="required" for="issue">{{ __("Issue") }}</label>
                <input type="text" class="form-control {{ $errors->has('issue') ? 'is-invalid' : '' }}" type="text" name="issue" id="issue" value="{{ old('issue') }}">
                @if($errors->has('issue'))
                    <div class="invalid-feedback">
                        {{ $errors->first('issue') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="required" for="issue">{{ __("Issue Description") }}</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">
                    {{ old('description') }}
                </textarea>
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
