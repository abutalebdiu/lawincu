@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("Edit City") }}</title>
    <meta name="description" content="Edit City and Manage City Details">
    <meta name="keywords" content="city,city_edit">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Edit City") }}
    </div>

    <div class="card-body">

        <form  action="{{ route('cities.update', $city->id)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label for="country" class="required">{{__('Country')}}</label>
                <select class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country" @change.prevent="fetchStates">
                    <option value="" >{{__('Select Country')}}</option>
                    @foreach ($countries as $country)
                        <option  @if($country['id'] == $city->country_id) selected @endif value="{{$country['id'] }}">{{ $country['name'] }}</option>
                    @endforeach
                </select>
                @error('country')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="state" class="required">{{__('States')}}</label>
                <select class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state" id="state" v-model="state">
                    <option value="" >{{__('Select State')}}</option>
                    <option v-for="state in states" :key="state.id" :value="state.id">@{{ state.name }}</option>
                </select>
                @error('state')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="name">{{__('City Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $city->name)}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="arabic_name">{{__('City Arabic Name')}}</label>
                <input class="form-control {{ $errors->has('arabic_name') ? 'is-invalid' : '' }}" type="text" name="arabic_name" id="arabic_name" value="{{ old('arabic_name', $city->arabic_name)}}">
                @error('arabic_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

              <div class="mb-3">
                  <button class="btn btn-primary" type="submit">
                        {{ __('Update') }}
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
            state: @json($city->state_id),
            states: @json($states),
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
            },
        }

        vcreated = {
            ...vcreated
            // function key: function(){}
        }

        vmounted = {
            ...vmounted,
            // function key: function(){}
        }
    </script>
@endpush
