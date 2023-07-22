@extends('core::layouts.admin')

@section("title", "Create Permission")

@section("meta_tags")
    <meta name="description" content="Create Permission and Manage Permission Details">
    <meta name="keywords" content="permission,permission_create">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Create Permission') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("permissions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ __('Title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" >
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
