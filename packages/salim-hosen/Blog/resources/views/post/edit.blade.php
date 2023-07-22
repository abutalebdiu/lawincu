@extends(getLayout())


@section("meta_tags")
    <title>{{ __("Edit Post") }}</title>
    <meta name="description" content="Create Post and Manage Post Details">
    <meta name="keywords" content="post,post_create">
@endsection

@push('head_tags')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset("css/tags-input.css") }}"/>
@endpush

@section("content")
    <div class="card">
        <div class="card-body">

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="mb-3">
                    <label class="required" for="title">{{ __('Title') }}</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
                    @error("name")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="required" for="slug">{{ __('Slug') }}</label>
                    <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">
                    @error("slug")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="keywords">{{ __('Keywords') }}</label>
                    <input class="tags-input form-control @error('keywords') is-invalid @enderror" type="text" name="keywords" id="keywords" value="{{ old('keywords', $post->keywords) }}">
                    @error("keywords")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="short_description">{{ __('Short Description') }}</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" id="short_description" cols="30" rows="3">{{ old('short_description', $post->short_description) }}</textarea>
                    @error("short_description")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <label class="required" for="image">{{ __('Image') }}</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image', $post->image) }}">
                    @error("image")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                <div class="row">
                    <div class="col-md-3" v-if="Object.keys(media).length > 0">
                        <div class="mb-3">
                            <div class="product-image">
                                <img v-bind:src="media.url" alt="" class="img-fluid">
                                <div class="product-image-actions">
                                    <button @click.prevent="destroy()"
                                        class="btn btn-danger btn-xs">{{ __('Remove') }}</button>
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
                    <label for="category">{{ __("Choice Category") }}</label>

                    <select name="category[]" id="category" class="form-control select2" multiple="multiple">
                        @foreach ($categories as $category)
                            <option @if ($post->categories()->find($category->id)) selected @endif  value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <label for="category">{{ __("Choice Tag") }}</label>

                    <select name="tag[]" id="tag" class="form-control select2" multiple="multiple">
                        @foreach ($tags as $tag)
                            <option @if ($post->tags()->find($tag->id)) selected @endif value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label class="required" for="content">{{ __('Content') }}</label>
                    <input class="form-control @error('content') is-invalid @enderror" type="text" name="content" id="content" value="{{ old('content',  $post->content) }}">
                    @error("content")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="required" for="meta_title">{{ __('Meta Title') }}</label>
                    <input class="form-control @error('meta_title') is-invalid @enderror" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}">
                    @error("meta_title")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="required" for="meta_keywords">{{ __('Meta Keywords') }}</label>
                    <input class="form-control @error('meta_keywords') is-invalid @enderror" type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}">
                    @error("meta_keywords")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="required" for="meta_description">{{ __('Meta Description') }}</label>
                    <input class="form-control @error('meta_description') is-invalid @enderror" type="text" name="meta_description" id="meta_description" value="{{ old('meta_description', $post->meta_description) }}">
                    @error("meta_description")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <select class="form-control" name="status">
                        <option value="draft" @if($post->status == "draft") selected @endif>{{ __("Draft") }}</option>
                        <option value="published" @if($post->status == "published") selected @endif>{{ __("Published") }}</option>
                      </select>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" @if($post->is_featured) checked @endif>
                    <label class="form-check-label ml-2" for="is_featured">{{ __("Featured") }}</label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" @if($post->is_active) checked @endif>
                    <label class="form-check-label ml-2" for="is_active">{{ __("Active") }}</label>
                  </div>

                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        {{ __('Save') }}
                    </button>
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
    selector: '#content',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="{{ asset('js/tags-input.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $("#title").blur(function(e){
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
            media: @json($media) ?? {}
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
