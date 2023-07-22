@extends(getLayout())


@section("meta_tags")
<title>{{ __("Edit Lead Source") }}</title>
    <meta name="description" content="Edit Lead Source">
    <meta name="keywords" content="leadsource,leadsource_edit">
@endsection

@section('content')

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Update Lead Source") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("lead-sources.update", $leadSource->id) }}" enctype="multipart/form-data">

            @csrf
            @method("PUT")

            <div class="form-group">
                <label class="required" for="name">{{ __("Name") }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $leadSource->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ __("save") }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
