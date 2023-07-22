@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Create Subrole") }}</title>
    <meta name="description" content="Create Role and Manage Role Details">
    <meta name="keywords" content="role,role_create">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Create Role') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("subroles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="required" for="title">{{ __('Title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>


            <div class="mb-3">
                <label class="required" for="permissions">{{ __('Permissions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ __('Select All') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ __('Deselect All') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>{{ $permission->title }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('permissions') }}
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



@push("body_scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush
