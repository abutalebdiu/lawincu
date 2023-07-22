@extends(getLayout())

@section("meta_tags")
    <title>{{ __("Create Account") }}</title>
    <meta name="description" content="Contact Created and Manage Contact Details">
    <meta name="keywords" content="contact,contact_create">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="card">
    <div class="card-header">
        {{ __("Add Company") }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("accounts.update", $contact->id) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <label for="image" role="button">
                            <img src="{{ asset($contact->image ? "images/contact/$contact->image" : "images/company.png") }}" alt="" class="img-fluid" width="120">
                            <input type="file" name="image" id="image" hidden onchange="this.previousElementSibling.setAttribute('src',window.URL.createObjectURL(event.target.files[0]))">
                        </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="mb-3" >
                        {{-- <label class="required" for="name">{{ __("Name") }}</label> --}}
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $contact->name) }}" placeholder="{{ __("Name") }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        {{-- <label class="required" for="email">{{ __("Email") }}</label> --}}
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email',  $contact->email) }}" placeholder="{{__("Email")}}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                {{-- <label class="required" for="phone">{{ __("Phone") }}</label> --}}
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone',  $contact->phone) }}" placeholder="{{__("Phone")}}">
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                {{-- <label class="required" for="mobile">{{ __("Mobile") }}</label> --}}
                                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile',  $contact->mobile) }}" placeholder="{{__("Mobile")}}">
                                @if($errors->has('mobile'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('mobile') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                {{-- <label class="required" for="fax">{{ __("Fax") }}</label> --}}
                                <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{ old('fax',  $contact->fax) }}" placeholder="{{__("Fax")}}">
                                @if($errors->has('fax'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('fax') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-3"></div>

            <div class="row">
                <div class="col-md-3">
                    <label for="address">{{ __("Address") }}</label>
                </div>
                <div class="col-md-9">
                    <div class="mb-3">
                        <input type="text" class="form-control @error('address') is-invalide @enderror" id="address" name="address" id="address" placeholder="{{__("Address")}}" value="{{ $contact->address }}">
                        @error("address")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control @error('address_2') is-invalide @enderror" id="address_2" name="address_2" id="address_2" placeholder="{{__("Address 2")}}" value="{{ $contact->address_2 }}">
                        @error("address_2")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                {{-- <label class="required" for="city">{{ __("Country") }}</label> --}}
                                <select name="country" class="form-control @error('country') is-invalid @enderror" id="country"  @change.prevent="fetchStates">
                                    <option value="">{{ __("Select Country") }}</option>
                                    @foreach($countries as $country)
                                       <option @if($contact->country_id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                  </select>

                                @error("country")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        {{-- <label for="state" class="required">{{__('States')}}</label> --}}
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        {{-- <label class="required" for="city">{{ __("City") }}</label> --}}
                                        <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $contact->city) }}" placeholder="{{__("City")}}">
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
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="required" for="person_in_charge">{{ __("Person In Charge") }}</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('person_in_charge') ? 'is-invalid' : '' }}" type="text" name="person_in_charge" id="person_in_charge" value="{{ old('person_in_charge', $contact->person_in_charge) }}">
                    @if($errors->has('person_in_charge'))
                        <div class="invalid-feedback">
                            {{ $errors->first('person_in_charge') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="required" for="nationality">{{ __("Nationality") }}</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $contact->nationality) }}">
                    @if($errors->has('nationality'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nationality') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="required" for="website">{{ __("Website") }}</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $contact->website) }}">
                    @if($errors->has('website'))
                        <div class="invalid-feedback">
                            {{ $errors->first('website') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="required" for="tags">{{ __("Tags") }}</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="text" name="tags" id="tags" value="{{ old('tags', $contact->tags) }}">
                    @if($errors->has('tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tags') }}
                        </div>
                    @endif
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="required" for="tax_id">{{ __("Tax ID") }}</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('tax_id') ? 'is-invalid' : '' }}" type="text" name="tax_id" id="tax_id" value="{{ old('tax_id', $contact->tax_id) }}">
                    @if($errors->has('tax_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tax_id') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="notes">{{ __("Notes") }}</label>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" id="notes" name="notes" id="" cols="5" rows="3">{{ old('notes', $contact->notes) }}</textarea>
                    @if($errors->has('notes'))
                        <div class="invalid-feedback">
                            {{ $errors->first('notes') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="assign_to" class="required">{{__('Assign To')}}</label>
                </div>
                <div class="col-md-9">
                    <select class="form-control select2 {{ $errors->has('assign_to') ? 'is-invalid' : '' }}" name="assign_to" id="assign_to">
                        <option value="" >{{__('Select to Assign')}}</option>
                        @foreach ($users as $user)
                            <option @if($contact->assign_to == $user->id) selected @endif  value="{{$user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('assign_to')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="required" for="mailing_lists">{{ __('Add To Mailing List') }}</label>
                </div>
                <div class="col-md-9">
                    <select name="mailing_lists[]" id="mailing_lists"
                        class="select2 form-control @error('mailing_lists') is-invalid @enderror" multiple>
                        @foreach ($mailing_lists as $mailing_list)
                            <option @if ($contact->mailinglists()->find($mailing_list->id)) selected @endif value="{{ $mailing_list->id }}">
                                {{ $mailing_list->name }}</option>
                        @endforeach
                    </select>
                    @error("mailing_lists")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">
                            {{ __("Save") }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@push('body_scripts')
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

        });

    </script>
    <script>
        vdata = {
            ...vdata,
            state: @json($contact->state_id),
            states: @json($states),
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
