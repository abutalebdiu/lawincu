@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("Create State") }}</title>
    <meta name="description" content="Create State and Manage State Details">
    <meta name="keywords" content="state,state_create">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Create List') }}
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('states.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="required" for="name">{{__('State Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="arabic_name">{{__('State Arabic Name')}}</label>
                <input class="form-control {{ $errors->has('arabic_name') ? 'is-invalid' : '' }}" type="text" name="arabic_name" id="arabic_name" value="{{ old('arabic_name', '')}}">
                @error('arabic_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="country" class="required">{{__('Country')}}</label>
                <select class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country">
                    <option value="" >{{__('Select Country')}}</option>
                    @foreach ($countries as $country)
                        <option value="{{$country['id'] }}">{{ $country['name'] }}</option>
                    @endforeach
                </select>
                @error('country')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
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
