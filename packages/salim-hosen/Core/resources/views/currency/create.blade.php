@extends("core::layouts.admin")

@section("meta_tags")
<title>{{ __("Create Currency") }}</title>
    <meta name="description" content="Create Currency and Manage Currency Details">
    <meta name="keywords" content="currency,currency_create">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Create Menu") }}
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route('currencies.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="required">{{__('Currency Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="code" class="required">{{__('Currency Code')}}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}">
                @error('code')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                <span class="text-muted">{{ __('Currency code must be valid iso3 code') }}</span>
            </div>

            <div class="mb-3">
                <label for="symbol" class="required">{{__('Symbol')}}</label>
                <input class="form-control {{ $errors->has('symbol') ? 'is-invalid' : '' }}" type="text" name="symbol" id="symbol" value="{{ old('symbol', '') }}">
                @error('symbol')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="position" class="required">{{__('Symbol Position')}}</label>
                <select class="form-control select {{ $errors->has('position') ? 'is-invalid' : '' }}" name="position" id="position">
                    <option value="" >{{__('Select Position')}}</option>
                        <option value="left" @if(old('position') == 'left') selected @endif>Left</option>
                        <option value="right" @if(old('position') == 'right') selected @endif>Right</option>
                </select>
                @error('currency')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exchange_rate" class="required">{{__('Exchange Rate')}}</label>
                <input class="form-control {{ $errors->has('exchange_rate') ? 'is-invalid' : '' }}" type="text" name="exchange_rate" id="exchange_rate" value="{{ old('exchange_rate', '') }}">
                @error('exchange_rate')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">{{ __("Status") }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                    <label class="form-check-label ms-3" >{{ __('Active') }}</label>
                </div>
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
