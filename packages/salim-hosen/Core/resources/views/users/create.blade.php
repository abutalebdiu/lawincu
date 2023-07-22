@extends(getLayout())

@section("meta_tags")
    <title>{{ __("Create User") }}</title>
    <meta name="description" content="Create User and Manage User Details">
    <meta name="keywords" content="user,user_create">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush


@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Create User') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="required" for="name">{{ __('Name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="required" for="email">{{ __('Email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="required" for="phone">{{ __('Phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="required" for="password">{{ __('Password') }}</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" autocomplete="new-password">
                @error("password")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <label class="required" for="roles">{{ __('Roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ __('Select All') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ __('Deselect All') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
            </div> --}}

            {{-- <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="required" for="company">{{ __('Company') }}</label>
                        <select name="company" id="company" class="form-control @error('company') is-invalid @enderror">
                            <option value="">{{ __("Select Company") }}</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error("company")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="required" for="company_role">{{ __('Company Role') }}</label>
                        <select name="company_role" id="company_role" class="form-control @error('company_role') is-invalid @enderror" >
                            <option value="">{{ __("Select Company Role") }}</option>
                            @foreach ($subroles as $subrole)
                                <option value="{{ $subrole->id }}">{{ $subrole->title }}</option>
                            @endforeach
                        </select>
                        @error("company_role")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div> --}}


            <div class="mb-3">
                <label class="required" for="role">{{ __('Role') }}</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" >
                    <option value="">{{ __("Select Role") }}</option>
                    <option value="0">{{ __("Admin (Full Access)") }}</option>
                    @foreach ($subroles as $subrole)
                        <option value="{{ $subrole->id }}">{{ $subrole->title }}</option>
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
