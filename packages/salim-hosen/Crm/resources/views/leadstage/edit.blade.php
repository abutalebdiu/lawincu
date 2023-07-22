@extends(getLayout())


@section("meta_tags")
<title>{{ __("Edit Lead Stage") }}</title>
    <meta name="description" content="Lead Stage Created and Manage Lead Stage Details">
    <meta name="keywords" content="leadstage,leadstage_create">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Update Stage") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("lead-stages.update", $leadStage->id) }}" enctype="multipart/form-data">

            @csrf
            @method("PUT")

            <div class="mb-3">
                <label class="required" for="pipeline">{{ __("Pipeline") }}</label>
                <select name="pipeline" id="pipeline" class="form-control">
                    <option value="">{{ __("Select Pipeline") }}</option>
                    @foreach ($pipelines as $pipeline)
                        <option value="{{ $pipeline->id }}" @if($pipeline->id == $leadStage->pipeline_id) selected @endif>{{ $pipeline->name }}</option>
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
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $leadStage->name) }}">
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
