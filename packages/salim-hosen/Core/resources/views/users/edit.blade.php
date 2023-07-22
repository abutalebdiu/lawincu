@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Edit User") }}</title>
    <meta name="description" content="Edit User and Manage User Details">
    <meta name="keywords" content="user,user_edit">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        {{ __('Edit User') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="required" for="name">{{ __('Name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label class="required" for="email">{{ __('Email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" readonly>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label class="required" for="phone">{{ __('Phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password">{{ __('New Password') }} <small>({{ __("Optional") }})</small></label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" autocomplete="new-password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            {{-- <div class="mb-3">
                <label class="required" for="company">{{ __('Company') }}</label>
                <select name="company[]" id="company" class="form-control select2 @error('company') is-invalid @enderror" multiple>
                    <option value="">{{ __("Select Company") }}</option>
                    @foreach ($companies as $company)
                        <option @if(in_array($company->id, $user->companies()->pluck('id')->toArray())) selected @endif value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                @error("company")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}

            {{-- <div class="mb-3">
                <label class="required" for="roles">{{ __('Roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ __('Select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ __('Deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
            </div> --}}


            <div class="mb-3">
                <label class="required" for="role">{{ __('Role') }}</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" >
                    <option value="">{{ __("Select Role") }}</option>
                    <option value="0" selected>{{ __("Admin (Full Access)") }}</option>
                    @foreach ($subroles as $subrole)
                        <option @if ($company_user->subrole_id == $subrole->id) selected @endif value="{{ $subrole->id }}">{{ $subrole->title }}</option>
                    @endforeach
                </select>
                @error("role")
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


@push("body_scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush
