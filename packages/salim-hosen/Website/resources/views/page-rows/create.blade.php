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
        <form method="POST" action="{{ route('page-rows.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="row_index">{{ __("Row Index") }}</label>
                <input type="number" class="form-control" name="row_index">
            </div>

            <div class="mb-3">
                <label for="class_name">{{ __("Parent Class Name") }}</label>
                <input type="text" class="form-control" name="class_name">
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="is_active" type="checkbox" checked>
                    <label class="form-check-label ms-3" >{{ __("Active") }}</label>
                </div>
            </div>

            <div class="mb-3">
                <input type="hidden" value="{{ request('page_id') }}" name="page_id">
                <button class="btn btn-primary" type="submit">
                    {{ __('Save') }}
                </button>
            </div>

    </div>
</div>

@include("core::media_upload.uploader-modal")

@endsection


@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection


@push('body_scripts')
    <script>
        vdata = {
            ...vdata,
            selected_file_field: 'image',
            files: {
                image: {
                    multiple: false,
                    data: []
                }
            },
            media: {}
        }

        vmethods = {
            ...vmethods,
            async destroy() {
                this.media = {};
                this.files.image.data = [];
            },
            mediaUploadDone(){
                if(this.files[this.selected_file_field].data.length > 0){
                    this.media = this.files[this.selected_file_field].data[0];
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
