@extends(getLayout())


@section("meta_tags")
<title>{{ __("Create Lead Stage") }}</title>
    <meta name="description" content="Lead Stage Created and Manage Lead Stage Details">
    <meta name="keywords" content="leadstage,leadstage_create">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Add Pipeline") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("lead-stages.store") }}" >

            @csrf

            <div class="mb-3">
                <label class="required" for="pipeline">{{ __("Pipeline") }}</label>
                <select name="pipeline" id="pipeline" class="form-control {{ $errors->has('pipeline') ? 'is-invalid' : '' }}">
                    <option value="">{{ __("Select Pipeline") }}</option>
                    @foreach ($pipelines as $pipeline)
                        <option value="{{ $pipeline->id }}">{{ $pipeline->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('pipeline'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pipeline') }}
                    </div>
                @endif
            </div>


            <div class="mb-3">
                <label class="required" for="name">{{ __("Name") }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>


            <div class="mb-3">
                <button class="btn btn-primary" type="submit">
                    {{ __("Save") }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
