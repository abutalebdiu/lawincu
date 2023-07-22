@extends(getLayout())


@section("meta_tags")
<title>{{ __("Create Pipeline") }}</title>
    <meta name="description" content="Pipeline Create and Manage Pipeline Details">
    <meta name="keywords" content="pipeline,pipeline_create">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Add Pipeline") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("pipelines.store") }}" >

            @csrf



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
