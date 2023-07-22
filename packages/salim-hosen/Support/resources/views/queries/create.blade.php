@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Create Query") }}</title>
    <meta name="description" content="Create Ticket and Manage Ticket Details">
    <meta name="keywords" content="ticket,ticket_create">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Create Ticket") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("support-tickets.store") }}" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="required" for="your_query">{{ __("Your Query") }}</label>
                <input type="text" class="form-control {{ $errors->has('your_query') ? 'is-invalid' : '' }}" type="text" name="your_query" id="your_query" value="{{ old('your_query') }}">
                @if($errors->has('your_query'))
                    <div class="invalid-feedback">
                        {{ $errors->first('your_query') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="required" for="description">{{ __("Description") }}</label>
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
                <button class="btn btn-primary" type="submit">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
