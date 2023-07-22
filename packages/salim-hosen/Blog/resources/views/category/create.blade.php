@extends(getLayout())


@section('meta_tags')
    <title>{{ __('Create Category') }}</title>
    <meta name="description" content="Create Category and Manage Category Details">
    <meta name="keywords" content="category,category_create">
@endsection

@push('head_tags')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">

        <div class="card-header">
            {{ __('Create Category') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('blog-categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name">{{ __('Category Name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', '') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="arabic_name">{{ __('Category Arabic Name') }}</label>
                    <input class="form-control {{ $errors->has('arabic_name') ? 'is-invalid' : '' }}" type="text"
                           name="arabic_name" id="arabic_name" value="{{ old('arabic_name', '') }}">
                    @error('arabic_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category">{{ __('Parent Category') }}</label>
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category"
                            id="category">
                        <option value="">{{ __('Choice Parent Category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}" {{ $category['id'] == request('category_id') ? 'selected' : '' }}>
                                {{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="icon">{{ __('Font Awesome Icon') }}</label>
                    <input class="form-control" name="icon" value="fas fa-anchor" type="text" />
                </div>

                {{-- <div class="mb-3">
                <label for="formFile" class="form-label"></label>
                <input class="form-control" type="file" id="formFile" name="image">
              </div> --}}

                <div class="row">
                    <div class="col-md-3" v-if="Object.keys(media).length > 0">
                        <div class="mb-3">
                            <div class="product-image">
                                <img v-bind:src="media.url" alt="" class="img-fluid">
                                <div class="product-image-actions">
                                    <button @click.prevent="destroy()" class="btn btn-danger btn-xs">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="image" v-model="media.id">
                    </div>
                    <div class="col-md-3" v-else>
                        <div class="mb-3">
                            <label class="upload-button" for="brand-logo" data-bs-toggle="modal" data-bs-target="#fileUploaderModal">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p class="mt-2">{{ __('Upload Image') }}</p>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="is_featured" type="checkbox">
                        <label class="form-check-label ms-3">{{ __('Featured') }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        {{ __('Save') }}
                    </button>
                </div>

        </div>
    </div>

    @include('core::media_upload.uploader-modal')
@endsection


@push('body_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush



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
            mediaUploadDone() {
                if (this.files[this.selected_file_field].data.length > 0) {
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
