@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("Edit Language") }}</title>
    <meta name="description" content="Edit Language and Manage Language Details">
    <meta name="keywords" content="language,language_edit">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Edit Language") }}
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('languages.update', $language->id) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="form-group">
                <label for="name" class="required">{{__('Language Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $language->name)}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="country" class="required">{{__('Country')}}</label>
                <select class="form-control select {{ $errors->has('position') ? 'is-invalid' : '' }}" name="country" id="country">
                    <option value="" >{{__('Select Country')}}</option>
                    @foreach ($countries as $country)
                        <option  @if($language->country_id == $country->id) selected @endif value="{{$country['id'] }}">{{ $country['name'] }}</option>
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
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $language->code) }}" readonly>
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
                         <option @if($language->direction == 'ltr') selected @endif value="ltr">{{ __("Left to Right") }}</option>
                         <option @if($language->direction == 'rtl') selected @endif value="rtl">{{ __("Right to Left") }}</option>
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
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" @if($language->is_active) checked @endif>
                    <label class="form-check-label ms-3" >{{ __('Active') }}</label>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ __('Update')}}
                </button>
            </div>


        </form>

    </div>
</div>



@endsection
