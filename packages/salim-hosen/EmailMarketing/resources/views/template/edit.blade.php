@extends('core::layouts.admin')


@section("meta_tags")
<title>{{ __("Edit Template") }}</title>
    <meta name="description" content="Template Edit">
    <meta name="keywords" content="template,template_edit">
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        {{ trans('Edit Template') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("email-templates.update", $emailTemplate->id) }}">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label class="required" for="template_name">{{ __('Template Name') }}</label>
                <input class="form-control @error('template_name') is-invalid @enderror" type="template_name" name="template_name" id="template_name" value="{{ old('template_name', $emailTemplate->name) }}">
                @error("template_name")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="required" for="content">{{ __("Content") }}</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content', $emailTemplate->content) }}</textarea>
                @error("content")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="">{{ __("Status") }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="is_active" type="checkbox" @if($emailTemplate->is_active) checked @endif >
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
