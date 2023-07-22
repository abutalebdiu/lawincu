@extends('core::layouts.admin')

@section("meta_tags")
    <title>{{ __("Create Country") }}</title>
    <meta name="description" content="Create Country and Manage Country Details">
    <meta name="keywords" content="country,country_create">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Create Country") }}
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('countries.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="required" for="name">{{__('Country Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="arabic_name">{{__('Country Arabic Name')}}</label>
                <input class="form-control {{ $errors->has('arabic_name') ? 'is-invalid' : '' }}" type="text" name="arabic_name" id="arabic_name" value="{{ old('arabic_name', '')}}">
                @error('arabic_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="iso_code_2">{{__('ISO Code 2')}}</label>
                <input class="form-control {{ $errors->has('iso_code_2') ? 'is-invalid' : '' }}" type="text" name="iso_code_2" id="iso_code_2" value="{{ old('iso_code_2', '') }}">
                @error('iso_code_2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="iso_code_3">{{__('ISO Code 3')}}</label>
                <input class="form-control {{ $errors->has('iso_code_3') ? 'is-invalid' : '' }}" type="text" name="iso_code_3" id="iso_code_3" value="{{ old('iso_code_3', '') }}">
                @error('iso_code_3')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="country_code">{{__('Country Code')}}</label>
                <input class="form-control @error('country_code') is-invalid @enderror" type="text" name="country_code" id="country_code" value="{{ old('country_code', '') }}">
                @error('country_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="flag" class="form-label"></label>
                <input class="form-control  @error('flag') is-invalid @enderror" type="file" id="flag" name="flag">
                @error('flag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">{{ __("Status") }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="is_active" type="checkbox" >
                    <label class="form-check-label ms-3" >{{ __("Active") }}</label>
                </div>
            </div>

              <div class="mb-3">
                  <button class="btn btn-primary" type="submit">
                        {{ ('Save') }}
                  </button>
              </div>
        </form>
    </div>
</div>



@endsection
