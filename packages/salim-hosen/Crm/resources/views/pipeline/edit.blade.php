@extends(getLayout())

@section("meta_tags")
<title>{{ __("Edit Pipeline") }}</title>
    <meta name="description" content="Edit Pipeline">
    <meta name="keywords" content="pipeline,pipeline_edit">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Update Contact") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("pipelines.update", $pipeline->id) }}" enctype="multipart/form-data">

            @csrf
            @method("PUT")

            <div class="mb-3">
                <label class="required" for="name">{{ __("Name") }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $pipeline->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>


            <div class="mb-3">
                <button class="btn btn-primary" type="submit">
                    {{ __("Update") }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
