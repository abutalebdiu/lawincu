@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Create Template") }}</title>
    <meta name="description" content="Create Template and Manage Template Details">
    <meta name="keywords" content="template,template_create">
@endsection

@push("head_tags")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="card">

    <div class="card-header">
        {{ trans('Create Template') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("email-templates.store") }}">
            @csrf

            <div class="mb-3">
                <label class="required" for="template_name">{{ __('Template Name') }}</label>
                <input class="form-control @error('template_name') is-invalid @enderror" type="template_name" name="template_name" id="template_name" value="{{ old('template_name', '') }}">
                @error("template_name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="content">{{ __("Content") }}</label>
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
                <button class="btn btn-primary" type="submit">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

</div>



@endsection


@push('body_scripts')
    <script src="https://cdn.tiny.cloud/1/uk57kx8225bu90dgs5yav45m4xtqeohx6okmiaiiukd893pr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function(){
            $(".select2").select2();
        });

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
