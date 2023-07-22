@extends('core::layouts.admin')

@section("meta_tags")
    <title>{{ __("Create Language") }}</title>
    <meta name="description" content="Create Language and Manage Language Details">
    <meta name="keywords" content="language,language_create">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Create Language") }}
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('languages.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="required">{{__('Language Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="country" class="required">{{__('Country')}}</label>
                <select class="form-control select {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country">
                    <option value="" >{{__('Select Country')}}</option>
                    @foreach ($countries as $country)
                        <option @if(old('country') == $country->id) selected @endif value="{{$country['id'] }}">{{ $country['name'] }}</option>
                    @endforeach
                </select>
                @error('country')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="code" class="required">{{__('Code')}}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}">
                @error('code')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label for="direction" class="required">{{__('Direction')}}</label>
                <select class="form-control select2 {{ $errors->has('direction') ? 'is-invalid' : '' }}" name="direction" id="direction">
                    <option value="" >{{__('Select Direction')}}</option>
                         <option @if(old('direction') == 'ltr') selected @endif value="ltr">{{ __("Left to Right") }}</option>
                         <option @if(old('direction') == 'rtl') selected @endif value="rtl">{{ __("Right to Left") }}</option>
                </select>
                @error('direction')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">{{ __("Status") }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label ms-3" >{{ __('Active') }}</label>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ __('Save')}}
                </button>
            </div>


        </form>
    </div>

</div>



@endsection
