@extends('core::layouts.admin')

@section("meta_tags")
<title>{{ __("Edit Country") }}</title>
    <meta name="description" content="Edit Country and Manage Country Details">
    <meta name="keywords" content="country,country_edit">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Edit Country") }}
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('countries.update', $country->id)}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label class="required" for="name">{{__('Country Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $country->name)}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="arabic_name">{{__('Country Arabic Name')}}</label>
                <input class="form-control {{ $errors->has('arabic_name') ? 'is-invalid' : '' }}" type="text" name="arabic_name" id="arabic_name" value="{{ old('arabic_name', $country->arabic_name)}}">
                @error('arabic_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="iso_code_2">{{__('ISO Code 2')}}</label>
                <input class="form-control {{ $errors->has('iso_code_2') ? 'is-invalid' : '' }}" type="text" name="iso_code_2" id="iso_code_2" value="{{ old('iso_code_2', $country->iso_code_2) }}">
                @error('iso_code_2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="iso_code_3">{{__('ISO Code 3')}}</label>
                <input class="form-control {{ $errors->has('iso_code_3') ? 'is-invalid' : '' }}" type="text" name="iso_code_3" id="iso_code_3" value="{{ old('iso_code_3', $country->iso_code_3) }}">
                @error('iso_code_3')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="country_code">{{__('Country Code')}}</label>
                <input class="form-control {{ $errors->has('country_code') ? 'is-invalid' : '' }}" type="text" name="country_code" id="country_code" value="{{ old('country_code', $country->country_code) }}">
                @error('country_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label"></label>
                <input class="form-control" type="file" id="formFile" name="flag">
              </div>

              <div class="mb-3">
                <label for="">{{ __("Status") }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="is_active" type="checkbox" @if($country->is_active) checked @endif >
                    <label class="form-check-label ms-3" >{{ __("Active") }}</label>
                </div>
            </div>

              <div class="mb-3">
                  <button class="btn btn-primary" type="submit">
                        {{ ('Update') }}
                  </button>
              </div>
        </form>

    </div>
</div>



@endsection
