@extends('core::layouts.admin')


@section("meta_tags")
    <title>{{ __("Create Page") }}</title>
    <meta name="description" content="Create PageContent and Manage PageContent Details">
    <meta name="keywords" content="pagecontent,pagecontent_create">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ __("Create Page") }}
    </div>
    <div class="card-body">
        <div class="card-body">
            <form action="{{ route('pages.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="required" for="name">{{ __('Name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', '') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="page-url" class="form-label">{{ __("URL") }}</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="app-url">{{ config("app.url") }}/</span>
                        <input type="text" class="form-control @error('url') is-invalid @enderror" id="menu-url" name="url" value="{{ old('url') }}">
                        @error('url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="required" for="title">{{ __("SEO Title") }}</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="required" for="keywords">{{ __("SEO Keywords") }}</label>
                    <input type="text" class="form-control {{ $errors->has('keywords') ? 'is-invalid' : '' }}" type="text" name="keywords" id="keywords" value="{{ old('keywords', '') }}">
                    @if($errors->has('keywords'))
                        <div class="invalid-feedback">
                            {{ $errors->first('keywords') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="required" for="description">{{ __("SEO Description") }}</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" >{{ old('description', '') }}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="required" for="content">{{ __('Content') }}</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', '') }}</textarea>
                    @error("content")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="">{{ __("Status") }}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="is_active" type="checkbox" checked >
                        <label class="form-check-label ms-3" >{{ __("Active") }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="hidden" name="page_id" value="{{ request('page_id') }}">
                    <button class="btn btn-primary" type="submit">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>



@endsection


@push('body_scripts')

    <script src="https://cdn.tiny.cloud/1/uk57kx8225bu90dgs5yav45m4xtqeohx6okmiaiiukd893pr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
        language: 'en',
        selector: '#content',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        toolbar: [
            'ltr rtl | acelletags | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify',
            'outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl'
        ],
        plugins: 'fullpage print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        toolbar_location: 'top',
        menubar: true,
        statusbar: false,
        toolbar_sticky: true,
        height : "600"
    });
    </script>
@endpush
