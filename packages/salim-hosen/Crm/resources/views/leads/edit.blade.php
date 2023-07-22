@extends('core::layouts.admin')


@section('meta_tags')
<title>{{ __("Edit Lead") }}</title>
    <meta name="description" content="Edit Leads">
    <meta name="keywords" content="lead,lead_edit">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush


@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Edit Lead') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('leads.update', [$lead->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="required" for="title">{{ __('Lead Title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', $lead->title) }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>


                <div class="mb-3">
                    <label class="required" for="lead_value">{{ __('Lead Value') }}</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">{{ config('settings.currency') }}</span>
                        </div>
                        <input class="form-control {{ $errors->has('lead_value') ? 'is-invalid' : '' }}" type="number" name="lead_value" id="lead_value" value="{{ old('lead_value', $lead->lead_value) }}">
                        @if($errors->has('lead_value'))
                            <div class="invalid-feedback">
                                {{ $errors->first('lead_value') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label class="required" for="contact">{{ __('Contact') }}</label>
                    <select class="form-control js-data-example-ajax {{ $errors->has('contact') ? 'is-invalid' : '' }}" name="contact"
                        id="contact">
                        @foreach ($contacts as $contact)
                            <option value="{{ $contact->id }}" @if($lead->contact_id == $contact->id) selected @endif>{{ $contact->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('contact'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="required" for="email">{{ __('Email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                        id="email" value="{{ old('email', $lead->email) }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="required" for="phone">{{ __('Phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                        id="phone" value="{{ old('phone', $lead->phone) }}">
                    @if ($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="required" for="pipeline">{{ __('Pipeline') }}</label>
                    <select class="form-control select2 {{ $errors->has('pipeline') ? 'is-invalid' : '' }}" name="pipeline" id="pipeline" @change.prevent="fetchStages">
                        <option value="">{{ __("Select Pipeline") }}</option>
                        @foreach($pipelines as $pipeline)
                            <option @if($pipeline->id == $lead->pipeline_id) selected @endif value="{{ $pipeline->id }}">{{ $pipeline->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('pipeline'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pipeline') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="required" for="lead_stage">{{ __('Lead Stage') }}</label>
                    <select class="form-control select2 {{ $errors->has('lead_stage') ? 'is-invalid' : '' }}" name="lead_stage" id="lead_stage" v-model="stage" >
                        <option value="">{{ __("Select Lead Stage") }}</option>
                        <option v-for="stage in stages" :key="stage.id" :value="stage.id">@{{ stage.name }}</option>
                    </select>
                    @if($errors->has('lead_stage'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lead_stage') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="expected_closing_date">{{ __('Expected Closing Date') }}</label>
                    <input class="form-control {{ $errors->has('expected_closing_date') ? 'is-invalid' : '' }}" type="date" name="expected_closing_date" id="expected_closing_date" value="{{ old('expected_closing_date', $lead->expected_closing_date) }}">
                    @if($errors->has('expected_closing_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('expected_closing_date') }}
                        </div>
                    @endif
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script type="text/javascript">


    $(document).ready(function(){


                $('.js-data-example-ajax').select2({
                    placeholder: 'Search for Company',
                    ajax: {
                        url: "{{ route('api.contacts.index') }}",
                        dataType: 'json',
                        processResults: function (data, params) {

                            const items = data.map(row => ({
                                id: row.id,
                                text: row.name,
                                email: row.email,
                                phone: row.phone
                            }));

                            return {
                                results: items
                            };
                        }
                    }
                });

                $('.js-data-example-ajax').on('select2:select', function (e) {
                    var data = e.params.data;
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                });

    });
</script>
    <script>
        vdata = {
            ...vdata,
            stages: @json($stages),
            stage: @json($lead->lead_stage_id)
        }

        vmethods = {
            ...vmethods,
            async fetchStages(e){
                try{
                    const response = await axios.get("/lead-stages?pipeline_id="+e.target.value);
                    this.stages = response.data;
                    this.stage = "";
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
