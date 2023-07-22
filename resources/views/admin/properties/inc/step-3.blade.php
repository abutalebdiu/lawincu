<input type="hidden" name="step" value="3">
@if ($property)
    <input type="hidden" name="property_id" value="{{ $property->id }}">
@endif

<div class="row">
    <div class="col-md-12">
        <h3>@lang('Enter the property details')</h3>
    </div>
    @if ($property->property_type_id == 3)
        <div class="col-xl-4 col-md-6">
            <div class="mb-1">
                <label for="kind">Property kind (نوع الإعلان)
                    {{ request('property_id') }}</label>
                <select class="form-control" name="kind" id="kind">
                    <option value="">-Select-</option>
                    <option {{ $property->kind == 'Single (عزاب)' ? 'selected' : '' }} value="Single (عزاب)">Single
                        (عزاب)
                    </option>
                    <option {{ $property->kind == 'Family (عوائل)' ? 'selected' : '' }} value="Family (عوائل)">For Rent
                        (عوائل)
                    </option>
                </select>
            </div>
        </div>
    @endif

    {{-- In case for Villa or a building or a apartment add --}}
    @if ($property->property_type_id == 2 || $property->property_type_id == 3 || $property->property_type_id == 6)
        <div class="col-xl-4 col-md-6">
            <div class="mb-1">
                <label for="area">Property area (sft)</label>
                <input id="area" type="number" name="area" placeholder="Property area (مساحة العقار ) sft"
                    class="form-control" value="{{ old('area') != '' ? old('area') : $property->area }}">
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="mb-1">
                <label for="total_rooms">No. of rooms</label>
                <input id="total_rooms" type="text" name="total_rooms" placeholder="No. of rooms (عدد الغرف)"
                    class="form-control"
                    value="{{ old('total_rooms') != '' ? old('total_rooms') : $property->total_rooms }}">
            </div>
        </div>
    @endif

    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="receptions">No. of Receptions</label>
            <input id="receptions" type="number" name="receptions" placeholder="No. of Receptions (عدد الصالات)"
                class="form-control" value="{{ $property->receptions }}">
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="total_toilets">No. of toilets</label>
            <input id="total_toilets" type="number" name="total_toilets"
                placeholder="No. of toilets (عدد دورات المياة)" class="form-control"
                value="{{ $property->total_toilets }}">
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="floor_no">Floor number (رقم الدور) </label>
            <select class="form-control" name="floor_no" id="floor_no">
                <option value="">-Select-</option>
                <option {{ $property->floor_no == 'Single (عزاب)' ? 'selected' : '' }} value="Single (عزاب)">Land floor
                    (ارضي)
                </option>
                <option {{ $property->floor_no == 'Family (عوائل)' ? 'selected' : '' }} value="Family (عوائل)">Upper
                    floor (علوي)
                </option>
            </select>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="age">Property age (عمر العقار)</label>
            <select class="form-control" name="age" id="age">
                <option value="">-Select-</option>
                <option {{ $property->age == 'Less than one year (أقل من سنة )' ? 'selected' : '' }}
                    value="Less than one year (أقل من سنة )">Less than one year
                    (أقل من سنة )</option>
                <option {{ $property->age == 'Year – 5 years (سنة – 5 سنوات)' ? 'selected' : '' }}
                    value="Year – 5 years (سنة – 5 سنوات)">Year – 5 years (سنة –
                    5 سنوات)</option>
                <option {{ $property->age == 'More than 5 years (اكثر من 5 سنين)' ? 'selected' : '' }}
                    value="More than 5 years (اكثر من 5 سنين)">More than 5 years
                    (اكثر من 5 سنين)</option>
                <option {{ $property->age == 'More than 10 years (اكثر من 10 سنوات)' ? 'selected' : '' }}
                    value="More than 10 years (اكثر من 10 سنوات)">More than 10
                    years (اكثر من 10 سنوات)</option>
            </select>
        </div>
    </div>


    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="total_price">Total price</label></label>
            <input id="total_price" type="number" name="total_price" placeholder="Total price (السعر الاجمالي)"
                class="form-control" value="{{ $property->total_price }}" required>
            <div class="invalid-feedback">
                The total price field is required.
            </div>
        </div>
    </div>




    {{-- In case for apartment ad --}}
    @if ($property->property_type_id == 2 || $property->property_type_id == 6)
        <div class="col-xl-4 col-md-6">
            <div class="mb-1">
                <label for="chart_no">Chart Number</label></label>
                <input id="chart_no" type="number" name="chart_no" placeholder="Chart Number (رقم المخطط)"
                    class="form-control" value="{{ old('chart_no') != '' ? old('chart_no') : $property->chart_no }}">
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="mb-1">
                <label for="part_no">Part number</label></label>
                <input id="part_no" type="number" name="part_no" placeholder="Part Number (رقم القطعة)"
                    class="form-control" value="{{ old('part_no') != '' ? old('part_no') : $property->part_no }}">
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="mb-1">
                <label for="other_features">Other features (مزايا أخرى)</label>
                <select class="form-control" name="other_features[]" id="other_features" multiple>
                    <option value="">-Select-</option>
                    <option value="1">Furnished (مؤثث)</option>
                    <option value="2">Kitchen (مطبخ)</option>
                    <option value="3">Car parking (مدخل سيارة)</option>
                    <option value="4">Elevator (مصعد)</option>
                    <option value="5">Air conditioners (مكيفات)</option>
                    <option value="6">Basement (قبو)</option>
                    <option value="7">Driver room (غرفة سائق)</option>
                    <option value="8">Maid room (غرفة خادمة)</option>
                </select>
            </div>
        </div>
    @endif


    {{-- <div class="col-xl-4 col-md-6">
                                                    <div class="mb-1">
                                                        <label for="">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="1">Publish</option>
                                                            <option value="2">Unpublish</option>
                                                            <option value="3">Draft</option>
                                                        </select>
                                                    </div>
                                                </div> --}}

    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label>Country</label>
            <select class="form-control" name="country_id" id="country_id" required oninput="getStates(this.value)">
                <option value="">-Select-</option>
                @foreach ($countries as $country)
                    <option {{ $country->id == $property->country_id ? 'selected' : '' }}
                        value="{{ $country->id }}">
                        {{ $country->name . '(' . $country->name_ar . ')' }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="state_id">State</label>
            <select class="form-control" name="state_id" id="state_id" oninput="getCities(this.value)" required>
                <option value="">-Select-</option>
            </select>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="city_id">City</label>
            <select class="form-control" name="city_id" id="city_id" required>
                <option value="">-Select-</option>
            </select>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ $property->location }}"
                placeholder="enter location ">
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="mb-1">
            <label for="other_features">Other features (مزايا أخرى)</label>
            <select class="form-control" name="other_features[]" id="other_features" multiple>
                <option value="">-Select-</option>
                <option value="1">Furnished (مؤثث)</option>
                <option value="2">Kitchen (مطبخ)</option>
                <option value="3">Car parking (مدخل سيارة)</option>
                <option value="4">Elevator (مصعد)</option>
                <option value="5">Air conditioners (مكيفات)</option>
            </select>
        </div>
    </div>
    <div class="col-12 mt-1">
        <div class="mb-5">
            <label for="editor">Enter the property details (ادخل تفاصيل
                العقار)</label>
            <textarea id="editor" name="description" rows="5" placeholder="Description">{{ old('description') ?? $property->description }}</textarea>
        </div>
    </div>
</div>



