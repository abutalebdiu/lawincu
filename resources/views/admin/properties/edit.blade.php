@extends(getLayout())
@section('meta_tags')
    <title>{{ __('Edit Property') }}</title>
    <meta name="description" content="Property List and Manage Property Details">
    <meta name="keywords" content="Property,Add New Property">
@endsection
@push('head_tags')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Page CSS-->
@endpush

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.property.index') }}">
                {{ __('Property List') }}
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-1">
            {{ __('Edit Property') }}
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.property.update',$property->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Property Title</label>
                            <input type="text" name="title" id="title" value="{{ $property->title }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Property Title (Arabic)</label>
                            <input type="text" name="title_ar" id="title_ar" value="{{ $property->title_ar }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Property Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ $property->slug }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Property Type</label>
                            <select name="property_type_id" id="property_type_id" class="form-control">
                                <option value="">Select Property</option>
                                @foreach ($propertytypes as $type)
                                    <option {{ $property->property_type_id == $type->id ? "selected" : "" }} value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Construction Type</label>
                            <select name="construction_type" id="construction_type" class="form-control">
                                <option value="">Select Construction Type</option>
                                <option {{ $property->construction_type == 'Under Construction' ? 'selected' : '' }}
                                    value="Under Construction">Under Construction</option>
                                <option {{ $property->construction_type == 'Ready' ? 'selected' : '' }} value="Ready">Ready
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Purpose</label>
                            <select name="purpose" id="purpose" class="form-control">
                                <option value="">Select Purpose</option>
                                <option {{  $property->purpose == 'For Rent' ? 'selected' : '' }} value="For Rent">For Rent</option>
                                <option {{  $property->purpose == 'For Sale' ? 'selected' : '' }} value="For Sale">For Sale</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Electricity</label>
                            <select name="electricity" id="electricity" class="form-control">
                                <option value="">Select</option>
                                <option {{ $property->electricity == 'Yes' ? 'selected' : '' }} vvalue="Yes">Yes</option>
                                <option {{ $property->electricity == 'No' ? 'selected' : '' }} value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Water</label>
                            <select name="water" id="water" class="form-control">
                                <option value="">Select</option>
                                <option {{ $property->water == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
                                <option {{ $property->water == 'No' ? 'selected' : '' }} value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Property Length</label>
                            <input type="text" name="length" id="length" value="{{ $property->length }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Property Width</label>
                            <input type="text" name="width" id="width" value="{{ $property->width }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Property Age</label>
                            <input type="text" name="age" id="age" value="{{ $property->age }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Bedrooms (Number)</label>
                            <input type="text" name="bedrooms" id="bedrooms" value="{{ $property->bedrooms }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Bathrooms (Number)</label>
                            <input type="text" name="bathrooms" id="bathrooms" value="{{ $property->bathrooms }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Living Rooms (Number)</label>
                            <input type="text" name="livingroom" id="livingroom" value="{{ $property->livingroom }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Guest Rooms (Number)</label>
                            <input type="text" name="guestroom" id="guestroom" value="{{ $property->guestroom }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Land Area (Number)</label>
                            <input type="text" name="landarea" id="landarea" value="{{ $property->landarea }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Built-Up Area (Number)</label>
                            <input type="text" name="builduparea" id="builduparea" value="{{ $property->builduparea }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Images ।</label>
                            <small class="text-dark-50"> Every image size should be: 400x400 pixels</small>
                            <br>

                            @if($property->images)
                                @foreach ($property->images as $image)
                                    <img src="{{ asset($image) }}" alt="" class="w-25">
                                @endforeach
                            @endif


                            <input type="file" name="images[]" id="images" value="{{ old('images') }}"
                                class="form-control" multiple accept=".jpg,.jpeg,.png,.gif">
                        </div>
                    </div>

                    <div class="col-12 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Property Description</label>
                            <textarea name="description" id="description" class="form-control tinymceeditor" rows="10">{{ $property->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Property Description (Arabic) </label>
                            <textarea name="description_ar" id="description_ar" class="form-control tinymceeditor" rows="10">{{ $property->description_ar }}</textarea>
                        </div>
                    </div>

                    <div class="col-12 ">
                        <p class="border-bottom">Price Information</p>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Price (SAR)</label>
                            <input type="text" name="price" id="price" value="{{ $property->price }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Per Square Meter (sqm) Price (SAR)</label>
                            <input type="text" name="sqrprice" id="sqrprice" value="{{ $property->sqrprice }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Ref no.</label>
                            <input type="text" name="referenceno" id="referenceno" value="{{ $property->referenceno }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12 ">
                        <p class="border-bottom">Location Information</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="required">{{ __('Country') }}</label>
                        <select name="country" id="country" class="form-control">
                            <option value="">{{ __('Select Country') }}</option>
                            @foreach ($countries as $country)
                                <option {{ $property->country == $country->id ? "selected" : "" }} value="{{ $country->id }}">{{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="required">{{ __('State') }}</label>
                        <select name="state" id="state" class="form-control">
                            <option value="">{{ __('Select State') }}</option>
                            <option></option>
                        </select>
                    </div>

                    <div class="col-12 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Location & Nearby (PB Value)</label>
                            <input type="text" name="map_code" id="map_code" value="{{ $property->map_code }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-12 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Features and Amenities</label>
                            <textarea name="features" id="features" class="form-control tinymceeditor" rows="2">{{ $property->features }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Fixtures and Fittings</label>
                            <textarea name="fixtures" id="fixtures" class="form-control tinymceeditor" rows="2">{{ $property->fixtures }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="form-group">
                            <label for="">Street</label>
                            <input type="text" name="street" id="street" value="{{ $property->street }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="form-group">
                            <label for="">Width</label>
                            <input type="text" name="streetwidth" id="streetwidth" value="{{ $property->streetwidth }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <div class="form-group">
                            <label for="">Facing</label>
                            <input type="text" name="facing" id="facing" value="{{ $property->facing }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-12 col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script src="https://cdn.tiny.cloud/1/uk57kx8225bu90dgs5yav45m4xtqeohx6okmiaiiukd893pr/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '.tinymceeditor',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="{{ asset('js/tags-input.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#title").blur(function(e) {
                var slug = convertToSlug(e.target.value);
                $("#slug").val(slug);
            });

            function convertToSlug(Text) {
                return Text.toLowerCase()
                    .replace(/ /g, '-')
                    .replace(/[^\w-]+/g, '');
            }

        });
    </script>
@endpush
