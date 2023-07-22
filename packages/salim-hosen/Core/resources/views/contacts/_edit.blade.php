@extends(getLayout())


@section("meta_tags")
<title>{{ __("Edit Contact") }}</title>
    <meta name="description" content="Edit Contact">
    <meta name="keywords" content="contact,contact_edit">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Edit Contact") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("contacts.update", $contact->id) }}" enctype="multipart/form-data">

            @csrf
            @method("PUT")

            <div class="form-group">
                <label>{{ __('Contact Type') }}</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="contact_type" id="contact_type" value="Individual" v-model="contact_type">
                        <label class="form-check-label" for="contact_type">{{ __("Individual") }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="contact_type" id="contact_type" value="Company" v-model="contact_type">
                        <label class="form-check-label" for="contact_type">{{ __("Company") }}</label>
                    </div>
                </div>
                @if($errors->has('contact_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_type') }}
                    </div>
                @endif
            </div>

            <div class="mb-3" v-show="contact_type=='Individual'">
                <label class="required" for="company">{{ __('Company') }}</label>
                <select name="company" id="company" class="form-control js-data-example-ajax @error('company') is-invalid @enderror">

                </select>
                @error("company")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row" v-if="contact_type=='Individual'">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="title">{{ __("Title") }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $contact->title) }}" placeholder="{{__("Mr")}}/{{ __("Mrs") }}">
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{ __('Gender') }}</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" @if($contact->gender == 'male') checked @endif>
                                <label class="form-check-label" for="male">{{ __("Male") }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" @if($contact->gender == 'female') checked @endif>
                                <label class="form-check-label" for="female">{{ __("Female") }}</label>
                            </div>
                        </div>
                        @if($errors->has('gender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="form-group" >
                <label class="required" for="name">{{ __("Name") }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $contact->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="email">{{ __("Email") }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $contact->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="phone">{{ __("Phone") }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}">
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="mobile">{{ __("Mobile") }}</label>
                        <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $contact->mobile) }}">
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="fax">{{ __("Fax") }}</label>
                        <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{ old('fax', $contact->fax) }}">
                        @if($errors->has('fax'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fax') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>



            <div class="form-group" v-if="contact_type=='Individual'">
                <label class="required" for="job_position">{{ __("Job Position") }}</label>
                <input class="form-control {{ $errors->has('job_position') ? 'is-invalid' : '' }}" type="text" name="job_position" id="job_position" value="{{ old('job_position', $contact->job_position) }}">
                @if($errors->has('job_position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_position') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="person_in_charge">{{ __("Person In Charge") }}</label>
                <input class="form-control {{ $errors->has('person_in_charge') ? 'is-invalid' : '' }}" type="text" name="person_in_charge" id="person_in_charge" value="{{ old('person_in_charge', $contact->person_in_charge) }}">
                @if($errors->has('person_in_charge'))
                    <div class="invalid-feedback">
                        {{ $errors->first('person_in_charge') }}
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">{{ __("Street Address1") }}</label>
                        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" id="" cols="5" rows="3">{{ old('address', $contact->address) }}</textarea>
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
                        <textarea class="form-control {{ $errors->has('address_2') ? 'is-invalid' : '' }}" id="address_2" name="address_2" id="" cols="5" rows="3">{{ old('address_2', $contact->address_2) }}</textarea>
                        @if($errors->has('address_2'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address_2') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="country">{{ __("Country") }}</label>
                        <select name="country" class="form-control" id="country"  @change.prevent="fetchStates">
                            <option value="">{{ __("Select Country") }}</option>
                                @foreach($countries as $country)
                                <option @if($country->id == $contact->country_id) selected @endif  value="{{$country->id}}">{{$country->name}}</option>
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
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="required" for="city">{{ __("City") }}</label>
                                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $contact->city) }}">
                                @if($errors->has('city'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="nationality">{{ __("Nationality") }}</label>
                        <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $contact->nationality) }}">
                        @if($errors->has('nationality'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nationality') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="website">{{ __("Website") }}</label>
                        <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $contact->website) }}">
                        @if($errors->has('website'))
                            <div class="invalid-feedback">
                                {{ $errors->first('website') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="tags">{{ __("Tags") }}</label>
                        <input class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="text" name="tags" id="tags" value="{{ old('tags', $contact->tags) }}">
                        @if($errors->has('tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tags') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="job_position">{{ __("Job Position") }}</label>
                        <input class="form-control {{ $errors->has('job_position') ? 'is-invalid' : '' }}" type="text" name="job_position" id="job_position" value="{{ old('job_position', $contact->job_position) }}">
                        @if($errors->has('job_position'))
                            <div class="invalid-feedback">
                                {{ $errors->first('job_position') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="tax_id">{{ __("Tax ID") }}</label>
                        <input class="form-control {{ $errors->has('tax_id') ? 'is-invalid' : '' }}" type="text" name="tax_id" id="tax_id" value="{{ old('tax_id', $contact->tax_id) }}">
                        @if($errors->has('tax_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tax_id') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="contact_source">{{ __("Contact Source") }}</label>
                        <select name="contact_source" id="contact_source" class="form-control {{ $errors->has('contact_source') ? 'is-invalid' : '' }}">
                            <option value="">{{ __("Select Contact Source") }}</option>
                            @foreach (["Email", "Facebook"] as $source)
                                <option @if($contact->contact_source == $source) selected @endif value="{{ $source }}">{{ $source }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('contact_source'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contact_source') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="notes">{{ __("Notes") }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" id="notes" name="notes" id="" cols="5" rows="3">{{ old('notes', $contact->notes) }}</textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label  for="image">{{ __("Image") }}</label>
                <input type="file" name="image" class="form-control">
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="required" for="mailing_lists">{{ __('Mailing Lists') }}</label>
                <select name="mailing_lists[]" id="mailing_lists" class="select2 form-control @error('mailing_lists') is-invalid @enderror" multiple>
                    @foreach ($mailing_lists as $mailing_list)
                        <option @if($contact->mailinglists()->find($mailing_list->id)) selected @endif value="{{ $mailing_list->id }}">{{ $mailing_list->name }}</option>
                    @endforeach
                </select>
                @error("mailing_lists")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ __("Save") }}
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

                    $('.js-data-example-ajax').select2({
                        placeholder: 'Search for Company',
                        ajax: {
                            url: "{{ route('api.contacts.index') }}",
                            dataType: 'json',
                            processResults: function (data, params) {

                                const items = data.map(row => ({
                                    id: row.id,
                                    text: row.name
                                }));

                                return {
                                    results: items
                                };
                            }
                        }
                    });


                    $("#type_company").on("click", function(){
                        $("#company_container").hide();
                    });

                    $("#type_individual").on("click", function(){
                        $("#company_container").show();
                    });

                });




            </script>

<script>
    vdata = {
        ...vdata,
        states: @json($states),
        contact_type: @json($contact->contact_type)
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
