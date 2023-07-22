@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Create Zone") }}</title>
    <meta name="description" content="Create Zone and Manage Zone Details">
    <meta name="keywords" content="zone,zone_create">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush



@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Create Zone") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('zones.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="required" for="name">{{__('Zone Name')}}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if ($has_whole_world_coverage)
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="cover_whole_world" value="1" type="checkbox" v-model="cover_whole_world">
                        <label class="form-check-label ms-3">{{ __('Cover Whole World') }}</label>
                    </div>
                </div>
            @endif

            <div class="mb-3" v-show="!cover_whole_world">
                <label class="required" for="regions">{{ __('Regions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ __('Select All') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ __('Deselect All') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('regions') ? 'is-invalid' : '' }}" name="regions[]" id="regions" multiple>
                    <option value="" >{{__('Select Regions')}}</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country['name'] }}</option>
                        @foreach ($country->states as $state)
                            <option value="{{ $country->id."-".$state->id }}">{{ $state->name }} - {{ $country->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                @if($errors->has('regions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('regions') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="">{{ __("Status") }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="is_active" value="1" type="checkbox" checked >
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

@push("body_scripts")


<script>
    vdata = {
        ...vdata,
        cover_whole_world: false,
    }

    vmethods = {
        ...vmethods,
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush


