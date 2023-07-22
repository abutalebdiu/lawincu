@extends("core::layouts.admin")


@section("meta_tags")
    <title>{{ __("Edit Tag") }}</title>
    <meta name="description" content="User can Edit Tag">
    <meta name="keywords" content="tag,tag_edit">
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="mb-3">
                <label class="required" for="name">{{ __('Name') }}</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $tag->name) }}">
                @error("name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit">
                    {{ __('Update') }}
                </button>
            </div>


        </form>
    </div>
</div>
@endsection



