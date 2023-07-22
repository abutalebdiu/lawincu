@extends("core::layouts.admin")


@section("meta_tags")
<title>{{ __("Edit Currency") }}</title>
    <meta name="description" content="Edit Currency and Manage Currency Details">
    <meta name="keywords" content="currency,currency_edit">
@endsection


@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Edit Menu") }}
    </div>

    <div class="card-body">
        <form action="{{ route('currencies.update', $currency->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="name" class="required">{{__('Currency Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $currency->name)}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="code" class="required">{{__('Currency Code')}}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $currency->code) }}">
                @error('code')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="symbol" class="required">{{__('Symbol')}}</label>
                <input class="form-control {{ $errors->has('symbol') ? 'is-invalid' : '' }}" type="text" name="symbol" id="symbol" value="{{ old('symbol', $currency->symbol) }}">
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
                        <option value="left" @if($currency->position == 'left') selected @endif>{{ __("Left") }}</option>
                        <option value="right" @if($currency->position == 'right') selected @endif>{{ __("Right") }}</option>
                </select>
                @error('currency')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exchange_rate" class="required">{{__('Exchange Rate')}}</label>
                <input class="form-control {{ $errors->has('exchange_rate') ? 'is-invalid' : '' }}" type="text" name="exchange_rate" id="exchange_rate" value="{{ old('exchange_rate', $currency->exchange_rate) }}">
                @error('exchange_rate')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

              <div class="mb-3">
                <label for="">{{ __("Status") }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" @if($currency->is_active) checked @endif>
                    <label class="form-check-label ms-3" >{{ __('Active') }}</label>
                </div>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit">
                    {{ __('Update')}}
                </button>
            </div>


        </form>
    </div>
</div>



@endsection
