@extends('core::layouts.admin')

@section("meta_tags")
<title>{{ __("Edit Contact") }}</title>
    <meta name="description" content="Edit Contact">
    <meta name="keywords" content="contact,contact_edit">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
<style>
    .img-flag{
        width: 30px;
    }
</style>
@endpush


@section('content')
@if($errors->count() > 0)
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">

    <div class="card-header">
        {{ trans('Create Contact') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("contacts.update", $contact['id']) }}">
            @csrf
            @method("PUT")

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="required" for="first_name">{{ __('First Name') }}</label>
                        <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" value="{{ old('first_name', $contact['attributes']['FIRSTNAME'] ?? "") }}">
                        @error("first_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="required" for="last_name">{{ __('Last Name') }}</label>
                        <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" value="{{ old('last_name', $contact['attributes']['LASTNAME'] ?? "") }}">
                        @error("last_name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="required" for="email">{{ __('Email') }}</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email', $contact['email']) }}">
                @error("email")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text p-0" id="country_select">
                    <select name="country"></select>
                </span>
                <input type="text" name="phone" class="form-control py-3" placeholder="{{__("Phone")}}" aria-label="phone" aria-describedby="phone" value="{{ old('phone', ltrim($contact['attributes']['SMS'] ?? "", $country->country_code ?? "")) }}">
            </div>

            <div class="mb-3">
                <label class="required" for="lists">{{ __('Select Lists') }}</label>
                <select name="lists[]" id="lists" class="select2 form-control @error('lists') is-invalid @enderror" multiple>
                    @foreach ($lists as $list)
                        <option @if(in_array($list['id'], $contact['listIds'])) selected @endif value="{{ $list['id'] }}">{{ $list['name'] }}</option>
                    @endforeach
                </select>
                @error("lists")
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
        $(document).ready(function(){

            $(".select2").select2();

            var isoCountries = [];

            let countries = @json($countries);
            for(let i = 0; i < countries.length; i++){
                isoCountries.push({
                    id: countries[i].id,
                    text: countries[i].name,
                    country_code: countries[i].country_code,
                    flag: `{{ asset('images/country') }}/${countries[i].flag}`,
                    selected: countries[i].id == @json($country->id ?? "")
                });
            }

            function formatCountry (country) {
              if (!country.id) { return country.text; }
              var $country = $(
                  `<span><img src="${country.flag}" class="img-flag"/> ${country.text} (${country.country_code})</span>`
              );
              return $country;
            };

            //Assuming you have a select element with name country
            // e.g. <select name="name"></select>

            $("[name='country']").select2({
                placeholder: "Select a country",
				templateResult: formatCountry,
                data: isoCountries,
                templateSelection: function (country) {
                    return $(`<span><img src="${country.flag}" class="img-flag"/> ${country.text} (${country.country_code})</span>`)
                }

            });

        });
    </script>

@endpush
