@extends(getLayout())


@section("meta_tags")
<title>{{ __("Create Category") }}</title>
    <meta name="description" content="Create Category and Manage Category Details">
    <meta name="keywords" content="category,category_create">
@endsection

@section("styles")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Add Slider") }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('page-columns.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="column_index">{{ __("Column Index") }}</label>
                <input type="number" class="form-control" name="column_index">
            </div>

            <div class="mb-3">
                <label for="class_name">{{ __("Class Name") }}</label>
                <input type="text" class="form-control" name="class_name">
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="show_data" type="checkbox" v-model="show_data">
                    <label class="form-check-label ms-3" >{{ __("Show Data") }}</label>
                </div>
            </div>

            <div class="mb-3" v-show="show_data">
                <label for="data_type">{{ __("Data Type") }}</label>
                <select name="data_type" id="data_type" class="form-control" v-model="data_type">
                    <option value="">{{ __("Select Data Type") }}</option>
                    <option value="featured_product">{{ "Featured Product" }}</option>
                    <option value="featured_category">{{ "Featured Category" }}</option>
                </select>
            </div>

            <div class="mb-3" v-show="data_type == 'featured_product'">
                <label for="data">{{ __("Product") }}</label>
                <select name="data" id="data" class="form-control" name="data">
                    <option value="">{{ __("Select Product") }}</option>
                    @foreach ($featured_products as $featured_product)
                        <option value="{{ $featured_product->id }}">{{ $featured_product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" v-show="data_type == 'featured_category'">
                <label for="data">{{ __("Category") }}</label>
                <select name="data" id="data" class="form-control">
                    <option value="">{{ __("Select Category") }}</option>
                    @foreach ($featured_categories as $featured_category)
                        <option value="{{ $featured_category->id }}">{{ $featured_category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="is_active" type="checkbox" checked>
                    <label class="form-check-label ms-3" >{{ __("Active") }}</label>
                </div>
            </div>

            <div class="mb-3">
                <input type="hidden" value="{{ request('page_row_id') }}" name="page_row_id">
                <button class="btn btn-primary" type="submit">
                    {{ __('Save') }}
                </button>
            </div>

    </div>
</div>


@endsection


@push("body_scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        vdata = {
            ...vdata,
            show_data: false,
            data_type: '',
        }

        vmethods = {
            ...vmethods,
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

