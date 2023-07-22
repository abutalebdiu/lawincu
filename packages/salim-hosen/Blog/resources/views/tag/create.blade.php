@extends(getLayout())

@section("meta_tags")
    <title>{{ __("Create Tag") }}</title>
    <meta name="description" content="Create Tag and Manage Tag Details">
    <meta name="keywords" content="tag,tag_create">
@endsection

@section("content")
    <div class="card">
        <div class="card-body">

            <form action="{{ route('tags.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="required" for="name">{{ __('Name') }}</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="name" name="name" id="name" value="{{ old('name', '') }}">
                    @error("name")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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


