@extends(getLayout())


@section("meta_tags")
<title>{{ __("Create Address") }}</title>
    <meta name="description" content="Contact Created and Manage Contact Details">
    <meta name="keywords" content="contact,contact_create">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Add Contact") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("address.store") }}" enctype="multipart/form-data">

            @csrf

            <div class="form-group" >
                <label class="required" for="name">{{ __("Name") }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="email">{{ __("Email") }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="phone">{{ __("Phone") }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone') }}">
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">{{ __("Street Address1") }}</label>
                        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" id="" cols="5" rows="3">{{ old('address') }}</textarea>
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_2">{{ __("Street Address2") }}</label>
                        <textarea class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" id="address_2" name="address_2" id="" cols="5" rows="3">{{ old('address_2') }}</textarea>
                        @if($errors->has('address_2'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address_2') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="city">{{ __("Country") }}</label>
                        <select name="country" class="form-control" id="country"  @change.prevent="fetchStates">
                            <option value="">{{ __("Select Country") }}</option>
                            @foreach($countries as $country)
                               <option value="{{$country->id}}" >
                                  {{$country->name}}
                               </option>
                            @endforeach
                          </select>
                        {{-- <label class="required" for="country_id">{{ __("Country ID") }}</label>
                        <input class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" type="text" name="country_id" id="country_id" value="{{ old('country_id') }}">
                        @if($errors->has('country_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('country_id') }}
                            </div>
                        @endif --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="state" class="required">{{__('States')}}</label>
                        <select class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state" id="state">
                            <option value="" >{{__('Select State')}}</option>
                            <option v-for="state in states" :key="state.id" :value="state.id">@{{ state.name }}</option>
                        </select>
                        @error('state')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="city">{{ __("City") }}</label>
                        <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city') }}">
                        @if($errors->has('city'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="zip_code">{{ __("Zip Code") }}</label>
                        <input class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}">
                        @if($errors->has('zip_code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('zip_code') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" name="contact_id" value="{{ request('contact') }}">
                <button class="btn btn-primary" type="submit">
                    {{ __("Save") }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('body_scripts')
    <script>
        vdata = {
            ...vdata,
            states: [],
contact_type: "Individual"
        }

        vmethods = {
            ...vmethods,
            async fetchStates(e){
                try{
                    const response = await axios.get("/states?country_id="+e.target.value);
                    this.states = response.data.data;
                }catch(err){
                    console.log(err);
                    // this.toast("Something Wen't Wrong!", "error");
                }
            }
        }

        vcreated = {
            ...vcreated,
            // function key: function(){}
        }

        vmounted = {
            ...vmounted,
            // function key: function(){}
        }
    </script>
@endpush
