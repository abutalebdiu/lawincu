@extends('core::layouts.admin')

@section("title", "Edit Permission")

@section("meta_tags")
    <meta name="description" content="Edit Permission and Manage Permission Details">
    <meta name="keywords" content="permission,permission_edit">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Edit Permission') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("permissions.update", [$permission->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ __('Title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $permission->title) }}" >
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
